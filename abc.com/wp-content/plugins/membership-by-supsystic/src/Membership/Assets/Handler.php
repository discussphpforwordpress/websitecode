<?php

class Membership_Assets_Handler {

	protected $styles = array();
	protected $scripts = array();
	protected $enqueued = array();
	protected $handles = array();
	protected $localizeData = array();
	private $_enqued = array();

	public function __construct($module) {
		$this->module = $module;
		$this->config = $module->getConfig();
        $this->prefix = $this->config->get('plugin_name') . '-';
        $this->version = $this->config->get('plugin_version');
        $this->isPluginPage = $module->isPluginPage();
        add_action('wp_enqueue_scripts', array($this, 'enqueueFrontend'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueBackend'));
	}

	public function register($type, $assets) {
		$this->{'add' . ucfirst($type)}($assets);
	}

	public function registerLocalizeData($handle, $name, $data) {
		$this->localizeData[] = array(
			'handle' => $handle,
			'name' => $name,
			'data' => $data,
		);
	}

	public function localizeData() {
		foreach ($this->localizeData as $data) {
			wp_localize_script($data['handle'], $data['name'], $data['data']);
		}
	}

	public function enqueue($type, $assets, $location = MBS_BACKEND, $global = false) {
		if (!$global && !$this->isPluginPage && $location == MBS_BACKEND) {
			return;
		}
		foreach ($assets as $i => $asset) {
			$assets[ $i ] = $this->prepare($asset);
			if(!isset($this->_enqued[ $location ])) {	// if it was not enqued before - add to to stack
				$this->enqueued[$location][$type][] = $assets[ $i ];
			}
		}

		// For case when it was enqued - let it be pushed here to footer
		if(isset($this->_enqued[ $location ])) {
			$this->{'enqueue'. ucfirst($type)}( $assets );
		}
	}

	private function addStyles($assets) {
		foreach ($assets as $asset) {
			$this->styles[] = $this->prepare($asset);
		}
	}

	private function addScripts($assets) {
		foreach ($assets as $asset) {
			$this->scripts[] = $this->prepare($asset);
		}
	}

	private function prepare($asset) {
		$dependencies = array();
		$version = $this->version;

		if (is_array($asset)) {

			if (!isset($asset['source'])) {
				return;
			}

			$source = $asset['source'];

			if (isset($asset['handle'])) {
				$handle = $asset['handle'];
			} else {
				$handle = basename($asset['source']);
			}

			if (isset($asset['dependencies'])) {
				$dependencies = $asset['dependencies'];
			}

			if (isset($asset['version'])) {
				$version = $asset['version'];
			}

		} elseif (is_string($asset)) {
			$source = $asset;
			$handle = basename($source);

			if ($source == $handle) {
				return array(
					'handle' => $handle,
				);
			}
		}

		if (in_array($handle, $this->handles)) {
			// throw new Exception(sprintf('Handle with name %s already registered', $handle));
		}

		$this->handles[] = $handle;

		return array(
			'handle' => $handle,
			'source' => $source,
			'dependencies' => $dependencies,
			'version' => $version
		);
	}

	public function enqueueFrontend() {
		$this->registerAssets();
		$this->enqueueAssets( MBS_FRONTEND );
		$this->localizeData();
	}

	public function enqueueBackend() {
		$this->registerAssets();
		$this->enqueueAssets(MBS_BACKEND);
		$this->enqueueAssets(MBS_BACKEND_GLOBAL);
		$this->localizeData();
	}

	private function enqueueAssets($location) {

		if (isset($this->enqueued[$location])) {
			if (isset($this->enqueued[$location]['styles'])) {
				$this->enqueueStyles($this->enqueued[$location]['styles']);
			}

			if (isset($this->enqueued[$location]['scripts'])) {
				$this->enqueueScripts($this->enqueued[$location]['scripts']);
			}
		}

		$this->_enqued[ $location ] = 1;
	}

	private function registerAssets() {
		foreach ($this->styles as $style) {
			extract($style);
			wp_register_style($handle, $source, $dependencies, $version);
		}

		foreach ($this->scripts as $script) {
			extract($script);
			wp_register_script($handle, $source, $dependencies, $version, true);
		}
	}

	private function enqueueStyles($styles) {
		foreach ($styles as $style) {
			extract($style);
			if (!isset($style['source'])) {
				wp_enqueue_style($handle);
				continue;
			}
			wp_enqueue_style($handle, $source, $dependencies, $version);
		}
	}

	private function enqueueScripts($scripts) {
		foreach ($scripts as $script) {
			extract($script);

			if (!isset($script['source'])) {
				wp_enqueue_script($handle);
				continue;
			}
			wp_enqueue_script($handle, $source, $dependencies, $version, true);
		}
	}
}