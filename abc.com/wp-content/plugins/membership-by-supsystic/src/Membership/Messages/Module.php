<?php

class Membership_Messages_Module extends Membership_Base_Module
{

	public function afterModulesLoaded() {

        $settings = $this->getSettings();

        if (is_admin() || $settings['base']['main']['messages'] === 'true') {
            $this->getModule('routes')->registerAjaxRoutes(array(
                'messages.sendMessage' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'sendMessage')
                ),
	            'messages.sendMessageToUser' => array(
		            'method' => 'post',
		            'handler' => array($this->getController(), 'sendMessageToUser')
	            ),
                'messages.getMessages' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'getMessages')
                ),
                'messages.checkUnreadMessages' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'checkUnreadMessages')
                ),
                'messages.deleteMessages' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'deleteMessages')
                ),
                'messages.createConversation' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'createConversation')
                ),
                'messages.deleteConversation' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'deleteConversation')
                ),
                'messages.blockUser' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'blockUser')
                ),
                'messages.unblockUser' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'unblockUser')
                ),
            ));
        }
	}

	public function enqueueMessagesAssets() {

		$assetsPath = $this->getAssetsPath();
		$baseModule = $this->getModule('Base');
		$baseAssetsPath = $baseModule->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				array(
					'source' => $assetsPath . '/css/messages.frontend.css',
					'dependencies' => array(
						'semantic-ui',
					)
				)
			),
			array(
				$baseAssetsPath . '/lib/moment/moment.min.js',
				$baseAssetsPath . '/lib/moment/locales.min.js',
				$assetsPath . '/js/messages.frontend.js'
			),
			MBS_FRONTEND
		);

	}


}