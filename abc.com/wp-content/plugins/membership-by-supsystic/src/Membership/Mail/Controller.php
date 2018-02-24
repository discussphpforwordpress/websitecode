<?php

class Membership_Mail_Controller extends Membership_Base_Controller
{

	public function indexAction(Rsc_Http_Request $request)
	{
		$settings = $this->getModel('Settings', 'Mail')->getSettings();

		return $this->response(
			'@mail/backend/index.twig',
			array(
				'settings' => $settings
			)
		);
	}

	public function saveSettings($request) 
	{
		$settings = $request->get('settings');
		$this->getModel('Settings', 'Mail')->saveSettings($settings);
	}


	public function sendTestMail($request)
	{
		$id = $request->get('id');
		$settings = $this->getModule('Base')->getSettings();
		$to = $settings['base']['main']['admin-email'];
		$subject = $this->translate('Test mail');
		$message = $this->translate('Test');

		if ($id) {
			$subject = isset($settings['mail']['emails'][$id. '-subject'])
				? $settings['mail']['emails'][$id. '-subject']
				: $settings['mail']['notifications'][$id. '-subject'];
			$message = isset($settings['mail']['emails'][$id. '-body'])
				? $settings['mail']['emails'][$id. '-body']
				: $settings['mail']['notifications'][$id. '-body'];
		}

		$result = $this->getDispatcher()->apply('sendEmail', array(
			'to' => $to,
			'subject' => $subject,
			'message' => $message,
			'options' => array(
				'variables' => array(
					'site_name' => get_bloginfo('sitename'),
					'display_name' => $this->translate('Test user'),
					'admin_email' => get_bloginfo('admin_email'),
					'account_activation_link' => home_url(). '/account_activation_link/',
					'user_profile_link' => home_url(). '/user_profile_link/',
					'login_url' => $this->getModule('routes')->getRouteUrl('login'),
					'password_change_url' => home_url(). '/password_change_url/',
					'email' => 'user_email',
					'username' => 'user_login',
					'password' => 'user_pass',
				)
			)
		));

		if ($result['status'] != 200) {
			$result['statusText'] = $result['message'];
		}

		return $this->response('ajax', $result);
	}

	public function getDefaultMailOptions($request) {
		$template = $request->get('template');

		$mailModel = $this->getModel('Settings');
		$mailSett = $mailModel->defaultSettings();
		if(isset($mailSett['emails'][$template. '-subject'])) {
			$subject = $mailSett['emails'][$template. '-subject'];
		}
		if(isset($mailSett['emails'][$template. '-body'])) {
			$message = $mailSett['emails'][$template. '-body'];
		}

		return $this->response(
			'ajax',
			array(
				'subject' => $subject,
				'message' => $message
			)
		);

	}

}