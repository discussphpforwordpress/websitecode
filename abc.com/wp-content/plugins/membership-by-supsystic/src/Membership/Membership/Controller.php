<?php

class Membership_Membership_Controller extends Membership_Base_Controller
{
	public function indexAction(Rsc_Http_Request $request)
	{
		$settings = $this->getModel('settings', 'membership')->getSettings();
		$routesModule = $this->getModule('routes');

		$isBuddyPressExists = in_array('buddypress/bp-loader.php', array_keys(get_plugins()));
		$isUltimateMemberExists = in_array('ultimate-member/index.php', array_keys(get_plugins()));
		// Reports tab
		$orderColumn = 'id';
		$order = 'DESC';
		if (isset($request->query['order_by'])) {
			$orderColumn = $request->query['order_by'];
			$order = $request->query['order'];
		}
		$reportComment = $request->query->get('report_comment', null);
		$reports = $this->getModel('reports', 'reports')->get(50, 0, $orderColumn, $order, $reportComment);
		$groupCategoryModel = $this->getModel('GroupsCategory', 'Groups');
		$groupCategoryList = $groupCategoryModel->getGroupCategoryList('id');

		return $this->response(
			'@membership/backend/index.twig',
			array(
				'settings' => $settings,
                'maxFileUpload' => $this->maxFileUploadInBytes(),
				'roles' => get_editable_roles(),
				'wpPages' => get_pages(),
				'pages' => $routesModule->getRoutesPages(),
				'isBuddyPressExists' => $isBuddyPressExists,
				'isUltimateMemberExists' => $isUltimateMemberExists,
				'reports' => $reports,
				'reportsUrl' => $this->generateUrl('membership'),
				'groupCategoryList' => $groupCategoryList,
			)
		);
	}

    public function getIniValueInBytes($value)
    {
        $value = trim($value);
        $last = strtolower($value[strlen($value) - 1]);
	    $value = intval($value);

        switch($last)
        {
            case 'g':
                $value *= 1024;
            case 'm':
                $value *= 1024;
            case 'k':
                $value *= 1024;
        }

        return $value;
    }

    public function maxFileUploadInBytes()
    {
        $maxUpload = $this->getIniValueInBytes(ini_get('upload_max_filesize'));
        $maxPost = $this->getIniValueInBytes(ini_get('post_max_size'));
        $memoryLimit = $this->getIniValueInBytes(ini_get('memory_limit'));

        return min($maxUpload, $maxPost, $memoryLimit);
    }

	public function saveSettings($request) 
	{
		$settings = $request->get('settings');
		$this->getModel('settings', 'membership')->saveSettings($settings);
	}

	public function savePages($parameters) {
		$pages = $parameters->get('pages');
		$pages = $pages['pages'];
		$routesModule = $this->getModule('routes');
		$currentRoutes = $routesModule->getRoutesList();

		foreach ($pages as $slug => $pageId) {

			$currentRoutes[$slug] = (int) $pageId;

			if ($pageId == '__none') {
				unset($currentRoutes[$slug]);
			} else {

				$page = get_post($pageId);
				$pageContent = $page->post_content;
				$shortcodeName = $routesModule->getConfig('shortcode_name');
				$shortcode = "[$shortcodeName-$slug]";

				if (strpos($pageContent, $shortcode) === false) {

					$postContent = preg_replace('/\[supsystic\-membership\-.*?\]/m', $shortcode, $page->post_content);

					if ($postContent !== null && $postContent !== $page->post_content) {
						wp_update_post(array(
							'ID' => $pageId,
							'post_content' => $postContent
						));
					}

					if ($postContent === $page->post_content) {
						wp_update_post(array(
							'ID' => $pageId,
							'post_content' => $page->post_content . $shortcode
						));
					}
				}
			}
		}

		$routesModule->getModel('settings')->saveSettings($currentRoutes);

		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}

	public function createUnassignedPages($parameters) {

		$routesModule = $this->getModule('routes');
		$routePages = $routesModule->getRoutesPages();
		$newPages = array();
		$newRoutes = array();

		foreach ($routePages as $slug => $page) {
			if (!$page['id']) {
				$newPages[$slug] = $routesModule->createRoutePage($slug);
				$routePages[$slug]['id'] = $newPages[$slug]['id'];
			} else {
				if (!get_post($page['id'])) {
					$newPages[$slug] = $routesModule->createRoutePage($slug);
					$routePages[$slug]['id'] = $newPages[$slug]['id'];
				}
			}
		}

		foreach ($routePages as $slug => $page) {
			$newRoutes[$slug] = (int) $page['id'];
		}

		$routesModule->getModel('settings')->saveSettings($newRoutes);

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'pages' => $newPages,
			)
		);
	}

    public function createPage($parameters)
    {
	    $slug = $parameters->get('slug');
	    $page = $this->getModule('routes')->createRoutePage($slug);

	    return $this->response(
		    'ajax',
		    array(
			    'success' => true,
			    'page' => $page,
		    )
	    );
    }

    public function importBuddyPressData(Rsc_Http_Parameters $parameters) {

	    $buddyPressModel = $this->getModel('BuddyPress', 'Membership');

	    $optionsName = $this->getConfig()->get('db_prefix') . 'buddyPressImport';
		$importedData = get_option($optionsName, array());
	    @set_time_limit(300);

	    if ($parameters->get('fields', null) == 'true' && !in_array('fields', $importedData)) {
			$fieldsModel = $this->getModel('Fields', 'Users');

			$fields = $fieldsModel->getFields();
			$bpFields = $buddyPressModel->prepareFieldsForMerge($buddyPressModel->getBuddyPressFields());

			$fieldNames = array();

			foreach ($fields as $field) {
				$fieldNames[] = $field['name'];
			}

			foreach ($bpFields as $field) {
				if (!in_array($field['name'], $fieldNames)) {
					$fields[] = $field;
				}
			}

			$fieldsModel->saveFields($fields);

			$buddyPressModel->insertBuddyPressFields();
			$buddyPressModel->insertBuddyPressFieldsData();
		    $importedData[] = 'fields';
		}

		if ($parameters->get('groups', null) == 'true' && !in_array('groups', $importedData)) {
			$buddyPressModel->insertBuddyPressGroups();
			$importedData[] = 'groups';
		}

		if ($parameters->get('friends', null) == 'true' && !in_array('friends', $importedData)) {
			$buddyPressModel->insertBuddyPressFriends();
			$importedData[] = 'friends';
		}

		if ($parameters->get('activity', null) == 'true' && !in_array('activity', $importedData)) {
			$buddyPressModel->insertBuddyPressActivity();
			$importedData[] = 'activity';
		}

		update_option($optionsName, $importedData);

	    return $this->response(
		    'ajax',
		    array(
			    'success' => true
		    )
	    );

    }

	public function importUltimateMemberData(Rsc_Http_Parameters $parameters) {

		$umModel = $this->getModel('UltimateMember', 'Membership');

		$optionsName = $this->getConfig()->get('db_prefix') . 'ultimateMemberImport';
		$importedData = get_option($optionsName, array());
		@set_time_limit(300);

		if ($parameters->get('fields', null) == 'true' /* && !in_array('fields', $importedData) */) {
			$fieldsModel = $this->getModel('Fields', 'Users');

			$fields = $fieldsModel->getFields();
			$umFields = $umModel->prepareFieldsForMerge($umModel->getFields());

			$fieldNames = array();

			foreach ($fields as $field) {
				$fieldNames[] = $field['name'];
			}

			foreach ($umFields as $field) {
				if (!in_array($field['name'], $fieldNames)) {
					$fields[] = $field;
				}
			}

			$fieldsModel->saveFields($fields);

			$umModel->insertFields($umFields);
			$umModel->insertFieldsData($umFields);
			$importedData[] = 'fields';
		}

		update_option($optionsName, $importedData);

		return $this->response(
			'ajax',
			array(
				'success' => true
			)
		);
	}

	public function reviewNoticeResponse(Rsc_Http_Parameters $parameters) {
		$response = $parameters->get('response');
		$option = $this->getConfig()->get('db_prefix') . 'reviewNotice';
		if ($response === 'later') {
			update_option($option, array(
				'time' => time() + (60 * 60 * 24 * 2),
				'shown' => false
			));
		} else {
			update_option($option, array(
				'shown' => true
			));
		}

		return $this->response(
			'ajax',
			array(
				'success' => true
			)
		);
	}
}
