<?php
class Membership_Reports_Model_Reports extends Membership_Base_Model_Base {

    public function create($reporterId, $reportedId, $contentType, $comment) {
        $fields = array('content_type', 'comment', 'reporter_id', 'reported_id', 'date');
        $values = array('%s', '%s', '%d', '%d', '%s');
        $currentDateTime = $this->getCurrentDateInUTC();
        $queryParams = array($contentType, $comment, $reporterId, $reportedId, $currentDateTime);

        $query = $this->getQueryBuilder()
            ->insertInto($this->getTable('reports'))
            ->fields($fields)
            ->values($values)
            ->build();

        $this->db->query(
            $this->db->prepare($query, $queryParams)
        );

        return $this->db->insert_id;
    }

	public function get($limit = 50, $offset = 0, $orderColumn = 'id', $order = 'DESC', $commentInfo = null) {

    	$queryParams = array(
		    $limit,
		    $offset
	    );
		$leftJoinStr = null;

    	if (!in_array($orderColumn, array(
    		'id',
		    'content_type',
		    'reporter_id',
		    'reported_id',
		    'status',
		    'date'
	    ))) {
			$orderColumn = 'id';
	    }

	    $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

		if($orderColumn == 'reporter_id') {
			$leftJoinStr = 'LEFT JOIN {wp_prefix}users w ON w.ID = r.reporter_id';
			$orderColumn = 'w.display_name';
		} else if($orderColumn == 'status') {
			// only for status sorting
			if($order == 'ASC') {
				$order = "CASE r.status WHEN 'new' THEN 2 ELSE 1 END, date {$order}";
			} else {
				$order = "CASE r.status WHEN 'new' THEN 1 ELSE 2 END, date {$order}";
			}
			$orderColumn = null;
		} else {
			$orderColumn = 'r.' . $orderColumn;
		}

		$commentInfo = trim($commentInfo);
		// always Add User table when user enter Search Field
		if($orderColumn != 'reporter_id' && $commentInfo) {
			$leftJoinStr = 'LEFT JOIN {wp_prefix}users w ON w.ID = r.reporter_id';
		}

		$query = $this->preparePrefix("
			SELECT r.*
			FROM {prefix}reports r
			{$leftJoinStr}
			WHERE r.reported_id IS NOT NULL
    	");

		if($commentInfo) {
			$likeParam1 = '%' . $this->db->_escape($commentInfo) . '%';
			$queryParams = array_merge(array($likeParam1, $likeParam1), $queryParams);
			$query = $query . " AND (r.comment like %s OR w.display_name like %s)";
		}
		$query = $query . "ORDER BY {$orderColumn} {$order}
			LIMIT %d
			OFFSET %d";

	    array_unshift($queryParams, $query);

	    $reports = $this->getData($queryParams);

        return $this->prepareReportsRelatedData($reports);
    }

    public function prepareReportsRelatedData($reports) {

	    if (!$reports) {
		    return array();
	    }

	    $relatedData = array(
		    'users' => array(),
		    'activities' => array(),
		    'groups' => array(),
	    );

	    $fetchedData = array(
		    'users' => array(),
		    'activities' => array(),
		    'groups' => array(),
	    );

	    foreach ($reports as $key => $report) {
		    switch ($report['content_type']) {
			    case 'user':
				    $relatedData['users'][] = $report['reporter_id'];
				    $relatedData['users'][] = $report['reported_id'];
				    break;
			    case 'activity':
				    $relatedData['users'][] = $report['reporter_id'];
				    $relatedData['activities'][] = $report['reported_id'];
				    break;
		    }
	    }

	    $reports = $this->getDispatcher()->apply('reports.relatedDataPrepare', array($reports, &$relatedData));

	    $usersModule = $this->environment->getModule('users');
	    $usersModel = $usersModule->getModel('profile');

	    $users = $usersModel->getUsersByIds(array('users' => array_unique($relatedData['users'])));


	    foreach ($users as &$user) {
	    	$user['editLink'] = get_edit_user_link((int)$user['id']);
	    	$user['url'] = $usersModule->getUserProfileUrl($user);
		    $fetchedData['users'][$user['id']] = $user;
		    $fetchedData['users'][$user['id']] = $user;
	    }

	    if ($relatedData['activities']) {
		    $activities = $this->getModel('Activity', 'Activity')->getActivityById($relatedData['activities'], null);
		    foreach ($activities as $activity) {
			    if ($activity['author']) {
				    $activity['author']['editLink'] = get_edit_user_link((int) $activity['author']['id']);
				    $activity['author']['url'] = $usersModule->getUserProfileUrl($activity['author']);
			    }
			    $fetchedData['activities'][$activity['id']] = $activity;
		    }
	    }

	    foreach ($reports as $key => &$report) {
		    switch ($report['content_type']) {
			    case 'user':
				    $report['reporter'] = @$fetchedData['users'][$report['reporter_id']];
				    $report['reported'] = @$fetchedData['users'][$report['reported_id']];
				    break;
			    case 'activity':
				    $report['reporter'] = @$fetchedData['users'][$report['reporter_id']];
				    $report['reported'] = @$fetchedData['activities'][$report['reported_id']];
				    break;
		    }
	    }

	    return $this->getDispatcher()->apply('notifications.relatedData', array($reports, $fetchedData));
    }

    public function update($reportId, $status) {
        $query = $this->getQueryBuilder()
            ->update($this->getTable('reports'))
            ->set(array('status' => '%s'))
            ->where('id', '=', '%d')
            ->build();

        return $this->db->query(
            $this->db->prepare($query, array($status, $reportId))
        );
    }
}