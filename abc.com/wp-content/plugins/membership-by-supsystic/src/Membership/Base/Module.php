<?php
class Membership_Base_Module extends Rsc_Mvc_Module {

	private $models = array();
	private $frontendData = array();
	private $settings;
	private $_nonce;

	const MBS_YES = 'yes';
	const MBS_NO = 'no';


	public function onInit() {
		if (!$this->pluginStateCheck()) {
			return false;
		};

		add_action(
			$this->getConfig('hooks_prefix') . 'after_modules_loaded',
			array($this, 'afterModulesLoaded')
		);

		return true;
	}

	public function afterModulesLoaded() {

        add_filter('get_avatar', array($this, 'getAvatar'), 1, 6);

		// IE11 Issue #124
		if (preg_match("/Trident\/7.0;(.*)rv:11.0/", $_SERVER["HTTP_USER_AGENT"], $match) !== 0) {
			remove_action('wp_head', 'print_emoji_detection_script', 7);
		}

		$this->getDispatcher()->on('route:beforeCall', array($this, 'beforeRouteCall'));
		$this->registerTwigExtensions();
		$this->registerTwigThemePathOverrides();
		$this->enableTwigOptions();
		$this->registerValidator();
		$this->registerThemeTemplatesPath();
		add_action('admin_menu', array($this, 'registerSubMenuItems'));
		add_action('admin_head', array($this, 'highlightAdminSubMenu'));
		//$this->registerSubMenuItems();

		$this->getModule('routes')->registerOnRequestAction(
			array(
				array($this, 'onRequest')
			)
		);

		$this->getModule('routes')->registerAjaxRoutes(array(
			'base.createTempImage' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'createTempImage')
			),
			'base.uploadImage' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'uploadImage')
			),
            'base.uploadFile' => array(
                'method' => 'post',
                'guest' => true,
                'handler' => array($this->getController(), 'uploadFile')
            ),
			'base.uploadAnyFile' => array(
				'method' => 'post',
				'guest' => true,
				'handler' => array($this->getController(), 'uploadAnyFile')
			),
            'photos.get' => array(
                'method' => 'get',
                'guest' => true,
                'handler' => array($this->getController(), 'getPhotos')
            ),
            'base.getNonce' => array(
                'method' => 'get',
                'guest' => true,
                'handler' => array($this->getController(), 'getNonce')
            ),
			'base.getAttachmentFiles' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'getAttachmentFiles'),
			),
		));

		$assetsModule = $this->getModule('assets');
		$assetsPath = $this->getAssetsPath();

		if ($this->isPluginPage()) {
			$assetsModule->enqueueAssets(
				array(
					'//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
					$assetsPath . '/lib/bootstrap/bootstrap.min.css',
					$assetsPath . '/lib/chosen/chosen.css',
					$assetsPath . '/css/base.css',
					$assetsPath . '/css/base.backend.css',
					$assetsPath . '/css/option.backend.css',
					$assetsPath . '/lib/tooltipster/tooltipster.bundle.min.css',
				),
				array(
					$assetsPath . '/lib/moment/moment.min.js',
					$assetsPath . '/lib/moment/locales.min.js',
					$assetsPath . '/js/helpers.js',
					$assetsPath . '/js/base.backend.js',
					$assetsPath . '/lib/validate.min.js',
					$assetsPath . '/lib/holder.min.js',
					$assetsPath . '/lib/supsystic/modal.js',
					'jquery-ui-sortable',
					$assetsPath . '/lib/supsystic/tabs.js',
					$assetsPath . '/lib/supsystic/notify.js',
					$assetsPath . '/lib/supsystic/validation.js',
					$assetsPath . '/lib/chosen/chosen.jquery.min.js',
					$assetsPath . '/lib/jquery.serializejson.min.js',
					$assetsPath . '/lib/tooltipster/tooltipster.bundle.min.js',
				)
			);

			add_action('admin_enqueue_scripts', array($this, 'enqueueAssets'));
		}

	}

	public function onRequest($query, $requestedPageId, $routesList) {
		if (in_array($requestedPageId, $routesList)) {
			add_action('wp_enqueue_scripts', array($this, 'enqueueAssets'));
		}
		return $query;
	}

	public function beforeRouteCall() {
		add_filter('jpeg_quality', array($this, 'imageEditorQuality'));
		add_filter('wp_editor_set_quality', array($this, 'imageEditorQuality'));
	}

	public function getAvatar($avatar, $id_or_email, $size = 96, $default = '', $alt = '', $args = null) {
		$user = false;

		if (is_numeric($id_or_email)) {
			$id = (int) $id_or_email;
			$user = get_user_by('id', $id);
		} elseif (is_object($id_or_email)) {
			if (!empty($id_or_email->user_id)) {
				$id = (int) $id_or_email->user_id;
				$user = get_user_by('id', $id);
			}
		} else {
			$user = get_user_by('email', $id_or_email);
		}

		if ($user && is_object($user)) {
			$user = $this->getModel('profile', 'users')->getUserById(intval($user->data->ID));
			$source = '';

			if (isset($user['images'])) {
				foreach ($user['images'] as $image) {
					if ($image['type'] == 'avatar' && (int)$image['height'] == $size) {
						$source = $image['source'];
						continue;
					}
				}

				if (!$source) {
					foreach ($user['images'] as $image) {
						if ($image['type'] == 'avatar' && (int)$image['height'] > $size) {
							$source = $image['source'];
							continue;
						}
					}
				}
			}

			if ($source) {
				$avatar = "<img alt='{$alt}' src='{$source}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
			}
		}

		return $avatar;
	}

	public function imageEditorQuality($quality) {

		$settings = $this->getSettings();

		if (isset($settings['base']['uploads']['image-quality'])) {
			return intval($settings['base']['uploads']['image-quality']);
		}

		return $quality;
	}

	private function _setNonce() {
		$this->_nonce = wp_create_nonce( $this->getEnvironment()->getConfig()->get('plugin_slug') );
	}
	public function getNonce() {
		if(empty($this->_nonce)) {
			$this->_setNonce();
		}
		return $this->_nonce;
	}

	public function enqueueAssets() {

		$settings = $this->getSettings();
		$pluginVersion = $this->getConfig('plugin_version');

		wp_register_script(
			'MembershipApi',
			$this->getAssetsPath() . '/js/api.js',
			array('jquery'),
			$this->getConfig('plugin_version')
		);

		$apiData = 	array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'modulesPath' => plugins_url('', dirname(__FILE__)),
			'version' => $this->getConfig('plugin_version'),
			'wpnonce' => $this->getNonce(),
			'isLoggedIn' => is_user_logged_in(),
			'isAdmin' => is_admin(),
			'locale' => get_locale(),
			'timestamp' => time(),
		);

		if (function_exists('get_user_locale')){
			$apiData['locale'] = get_user_locale(get_current_user_id());
		}

		if (!is_admin()) {
			$assetsPath = $this->getAssetsPath();

			wp_enqueue_script('jquery');

			wp_enqueue_script('membership-helpers-js',
				$assetsPath . '/js/helpers.js',
				array(
					'MembershipApi',
				),
				$pluginVersion
			);

			if (@$settings['design']['general']['default-theme-colors'] === 'false') {
				wp_enqueue_style('semantic-ui', $assetsPath . '/lib/semantic/semantic-membership.min.css', array(), $pluginVersion);
			} else {
				wp_enqueue_style('semantic-ui', $assetsPath . '/lib/semantic/semantic-membership-no-buttons-inputs.min.css', array(), $pluginVersion);
			}

			wp_enqueue_script('semantic-ui-js', $assetsPath . '/lib/semantic/semantic.min.js', array('jquery'), $pluginVersion);
			wp_enqueue_script('snackbar-js', $assetsPath . '/lib/snackbar/snackbar.min.js', array('jquery'), $pluginVersion);
			wp_enqueue_style('snackbar-css', $assetsPath . '/lib/snackbar/snackbar.min.css', array(), $pluginVersion);
			wp_enqueue_style('base-mbs', $assetsPath . '/css/base.css', array(), $pluginVersion);
			wp_enqueue_style('base-frontend', $assetsPath . '/css/base.frontend.css', array(), $pluginVersion);

			$apiData = array_merge(
				$apiData,
				$this->frontendData,
				array(
					'permalink' => (bool) get_option('permalink_structure'),
					'settings' => $this->getSettings(array('profile', 'groups', 'base', 'design')),
					'logoutUrl' => wp_logout_url(),
				)
			);
		}

		if ($this->isPluginPage()) {
			wp_enqueue_media();
			wp_register_script(
				'MembershipApiHelpers',
				$this->getAssetsPath() . '/js/helpers.js',
				array('jquery'),
				$this->getConfig('plugin_version')
			);
		}

		wp_localize_script('MembershipApi', 'Membership', $apiData);
		wp_enqueue_script('MembershipApi');
	}

	public function registerFrontendData(array $data) {
		$baseModule = $this->getModule('base');
		$baseModule->frontendData = array_merge($baseModule->frontendData, $data);
	}

	public function getConfig($value = null) {
		$environmentConfig = $this->getEnvironment()->getConfig();
		if ($value) {
			return $environmentConfig->get($value);
		}
		return $environmentConfig;
	}

	public function getModel($model = null, $module = null, $prefix = null) {
		if (! $module) {
			$moduleClassName = explode('_', get_class($this));
			$module = $moduleClassName[1];
		}

		if (! $model) {
			$model = $module;
		}

		if (! $prefix) {
			$prefix = $this->getConfig('plugin_prefix');
		}
		
		$className = $prefix . '_' . ucfirst($module) . '_Model_' . ucfirst($model);
		if (! class_exists($className)) {
			throw new Exception(sprintf('Model with classname: %s not exists', $className), 1);
		}

		if (! array_key_exists($className, $this->models)) {
			$this->models[$className] = new $className($this->getEnvironment());
		}

		return $this->models[$className];
	}

	public function getModule($module, $prefix = null) {
		if(!empty($prefix)) {
			$module = $prefix. '_'. $module;
		}
		return $this->getEnvironment()->getModule( $module );
	}

	public function enableTwigOptions() {
		$this->getTwig()->enableAutoReload();
	}

	public function registerTwigExtensions() {
		$twig = $this->getTwig();
		$twig->addExtension(new Membership_Base_Twig($this->getEnvironment()));
	}

	public function registerTwigThemePathOverrides() {
		$twigLoader = $this->getTwig()->getLoader();
		$modulesDir = dirname(dirname(__FILE__));
		$themePath = get_stylesheet_directory() . DIRECTORY_SEPARATOR . $this->getConfig('theme_folder') . DIRECTORY_SEPARATOR;
		foreach (scandir($modulesDir) as $fileName) {
			$moduleDir = $modulesDir . DIRECTORY_SEPARATOR . $fileName;
			if (!in_array($fileName, array('.', '..')) && is_dir($moduleDir)) {
				$fileName = strtolower($fileName);
				if (is_dir($themePath . $fileName)) {
					$twigLoader->prependPath($themePath . $fileName, $fileName);
				}
			}
		}
	}

	private function registerValidator() {
		$this->validator = new Membership_Base_Validator();
	}

	public function validate($input, $validationRules, $messages = array()) {
		return $this->validator->validate($input, $validationRules, $messages);
	}

	public function registerThemeTemplatesPath() {
		$themePath = get_stylesheet_directory() . DIRECTORY_SEPARATOR . $this->getConfig('theme_folder');
		if (is_dir($themePath)) {
			$twigLoader = $this->getTwig()->getLoader();
			$twigLoader->addPath($themePath, 'theme');
		}
	}

	public function render($template, $data = array()) {
		return $this->getTwig()->render($template, $data);
	}

	public function getAssetsPath() {
		return $this->getLocationUrl() . '/assets';
	}

	public function getSettings(array $fields = null) {

		if (! $this->settings) {
			$this->settings = $this->getModule('base')->getModel('settings')->getAll();
		}

		if ($fields) {
			$settings = array();
			foreach ($this->settings as $field => $setting) {
				if (in_array($field, $fields)) {
					$settings[$field] = $setting;
				}
			}
			return $settings;
		}

		return $this->settings;
	}

	public function getGravatarUrl($email, $size) {
		$url = 'https://www.gravatar.com/avatar/';
		$url .= md5(strtolower(trim($email)));
		$url .= "?s=$size&d=identicon";
		return $url;
	}

	public function pluginStateCheck() {
		if (property_exists($this, 'pluginSlug') && !empty($this->pluginSlug)) {
			$addonsModel = $this->getModel('Addons', 'License');
			$addons = $addonsModel->getAddons();
			if (isset($addons[$this->pluginSlug]) && 
				(
					!isset($addons[$this->pluginSlug]['state']) ||
					$addons[$this->pluginSlug]['state'] === 'error' ||
					$addons[$this->pluginSlug]['state'] === 'not-activated'
				)
			) {
				return false;
			}
		}

		return true;
	}

	public function translateCyrillicToLatin($string, $gost = false) {
		if($gost) {
			$replace = array("А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
				"Е"=>"E","е"=>"e","Ё"=>"E","ё"=>"e","Ж"=>"Zh","ж"=>"zh","З"=>"Z","з"=>"z","И"=>"I","и"=>"i","Й"=>"I",
				"й"=>"i","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n","О"=>"O","о"=>"o",
				"П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t","У"=>"U","у"=>"u","Ф"=>"F",
				"ф"=>"f","Х"=>"Kh","х"=>"kh","Ц"=>"Tc","ц"=>"tc","Ч"=>"Ch","ч"=>"ch","Ш"=>"Sh","ш"=>"sh","Щ"=>"Shch",
				"щ"=>"shch","Ы"=>"Y","ы"=>"y","Э"=>"E","э"=>"e","Ю"=>"Iu","ю"=>"iu","Я"=>"Ia","я"=>"ia","ъ"=>"","ь"=>"");
		} else {
			$arStrES = array("ае","уе","ое","ые","ие","эе","яе","юе","ёе","ее","ье","ъе","ый","ий");
			$arStrOS = array("аё","уё","оё","ыё","иё","эё","яё","юё","ёё","её","ьё","ъё","ый","ий");
			$arStrRS = array("а$","у$","о$","ы$","и$","э$","я$","ю$","ё$","е$","ь$","ъ$","@","@");

			$replace = array("А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
				"Е"=>"Ye","е"=>"e","Ё"=>"Ye","ё"=>"e","Ж"=>"Zh","ж"=>"zh","З"=>"Z","з"=>"z","И"=>"I","и"=>"i","Й"=>"Y",
				"й"=>"y","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n","О"=>"O","о"=>"o",
				"П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t","У"=>"U","у"=>"u","Ф"=>"F",
				"ф"=>"f","Х"=>"Kh","х"=>"kh","Ц"=>"Ts","ц"=>"ts","Ч"=>"Ch","ч"=>"ch","Ш"=>"Sh","ш"=>"sh","Щ"=>"Shch",
				"щ"=>"shch","Ъ"=>"","ъ"=>"","Ы"=>"Y","ы"=>"y","Ь"=>"","ь"=>"","Э"=>"E","э"=>"e","Ю"=>"Yu","ю"=>"yu",
				"Я"=>"Ya","я"=>"ya","@"=>"y","$"=>"ye");

			$string = str_replace($arStrES, $arStrRS, $string);
			$string = str_replace($arStrOS, $arStrRS, $string);
		}

		return iconv("UTF-8", "UTF-8//IGNORE", strtr($string,$replace));
	}

	public function highlightAdminSubMenu() {
		global $parent_file, $submenu_file;
		$plugSlug = $this->getEnvironment()->getConfig()->get('plugin_slug');
		if ($parent_file === $plugSlug) {
			if (isset($_GET['module']) && $_GET['module'] !== 'membership') {
				$submenu_file = 'admin.php?page='. $plugSlug. '&module=' . $_GET['module'];
				if (isset($_GET['action'])) {
					$submenu_file = 'admin.php?page='. $plugSlug. '&module=' . $_GET['module'] . '&action=' . $_GET['action'];
				}
			}

		}
	}

	public function registerSubMenuItems() {
		$menu = $this->getMenu();
		$menuUrl = $menu->getMenuSlug();
		$config = $this->getConfig();
		$defaultCapability = 'manage_options';

		$subMenus = array(
			array(
				'title' => $this->translate('Main'),
				'fa_icon' => 'fa-cogs',
				'order' => 10,
				'module' => 'membership',
				'is_main' => true,
			),
			array(
				'title' => $this->translate('Profile'),
				'fa_icon' => array('fa-user', 'fa-file fa-file-stacked'),
				'order' => 20,
				'module' => 'users',
			),
			array(
				'title' => $this->translate('Users'),
				'fa_icon' => array('fa-user'),
				'order' => 20,
				'module' => 'users',
				'action' => 'list'
			),
			array(
				'title' => $this->translate('Roles'),
				'fa_icon' => array('fa-user', 'fa-check-square-o fa-file-stacked'),
				'order' => 30,
				'module' => 'roles',
			),
//			array(
//				'title' => $this->translate('Groups'),
//				'fa_icon' => 'fa-group',
//				'order' => 40,
//				'module' => 'groups',
//			),
			array(
				'title' => $this->translate('Mails'),
				'fa_icon' => 'fa-envelope',
				'order' => 60,
				'module' => 'mail',
			),
			array(
				'title' => $this->translate('Design'),
				'fa_icon' => 'fa-picture-o',
				'order' => 70,
				'module' => 'design',
			),
//			array(
//				'title' => $this->translate('Reports'),
//				'fa_icon' => 'fa-flag',
//				'order' => 80,
//				'module' => 'reports',
//			)
		);

		if ($config->get('addons', false)) {
			$subMenus[] = array(
				'title' => $this->translate('License'),
				'fa_icon' => 'fa-hand-o-right',
				'order' => 999,
				'module' => 'license',
			);
		}

		$subMenus = $this->getEnvironment()->getDispatcher()->apply('adminAreaMenus', array($subMenus));
		uasort( $subMenus, array($this, 'sortAdminAreaMenusClb') );
		foreach ($subMenus as $i => $subMenu) {
			$subMenus[ $i ]['slug'] = 'admin.php?page='. $menuUrl;
			if(!isset($subMenu['is_main']) || !$subMenu['is_main']) {
				$subMenus[ $i ]['slug'] .= '&module='. $subMenu['module'];
				if(isset($subMenu['action']) && $subMenu['action']) {
					$subMenus[ $i ]['slug'] .= '&action='. $subMenu['action'];
				}
			}
			$subMenus[ $i ]['capability'] = $defaultCapability;
			
			$subMenu = $subMenus[ $i ];
			
			add_submenu_page(
				$menu->getMenuSlug(),
				$subMenu['title'],
				$subMenu['title'],
				$subMenu['capability'],
				$subMenu['slug'],
				array($this->getEnvironment()->getResolver(), 'resolve')
			);
		}

		if (method_exists($this->getEnvironment(), 'setAdminAreaMenus')) {
			$this->getEnvironment()->setAdminAreaMenus( $subMenus );
		}
	}
	public function sortAdminAreaMenusClb( $a, $b ) {
		if($a['order'] > $b['order'])
			return 1;
		if($a['order'] < $b['order'])
			return -1;
		return 0;
	}
	public function getTblListModel() {
		return $this->getController()->getTblListModel();
	}
	public function getSettingsModel() {
		return $this->getController()->getSettingsModel();
	}
	public function getDirectUrl( $route, $params = array() ) {
		static $siteUrl = '';
		if(empty($siteUrl)) {
			$siteUrl = get_site_url();
		}
		$config = $this->getEnvironment()->getConfig();
		return $siteUrl. '?'. http_build_query(array_merge(array(
			MBS_ROUTE => $route,
			MBS_PL => $config->get('plugin_slug'),
		), $params));
	}

	public function getClientIP() {

		$ip = null;

		if (empty($_SERVER['HTTP_CLIENT_IP'])) {
			if (empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['REMOTE_ADDR'];
			} else {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		} else {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}

		return $ip;

	}
}