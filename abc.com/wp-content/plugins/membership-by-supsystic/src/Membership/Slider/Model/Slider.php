<?php
class Membership_Slider_Model_Slider extends Membership_Base_Model_Base {
	private $sliderClass = 'SupsysticSlider';
	private $table;

	public function __construct($environment) {
		parent::__construct($environment);
		$this->table = $this->db->prefix . 'rs_membership_presets';
	}

	public function isPluginActive() {
		return class_exists($this->sliderClass);
	}

	public function getPluginInstallUrl() {
		return add_query_arg(
			array(
				's' => 'Slider+by+Supsystic',
				'tab' => 'search',
				'type' => 'term',
			),
			admin_url( 'plugin-install.php' )
		);
	}

	public function getSliderInfo() {
		$isActive = $this->isPluginActive();
		$presets = false;

		$dbName = $this->getDb()->dbname;
		$dbTablesNeed = array(
			$this->table,
			'{prefix}slider',
			'{prefix}slider_images',
		);

		if($isActive) {
			// from slider version >= 1.7.1
			$tableExistsQuery =  $this->preparePrefix("SHOW TABLES WHERE `Tables_in_" . $dbName . "` IN ('" . implode("','", $dbTablesNeed) . "')");
			$results = $this->db->get_results($tableExistsQuery);

			if(count($results) == 3) {
				$presetQuery = "SELECT s.id, s.title FROM `" . $this->table . "` mp "
					. " LEFT JOIN `" . $this->db->prefix . "rs_sliders` s "
					. " ON s.id = mp.slider_id "
					. " WHERE mp.allow_use = 1 "
					. " AND s.id is not null ";
				$presets = $this->db->get_results($presetQuery);
			} else {
				$isActive = false;
			}
		}

		return array(
			'isPuliginActive' => $isActive,
			'installUrl' => $this->getPluginInstallUrl(),
			'installWpUrl' => 'https://wordpress.org/plugins/slider-by-supsystic/',
			'presets' => $presets,
		);
	}

	public function getSliderListJoinSettings($memberShipSettings) {

		$isActive = $this->isPluginActive();
		$dbName = $this->getDb()->dbname;
		$dbTablesNeed = array(
			$this->table,
			'{prefix}slider',
			'{prefix}slider_images',
		);

		$tableExistsQuery =  $this->preparePrefix("SHOW TABLES WHERE `Tables_in_" . $dbName . "` IN ('" . implode("','", $dbTablesNeed) . "')");
		$results = $this->db->get_results($tableExistsQuery);

		if(count($results) == 3 && $isActive) {
			return $this->getActivePresets($memberShipSettings);
		}
		return false;
	}

	public function getActivePresets($memberShipSettings) {
		if($memberShipSettings != null
			&& $this->isPluginActive()
			&& isset($memberShipSettings['enabled'])
			&& $memberShipSettings['enabled'] == 1
			&& isset($memberShipSettings['ids'])
			&& count($memberShipSettings['ids'])) {

			$sliderIds = array();
			foreach($memberShipSettings['ids'] as $elem) {
				$sliderId = (int)$elem;
				if($sliderId) {
					$sliderIds[] = $elem;
				}
			}

			if(count($sliderIds)) {
				$presetQuery = "SELECT s.id, s.title FROM `" . $this->table . "` mp "
					. " LEFT JOIN `" . $this->db->prefix . "rs_sliders` s "
					. " ON s.id = mp.slider_id "
					. " WHERE mp.allow_use = 1 AND s.id IN (" . implode(',', $sliderIds) . ")";
				$presets = $this->db->get_results($presetQuery);
				return $presets;
			}
		}
		return false;
	}

	public function getPluginPath($getUrl = null) {
		$config = $this->environment->getConfig();
		$pluginPath = $config->get('plugin_path');
		if($getUrl) {
			return plugin_dir_url($config->get('plugin_basename'), realpath($pluginPath));
		}
		return $pluginPath;
	}

	public function getDefaultSliderImageUrl() {
		$strImageUrl = $this->getPluginPath(1) . 'src/Membership/Slider/assets/img/mbs_slider_logo.png';
		return $strImageUrl;
	}
}