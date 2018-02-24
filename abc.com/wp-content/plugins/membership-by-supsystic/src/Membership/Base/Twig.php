<?php

class Membership_Base_Twig extends Twig_Extension {

	private $environment;
	private $version;

	public function __construct($environment) {
		$this->environment = $environment;
		$this->version = $this->environment->getConfig()->get('plugin_version');
	}

	public function getName() {
		return 'Membership_Base_Twig';
	}

	public function getGlobals()
	{
		$userLoggedIn = is_user_logged_in();

		return array(
			'environment' => $this->environment,
			'currentUser' => $this->getEnvironment()->getModule('users')->getCurrentUser(),
			'isGuest' => !$userLoggedIn,
			'userLoggedIn' => $userLoggedIn,
			'settings' => $this->getEnvironment()->getModule('base')->getSettings(),
			'logoutUrl' => wp_logout_url(),
			'isDev' => isset($_REQUEST['dev'])
		);
	}

	public function getFunctions() {
		return array(
			new Twig_SimpleFunction('translate', array($this->getEnvironment(), 'translate')),
			new Twig_SimpleFunction('function', array($this, 'callFunction')),
			new Twig_SimpleFunction('assets', array($this, 'getAssetsPath')),
			new Twig_SimpleFunction('dashboardUrl', array($this, 'dashboardUrl')),
			new Twig_SimpleFunction('getMembershipAddonUrl', array($this, 'getMembershipAddonUrl')),
			new Twig_SimpleFunction('getMembershipExtensionUrl', array($this, 'getMembershipExtensionUrl')),
			new Twig_SimpleFunction('mbsHtml', array($this, 'getHtmlMethod'), array('is_safe' => array('html'))),
			new Twig_SimpleFunction('mbsConst', array($this, 'getConstForTwig')),
			new Twig_SimpleFunction('mbsVarFormat', array($this, 'varFormat')),
			new Twig_SimpleFunction('truncate', array($this, 'truncate')),
			new Twig_SimpleFunction('max', 'max'),
			new Twig_SimpleFunction('min', 'min'),
		);
	}
	/**
	 * Replace variables in string, for example $str = 'Hello [first_name]', $variables = array('first_name' => 'John')
	 * will return 'Hello John'
	 * @param string $str
	 * @param array $variables
	 * @return string
	 */
	public function varFormat( $str, $variables, $prefix = '' ) {
		foreach($variables as $k => $v) {
			$search = $prefix ? $prefix. '_'. $k : $k;
			$str = str_replace('{'. $search. '}', $v, $str);
		}
		return $str;
	}
	
	public function getConstForTwig( $name ) {
		return defined( $name ) ? constant( $name ) : false;
	}
	
	public function getEnvironment() {
		return $this->environment;
	}

	public function callFunction($name) {
		$args = array_slice(func_get_args(), 1);
		return call_user_func_array($name, $args);
	}

	public function getAssetsPath($module, $path, $ver = true) {
		if ($ver) {
			$ver = '?ver=' . $this->version;
		} else {
			$ver = '';
		}

		return $this->getEnvironment()->getModule($module)->getAssetsPath() . '/' . $path . $ver;
	}

	public function getMembershipAddonUrl($addon) {
		return "https://supsystic.com/plugins/{$addon}/?utm_source=plugin&utm_campaign=membership&utm_medium={$addon}";
	}
	
	public function getMembershipExtensionUrl($extension) {
		return "https://supsystic.com/extensions/{$extension}/?utm_source=plugin&utm_campaign=membership&utm_medium={$extension}";
	}
	
	public function getHtmlMethod( $method ) {
		$args = array_slice(func_get_args(), 1);
		return call_user_func_array(array('Rsc_Html', $method), $args);
	}

	public function truncate($string, $size, $end = '...') {
		if (strlen($string) < $size) {
			return $string;
		} else {
			$split = str_split($string, $size);
			return array_shift($split) . $end;
		}
	}

	public function dashboardUrl() {
		// fixed php 5.2 Fatal error: func_get_args(): Can't be used as a function parameter
		$funcParams = func_get_args();
		return call_user_func_array(array($this->environment, 'generateUrl'), $funcParams);
	}
}