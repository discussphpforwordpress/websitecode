<?php

class Membership_Forum_Model_bbPress extends Membership_Base_Model_Base
{
	public function countForumData($userId) {

		$topics = $this->getData($this->db->prepare("
			SELECT 
			    COUNT(p.ID)
			FROM
			    {wp_prefix}posts as p
			    JOIN {wp_prefix}posts AS forum ON (forum.ID = p.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
			WHERE
			    p.post_author = '%d' AND p.post_type = 'topic'  AND p.post_status IN ('publish', 'closed')
		", $userId), 'one');

		$replies = $this->getData($this->db->prepare("
			SELECT 
			    COUNT(p.ID)
			FROM
			    {wp_prefix}posts as p
			    JOIN {wp_prefix}posts AS topic ON (p.post_parent = topic.ID)
			    JOIN {wp_prefix}posts AS forum ON (forum.ID = topic.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
			WHERE
			    p.post_author = '%d' AND p.post_type = 'reply' AND p.post_status = 'publish' AND topic.post_status IN ('publish', 'closed')
		", $userId), 'one');

		$favoritesTopics =  bbp_get_user_favorites_topic_ids($userId);


		if ($favoritesTopics) {
			$favoritesTopics = implode(',' , array_map('strval', $favoritesTopics));
			$favorites = $this->getData("
	            SELECT
	              COUNT(p.ID)
	            FROM {wp_prefix}posts AS p
	            JOIN {wp_prefix}posts AS forum ON (forum.ID = p.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
	            WHERE p.post_status = 'publish' AND p.post_type = 'topic' AND p.id IN ({$favoritesTopics})
	        ", 'one');
		} else {
			$favorites = 0;
		}



		$subscribedTopics = bbp_get_user_subscribed_topic_ids($userId);


		if ($subscribedTopics) {
			$subscribedTopics = implode(',' , array_map('strval', $subscribedTopics));
			$subscriptions = $this->getData("
	            SELECT
	              COUNT(p.ID)
	            FROM {wp_prefix}posts AS p
	            JOIN {wp_prefix}posts AS forum ON (forum.ID = p.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
	            WHERE p.post_status = 'publish' AND p.post_type = 'topic' AND p.id IN ({$subscribedTopics})
	        ", 'one');
		} else {
			$subscriptions = 0;
		}

		return array(
			'topics' => $topics,
			'replies' => $replies,
			'subscriptions' => $subscriptions,
			'favorites' => $favorites
		);
	}

	public function getStartedTopics($userId, $limit, $offsetId = null) {
		$queryParams = array($userId, $limit);

		$whereQuery = '';

		if ($offsetId) {
			$whereQuery = $this->db->prepare("AND p.ID < '%d'", $offsetId);
		}

		$query = $this->preparePrefix("
            SELECT
              p.ID AS id,
              p.post_author AS author,
              p.post_title AS title,
              p.post_content AS content,
              p.post_date_gmt AS date,
              forum.post_title AS forumTitle,
              forum.ID AS forumId
            FROM {$this->db->prefix}posts AS p
            JOIN {$this->db->prefix}posts AS forum ON (forum.ID = p.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
            WHERE p.post_status = 'publish' AND p.post_type = 'topic' AND p.post_author = '%d' {$whereQuery}
            ORDER BY p.ID DESC
			LIMIT %d
        ");

		$posts = $this->db->get_results($this->db->prepare($query, $queryParams), ARRAY_A);

		$_posts = array();

		foreach ($posts as $post) {
			$post['link'] = get_post_permalink($post['id']);
			$post['forumLink'] = get_post_permalink($post['forumId']);
			$_posts[] = $post;
		}

		return $_posts;
	}

	public function getReplies($userId, $limit, $offsetId = null)
	{
		$queryParams = array($userId, $limit);

		$whereQuery = '';

		if ($offsetId) {
			$whereQuery = $this->db->prepare("AND p.ID < '%d'", $offsetId);
		}

		$query = $this->preparePrefix("
            SELECT
              p.ID AS id,
              p.post_author AS author,
              p.post_date_gmt AS date,
              p.post_content AS content,
              topic.ID as topicId,
              topic.post_title as topicTitle,
              forum.post_title AS forumTitle,
              forum.ID AS forumId
            FROM {$this->db->prefix}posts AS p
            JOIN {$this->db->prefix}posts AS topic ON (p.post_parent = topic.ID)
            JOIN {$this->db->prefix}posts AS forum ON (forum.ID = topic.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
            WHERE p.post_status = 'publish' AND p.post_type = 'reply' AND p.post_author = '%d' AND topic.post_status IN ('publish', 'closed') {$whereQuery} 
            ORDER BY p.ID DESC
			LIMIT %d
        ");

		$replies = $this->db->get_results($this->db->prepare($query, $queryParams), ARRAY_A);

		$_replies = array();

		foreach ($replies as $reply) {
			$reply['topicLink'] = get_post_permalink($reply['topicId']);
			$reply['forumLink'] = get_post_permalink($reply['forumId']);
			$_replies[] = $reply;
		}

		return $_replies;
	}

	public function getFavorites($userId, $limit, $offsetId = null) {

		$favoritesTopics =  bbp_get_user_favorites_topic_ids($userId);
		$favoritesTopics = array_reverse($favoritesTopics);

		if ($offsetId) {
			$offsetId = array_search((int) $offsetId, $favoritesTopics);

			if (!$offsetId) {
				return array();
			}

			$slice = array_slice($favoritesTopics, $offsetId + 1, $limit);

			if (!$slice) {
				return array();
			}
		} else {
			$slice = array_slice($favoritesTopics, 0, $limit);
		}

		$slice = implode(',', $slice);

		$query = $this->preparePrefix("
            SELECT
              p.ID AS id,
              p.post_author AS author,
              p.post_title AS title,
              p.post_date_gmt AS date,
              forum.post_title AS forumTitle,
              forum.ID AS forumId
            FROM {$this->db->prefix}posts AS p
            JOIN {$this->db->prefix}posts AS forum ON (forum.ID = p.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
            WHERE p.post_status = 'publish' AND p.post_type = 'topic' AND p.id IN ({$slice})
            ORDER BY FIELD(p.ID, {$slice})
        ");

		$posts = $this->getData($query);

		$_posts = array();

		foreach ($posts as $post) {
			$post['link'] = get_post_permalink($post['id']);
			$post['forumLink'] = get_post_permalink($post['forumId']);
			$_posts[] = $post;
		}

		return $_posts;
	}

	public function getSubscriptions($userId, $limit, $offsetId = null) {

		$subscribedTopics = bbp_get_user_subscribed_topic_ids($userId);

		$subscribedTopics = array_reverse($subscribedTopics);

		if ($offsetId) {
			$offsetId = array_search($offsetId, $subscribedTopics);

			if (!$offsetId) {
				return array();
			}

			$slice = array_slice($subscribedTopics, $offsetId + 1, $limit);

			if (!$slice) {
				return array();
			}

		} else {
			$slice = array_slice($subscribedTopics, 0, $limit);
		}

		$slice = implode(',', $slice);

		$query = $this->preparePrefix("
            SELECT
              p.ID AS id,
              p.post_author AS author,
              p.post_title AS title,
              p.post_date_gmt AS date,
              forum.post_title AS forumTitle,
              forum.ID AS forumId
            FROM {$this->db->prefix}posts AS p
            JOIN {$this->db->prefix}posts AS forum ON (forum.ID = p.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
            WHERE p.post_status = 'publish' AND p.post_type = 'topic' AND p.id IN ({$slice})
            ORDER BY FIELD(p.ID, {$slice})
        ");

		$posts = $this->getData($query);

		$_posts = array();

		foreach ($posts as $post) {
			$post['link'] = get_post_permalink($post['id']);
			$post['forumLink'] = get_post_permalink($post['forumId']);
			$_posts[] = $post;
		}

		return $_posts;
	}
}