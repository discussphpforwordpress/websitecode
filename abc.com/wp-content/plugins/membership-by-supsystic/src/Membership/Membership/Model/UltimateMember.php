<?php

class Membership_Membership_Model_UltimateMember extends Membership_Base_Model_Base {

	public function getFields() {

		$forms = $this->getData("
			SELECT
				p.ID, p.post_title as title, pm.meta_value as fields
			FROM
				{wp_prefix}posts AS p
			LEFT JOIN {wp_prefix}postmeta as pm ON (pm.post_id = p.ID AND pm.meta_key = '_um_custom_fields')
			JOIN {wp_prefix}postmeta as pm2 ON (pm2.post_id = p.ID AND pm2.meta_key = '_um_mode' AND pm2.meta_value = 'profile')
			WHERE
				post_type = 'um_form'
		");

		$_fields = array();

		if ($forms) {
			foreach ($forms as $form) {
				$_fields[$form['title']] = unserialize($form['fields']);
			}
		}

		return $_fields;
	}

	public function getTypesConversion() {
		return array(
			'text' => 'text',
			'url' => 'text',
			'number' => 'numeric',
			'textarea' => 'text',
			'select' => 'drop',
			'multiselect' => 'scroll',
			'radio' => 'radio',
			'checkbox' => 'checkbox',
			'password' => 'password',
			'image' => 'text',
			'file' => 'text',
			'date' => 'date',
			'time' => 'text',
			'rating' => 'text',
			'googlemap' => 'text',
			'youtube_video' => 'text',
			'vimeo_video' => 'text',
			'soundcloud_track' => 'text',
		);
	}

	/**
	 * Convert UM user fields to Membership fields format.
	 *
	 * @param $rawFields
	 *
	 * @return array
	 */
	public function prepareFieldsForMerge($rawFields) {

		if (!$rawFields) {
			return $rawFields;
		}

		$fields = array();
		$typesConversion = $this->getTypesConversion();

		foreach ($rawFields as $formName => $_fields) {
			foreach ($_fields as $field) {

				/*
				 * Skip um special and default wordpress fields
				 */
				if (in_array($field['type'],
						array(
							'divider',
							'block',
							'shortcode',
							'spacing',
							'row',
						)
				    ) || in_array($field['metakey'],
						array(
							'role_select',
							'role_radio',

							'first_name',
							'last_name',
							'user_password',
							'user_login',
							'username',
							'user_email',
							'user_registered',
							'last_login',
							'nickname'
						)
				    )) {
					continue;
				}

				$fields[$field['metakey']] = array(
					'label' => $field['title'],
					'name' => $field['metakey'],
					'description' => @$field['help'],
					'type' => $typesConversion[$field['type']],
					'enabled' => true,
					'required' => intval($field['required']) === 1,
					'registration' => intval($field['required']) === 1,
					'section' => $formName
				);

				if (in_array($field['type'], array('select', 'multiselect', 'radio', 'checkbox'))) {
					$options = array();

					foreach ($field['options'] as $id => $name) {
						$options[] = array(
							'id' => (string) $id,
							'name' => (string) $name
						);
					}

					$fields[$field['metakey']]['options'] = $options;
				}

			}
		}

		return $fields;
	}


	/**
	 * Insert  Ultimate member fields to membership fields table
	 */
	public function insertFields($fields) {

		$fieldNames = array_keys($fields);
		$fieldNamesPlaceholder = array_pad(array(), count($fieldNames), '%s');
		$fieldNamesPlaceholder = implode(',', $fieldNamesPlaceholder);

		/**
		 * Insert field only if user provide some data
		 */
		return $this->query($this->db->prepare($this->preparePrefix("
			INSERT IGNORE INTO {prefix}fields (user_id, name, privacy)
				SELECT
				    um.user_id,
				    um.meta_key AS name,
				    'public' AS privacy
				FROM
				    {wp_base_prefix}usermeta AS um
			    WHERE um.meta_key IN (${fieldNamesPlaceholder})
			    AND um.meta_value IS NOT NULL
	            AND um.meta_value != ''
		"), $fieldNames));
	}
	/**
	 * Insert Ultimate member fields data to membership fields data table
	 */
	public function insertFieldsData($fields) {

		$fieldNames = array_keys($fields);
		$fieldNamesPlaceholder = array_pad(array(), count($fieldNames), '%s');
		$fieldNamesPlaceholder = implode(',', $fieldNamesPlaceholder);

		/**
		 * Remove all Ultimate Member fields data to avoid duplicate if it's run more than once
		 */
		$this->query($this->db->prepare("
			DELETE FROM {prefix}fields_data WHERE field_id IN (
				SELECT
				    f.id
				FROM
				    {prefix}fields AS f
				WHERE
	                f.name IN (${fieldNamesPlaceholder})
	        )
		", $fieldNames));

		$singleValueFields = array();
		$multipleValueFields = array();

		foreach ($fields as $field) {
			if (isset($field['options'])) {
				$multipleValueFields[$field['name']] = $field;
			} else {
				$singleValueFields[$field['name']] = $field;
			}
		}

		$fieldNamesPlaceholder = array_pad(array(), count($singleValueFields), '%s');
		$fieldNamesPlaceholder = implode(',', $fieldNamesPlaceholder);

		/**
		 * Insert field with single value.
		 */
		$this->query($this->db->prepare("
     	  	INSERT INTO {prefix}fields_data (field_id, data)
			SELECT
			    f.id,
                um.meta_value
			FROM
				{prefix}fields AS f
				LEFT JOIN {wp_base_prefix}usermeta AS um ON (um.user_id = f.user_id AND um.meta_key = f.name)
			WHERE
                f.name IN (${fieldNamesPlaceholder})
		", array_keys($singleValueFields)));


		/**
		 * Insert fields with optional values.
		 */
		foreach ($multipleValueFields as $field) {

			$possibleValues = array();

			foreach ($field['options'] as $option) {
				$possibleValues[] = $this->db->prepare("SELECT '%s' AS id, '%s' AS name", array(
					$option['id'],
					$option['name'],
				));
 			}

 			$possibleValuesSelect = "SELECT * FROM (" . implode(' UNION ALL ', $possibleValues) . ") AS fieldOptions";
			$joinOn = 'um.meta_value = fo.name';
			if (in_array($field['type'], array('scroll', 'checkbox', 'radio'))) {
				// For serialized values
				$joinOn = "um.meta_value RLIKE CONCAT('\"', fo.name, '\"')";
			}

			$this->query($this->db->prepare("
				INSERT INTO {prefix}fields_data (field_id, data)
					SELECT
						f.id AS field_id,
					    fo.id AS data
					FROM
						{wp_base_prefix}usermeta AS um
					    JOIN (
						    SELECT * FROM ($possibleValuesSelect) AS fieldOptions
					    ) AS fo ON ($joinOn)
					    JOIN {prefix}fields AS f ON (f.name = um.meta_key AND f.user_id = um.user_id)
					WHERE
						um.meta_key = '%s'
			", $field['name']));
		}

	}


}