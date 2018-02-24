<?php 

class Membership_Base_Validator {

	public $errors = array();
	//public $messages = array();
	public $input;

	// Old implementation - saved here just to check how it worked before
	/*public function validate($input, $validationRules, $messages = array())
	{
		$this->input = $input;
		$this->messages = $messages;

		foreach ($validationRules as $attribute => $rules) {

			if (!isset($this->input[$attribute])) {
				$this->errors[$attribute][] = 'Data is not provided';
				continue;
			}

			$rules = explode('|', $rules);

			foreach ($rules as $rule) {
				$method = $rule;
				$params = array($attribute);

				if (strpos($rule, ':') !== false) {
    				$rule = explode(':', $rule);
    				$method = $rule[0];
    				$params[] = $rule[1];
				}

				$result = call_user_func_array(array($this, $method), $params);

				if ($result === false) {
					$this->errors[$attribute][] = $this->messages[$attribute][$method];
				}

			}
		}

		return $this;
	}*/
	
	public function validate($input, $validationRules)
	{
		$this->input = $input;

		foreach ($validationRules as $attribute => $rules) {
			if (!isset($this->input[$attribute])) {
				$this->errors[$attribute][] = 'Data is not provided ' . $attribute;
				continue;
			}

			if(!is_array($rules)) {
				$rulesEx = explode('|', $rules);
				$rules = array();
				foreach($rulesEx as $rex) {
					$rules[ $rex ] = false;
				}
			}

			foreach($rules as $rule => $ruleData) {
				$params = array($attribute);

				if (strpos($rule, ':') !== false) {
    				$rule = explode(':', $rule);
    				$method = $rule[0];
    				$params[] = $rule[1];
				}

				$method = $rule;
				$params[] = $ruleData;
				
				$result = call_user_func_array(array($this, $method), $params);

				if ($result === false) {
					$this->errors[$attribute][] = $ruleData && $ruleData['message'] ? $ruleData['message'] : '';
				}
			}
		}
		return $this;
	}
	
	private function required($attribute)
	{
		$input = $this->input[$attribute];
		if (mb_strlen($input) === 0) {
			return false;
		};
	}
	
	// Just alias for required() method - for compatibility with js validator rule names
	private function presence($attribute) 
	{
		return $this->required( $attribute );
	}

	private function equality($attribute, $data) {
		return $this->input[$attribute] === $this->input[$data['attribute']];
	}

	private function max($attribute, $limit)
	{
		$input = $this->input[$attribute];
		if (mb_strlen($input) > $limit) {
			return false;
		};
	}

	private function min($attribute, $limit)
	{
		$input = $this->input[$attribute];
		if (mb_strlen($input) < $limit) {
			return false;
		};
	}

	private function email($attribute)
	{
		if (!filter_var($this->input[$attribute], FILTER_VALIDATE_EMAIL)) {
			return false;
		};
	}

	private function unique($attribute, $table)
	{
		//
	}
	private function size($attribute, $params) {
		$file = $this->input[$attribute];

		if ($file['size'] > $params['limit']) {
			return false;
		}
	}

	private function mimes($attribute, $params)
	{	
		$file = $this->input[$attribute];
		$allowedFormats = $params['formats'];

		$mimes = array(
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        );

		$file = $this->input[$attribute];

		if (!function_exists('exif_imagetype')) {
			function exif_imagetype($filename) {
				if ((list($width, $height, $type, $attr) = getimagesize($filename)) !== false) {
					return $type;
				}
				return false;
			}
		}

		$mimeType = image_type_to_mime_type(exif_imagetype($file['tmp_name']));
		$extension = strtolower(substr(strrchr($file['name'], "."), 1));

		if (!in_array($extension, $allowedFormats) || $mimes[$extension] !== $mimeType) {
			return false;
		}
	}

	public function isFail() {
		return count($this->errors) > 0;
	}

	public function isSuccess() {
		return !$this->isFail();
	}

	public function getErrors() {
		return $this->errors;
	}

	public function getErrorsList() {
		$errorsList = array();
		foreach ($this->getErrors() as $errors) {
			$errorsList = array_merge($errorsList, $errors);
		}
		return $errorsList;
	}

	public function recaptcha($attribute, $params) {

		$response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', array(
			'body' => array(
				'secret' => $params['secret'],
				'response' => $this->input[$attribute],
				'remoteip' => $params['remoteip'],
			),
		));

		if (!is_wp_error($response)) {
			if (isset($response['body']) && !empty($response['body']) && ($responseMessage = json_decode($response['body'], true))) {
				if ($responseMessage['success']) {
					return true;
				} else {
					$responseErrors = array(
						'missing-input-secret' => 'Google reCaptcha: The secret parameter is missing.',
						'invalid-input-secret' => 'Google reCaptcha: The secret parameter is invalid or malformed.',
						'missing-input-response' => 'Google reCaptcha: The response parameter is missing.',
						'invalid-input-response' => 'Google reCaptcha: The response parameter is invalid or malformed.',
					);

					foreach($responseMessage['error-codes'] as $errorCode) {
						if (isset($responseErrors[$errorCode])) {
							$this->errors[$attribute][] = $responseErrors[$errorCode];
						}
					}
				}
			} else {
				$this->errors[$attribute][] = 'Wrong response from Google ReCaptcha validation server.';
			}
		} else {
			$this->errors[$attribute][] = $response->get_error_message();
		}

		return false;

	}

}