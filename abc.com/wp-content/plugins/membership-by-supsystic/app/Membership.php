<?php

class SupsysticMembership {

	public function __construct($version) {
        $shortcode = 'supsystic-membership';
        $prefix = 'supsystic_membership';
        $pluginPath = dirname(dirname(__FILE__));

        if (!class_exists('Rsc_Autoloader', false)) {
            require dirname(dirname(__FILE__)) . '/vendor/Rsc/Autoloader.php';
            Rsc_Autoloader::register();
        }

		add_action('after_setup_theme', array($this, 'loadThemeTextDomain'));
        // add_action('init', array($this, 'addShortcodeButton'));

        $environment = new Rsc_Environment($shortcode, $version, $pluginPath);

        $this->config = array(
	        'environment' => $this->getPluginEnvironment(),
	        'default_module' => 'membership',
	        'theme_folder' => 'membership-by-supsystic',
	        'theme_lang_folder' => 'supsystic-membership-lang',
	        'lang_domain' => 'membership-by-supsystic',
	        'lang_path' => plugin_basename(dirname(__FILE__)) . '/lang',
	        'plugin_source' => $pluginPath . '/src',
	        'plugin_basename' => plugin_basename($pluginPath . '/index.php'),
	        'plugin_title_name' => 'Membership by Supsystic',
	        'plugin_prefix' => 'Membership',
	        'plugin_menu' => array(
		        'page_title' => __('Membership by Supsystic', $shortcode),
		        'menu_title' => __('Membership by Supsystic', $shortcode),
		        'capability' => 'manage_options',
		        'menu_slug' => $shortcode,
		        'icon_url' => 'dashicons-groups',
		        'position' => '100.3',
	        ),
	        'shortcode_name' => $shortcode,
	        'db_prefix' => $prefix . '_',
	        'hooks_prefix' => $prefix . '_',
	        'page_url' => 'http://supsystic.com/plugins/membership/',
	        'ajax_url' => admin_url('admin-ajax.php'),
	        'admin_url' => admin_url(),
	        'addons' => array(),
	        'plugin_slug' => 'supsystic-membership',
			'plugin_folder_name' => basename(dirname(dirname(__FILE__))),
        );

        $environment->configure($this->config);

		register_activation_hook($pluginPath . '/index.php', array($this, 'onActivation'));

        $this->environment = $environment;
        $this->alerts = array();
        $this->pluginPath = $pluginPath;

        $this->initialize();
    }

	public function run() {

	    global $membership_supsystic;

		$this->environment->run();
        $this->environment->getTwig()->addGlobal('core_alerts', $this->alerts);

        $membership_supsystic = $this->environment;
	}

	public function loadThemeTextDomain() {

		$themeTranslationPath = get_template_directory() . DIRECTORY_SEPARATOR . $this->config['theme_lang_folder'];

		if (is_dir($themeTranslationPath)) {
			/**
			 * Set priority translations from theme folder over plugin folder translation.
			 */
			unload_textdomain($this->config['lang_domain']);
			load_theme_textdomain($this->config['lang_domain'], $themeTranslationPath);
			$this->environment->getLang()->_loadPluginsTextDomain();
		}
	}

    protected function getPluginEnvironment() {
        $environment = Rsc_Environment::ENV_PRODUCTION;

        if (defined('WP_DEBUG') && WP_DEBUG) {
            $environment = Rsc_Environment::ENV_DEVELOPMENT;
        }

        return $environment;
    }

	public function getEnvironment() {
		return $this->environment;
	}

    protected function initialize() {
        $config = $this->environment->getConfig();
        $uploads = wp_upload_dir(null, false);

        if (!is_writable($uploads['basedir'])) {
            $this->alerts[] = sprintf(
                '<div class="error">
                    <p>You need to make your "%s" directory writable.</p>
                </div>',
                $uploads['basedir']
            );

            $config->set('uploads_rw', false);
        } else {
            $this->initFilesystem();
        }

        $config->add('wp_upload_dir', $uploads);
    }

    /**
     * Creates plugin's directories.
    */
    protected function initFilesystem() {
        $directories = array(
            'tmp' => '/membership',
            'log' => '/membership/log',
            'cache' => '/membership/cache',
            'cache_twig' => '/membership/cache/twig',
        );

        foreach ($directories as $key => $dir) {
            if (false !== $fullPath = $this->makeDirectory($dir)) {
                $this->environment->getConfig()->add('plugin_' . $key, $fullPath);
            }
        }
    }

    
    /**
     * Make directory in uploads directory.
     * @param string $directory Relative to the WP_UPLOADS dir
     * @return bool|string FALSE on failure, full path to the directory on success
     */
    protected function makeDirectory($directory) {
        $uploads = wp_upload_dir();

        $basedir = $uploads['basedir'];
        $dir = $basedir . $directory;
        if (!is_dir($dir)) {
            if (false === @mkdir($dir, 0775, true)) {
                return false;
            }
        } else {
            if (! is_writable($dir)) {
                return false;
            }
        }

        return $dir;
    }

    public function onActivation($networkActivation) {
	    $slug = $this->environment->getConfig()->get('plugin_slug');
	    add_option($slug . '_activation', $networkActivation);
    }
}