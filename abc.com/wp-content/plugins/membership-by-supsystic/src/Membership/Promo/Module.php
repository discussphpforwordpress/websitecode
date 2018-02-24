<?php

class Membership_Promo_Module extends Membership_Base_Module
{

	public function afterModulesLoaded() {

		$currentUserId = get_current_user_id();

		$routesModule = $this->getModule('routes');

		$routesModule->registerAjaxRoutes(array(
			'promo.endTutorial' => array(
				'admin' => true,
				'method' => 'post',
				'handler' => array($this->getController(), 'endTutorial')
			),
			'promo.saveDeactivateData' => array(
				'admin' => true,
				'method' => 'post',
				'handler' => array($this->getController(), 'saveDeactivateDataAction')
			),
		));

		if (!get_user_meta(get_current_user_id(),  $this->getConfig('hooks_prefix') . 'tutorialShowed', true)) {
			$this->enqueueTutorialAssets();
		}
		if ($this->isPluginPage() && !$this->isModule('promo', 'welcome') &&
		    !get_user_meta($currentUserId, $this->getConfig('hooks_prefix') . 'welcomePageShowed', true)
		) {
			update_user_meta($currentUserId, $this->getConfig('hooks_prefix') . 'welcomePageShowed', true);
			return $this->getController()->redirect($this->generateUrl('promo', 'welcome'));
		}
		
		add_action('admin_footer', array($this, 'checkPluginDeactivation'));
	}

	public function enqueueTutorialAssets() {

		$assetsModule = $this->getModule('assets');

		add_action('admin_enqueue_scripts', array($this, 'enqueuePointersData'));

		$assetsModule->enqueueScripts(array(
			array(
				'handle' => 'MembershipApi',
				'source' => $this->getModule('base')->getAssetsPath() . '/js/api.js',
				'dependencies' => array('jquery')
			),
			array(
				'handle' => $this->getConfig('hooks_prefix') . 'tutorial',
				'source' => $this->getLocationUrl() . '/assets/js/tutorial.js',
				'dependencies' => array('wp-pointer', 'MembershipApi', 'jquery-ui-draggable')
			)
		), MBS_BACKEND_GLOBAL, true);


	}

	public function enqueuePointersData() {

		wp_enqueue_style('wp-pointer');

		wp_localize_script('MembershipApi', 'Membership', array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'wpnonce' => $this->getNonce(),
		));

		$data = array(
			'next'  => $this->translate('Next'),
			'close' => $this->translate('Close Tutorial'),
			'change' => $this->translate('Changing page...'),
			'pointersData'	=> $this->pointers(),
		);

		wp_localize_script($this->getConfig('hooks_prefix') . 'tutorial', 'MembershipPromoPointers', $data);
	}

	public function pointers()
	{
		return array(
			array(
				'id' => 'step-0',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Thank you for choosing our Membership plugin')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Let\'s make a quick tour through features and main options of the plugin. Just click "Next" button.')),
				'target' => '#toplevel_page_supsystic-membership',
				'edge'	  => 'left',
				'align'	 => 'left',
				'nextURL' => $this->generateUrl('membership', 'index') . '#main'
			),
			array(
				'id' => 'step-1',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Main Settings')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Here you can adjust main settings of the site page and enter your admin email.')),
				'target' => '.sc-tabs [data-target="main"]',
				'edge'	  => 'top',
				'align'	 => 'left',
				'nextURL' => $this->generateUrl('membership', 'index') . '#security'
			),
			array(
				'id' => 'step-2',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Security Settings')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Establish your privacy settings for you local social network.')),
				'target' => '.sc-tabs [data-target="security"]',
				'edge'	  => 'top',
				'align'	 => 'left',
				'nextURL' => $this->generateUrl('users', 'index'),
			),
			array(
				'id' => 'step-3',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Profile Settings')),
				'content'  => sprintf('<p>%s</p>', $this->translate('Here is possible to adjust external user\'s profiles look, Registration сonfirmation and others.')),
				'target' => '.sc-container .menu-sidebar-item:eq(2)',
				'edge'	  => 'left',
				'align'	 => 'center',
				'nextURL' => $this->generateUrl('users', 'index') . '#fields',
			),
			array(
				'id' => 'step-4',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Profile Fields')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Profile Fields are made for their creation and configuration of asking on registration page and demonstrating at About section in users profiles after loginning to the site.')),
				'target' => '.sc-tabs [data-target="fields"]',
				'edge'	  => 'top',
				'align'	 => 'left',
				'nextURL' => $this->generateUrl('roles', 'index'),
			),
			array(
				'id' => 'step-5',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Roles')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Roles tab offers you to manage with membership roles. By default there are three roles – Membership Administrator, Membership User and Membership Guest.')),
				'target' => '.sc-container .menu-sidebar-item:eq(3)',
				'edge'	  => 'left',
				'align'	 => 'center',
				'nextURL' => $this->generateUrl('groups', 'index'),
			),
			array(
				'id' => 'step-6',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Groups')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Tune needed settings for frontend appearance of Membership Groups.')),
				'target' => '.sc-container .menu-sidebar-item:eq(4)',
				'edge'	  => 'left',
				'align'	 => 'center',
				'nextURL' => $this->generateUrl('mail', 'index'),
			),
			array(
				'id' => 'step-7',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Mails Configuration')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Create and edit mailing templates of users letters and notifications for administrator.')),
				'target' => '.sc-container .menu-sidebar-item:eq(5)',
				'edge'	  => 'left',
				'align'	 => 'center',
				'nextURL' => $this->generateUrl('design', 'index'),
			),
			array(
				'id' => 'step-8',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Design Customization')),
				'content'   => sprintf('<p>%s</p>', $this->translate('To be unique develop your own coloristic combination of Membership design.')),
				'target' => '.sc-container .menu-sidebar-item:eq(6)',
				'edge'	  => 'left',
				'align'	 => 'center',
				'nextURL' => $this->generateUrl('reports', 'index'),
			),
			array(
				'id' => 'step-9',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Reports')),
				'content'   => sprintf('<p>%s</p>', $this->translate('This tab allows you to see detail user reports on restricted content types of other users and write to the reporter/reported user or block him/her.')),
				'target' => '.sc-container .menu-sidebar-item:eq(7)',
				'edge'	  => 'left',
				'align'	 => 'center',
				'nextURL' => $this->generateUrl('addons', 'index'),
			),
			array(
				'id' => 'step-10',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Extensions')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Upgrade your Membership site and provide beneficial abilities for clients with Membership PRO Addons by Supsystic.')),
				'target' => '.sc-container .menu-sidebar-item:eq(8)',
				'edge'	  => 'left',
				'align'	 => 'center',
				'nextURL' => $this->generateUrl('addons', 'index') . '#social-login',
			),
			array(
				'id' => 'step-11',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Social Login (PRO)')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Let your users register and login easily via Facebook or Twitter accounts.')),
				'target' => '.sc-tabs [data-target="social-login"]',
				'edge'	  => 'top',
				'align'	 => 'left',
				'nextURL' => $this->generateUrl('addons', 'index') . '#social-network-integration',
			),
			array(
				'id' => 'step-12',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Social Networks Integration (PRO)')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Allow your members share posts to several networks simultaneously in one click, making your site more famous again and again.')),
				'target' => '.sc-tabs [data-target="social-network-integration"]',
				'edge'	  => 'top',
				'align'	 => 'left',
				'nextURL' => $this->generateUrl('addons', 'index') . '#subscriptions',
			),
			array(
				'id' => 'step-13',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Subscriptions (PRO)')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Pick up your Membership users to different Subscription lists right after registration.')),
				'target' => '.sc-tabs [data-target="subscriptions"]',
				'edge'	  => 'top',
				'align'	 => 'left',
				'nextURL' => $this->generateUrl('addons', 'index') . '#subscriptions',
			),
			array(
				'id' => 'step-14',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('WooCommerce (PRO)')),
				'content'   => sprintf('<p>%s</p>', $this->translate('WooCommerce integration is made for those who want to create online shop inside Membership community.')),
				'target' => '.sc-tabs [data-target="woocommerce"]',
				'edge'	  => 'top',
				'align'	 => 'left',
				'nextURL' => $this->generateUrl('addons', 'ecommerce'),
			),
			array(
				'id' => 'step-15',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('E-Commerce (PRO)')),
				'content'   => sprintf('<p>%s</p>', $this->translate('Powerful stuff of Membership Ecommerce addon will help you to start and manage your own paid Membership site.')),
				'target' => '.sc-container .menu-sidebar-item:eq(9)',
				'edge'	  => 'left',
				'align'	 => 'center',
				'nextURL' => '#',
			),
			array(
				'id' => 'step-16',
				'title'	 => sprintf('<h3>%s</h3>', $this->translate('Well done!')),
				'content'   => sprintf('<p>%s</p>', $this->translate('<p><b>Upgrading</b></p><p>Once you have purchased PRO addon of plugin - you\'ll have to enter license key (you can find it in your personal account on our site). Go to the License tab and enter your email and license key. Once you have activated your PRO license - you can use plugin pro addon.</p><p> That\'s all. From this moment you can use your Membership plugin without any doubt. But if you still have some question - do not hesitate to contact us through our <a href="https://supsystic.com/contact-us/">internal support</a> or on our <a href="https://supsystic.com/forum/membership-plugin/">Supsystic Forum</a>. Besides you can always describe your questions on <a href="https://wordpress.org/support/plugin/membership-by-supsystic">WordPress Ultimate Forum</a>.</p><p><b>Enjoy this plugin?</b></p> <p>It will be nice if you\'ll help us and boost plugin with <a href="https://wordpress.org/support/plugin/membership-by-supsystic/reviews/">Five Stars rating on WordPress.org.</a> We hope that you like this plugin and wish you all the best! Good luck!</p>')),
				'target' => '.sc',
				'edge'	  => 'center top',
				'align'	 => 'top left',
				'nextURL' => '#',
			)
		);
	}

	public function checkPluginDeactivation() {
		if(function_exists('get_current_screen')) {
			$screen = get_current_screen();
			if($screen && isset($screen->base) && $screen->base == 'plugins') {
				wp_enqueue_script('jquery-ui-dialog');
				wp_enqueue_script('mbs.admin.plugins', $this->getLocationUrl() . '/assets/js/admin.plugins.js');
				wp_localize_script('mbs.admin.plugins', 'mbsPluginsData', array(
					'plugSlug' => $this->getEnvironment()->getConfig()->get('plugin_folder_name'),
					'nonce' => $this->getModule('base')->getNonce(),
				));
				//$assetsPath = $this->getModule('base')->getAssetsPath();
				$backendCss = array(
					'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css',
					$this->getAssetsPath(). '/css/supsystic-ui.css',
				);
				foreach($backendCss as $s) {
					$src = is_string($s) ? $s : $s['source'];
					wp_enqueue_style(basename($src), $src);
				}
				echo $this->render('@promo/pluginDeactivation.twig');
			}
		}
	}
}