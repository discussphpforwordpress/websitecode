<?php

class Membership_Base_Model_Settings extends Membership_Base_Model_Base {

	protected $settingField = 'base';
	static private $_settingsModelAliases = array();
	public static $allSettings = array();

	public function settingsModelAliases() {
		if(empty(self::$_settingsModelAliases)) {
			self::$_settingsModelAliases = array(
				'base' => $this->getModel('settings', 'membership'),
				'profile' => $this->getModel('settings', 'users'),
				'fields' => $this->getModel('fields', 'users'),
			);
			self::$_settingsModelAliases = $this->environment->getDispatcher()->apply('settingsModelAliases', array( self::$_settingsModelAliases ));
		}
		return self::$_settingsModelAliases;
		/*$aliases = array(
			'base' => $this->getModel('settings', 'membership'),
			'profile' => $this->getModel('settings', 'users'),
			'fields' => $this->getModel('fields', 'users'),
		);

		return $this->environment->getDispatcher()->apply('settingsModelAliases', array($aliases));*/

		//return $aliases;	// ?:)
	}

	public function addModelAlias($alias, $model) {
		$aliases =  $this->settingsModelAliases();
		$aliases[$alias] = $model;
		self::$_settingsModelAliases = $aliases;
	}

	public function get($fields) {

		if (!is_array($fields)) {
			$fields = array($fields);
		}

		$query = $this->getQueryBuilder()
		->select('*')
		->from($this->getTable('settings'))
		->where('setting', 'in', rtrim(str_repeat('%s,', count($fields)), ','))
		->build();


		$results = $this->db->get_results(
			$this->db->prepare(
				$query, 
				$fields
			), 'OBJECT_K'
		);

		if ($results) {
			foreach ($results as &$row) {
				$row = @unserialize($row->value);
			}
		}

		$results = $this->mergeDefaultSettings($results, $fields);

		if ($this->db->last_error && $this->environment->isPluginPage()) {
			throw new RuntimeException($this->db->last_error);
		}



		return $results;
	}

	public function getAll() {

		if (!empty(self::$allSettings)) {
			/**
			 * Call merge default settings method in order to merge new settings that come from addModelAlias
			 */
			return $this->mergeDefaultSettings(self::$allSettings);
		}

		$results = $this->db->get_results(
			$this->getQueryBuilder()
				->select('*')
				->from($this->getTable('settings'))
				->build(),
			ARRAY_A
		);

		if ($this->db->last_error && $this->environment->isPluginPage()) {
			throw new RuntimeException($this->db->last_error);
		}

		$settings = array();

		if ($results) {
			foreach ($results as &$row) {
				$settings[$row['setting']] = @unserialize($row['value']);
			}
		}

		self::$allSettings = $this->mergeDefaultSettings($settings);

		return self::$allSettings;
	}

	public function set($value, $field) {
		$value = serialize($value);

		$query = $this->getQueryBuilder()
			->insertInto($this->getTable('settings'))
			->fields(array('setting', 'value'))
			->values(array('%s', '%s')) . ' ON DUPLICATE KEY UPDATE value = %s';

		$this->db->query(
			$this->db->prepare(
				$query, 
				array(
					$field,
					$value,
					$value,
				)
			)
		);

		if ($this->db->last_error) {
			throw new RuntimeException($this->db->last_error);
		}
	}

	public function getSettings() {
		return current($this->get($this->settingField));
	}

	public function saveSettings($settings) {
		$settings = $this->set($settings, $this->settingField);
	}

	protected function defaultSettings() {
		return array();
	}

	private function mergeDefaultSettings($settings, $fields = array()) {
		$modelAliases = $this->settingsModelAliases();

		foreach ($settings as $section => &$_settings) {
			if (isset($modelAliases[$section])) {
				$settingsModel = $modelAliases[$section];
			} else {
				try {
					$settingsModel = $this->getModel('settings', $section);
				} catch (Exception $e) {
					continue;
				}
			}

			$defaultSettings = $settingsModel->defaultSettings();

			if( $_settings ) {
				$settings[$section] = $this->arrayMergeRecursiveDistinct($defaultSettings, $_settings);
			}
		}

		foreach (array_keys($modelAliases) as $section) {
			if (
				(!isset($settings[$section]) || empty($settings[$section]))
				&& (empty($fields) || in_array($section, $fields))
			) {
				$settings[$section] = $modelAliases[$section]->defaultSettings();
			}
		}

		return $settings;
	}

	protected function arrayMergeRecursiveDistinct(array &$array1, array &$array2) {
		$merged = $array1;
		foreach ($array2 as $key => &$value)
		{
			if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
				$merged[$key] = $this->arrayMergeRecursiveDistinct($merged[$key], $value);
			} else {
				$merged[$key] = $value;
			}
		}
		return $merged;
	}
}