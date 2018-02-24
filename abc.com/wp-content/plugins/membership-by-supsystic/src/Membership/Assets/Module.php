<?php
class Membership_Assets_Module extends Membership_Base_Module {
	private $_cdnUrl = '';
	private $_loaded = array();

	public function getCdnUrl() {
		if(empty($this->_cdnUrl)) {
			$this->_cdnUrl = (is_ssl() ? 'https' : 'http'). '://supsystic-42d7.kxcdn.com/';
		}
		return $this->_cdnUrl;
	}

	public function onInit() {
		$this->handler = new Membership_Assets_Handler($this);
	}

	public function registerAssets($styles = array(), $scripts = array()) {
		$this->handler->register('styles', $styles);
		$this->handler->register('scripts', $scripts);
	}

	public function enqueueAssets($styles = array(), $scripts = array(), $destination = MBS_BACKEND, $global = false) {
		$this->enqueueStyles($styles, $destination, $global);
		$this->enqueueScripts($scripts, $destination, $global);
		return $this;
	}

	public function enqueueScripts($scripts = array(), $destination = MBS_BACKEND, $global = false) {
		if(is_string($scripts)) {
			$scripts = array( $scripts );
		}
		$this->handler->enqueue('scripts', $scripts, $destination, $global);
		return $this;
	}

	public function enqueueStyles($styles = array(), $destination = MBS_BACKEND, $global = false) {
		if(is_string($styles)) {
			$styles = array( $styles );
		}
		$this->handler->enqueue('styles', $styles, $destination, $global);
		return $this;
	}

	public function loadRegisteredAssets($styles = array(), $scripts = array()) {
		foreach ($styles as $source) {
			$handle = basename($source);
			wp_enqueue_style($handle);
		}

		foreach ($scripts as $source) {
			if (is_array($source)) {
				if (isset($source['handle'])) {
					$handle = $source['handle'];
				} else {
					$handle = basename($source['source']);
				}
			} else {
				$handle = basename($source);
			}

			wp_enqueue_script($handle);
		}
	}

	private function _setLoaded( $key ) {
		$this->_loaded[ $key ] = true;
	}

	private function _isLoaded( $key ) {
		return isset($this->_loaded[ $key ]) ? true : false;
	}

	public function loadJqGrid() {
		if(!$this->_isLoaded('jsGrid')) {
			$this->_setLoaded('jsGrid');
			$this->getCdnUrl();
			$scripts = array(
				array('handle' => 'jq-grid', 'source' => $this->_cdnUrl. 'lib/jqgrid/jquery.jqGrid.min.js'),
			);
			$styles = array(
				array('handle' => 'jq-grid', 'source' => $this->_cdnUrl. 'lib/jqgrid/ui.jqgrid.css'),
				array('handle' => 'supsystic-jq-grid', 'source' => $this->getAssetsPath(). '/css/jqgrid.css'),
			);
			$langToLoad = $this->getEnvironment()->getLangCode2Letter();
			$availableLocales = array('ar','bg','bg1251','cat','cn','cs','da','de','dk','el','en','es','fa','fi','fr','gl','he','hr','hr1250','hu','id','is','it','ja','kr','lt','mne','nl','no','pl','pt','pt','ro','ru','sk','sr','sr','sv','th','tr','tw','ua','vi');
			if(!in_array($langToLoad, $availableLocales)) {
				$langToLoad = 'en';
			}
			$scripts[] = array('handle' => 'jq-grid-lang', 'source' => $this->_cdnUrl. 'lib/jqgrid/i18n/grid.locale-'. $langToLoad. '.js');
			$this->enqueueAssets( $styles, $scripts );
		}
		return $this;
	}

	public function loadDatePicker() {
		if(!$this->_isLoaded('jqDatepicker')) {
			$this->_setLoaded('jqDatepicker');
			$this->enqueueScripts(array('handle' => 'jquery-ui-datepicker'));
		}
		return $this;
	}

	public function localizeScript($handle, $name, $data) {
		$this->handler->registerLocalizeData($handle, $name, $data);
	}
}