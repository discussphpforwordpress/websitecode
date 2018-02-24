<?php

class Membership_Installer_Module extends Membership_Base_Module {
	public $installerModel;

	public function afterModulesLoaded()
	{
		if (is_admin()) {

			$slug = $this->getConfig()->get('plugin_slug');
			$activation = get_option($slug . '_activation');

			if ($activation !== false) {
				$this->onActivation(!empty($activation));
				delete_option($slug . '_activation');
			} else {
				$this->updateCheck('installed_version', 'plugin_version');
			}
		}

		$this->pluginUninstallButton();
	}

	public function pluginUninstallButton() {

		if (is_admin()) {
			global $pagenow;
			if ($pagenow === 'plugins.php') {

				$localizeData = array(
					'translate' => array(
						'Uninstall' => $this->translate('Uninstall'),
					),
					'uninstallUrl' => $this->generateUrl('Installer', 'uninstall')
				);

				$loadAssets = true;

				if (is_multisite()) {
					$siteWidePlugins = get_site_option('active_sitewide_plugins');
					$pluginName = $this->getConfig('plugin_basename');
					$networkActivated = isset($siteWidePlugins[$pluginName]);

					if ($networkActivated && is_network_admin()) {
						$localizeData['translate']['Uninstall'] = $this->translate('Network Uninstall');
						$localizeData['uninstallUrl'] = $this->generateUrl('Installer', 'uninstall', array('networkActivated' => true));
					}

					if ((!$networkActivated && is_network_admin()) ||
					    ($networkActivated && !is_network_admin())
					) {
						$loadAssets = false;
					}
				}

				$assetsModule = $this->getModule('assets');
				$assetsPath = $this->getAssetsPath();

				if ($loadAssets) {
					$assetsModule->enqueueScripts(array(
						array(
							'source' => $assetsPath . '/js/plugins.backend.js',
							'dependencies' => array('jquery')
						)
					), MBS_BACKEND_GLOBAL, true);

					$assetsModule->localizeScript('plugins.backend.js', 'MembershipUninstall', $localizeData);
				}

			}
		}
	}

	/**
	 * Need to allow use $this->getModule() helper when register_activation_hook called.
	 * $this->getModule() disallow because register_activation_hook called before Rsc_Resolver::init() method
	 */
	public function onInstall() {
		if (is_admin()) {
			$this->getResolver()->setModules($this->getResolver()->getModulesList());
		}
	}

	/**
	 * On activation action calls when plugin activated or get updates
	 * @param $networkWide bool True if activated with Network Activate
	 */
	public function onActivation($networkWide) {

		if ($networkWide) {
			global $wpdb;
			$currentBlogId = $wpdb->blogid;

			$blogs = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogs as $blogId) {
				switch_to_blog($blogId); // Need to get proper base prefix
				$this->updateCheck('installed_version', 'plugin_version');
				$this->createSettings();
			}

			switch_to_blog($currentBlogId);

		} else {
			$this->updateCheck('installed_version', 'plugin_version');
			$this->createSettings();
		}

         if (!intval(get_option('users_can_register'))) {
             update_option('users_can_register', 1);
         }
	}

	public function updateCheck($installedVersionOptionName, $currentVersionConfigName, $updatesDirectoryPath = null) {

		if (! $updatesDirectoryPath) {
			$updatesDirectoryPath = dirname(__FILE__) . '/updates';
		}

		$config = $this->getConfig();
		$dbPrefix = $config->get('db_prefix');
		$installedVersion = get_option($dbPrefix . $installedVersionOptionName);
		$currentVersion = $config->get($currentVersionConfigName);

		if (version_compare($installedVersion, $currentVersion, '>=')) {
			return;
		}

		$updates = array_diff(scandir($updatesDirectoryPath), array('..', '.'));

		foreach ($updates as $filename) {
			$version = str_replace('.sql', '', $filename);
			if (version_compare($currentVersion, $version, '>=') &&
                version_compare($installedVersion, $version, '<'))
			{
				try {
					$this->getModel()->updateFromFile($updatesDirectoryPath . '/' . $filename);
				} catch (Exception $e) {
					wp_die(sprintf(
						'Failed to update database. <br>%s',
						$e->getMessage()
					));
				}
			}
		}

        update_option(
            $dbPrefix . $installedVersionOptionName,
            $currentVersion
        );
		// script runned once at "membership install life"
		$this->runedAtOnce();
	}

	protected function runedAtOnce() {
		$optionName = 'mbsRunActionAtOnceInPlugin';
		$strVal = get_option($optionName);

		$parsedArr = array();
		if($strVal) {
			$tempArr = json_decode($strVal, true);
			if(is_array($tempArr) && count($tempArr)) {
				$parsedArr = $tempArr;
			}
		}
		// if not runned -> runing
		if(empty($parsedArr['groupCreatorUpdated'])) {
			$installerModel = $this->getModel('Installer', 'Installer');
			$installerModel->updateUserGroupCreator();
			$parsedArr['groupCreatorUpdated'] = 1;
		}

		update_option($optionName, json_encode($parsedArr));
	}

	public function createSettings() {
		$modules = array('membership', 'design', 'users', 'mail', 'groups');
		foreach ($modules as $module) {
			$settingsModel = $this->getModel('settings', $module);
			if (! $settingsModel->getSettings()) {
				$settingsModel->saveSettings($settingsModel->defaultSettings());
			}
		}
	}

	private function seed() {

		// Seed Activity

		$users = array(1, 2, 3);

		$activityModel = $this->getModel('activity', 'activity');

		// Create activities
		foreach (range(0, 10) as $i) {
			$userKey = mt_rand(0, 2);
			$relatedUserKey = mt_rand(0, 1);

			$_users = $users;
			$userId = $_users[$userKey];
			unset($_users[$userKey]);

			$_users = array_values($_users);
			$relatedUserId = $_users[$relatedUserKey];
			unset($_users[$relatedUserKey]);
			$relatedUserId2 = array_shift($_users);

			$postId = $activityModel->createActivity($userId, 'post', $this->randomPhrase());
			$relatedPostId = $activityModel->createActivity($userId, 'related_post', $this->randomPhrase(), $relatedUserId);
			$activityModel->createActivity($relatedUserId2, 'shared_post', null, null, null, $postId);
			$activityModel->createActivity($relatedUserId2, 'shared_related_post', null, null, null, $relatedPostId);
		}
	}

	public function removeDirRecursive($dir) {
		if (file_exists($dir)) {
			$files = array_diff(scandir($dir), array('.', '..'));
			foreach ($files as $file) {
				(is_dir("$dir/$file")) ? $this->removeDirRecursive("$dir/$file") : unlink("$dir/$file");
			}
			return rmdir($dir);
		}
	}

	public function uninstall($networkWideUninstall = false) {

		global $wpdb;
		$dbPrefix = $this->getConfig('db_prefix');
		$tables = array(
			'settings',
			'user_fields',
			'groups_settings',
			'groups_users',
			'groups_blacklists',
			'groups_invites',
			'groups_followers',
			'groups_tags',
			'groups',
			'fields_data',
			'fields',
			'roles',
			'links',
			'activity_images',
			'activity_links',
			'activity_tags',
			'activity',
			'comments',
			'friends',
			'followers',
			'conversations_messages',
			'conversations_users',
			'conversations_users_blocks',
			'messages_users',
			'messages',
			'conversations',
			'attachments',
			'groups_images',
			'users_images',
			'images_thumbnails',
			'albums_images',
			'images',
			'groups_albums',
			'users_albums',
			'albums',
			'friends',
			'notifications',
			'reports',
			'tags',
			'users_statuses',
			'users_roles',
			'roles',
			'links',
			'badges',
			'users_badges_points',
		);

		if (is_multisite() && $networkWideUninstall) {
			$currentBlogId = $wpdb->blogid;

			$blogs = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

			foreach ($blogs as $blogId) {
				switch_to_blog($blogId);

				try {
					$currentRoutes = $this->getModule('routes')->getRoutesList();
					foreach($currentRoutes as $id) {
						wp_delete_post($id, true);
					}
				} catch (Exception $e) {
					print $e->getMessage();
				}

				foreach ($tables as $table) {
					$table = $wpdb->prefix . $dbPrefix . $table;
					$wpdb->query("DROP TABLE IF EXISTS $table");
					if ($wpdb->last_error !== '') {
						$wpdb->print_error();
					}
				}


				delete_option($dbPrefix . 'installed_version');
			}

			switch_to_blog($currentBlogId);
		} else {


			try {
				$currentRoutes = $this->getModule('routes')->getRoutesList();
				foreach($currentRoutes as $id) {
					wp_delete_post($id, true);
				}
			} catch (Exception $e) {
				print $e->getMessage();
			}


			foreach ($tables as $table) {
				$table = $wpdb->prefix . $dbPrefix . $table;
				$wpdb->query("DROP TABLE IF EXISTS $table");
				if ($wpdb->last_error !== '') {
					$wpdb->print_error();
				}
			}

			delete_option($dbPrefix . 'installed_version');
		}

		$uploadDirData = $this->getConfig()->get('wp_upload_dir');
		$this->removeDirRecursive($uploadDirData['basedir'] . '/membership');

		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
		deactivate_plugins($this->getConfig('plugin_basename'));
	}
}
