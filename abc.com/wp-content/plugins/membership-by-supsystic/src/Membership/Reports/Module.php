<?php
class Membership_Reports_Module extends Membership_Base_Module {

    public function afterModulesLoaded() {
        $settings = $this->getSettings();

        if (is_admin() || isset($settings['base']['main']['reports']) && $settings['base']['main']['reports'] === 'true') {
            $this->getModule('routes')->registerAjaxRoutes(array(
                'reports.getReports' => array(
                    'method' => 'get',
                    'admin' => true,
                    'handler' => array($this->getController(), 'getReports')
                ),
                'reports.send' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'createReport')
                ),
                'reports.setStatus' => array(
                    'method' => 'post',
	                'admin' => true,
                    'handler' => array($this->getController(), 'setStatus')
                ),
            ));

            if (!$this->isModule('reports')) {
                return;
            }

            $assetsPath = $this->getAssetsPath();
            $baseAssetsPath = $this->getModule('base')->getAssetsPath();

            $this->getModule('assets')->enqueueAssets(
                array(
                    $this->getModule('base')->getAssetsPath() . '/css/option.backend.css',
                    $baseAssetsPath . '/lib/tooltipster/tooltipster.bundle.min.css',
                ),
                array(
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/2.7.2/jquery.serializejson.min.js',
                    $assetsPath . '/js/reports.backend.js',
                    $baseAssetsPath . '/lib/tooltipster/tooltipster.bundle.min.js',
                    $this->getModule('membership')->getAssetsPath() . '/js/membership.backend.js',
                )
            );
        }
    }
}