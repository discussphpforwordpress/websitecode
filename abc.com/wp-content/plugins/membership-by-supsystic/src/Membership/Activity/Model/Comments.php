<?php

class Membership_Activity_Model_Comments extends Membership_Base_Model_Base
{
	public function getActivityComments($activityId, $currentUserId, $limit, $offsetId = null) {

		$whereQuery = '';

		if ($offsetId) {
			$whereQuery = $this->db->prepare("AND a.id < '%d'", $offsetId);
		}

		$queryLimit = $this->db->prepare("LIMIT %d", $limit);

		$query = $this->preparePrefix("
			SELECT 
				a.*,
				COUNT(ar.id) as replies
			FROM
				{prefix}activity AS a
			LEFT JOIN {prefix}activity AS ar ON (a.id = ar.foreign_id AND (ar.type = 'activity_comment_reply' OR ar.type = 'activity_group_comment_reply'))
			WHERE a.object_id = '%d'
			 AND (a.type = 'activity_comment' OR a.type = 'activity_group_comment')
			 AND a.status = 'active' {$whereQuery}
			GROUP BY a.id
			ORDER BY a.id DESC
			{$queryLimit}
		");

		$comments = array_reverse($this->db->get_results(
			$this->db->prepare($query, array($activityId)),
			ARRAY_A
		));

		return $this->prepareCommentsRelatedData($comments, $currentUserId);
	}

	public function getCommentReplies($commentId, $currentUserId, $limit, $offsetId = null)
	{
		$whereQuery = '';

		if ($offsetId) {
			$whereQuery = $this->db->prepare("AND a.id < '%d'", $offsetId);
		}

		$queryLimit = $this->db->prepare("LIMIT %d", $limit);

		$query = $this->preparePrefix("
			SELECT 
				a.*
			FROM
				{prefix}activity AS a
			WHERE a.foreign_id = '%d' AND (a.type = 'activity_comment_reply' OR a.type = 'activity_group_comment_reply') AND a.status = 'active' {$whereQuery}
			GROUP BY a.id
			ORDER BY a.id DESC
			{$queryLimit}
		");

		$comments = array_reverse($this->db->get_results(
			$this->db->prepare($query, array($commentId)),
			ARRAY_A
		));

		return $this->prepareCommentsRelatedData($comments, $currentUserId);
	}

	public function getCommentById($commentId, $currentUserId) {
		if (is_array($commentId)) {
			$queryParams = $commentId;
			$commentIds = implode(', ', array_pad(array(), count($commentId), "'%d'"));

			$query = $this->preparePrefix("
				SELECT 
					a.*,
					COUNT(ar.id) as replies
				FROM
					{prefix}activity AS a
				LEFT JOIN {prefix}activity AS ar ON (a.id = ar.foreign_id AND (ar.type = 'activity_comment_reply' OR ar.type = 'activity_group_comment_reply'))
				WHERE a.id IN ({$commentIds}) AND a.status = 'active'
			");

		} else {
			$queryParams = array($commentId);
			$query = $this->preparePrefix("
				SELECT 
					a.*,
					COUNT(ar.id) as replies
				FROM
					{prefix}activity AS a
				LEFT JOIN {prefix}activity AS ar ON (a.id = ar.foreign_id AND (ar.type = 'activity_comment_reply' OR ar.type = 'activity_group_comment_reply'))
				WHERE a.id = '%d' AND a.status = 'active'
				LIMIT 1
			");
		}

		$comments = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);

		if ($comments) {
			$comments = $this->prepareCommentsRelatedData($comments, $currentUserId);
		}

		return $comments;
	}

	public function prepareCommentsRelatedData($comments, $currentUserId) {

		if (!$comments) {
			return array();
		}

		$users = array();
		$_users = array();
        $groups = array();
        $_groups = array();
        $_comments = array();

		foreach ($comments as $key => $comment) {
            $_comments[] = $comment['id'];
			$users[] = $comment['user_id'];

            if ($comment['target_id']) {
                $groups[] = $comment['target_id'];
            }
		}

		$profileModel = $this->getModel('profile', 'users');
        $groupsModel = $this->getModel('groups', 'groups');
		$activityModel = $this->getModel('activity', 'activity');

		$users = $profileModel->getUsersByIds(array('users' => array_unique($users)));

		foreach ($users as &$user) {
			$_users[$user['id']] = $user;
		}

        if (!empty($groups)) {
            $groups = $groupsModel->getGroupsByIds(array_unique($groups), $currentUserId);

            foreach ($groups as &$group) {
                $_groups[$group['id']] = $group;
            }
        }

        $activitiesImages = $activityModel->getActivitiesImages($_comments);
		$activityAttachmentFile = $activityModel->getAttachmentFiles($_comments);
		$activitiesLinks = $activityModel->getActivitiesLinks($_comments);

		foreach ($comments as $key => &$comment) {
		    if ($comment['target_id']) {
                $comment['author'] = $_groups[$comment['target_id']];
		    } else {
                $comment['author'] = $_users[$comment['user_id']];
		    }

            if (isset($activitiesImages[$comment['id']])) {
                $comment['images'] = $activitiesImages[$comment['id']];
            }
			if(isset($activityAttachmentFile[$comment['id']])) {
				$comment['attachmentFiles'] = $activityAttachmentFile[$comment['id']];
			}

            if (isset($activitiesLinks[$comment['id']])) {
                $comment['link'] = $activitiesLinks[$comment['id']];
            }
		}

		return $comments;
	}


	public function removeComment($commentId)
	{
		$this->getModel('Activity', 'Activity')->updateActivityStatus($commentId, 'deleted');
	}

    public function setCommentImages($commentId, $imagesIds)
    {
        foreach ($imagesIds as $imageId) {
            $query = $this->preparePrefix(
                "
                INSERT INTO `{prefix}activity_images`
                    (`activity_id`, `image_id`)
                VALUES ('%d', '%d')
                ON DUPLICATE KEY UPDATE image_id = '%d'
                "
            );

            $this->db->query(
                $this->db->prepare($query, array($commentId, $imageId, $imageId))
            );
        }
    }

    public function getCommentsImages($commentsIds) {

        $placeholders = implode(', ', array_pad(array(), count($commentsIds), "'%d'"));

        $query = $this->preparePrefix("
			SELECT 
				COUNT(ai.image_id) as total, ai.activity_id
			FROM
				{prefix}activity_images AS ai
			WHERE ai.activity_id IN ($placeholders)
			GROUP BY ai.activity_id
		");

        $count = $this->db->get_results(
            $this->db->prepare($query, $commentsIds),
            ARRAY_A
        );

        $commentsImages = array();

        foreach ($count as $comment) {
            $commentsImages[$comment['activity_id']] = array(
                'total' => $comment['total'],
                'thumbnails' => array(),
            );
        }

        if (! $commentsImages) {
            return array();
        }

        $query = array();

        foreach ($commentsImages as $comment => $commentData) {
            $query[] =  $this->db->prepare($this->preparePrefix("
				(SELECT 
					ai.activity_id, ai.image_id
				FROM
					{prefix}activity_images AS ai
				WHERE activity_id = '%d'
				ORDER BY image_id
				LIMIT 5)
			"), array($comment));
        }

        $query = implode(' UNION ALL ', $query);

        $images = $this->db->get_results(
            $query,
            ARRAY_A
        );

        $imagesIds = array();

        foreach ($images as $image) {
            $imagesIds[] = $image['image_id'];
        }

        $imagesIds = implode(',', $imagesIds);

        $images = $this->db->get_results(
            $this->preparePrefix("
				SELECT 
					it.image_id, it.width, it.height, it.source, ai.activity_id
				FROM
					{prefix}images_thumbnails AS it
				LEFT JOIN {prefix}activity_images AS ai ON (it.image_id = ai.image_id)
				WHERE it.image_id IN ({$imagesIds})
			"),
            ARRAY_A
        );

        foreach ($images as $image) {
            $commentsImages[$image['activity_id']]['thumbnails'][] = $image;
        }

        return $commentsImages;

    }

}