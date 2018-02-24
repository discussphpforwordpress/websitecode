<?php

class Membership_Membership_Module extends Membership_Base_Module
{
	protected $menu = array();
	protected $menuWalkerClassName = null;

	public function onInit() {
		parent::onInit();

		if(is_admin()) {
			// init custom navigation menu edit items
			if(!$this->menuWalkerClassName) {
				$mbsMenuItemsClass = new Membership_Membership_Model_MenuEditItemCustomFields();
				$mbsMenuItemsClass->init();
				add_action('wp_loaded', array($this, 'wpLoadHandler'));
				$this->menuWalkerClassName = 'Membership_Membership_Model_MenuEditItemCustomFieldsWalker';
			}
		}

		if(!is_admin()) {
			add_filter('wp_get_nav_menu_items', array($this, 'conditionalNavMenuHandler'), 9999, 3);
		}
	}

	public function afterModulesLoaded() {

		$routesModule = $this->getModule('routes');
		$this->registerActions();
		$routesModule->registerAjaxRoutes(array(
			'membership.saveSettings' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'saveSettings')
			),

			'membership.importBuddyPressData' => array(
				'admin' => true,
				'method' => 'post',
				'handler' => array($this->getController(), 'importBuddyPressData')
			),

			'membership.importUltimateMemberData' => array(
				'admin' => true,
				'method' => 'post',
				'handler' => array($this->getController(), 'importUltimateMemberData')
			),

			'membership.uninstall' => array(
                'method' => 'post',
                'admin' => true,
                'handler' => array($this->getController(), 'uninstall')
            ),
            'membership.createPage' => array(
                'method' => 'post',
                'admin' => true,
                'handler' => array($this->getController(), 'createPage')
            ),
            'membership.savePages' => array(
                'method' => 'post',
                'admin' => true,
                'handler' => array($this->getController(), 'savePages')
            ),
            'membership.createUnassignedPages' => array(
                'method' => 'post',
                'admin' => true,
                'handler' => array($this->getController(), 'createUnassignedPages')
            ),
            'membership.reviewNoticeResponse' => array(
                'method' => 'post',
                'admin' => true,
                'handler' => array($this->getController(), 'reviewNoticeResponse')
            )
		));


		if ($this->isPluginPage()) {
			$this->reviewNoticeCheck();
		}

		if (!$this->isModule('membership')) {
			return;
		}

		$assetsPath = $this->getAssetsPath();
        $baseAssetsPath = $this->getModule('base')->getAssetsPath();
		$reportsAssetsPath = $this->getModule('reports')->getAssetsPath();

        $this->getModule('assets')->enqueueAssets(
			array(
			    $baseAssetsPath . '/lib/tooltipster/tooltipster.bundle.min.css',
                $assetsPath . '/css/membership.backend.css',
            ),
			array(
                $baseAssetsPath . '/lib/tooltipster/tooltipster.bundle.min.js',
				$assetsPath . '/js/membership.backend.js',
				$reportsAssetsPath . '/js/reports.backend.js',
			)
		);
	}

	public function registerActions() {
		add_action('wp_logout', array($this, 'afterLogoutAction'));
		add_action('init', array($this, 'blockedIpCheck'));
		add_action('init', array($this, 'wpLoginRedirect'));
	}

	public function afterLogoutAction() {

		$settings = $this->getSettings();
		$afterLogoutAction = $settings['base']['main']['after-logout-action'];

		$redirectTo = home_url();

		if ($afterLogoutAction === 'redirect-to-url') {
			$redirectTo = $settings['base']['main']['after-logout-action-redirect-url'];
		}

		wp_redirect($redirectTo);
		exit;
	}

	public function wpLoginRedirect()
	{
		global $pagenow;

		if ($pagenow === 'wp-login.php') {

			$settings = $this->getSettings();
			$routesModule = $this->getModule('routes');
			$routesList = $routesModule->getRoutesList();

			if (!$routesList || !isset($routesList['login'])) {
				return;
			}

			$redirect = $settings['base']['security']['backend-login-screen-redirect'];
			$redirectTo = $routesModule->getRouteUrl('login');

			$action = isset($_GET['action']);

			if ($action) {
				$action = $_GET['action'];
			}

			if ($redirect !== 'no' && (!$action || $action !== 'logout') && $redirectTo !== false && !isset($_GET['interim-login'])) {
				wp_redirect($redirectTo);
				die();
			}
		}
	}

	public function blockedIpCheck() 
	{
		$settings = $this->getSettings();

		if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
			$currentUserIp = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$currentUserIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$currentUserIp = $_SERVER['REMOTE_ADDR'];
		}

		$blockedIps = trim($settings['base']['security']['blocked-ip']);

		if (!empty($blockedIps)) {


			$blockedIps = preg_split('/\s+/', str_replace(array('.', '*'), array('\.', '\d{0,3}'), $blockedIps));
			$blockedIpsPattern = '/' . implode('|', $blockedIps) . '/';

			if (preg_match($blockedIpsPattern, $currentUserIp)) {
				status_header(404);
				get_template_part(404);
				exit();
			}
		}
	}

	public function reviewNoticeCheck() {
		$option = $this->getConfig('db_prefix') . 'reviewNotice';
		$notice = get_option($option);
		if (!$notice) {
			update_option($option, array(
				'time' => time() + (60 * 60 * 24 * 7),
				'shown' => false
			));
		} elseif ($notice['shown'] === false && time() > $notice['time']) {
			add_action('admin_notices', array($this, 'showReviewNotice'));
		}
	}

	public function showReviewNotice() {
		print $this->render('@membership/backend/review-notice.twig');
	}

	public function wpLoadHandler() {
		add_filter('wp_edit_nav_menu_walker', array($this, 'wpEditNavMenuWalkerHandler' ), 100);
	}

	public function wpEditNavMenuWalkerHandler() {
		return $this->menuWalkerClassName;
	}

	function conditionalNavMenuHandler($items, $menu, $args) {

		$childMenuArrToHide = array();
		$isCurrUserLoggined = (int) get_current_user_id();

		if(count($items)) {
			foreach($items as $menuKey => $oneMenuItem) {
				$mbsVisibilityValue = (int) get_post_meta($oneMenuItem->ID, 'menu-item-mbs-menu-visibility', true);
				$currItemStayVisible = true;

				if(in_array($oneMenuItem->menu_item_parent, $childMenuArrToHide)) {
					$currItemStayVisible = false;
					// for nested menus
					$childMenuArrToHide[] = $oneMenuItem->ID;
				}

				// if current user Guest and param = 'logInned user' (1)
				if(!$isCurrUserLoggined && $mbsVisibilityValue == 1) {
					$currItemStayVisible = false;
				}

				// if current user is Authored and param = 'logOuted user' (2)
				if($isCurrUserLoggined && $mbsVisibilityValue == 2) {
					$currItemStayVisible = false;
				}

				if(!$currItemStayVisible) {
					if(!in_array($oneMenuItem->ID, $childMenuArrToHide)) {
						$childMenuArrToHide[] = $oneMenuItem->ID;
					}
					unset($items[$menuKey]);
				}
			}
		}

		return $items;
	}
}