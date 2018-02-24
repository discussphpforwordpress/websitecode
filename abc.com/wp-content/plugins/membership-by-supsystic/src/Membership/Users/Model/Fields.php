<?php

class Membership_Users_Model_Fields extends Membership_Base_Model_Settings {

	const STATUS_EMAIL_NOT_CONFIRMED = -5;
	const STATUS_DELETED = -4;
	const STATUS_REJECTED = -3;
    const STATUS_DISABLED = -2;
    const STATUS_PENDING_REVIEW = -1;
    const STATUS_ACTIVE = 0;

	protected $settingField = 'fields';

	public function getFields($params = array()) {
		$fields = current($this->get($this->settingField));

		if (! $fields) {
			$fields = array();
		}

        $_fields = array();
		$dateFormats = self::getDateFormats();
		foreach ($fields as $field) {
            if ($field['type'] == 'g-recaptcha-response') {
                $field['name'] = 'g-recaptcha-response';
            }

			if ($field['type'] == 'date') {
				$field['date-format'] = isset($field['date-format']) ? $field['date-format'] : 0;
				$field['format'] = $dateFormats[$field['date-format']]['value'];
			}

            $_fields[] = $field;
        }

		return $this->extendSystemFields($_fields, $params);
	}

	public function loadFieldsAssets($fields) {

		$styles = array();
		$scripts = array();
		$baseModule = $this->getModule('Base');
		$baseModuleAssets = $baseModule->getAssetsPath();


		foreach ($fields as $field) {
			if ($field['type'] == 'g-recaptcha-response') {
				$scripts[] = 'https://www.google.com/recaptcha/api.js';
			}

			if ($field['type'] == 'date') {
				$styles[] = $baseModuleAssets . '/lib/pikaday/css/pikaday.css';
				$scripts[] = $baseModuleAssets . '/lib/pikaday/pikaday.js';
			}
		}

		return array(
			'styles' => $styles,
			'scripts' => $scripts
		);
	}

	public function getRegistrationFields($params = array()) {
		$_fields = $this->getFields($params);
		$fields = array();

		foreach ($_fields as $field) {
			if ($field['enabled'] && (!empty($field['registration']) || !empty($field['required']))) {
				$fields[] = $field;
			}
		}

		return $fields;
	}


	/**
	 * Return date formats according to Moment.js display formats
	 *
	 * @return mixed|array $dateFormats
	 */
	public static function getDateFormats() {

		return array(
			0 => array(
				'text' => 'DD MM YYYY',
				'value' => 'DD MM YYYY',
			),
			1 => array(
				'text' => 'MM/DD/YYYY',
				'value' => 'MM/DD/YYYY',
			),
			2 => array(
				'text' => 'MMMM D YYYY',
				'value' => 'MMMM D YYYY',
			),
			3 => array(
				'text' => 'MM DD YYYY',
				'value' => 'MM DD YYYY',
			)
		);
	}

	private function getSystemFields( $params = array() ) {

		$params['exclude_password'] = isset($params['exclude_password']) ? $params['exclude_password'] : false;
		// Add here all fields, that is included by WP in user profile by default
		$res = array(
			array('name' => 'user_login', 'label' => $this->environment->translate('User Name'), 'enabled' => true, 'required' => true, 'type' => 'text', 'registration' => true, 'section' => 'Main'),
			array('name' => 'first_name', 'label' => $this->environment->translate('First Name'), 'enabled' => true, 'required' => false, 'type' => 'text', 'registration' => true, 'section' => 'Main'),
			array('name' => 'last_name', 'label' => $this->environment->translate('Last Name'), 'enabled' => true, 'required' => false, 'type' => 'text', 'registration' => true, 'section' => 'Main'),
			array('name' => 'user_email', 'label' => $this->environment->translate('E-mail'), 'enabled' => true, 'required' => true, 'type' => 'email', 'registration' => true, 'section' => 'Main'),
			array('name' => 'user_pass', 'label' => $this->environment->translate('Password'), 'enabled' => true, 'required' => true, 'type' => 'password', 'registration' => true, 'section' => 'Main'),
			array('name' => 'user_pass_confirm', 'label' => $this->environment->translate('Password Confirmation'), 'enabled' => true, 'required' => true, 'type' => 'password', 'registration' => true, 'section' => 'Main'),
		);
		if($params['exclude_password']) {
			for($i = 0; $i < count($res); $i++) {
				if(in_array($res[ $i ]['name'], array('user_pass', 'user_pass_confirm'))) {
					$res[ $i ] = false;	//array_filter will remove then all empty values
				}
			}
			$res = array_filter($res);
		}

		if (isset($params['include_user_status']) && $params['include_user_status']) {
		    $res[] = array(
                'name' => 'user_status',
                'label' => $this->environment->translate('Status'),
                'enabled' => true,
                'required' => true,
                'type' => 'drop',
                'options' => array(
	                array(
		                'id' => self::STATUS_DELETED,
		                'name' => 'Deleted'
	                ),
	                array(
		                'id' => self::STATUS_REJECTED,
		                'name' => 'Rejected'
	                ),
                    array(
                        'id' => self::STATUS_DISABLED,
                        'name' => 'Disabled'
                    ),
                    array(
                        'id' => self::STATUS_PENDING_REVIEW,
                        'name' => 'Pending review'
                    ),
                    array(
                        'id' => self::STATUS_ACTIVE,
                        'name' => 'Active'
                    )
                ),
                'data' => array($params['user_status_value'])
            );
        }

        if (isset($params['include_user_role']) && $params['include_user_role']) {
		    $roles = $this->getModel('roles', 'roles')->getRoles();
		    $rolesOptions = array();

		    foreach ($roles as $role) {
		        $rolesOptions[] = array(
                    'id' => $role['id'],
                    'name' => $role['name']
                );
		    }

		    $userRoleParam = array(
                'name' => 'user_role',
                'label' => $this->environment->translate('Role'),
                'enabled' => true,
                'required' => true,
                'type' => 'drop',
                'options' => $rolesOptions,
                'data' => isset($params['user_role_value']) ? array($params['user_role_value']) : null,
            );
			// set default field params for register page
			if(isset($params['include_user_role']['enabled']) && $params['include_user_role']['enabled'] === false) {
				$userRoleParam['enabled'] = false;
				$userRoleParam['section'] = 'Main';
				// $userRoleParam['description'] = $this->environment->translate('User Role List');
				$userRoleParam['registration'] = true;
				$userRoleParam['asterisk'] = false;
				// remove data for correct in registration ("checked" parameter)
				unset($userRoleParam['data']);
			}
			$res[] = $userRoleParam;
		}

		$countries = $this->getModel('countries', 'users')->getCountries();
		$countryOptions = array();
		foreach ($countries as $country) {
			$aliasPrepare = mb_convert_encoding($country, 'UTF-8' );
			$alias = strtolower($this->getModule('base')->translateCyrillicToLatin(
				preg_replace('/[^\w0-9]/u', '_', $aliasPrepare)
			));
			$countryOptions[] = array(
				'id' => $alias,
				'name' => $country
			);
		}
		$countryParam = array(
			'name' => 'country',
			'label' => $this->environment->translate('Country'),
			'enabled' => true,
			'required' => false,
			'type' => 'drop',
			'options' => $countryOptions,
			'section' => 'Main',
			'asterisk' => false,
			'customValidation' => true,
		);



		foreach($res as $i => $f) {
			$res[ $i ]['sys'] = 1;
		}

		$res[] = $countryParam;

		return $res;
	}

	private function extendSystemFields( $fields, $params = array() ) {
		$sysFields = $this->getSystemFields( $params );
		$sysFieldsNames = $savedFieldsNames = array();

		foreach($sysFields as $i => $f) {
			$sysFieldsNames[ $f['name'] ] = $i;
		}

		foreach($fields as &$f) {
			if(isset($f['sys']) && isset($sysFieldsNames[ $f['name'] ])) {
				unset( $sysFieldsNames[ $f['name'] ] );
			}

			$f['customValidation'] = true;
		}

		// Some system fields are not present in fields list - let's add them here
		if(!empty($sysFieldsNames)) {
			foreach($sysFieldsNames as $fName => $fIter) {
				$fields[] = $sysFields[ $fIter ];
			}
		}

		return $fields;
	}

	/**
	 * @param $fields
	 * @param bool $secretSafe Means that the data will not be shown to the end user in reason that field can contain secret api keys etc...
	 *
	 * @return array
	 */
	public function getFieldsValidationRules($fields, $secretSafe = false) {

		$rules = array();

		foreach($fields as $field) {
			$fieldRules = array();

			if (isset($field['required']) && $field['required']) {

				$fieldRules['presence'] = array(
					'message' => sprintf($this->environment->translate("%s is required and can't be empty"), $field['label'])
				);

				if ($field['type'] == 'email') {
					$fieldRules['email'] = array(
						'message' => sprintf($this->environment->translate("%s is not valid email"), $field['label'])
					);
				}

				if (in_array($field['type'],  array('scroll', 'checkbox', 'radio'))) {
					$fieldRules['presence'] = array(
						'message' => sprintf($this->environment->translate("Please select at least one option"), $field['label'])
					);
				}
			}

			if ($field['name'] === 'g-recaptcha-response') {

				if ($secretSafe) {
					$fieldRules['recaptcha'] = array(
						'message' => $this->translate('Captcha response error.'),
						'secret' => $field['google-re-captcha-secret-key'],
						'remoteip' => $this->getModule('Base')->getClientIP()
					);
				} else {
					$fieldRules['presence'] = array(
						'message' => $this->translate('Please fill up the captcha.')
					);
				}
			}

			if ($field['name'] === 'user_pass_confirm') {
				$fieldRules['equality'] = array(
					'attribute' => 'user_pass',
					'message' => $this->environment->translate("Password and password confirmation not match.")
				);
 			}

			if (!empty($fieldRules)) {
				$rules[$field['name']] = $fieldRules;
			}
		}

		return $rules;
	}

	public function getFieldsList($exclude = array()) {
		$fieldsList = array();
		foreach ($this->getFields() as $field) {
			if (!in_array($field['name'], $exclude)) {
				$fieldsList[$field['name']] = $field;
			}
		}
		return $fieldsList;
	}

	public function saveFields($fields) {
		$allFields = array();

		foreach ($fields as $field) {
			$allFields[] = $field['name'];
		}

		function toBolean(&$value) {
			if (in_array($value, array('true', 'false'))) {
				$value = $value == 'true' ? true : false;
			}
		}

		array_walk_recursive($fields, 'toBolean');


		$this->set($fields, $this->settingField);
	}

//	public function getValidationRules($fields) {
//
//		$rules = array();
//
//		$environment = $this->environment;
//
//		foreach ($fields as $field) {
//			$validationRules = array();
//
//			if ($field['required']) {
//				$validationRules['presence'] = array(
//					'message' => implode('', array(
//						$environment->translate($field['label']),
//						' ',
//						$environment->translate('is required')
//					)),
//				);
//			}
//
//			switch ($field['type']) {
//				case 'email':
//					$validationRules['email'] = array(
//						'message' => $environment->translate('Email is not valid.')
//					);
//				break;
//                case 'g-recaptcha-response':
//                    $validationRules['g-recaptcha-response'] = array(
//                        'message' => $environment->translate('ReCaptcha is not valid.')
//                    );
//                    break;
//			}
//
//			$rules[$field['name']] = $validationRules;
//		}
//
//		return $rules;
//	}

	public function createUserFieldsData($userId, $fieldsData) {

		foreach ($fieldsData as $name => $data) {

			$query = $this->preparePrefix("
				INSERT INTO {prefix}fields
					(`user_id`, `name`, `privacy`)
				VALUES
					('%d', '%s', 'public')
			");

			$this->db->query(
				$this->db->prepare(
					$query, array($userId, $name)
				)
			);

			$fieldId = $this->db->insert_id;

			if ($fieldId) {
				$this->insertFieldDataValues($fieldId, $data);
			}
		}
	}

	private function insertFieldDataValues($fieldId, $data)
	{
		$values = array();
		$placeHolders = array();

		$query = $this->preparePrefix("
			INSERT INTO {prefix}fields_data
				(`field_id`, `data`)
			VALUES 
		");

		if (is_array($data)) {
			foreach ($data as $value) {
				$placeHolders[] = "('%d', '%s')";
				array_push($values, $fieldId, $value);
			}
		} else {
			$placeHolders[] = "('%d', '%s')";
			array_push($values, $fieldId, $data);
		}

		$query .= implode(', ', $placeHolders);

		$this->db->query(
			$this->db->prepare($query, $values)
		);
	}

	private function getFieldIdByName($userId, $fieldName) {
		$query = $this->preparePrefix("
			SELECT id FROM {prefix}fields
			WHERE user_id = '%d' AND name = '%s'
		");

		return $this->db->get_var(
			$this->db->prepare($query, array($userId, $fieldName))
		);
	}

	private function deleteFieldData($fieldId) {
		$query = $this->preparePrefix("
			DELETE FROM {prefix}fields_data
			WHERE field_id = '%d'
		");

		return $this->db->query(
			$this->db->prepare($query, array($fieldId))
		);
	}

	public function updateUserFieldData($userId, $fieldName, $fieldData) {

		$fieldId = intval($this->getFieldIdByName($userId, $fieldName));

		if (! $fieldId) {
			$this->createUserFieldsData($userId, array(
				$fieldName => $fieldData
			));
		} else {
			$this->deleteFieldData($fieldId);
			$this->insertFieldDataValues($fieldId, $fieldData);
		}
	}

	public function getUserFieldsData($userId, $exclude = array(), $params = array()) {

		$allFields = $this->getFields($params);

		$userFields = array();

		if (! $allFields) {
			return array();
		}

		$dataSeparator = '<d-separate>';	// You can't use here simple separators - like "|" - what if it will be in field value, entered by user?

		if (null !== $userId) {
			$query = $this->preparePrefix("
				SELECT 
				f.*,
					GROUP_CONCAT(fd.data ORDER BY fd.field_id ASC SEPARATOR '$dataSeparator') as data
				FROM
					{prefix}fields AS f
				LEFT JOIN
					{prefix}fields_data AS fd
						ON (f.id = fd.field_id)
				WHERE user_id = '%d'
				GROUP BY f.id
			");

			$fields = $this->db->get_results(
				$this->db->prepare($query, array($userId)),
				ARRAY_A
			);

			foreach ($fields as $field) {
				$data = $field['data'];
				if (strpos($data, $dataSeparator) !== false) {
					$data = explode($dataSeparator, $field['data']);
				}
				$userFields[$field['name']] = $data;
			}
		}


		$sections = array();

		$requestedUser = $this->getModel('Profile', 'Users')->getUserById($userId);

		foreach ($allFields as $key => &$field) {

			if (in_array($field['name'], $exclude)) {
				unset($allFields[$key]);
				continue;
			}

			if (isset($userFields[$field['name']])) {
				$field['data'] = $userFields[$field['name']];
			} else if ($field['name'] != 'user_status' && $field['name'] != 'user_role') {
				$field['data'] = null;
			}

			if ($field['name'] === 'user_login') {
				$field['data'] = $requestedUser['user_login'];
			}
			if ($field['name'] === 'user_status' && isset($params['user_status_value'])) {
				$field['data'] = array($params['user_status_value']);
			}

			if ($field['name'] === 'user_role' && isset($params['user_role_value'])) {
				$field['data'] = array($params['user_role_value']);
			}

			if (isset($field['section']) && !in_array($field['section'], $sections)) {
				$sections[] = $field['section'];
			}

			if ($field['name'] === 'first_name') {
				$field['data'] = $requestedUser['firstName'];
			}

			if ($field['name'] === 'last_name') {
				$field['data'] = $requestedUser['lastName'];
			}

			if ($field['type'] === 'date') {
				if  ($field['data']) {
					$field['timestamp'] = $field['data'];
					$date = strtotime($field['data']);
					$field['data'] = date($this->convertMomentToPHPFormat($field['format']),  $date);
				}
			}
			if($field['name'] == 'user_role') {
				$field['data'] = $requestedUser['role_id'];
			}
		}

		return array(
			'fields' => $allFields,
			'sections' => $sections
		);

	}

	function convertMomentToPHPFormat($format)
	{
		$replacements = array(
			'd' => 'DD',
			'D' => 'ddd',
			'j' => 'D',
			'l' => 'dddd',
			'N' => 'E',
			'S' => 'o',
			'w' => 'e',
			'z' => 'DDD',
			'W' => 'W',
			'F' => 'MMMM',
			'm' => 'MM',
			'M' => 'MMM',
			'n' => 'M',
			'o' => 'YYYY',
			'Y' => 'YYYY',
			'y' => 'YY',
			'a' => 'a',
			'A' => 'A',
			'g' => 'h',
			'G' => 'H',
			'h' => 'hh',
			'H' => 'HH',
			'i' => 'mm',
			's' => 'ss',
			'u' => 'SSS',
			'U' => 'X',
		);

		return strtr($format, array_flip($replacements));
	}

//	public function getUserFieldsDataValues( $userId ) {
//		$allFieldsData = $this->getUserFieldsData( $userId );
//		$allFieldsData = $allFieldsData['fields'];
//		if(!empty($allFieldsData)) {
//			$res = array();
//			foreach($allFieldsData as $f) {
//				$res[ $f['name'] ] = isset($f['data']) ? $f['data'] : '';
//			}
//			return $res;
//		}
//		return false;
//	}


	public function updateForUser( $userId, $fieldsData ) {
		foreach($fieldsData as $fName => $fData) {
			$this->updateUserFieldData( $userId, $fName, $fData );
		}
	}

	public function prepareDefaultRoleForRegistration($settings, &$fields) {
		if(isset($settings['default-role']) && count($fields)) {
			$settDefRoleId = (int) $settings['default-role'];
			// find system field with name 'user_role'
			foreach($fields as $oneFieldKey => $oneField) {
				if(!empty($oneField['name']) && $oneField['name'] == 'user_role' &&  $oneField['type'] == 'drop') {
					if(!empty($oneField['options']) && count($oneField['options'])) {
						// check every user role with settings value
						foreach($oneField['options'] as $oneUroKey => $oneUserRoleOpt) {
							if(isset($oneUserRoleOpt['id']) && $settDefRoleId == $oneUserRoleOpt['id']) {
								$fields[$oneFieldKey]['options'][$oneUroKey]['checked'] = 'checked';
							}
						}
					}
				}
			}
		}
		return true;
	}
}