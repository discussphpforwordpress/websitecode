<?php
class Membership_ContactForm_Model_ContactForm extends Membership_Base_Model_Base {

	public function isPluginActive() {
		return class_exists('frameCfs');
	}

	public function getPluginInstallUrl() {
		return add_query_arg(
			array(
				's' => 'Contact+Form+By+Supsystic',
				'tab' => 'search',
				'type' => 'term',
			),
			admin_url( 'plugin-install.php' )
		);
	}

	public function getWpPluginInstallUrl() {
		return 'https://wordpress.org/plugins/contact-form-by-supsystic';
	}

	public function getContactFormPresets() {
		if($this->isPluginActive()) {
			$dbPrefix = $this->getDb()->prefix;
			$dbName = $this->getDb()->dbname;
			$dbTablesNeed = array(
				$dbPrefix . 'cfs_membership_presets',
			);

			$query = "SHOW TABLES WHERE `Tables_in_" . $dbName . "` IN ('" . implode("','", $dbTablesNeed) . "')";
			$results = $this->db->get_results($query);
			if(count($results)) {

				$presetQuery = "SELECT f.id, f.label
					FROM " . $dbPrefix . "cfs_forms f
					INNER JOIN " . $dbPrefix . "cfs_membership_presets mp
						ON mp.form_id = f.id
					WHERE mp.allow_use = 1";

				$presets = $this->db->get_results($presetQuery);
				if(count($presets)) {
					return $presets;
				} else {
					return null;
				}
			}
		}
		return false;
	}

	public function checkIdInPresets($id, $presetsObject) {
		$notFound = true;
		$i = 0;
		while($notFound && $i < count($presetsObject)) {
			if(property_exists($presetsObject[$i], 'id')) {
				if($presetsObject[$i]->id == $id) {
					$notFound = false;
				}
			}
			$i++;
		}
		return !$notFound;
	}
}