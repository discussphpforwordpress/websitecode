<?php
class Membership_Gallery_Model_Gallery extends Membership_Base_Model_Base {
	private $galleryClass = 'SupsysticGallery';
	private $table;

	public function __construct($environment) {
		parent::__construct($environment);
		$this->table = $this->db->prefix . 'gg_membership_presets';
	}

	public function isPluginActive() {
		return class_exists($this->galleryClass);
	}

	public function getPluginInstallUrl() {
		return add_query_arg(
			array(
				's' => 'Photo+Gallery+by+Supsystic',
				'tab' => 'search',
				'type' => 'term',
			),
			admin_url( 'plugin-install.php' )
		);
	}

	public function getGalleryPresetsList() {
		$this->table = $this->db->prefix . 'gg_membership_presets';
	}
	
	public function getGalleryInfo() {
		$isActive = $this->isPluginActive();
		$presets = false;

		$dbName = $this->getDb()->dbname;
		$dbTablesNeed = array(
			$this->table,
			'{prefix}photo_gallery',
			'{prefix}photo_gallery_images',
		);

		if($isActive) {
			// from gallery version >= 1.9.19
			$tableExistsQuery =  $this->preparePrefix("SHOW TABLES WHERE `Tables_in_" . $dbName . "` IN ('" . implode("','", $dbTablesNeed) . "')");
			$results = $this->db->get_results($tableExistsQuery);

			if(count($results) == 3) {
				$presetQuery = "SELECT g.id, g.title FROM `" . $this->table . "` mp "
					. " LEFT JOIN `" . $this->db->prefix . "gg_galleries` g "
					. " ON g.id = mp.gallery_id "
					. " WHERE mp.allow_use = 1 "
					. " AND g.id IS NOT NULL ";
				$presets = $this->db->get_results($presetQuery);
			} else {
				$isActive = false;
			}
		}

		return array(
			'isPuliginActive' => $isActive,
			'installUrl' => $this->getPluginInstallUrl(),
			'installWpUrl' => 'https://wordpress.org/plugins/gallery-by-supsystic/',
			'presets' => $presets,
		);
	}

	public function getGalleryListJoinSettings($memberShipSettings) {

		$isActive = $this->isPluginActive();
		$dbName = $this->getDb()->dbname;
		$dbTablesNeed = array(
			$this->table,
			'{prefix}photo_gallery',
			'{prefix}photo_gallery_images',
		);

		// from gallery version >= 1.9.19
		$tableExistsQuery =  $this->preparePrefix("SHOW TABLES WHERE `Tables_in_" . $dbName . "` IN ('" . implode("','", $dbTablesNeed) . "')");
		$results = $this->db->get_results($tableExistsQuery);

		if(count($results) == 3 && $isActive) {
			if($memberShipSettings != null
				&& isset($memberShipSettings['enabled'])
				&& $memberShipSettings['enabled'] == 1
				&& isset($memberShipSettings['ids'])
				&& count($memberShipSettings['ids'])) {

				$galleryIds = array();
				foreach($memberShipSettings['ids'] as $elem) {
					$galleryId = (int)$elem;
					if($galleryId) {
						$galleryIds[] = $elem;
					}
				}

				if(count($galleryIds)) {
					$presetQuery = "SELECT g.id, g.title FROM `" . $this->table . "` mp "
						. " LEFT JOIN `" . $this->db->prefix . "gg_galleries` g "
						. " ON g.id = mp.gallery_id "
						. " WHERE mp.allow_use = 1 AND g.id IN (" . implode(',', $galleryIds) . ")";
					$presets = $this->db->get_results($presetQuery);
					return $presets;
				}
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

	public function getDefaultGalleryImageUrl() {
		$strImageUrl = $this->getPluginPath(1) . 'src/Membership/Gallery/assets/img/photo-gallery-types.png';
		return $strImageUrl;
	}
}