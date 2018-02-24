<?php

class Membership_Routes_Module extends Membership_Base_Module {
	private $rewriteRules = array();
	private $queryVars = array();
	private $ajaxRoutes = array();
	private $requestedPageId = null;
	private $requestActions = array();
	private $routesPages = array();
	private $pagesList = array();
	
	private $_directRoutes = array();

	public function afterModulesLoaded() {

		$this->registerTwigFunctions();
		$name = $this->getConfig('plugin_name');

		if ($this->isPluginPage() && is_admin()) {
			$this->checkRoutePages();
		}

		add_action('wp_ajax_' . $name, array($this, 'ajaxHandler'));
		add_action('wp_ajax_nopriv_' . $name, array($this, 'ajaxHandler'));
		add_action('init', array($this, 'initAction'));
		add_filter('query_vars', array($this, 'registerQueryVars'));
		add_action('parse_request', array($this, 'onRequestHandler'));
	}

	public function registerDirectRoutes($routes) {
		foreach ($routes as $name => $route) {
			$this->_directRoutes[ $name ] = $route;
		}
	}
	
	public function initAction() {
		$this->_checkDirectRoutes();
		
		$needFlush = false;
		$wpRewriteRules = get_option('rewrite_rules', array());
		foreach ($this->rewriteRules as $regex => $redirect) {
			if (! isset($wpRewriteRules[$regex]) ||
			    $wpRewriteRules[$regex] !== $redirect
			) {
				$needFlush = true;
			}
			add_rewrite_rule($regex, $redirect, 'top');
		}

		if ($needFlush) {
			flush_rewrite_rules(false);
		}
	}
	
	protected function _checkDirectRoutes() {
		if(empty($this->_directRoutes)) return;
		
		$request = $this->getRequest();

		$data = array();
		$pl = '';
		if ($request->post->has( MBS_ROUTE )) {
			$data = $request->post;
		} elseif ($request->query->has( MBS_ROUTE )) {
			$data = $request->query;
		}
		
		if ($request->post->has( MBS_PL )) {
			$pl = $request->post->get( MBS_PL );
		} elseif ($request->query->has( MBS_PL )) {
			$pl = $request->query->get( MBS_PL );
		}
		
		if(!empty($data) && !empty($pl) && $pl == $this->getEnvironment()->getConfig()->get('plugin_slug')) {
			if (isset($this->_directRoutes[ $data[ MBS_ROUTE ] ])) {
				$routeParams = $this->_directRoutes[ $data[ MBS_ROUTE ] ];
				if((isset($routeParams[ MBS_METHOD ]) && strtoupper($routeParams[ MBS_METHOD ]) == $request->server->get('REQUEST_METHOD'))
					|| !isset($routeParams[ MBS_METHOD ])
				) {
					// Check permission if set, by default checking is user logged in
					if (isset($routeParams[ MBS_ADMIN ])  && !current_user_can('manage_options')) {
						return false;
					}
					if (!isset($routeParams[ MBS_GUEST ]) && !is_user_logged_in()) {
						return false;
					}
					return call_user_func_array($routeParams[ MBS_HANDLER ], array($data, $request));
				}
			}
		}
	}

	public function registerQueryVars($vars) {
		return array_merge($vars, $this->queryVars);
	}

	public function registerOnRequestAction($actions, $priority = 0) {
		if (!isset($this->requestActions[$priority])) {
			$this->requestActions[$priority] = array();
		}
		$this->requestActions[$priority] = array_merge($this->requestActions[$priority], $actions);
	}

	public function onRequestHandler($query) {

		$requestedPageId = null;
		$routesList = $this->getRoutesList();

		if (!$routesList) {
			return $query;
		}

		if (get_option('permalink_structure')) {
			if ($query->matched_query && !empty($query->request)) {
				if (isset($query->query_vars['page_id'])) {
					$requestedPageId = $query->query_vars['page_id'];
				} else {
					$request = $query->request;
					if (strpos($query->matched_rule, 'index.php/') !== false) {
						$request = 'index.php/' . ltrim($request, 'index.php/');
					}
					$requestedPageId = url_to_postid(urldecode($request));
					if(!$requestedPageId){
						$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						$requestedPageId = url_to_postid( $actual_link );
					}
				}
			}
		} else {
			if (isset($query->query_vars['page_id'])) {
				$requestedPageId = $query->query_vars['page_id'];
			}
		}

		$routeList = $this->getRoutesList();
		krsort($this->requestActions);

		$query->membership = array();

		foreach ($this->requestActions as $priority => $actions) {
			foreach ($actions as $action) {
				$query = call_user_func_array(
					$action,
					array(
						$query,
						(int) $requestedPageId,
						$routeList
					));
			}
		}

		$this->registerFrontendData(array(
			'routes' => $this->getAllRoutes(),
		));

		return $query;
	}

	public function addQueryVars($vars) {
		$this->queryVars = array_merge($this->queryVars, $vars);
	}

	public function addRewriteRule($regex, $redirect) {
		$this->rewriteRules[$regex] = $redirect;
	}

	public function getRewriteRules() {
		return $this->rewriteRules;
	}
	
	public function registerTwigFunctions() {
		$twig = $this->getTwig();
		$twig->addFunction(
			new Twig_SimpleFunction(
				'getRouteUrl', 
				array($this, 'getRouteUrl')
			)
		);

		$twig->addGlobal('ajaxUrl', admin_url('admin-ajax.php'));
	}
	
	public function getRoutesList() {
		if (!empty($this->routesList)) {
			return $this->routesList;
		}

		$routes = $this->getModel('settings', 'membership')->get('routes');

		if ($routes) {
			$routes = array_shift($routes);
		}

		return $this->routesList = $routes;
	}

	public function getPageIdByRoute($route) {
		$routes = $this->getRoutesList();
		if (isset($routes[$route])) {
			return $routes[$route];
		}

		return null;
	}

	public function getRouteUrl($route, $args = array()) {
		$url = get_permalink($this->getPageIdByRoute($route));
		if ($url && $args) {
			$url = add_query_arg($args, $url);
		}

		return $url;
	}

	public function getRouteUrlWithQueryArguments($route, $args = array()) {

	}

	public function registerAjaxRoutes($routes) {
		foreach ($routes as $name => $route) {
			$this->ajaxRoutes[$name] = $route;
		}
	}

	public function getAllRoutes() {
		$routes = array();

		foreach ($this->getRoutesList() as $route => $pageId) {
			$routes[$route] = get_permalink($pageId);
		}

		return $routes;
	}

	public function resetPages() {
		$currentRoutes = $this->getRoutesList();

		foreach($currentRoutes as $id) {
			wp_delete_post($id, true);
		}

		$this->getModel('settings')->saveSettings(array());
	}


	public function createRoutePage($slug) {

		$pagesList = $this->getPagesList();
		$currentRoutes = $this->getRoutesList();

		if (!array_key_exists($slug, $pagesList)) {
			return null;
		}

		$title = $pagesList[$slug]['title'];
		$shortcode = $this->getConfig('shortcode_name');
		$post_content = "[$shortcode-$slug]";

		$id = wp_insert_post(array(
			'post_title' => $title,
			'post_content' => $post_content,
			'post_type' => 'page',
			'post_status'  => 'publish',
		), true);

		$currentRoutes[$slug] = $id;

		$this->getModel('settings')->saveSettings($currentRoutes);

		return array(
			'id' => $id,
			'title' => $title
		);
	}

	public function checkRoutePages() {
		$routesList = $this->getRoutesList();
		$error = false;

		if ($routesList) {
			$pages = array_keys($routesList);
		} else {
			$pages = array();
		}

		foreach ($this->getPagesList() as $slug => $page) {
			$id = null;
			// for contact_form we do not show warning (if page not exists)
			if($slug != 'contact_form') {
				if (!in_array($slug, $pages)) {
					$error = true;
				} else {
					if (get_post_status($routesList[$slug]) !== false) {
						$id = $routesList[$slug];
					} else {
						$error = true;
					}
				}
			}

			$this->routesPages[$slug] = array(
				'id' => $id,
				'title' => $page['title']
			);
		}

		if ($error) {
			add_action('admin_notices', array($this, 'pagesErrorNotice'));
		}
	}

	public function pagesErrorNotice() {
		if ($this->isModule('promo', 'welcome') || $this->isModule('installer')) {
			return;
		}

		$url = $this->generateUrl('membership') . '#pages';
		$message = sprintf(
			$this->translate('Warning! Some required Membership plugin pages are missing or haven\'t been created, you can assign or create them <a href="%s">here</a>'),
			$url
		);
		print '<div class="notice notice-warning"><p style="font-size: 14px">' . $message . '</p></div>';
	}

	public function getRoutesPages() {

		if (empty($this->routesPages)) {
			$this->checkRoutePages();
		}

		return $this->routesPages;
	}

	/**
	 * List of all pages required by plugin.
	 * @return array
	 */
	public function getPagesList() {
		if(empty($this->pagesList)) {
			$this->pagesList = $this->getDispatcher()->apply('pagesList', array(array(
				'profile' => array(
					'title' => $this->translate('Profile')
				),
				'members' => array(
					'title' => $this->translate('Members')
				),
				'groups' => array(
					'title' => $this->translate('Groups')
				),
				'joined-groups' => array(
					'title' => $this->translate('Joined Groups'),
				),
				'activity' => array(
					'title' => $this->translate('Activity')
				),
				'registration' => array(
					'title' => $this->translate('Registration')
				),
				'login' => array(
					'title' => $this->translate('Login')
				),
				'search' => array(
					'title' => $this->translate('Search')
				),
			)));
		}
		return $this->pagesList;
	}

	public function ajaxHandler() {
		$request = $this->getRequest();
		$dispatcher = $this->getDispatcher();

		if ($request->post->has( MBS_ROUTE )) {
			$data = $request->post;
		} elseif ($request->query->has( MBS_ROUTE )) {
			$data = $request->query;
		} else {
			return $this->ajaxResponse(array(
				'success' => false,
				'status' => 405
			));
		}

		$ajaxRoutes = $dispatcher->apply('routes.ajaxHandler.ajaxRoutes', array($this->ajaxRoutes));

		if (! in_array($data[ MBS_ROUTE ], array_keys($ajaxRoutes))) {
			return $this->ajaxResponse(array(
				'success' => false,
				'status' => 404
			));
		}

		if ($data->get('route') != 'base.getNonce' && ! wp_verify_nonce($data['wpnonce'], $this->getEnvironment()->getConfig()->get('plugin_slug'))) {
			return $this->ajaxResponse(array(
				'success' => false,
				'status' => 403,
				'errors' => array($this->translate('Invalid token. Please refresh page.'))
			));
		}


		$routeParams = $this->ajaxRoutes[$data[ MBS_ROUTE ]];

		if (strtoupper($routeParams[ MBS_METHOD ]) !== $request->server->get('REQUEST_METHOD')) {
			return $this->ajaxResponse(array(
				'success' => false,
				'status' => 405,
			));
		}

		// Check permission if set, by default checking is user logged in
		if (isset($routeParams[ MBS_ADMIN ])  && !current_user_can('manage_options')) {
			return $this->ajaxResponse(array(
				'success' => false,
				'status' => 403,
			));
		}

		if (! is_user_logged_in() && !isset($routeParams[ MBS_GUEST ])) {
			return $this->ajaxResponse(array(
				'success' => false,
				'status' => 403,
			));
		}

		$dispatcher->dispatch('route:beforeCall', array($data->all()));

		return call_user_func_array($routeParams[ MBS_HANDLER ], array($data, $request));
	}

	public function ajaxResponse($data) {
		return $this->getModule('base')->getController()->response('ajax', $data);
	}

	public function replaceContentWith($template, $templateData = array()) {
		$this->getModule('Base')->enqueueAssets();
		$this->replaceContentWithTemplate = $template;
		$this->replaceContentWithTemplateData = $templateData;
		add_filter('the_content', array($this, 'replaceContentHandler'));
	}

	public function replaceContentHandler() {
		return $this->render($this->replaceContentWithTemplate, $this->replaceContentWithTemplateData);
	}

	public function redirect404() {
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
		get_template_part(404);
		exit;
	}

}