<?php 
/**
* 
*/
class Membership_Promo_Controller extends Membership_Base_Controller
{
    public function welcomeAction(Rsc_Http_Request $request)
    {
		$model = $this->getModel('promo');
		$model->bigStatAdd('Welcome Show');
		update_option('mbs_plug_welcome_show', time());	// Remember this
        return $this->response(
            '@promo/promo.twig',
            array(
                'plugin_name' => $this->getConfig()->get('plugin_title_name'),
                'plugin_version' => $this->getConfig()->get('plugin_version'),
                'start_url' => '?page=supsystic-membership&module=membership'
            )
        );
    }

	public function endTutorial() {
		update_user_meta(get_current_user_id(), $this->getConfig()->get('hooks_prefix') . 'tutorialShowed', true);
	}
	
	public function saveDeactivateDataAction(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		//$lang = $this->getEnvironment()->getLang();
		$model = $this->getModel('promo');
		$model->saveDeactivateData($request->post);
		return $this->response(Rsc_Http_Response::AJAX, array(
			'success' => true,
			'message' => $this->translate('Hope you will come back.'),
		));
	}
}