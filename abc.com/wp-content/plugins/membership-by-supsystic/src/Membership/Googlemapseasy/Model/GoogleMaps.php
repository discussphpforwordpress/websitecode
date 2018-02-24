<?php
class Membership_Googlemapseasy_Model_GoogleMaps extends Membership_Base_Model_Base {
	private $googleMapsClass = 'frameGmp';
	private $table;

	public function __construct($environment) {
		parent::__construct($environment);
		$this->table = $this->db->prefix . 'gmp_membership_presets';
	}

	public function isPluginActive() {
		return class_exists($this->googleMapsClass);
	}

	public function checkPluginRequiments() {
		$isActive = $this->isPluginActive();
		$dbName = $this->getDb()->dbname;
		$dbTablesNeed = array(
			$this->table,
			'{prefix}google_maps_easy',
		);

		if($isActive) {
			// from googleMaps version >= 1.7.6
			$tableExistsQuery = $this->preparePrefix("SHOW TABLES WHERE `Tables_in_" . $dbName . "` IN ('" . implode("','", $dbTablesNeed) . "')");
			$results = $this->db->get_results($tableExistsQuery);
			if(count($results) > 1) {
				return true;
			}
		}
		return false;
	}

	public function getPluginInstallUrl() {
		return add_query_arg(
			array(
				's' => 'Google+Maps+Easy',
				'tab' => 'search',
				'type' => 'term',
			),
			admin_url( 'plugin-install.php' )
		);
	}

	public function getGoogleMapsInfo() {
		$isActive = $this->isPluginActive();
		$presets = false;

		$dbName = $this->getDb()->dbname;
		$dbTablesNeed = array(
			$this->table,
			'{prefix}google_maps_easy',
		);

		if($isActive) {
			// from googleMaps version >= 1.7.6
			$tableExistsQuery =  $this->preparePrefix("SHOW TABLES WHERE `Tables_in_" . $dbName . "` IN ('" . implode("','", $dbTablesNeed) . "')");
			$results = $this->db->get_results($tableExistsQuery);

			if(count($results) > 1) {
				$presetQuery = "SELECT m.id, m.title FROM `" . $this->table . "` mp "
					. " LEFT JOIN `" . $this->db->prefix . "gmp_maps` m "
					. " ON m.id = mp.maps_id "
					. " WHERE mp.allow_use = 1 "
					. " AND m.id is not null ";

				$presets = $this->db->get_results($presetQuery);
			} else {
				$isActive = false;
			}
		}

		return array(
			'isPuliginActive' => $isActive,
			'installUrl' => $this->getPluginInstallUrl(),
			'installWpUrl' => 'https://wordpress.org/plugins/google-maps-easy/',
			'presets' => $presets,
		);
	}

	public function getActivePresets($memberShipSettings) {
		if($memberShipSettings
			&& isset($memberShipSettings['enabled'])
			&& $memberShipSettings['enabled'] == 1
			&& isset($memberShipSettings['ids'])
			&& count($memberShipSettings['ids'])) {

			$googleMapsIds = array();
			foreach($memberShipSettings['ids'] as $elem) {
				$googleMapsId = (int)$elem;
				if($googleMapsId) {
					$googleMapsIds[] = $elem;
				}
			}

			if(count($googleMapsIds)) {
				$presetQuery = "SELECT m.id, m.title FROM `" . $this->table . "` mp "
					. " LEFT JOIN `" . $this->db->prefix . "gmp_maps` m "
					. " ON m.id = mp.maps_id "
					. " WHERE mp.allow_use = 1 "
					. " AND m.id IN (" . implode(',', $googleMapsIds) . ");";

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

	public function getDefaulImageUrl() {
		$gmpModule = $this->getModule('GoogleMapsEasy');
		$strImageUrl = $gmpModule->getAssetsPath() . '/img/frontend-google-maps-icon.png';
		return $strImageUrl;
	}
	
	public function getGoogleMapsEasyIconList() {
		if(class_exists('frameGmp')) {
			$gmpFrame = frameGmp::getInstance();
			if($gmpFrame) {
				$gmpModel = $gmpFrame->getModule('icons')->getModel();
				if($gmpModel) {
					return $gmpModel->getIcons(array('fields' => 'id, path, title'));
				}
			}
		}
		return null;
	}
	
	public function getDefaultIconUrl() {
		if(class_exists('frameGmp')) {
			$gmpFrame = frameGmp::getInstance();
			if($gmpFrame) {
				return $gmpFrame->getPluginUrl() . '/modules/icons/icons_files/def_icons/marker.png';
			}
		}
		return '';
	}
	
	public function initGoogleMapsHtml($presets) {
		$resArr = array();
		if(class_exists('frameGmp')) {
			$frameGmp = frameGmp::getInstance();
			$gmapModule = $frameGmp->getModule('gmap');

			foreach($presets as $onePreset) {
				//var_dump($onePreset->id); echo "<br/>";
				$resArr[$onePreset->id] = $gmapModule->drawMapFromShortcode(array(
					'id' => $onePreset->id,
					'membership-integrating' => 1,
				));
			}
		}
		return $resArr;
	}
}