<?php

class Membership_Users_Model_Comments extends Membership_Base_Model_Base
{
    public function getComments($userId, $limit, $offsetId = null)
    {
        $queryParams = array($userId, $limit);

	    $whereQuery = '';

	    if ($offsetId) {
		    $whereQuery = $this->db->prepare("AND c.comment_ID < '%d'", $offsetId);
	    }

	    $query = $this->preparePrefix("
            SELECT
              c.comment_ID AS id,
              p.ID AS post_id,
              p.post_title AS title,
              c.comment_content AS content,
              c.comment_date_gmt AS date
            FROM {$this->db->prefix}comments AS c
            LEFT JOIN {$this->db->prefix}posts AS p ON p.ID = c.comment_post_ID
            WHERE p.post_status = 'publish' AND c.comment_approved = '1' AND c.user_id = '%d' {$whereQuery}
            ORDER BY c.comment_ID DESC
            LIMIT %d
        ");

        $posts = $this->db->get_results($this->db->prepare($query, $queryParams), ARRAY_A);
        $_posts = array();

        foreach ($posts as $post) {
            $post['post_link'] = get_post_permalink($post['post_id']);
            $_posts[] = $post;
        }

        return $_posts;
    }
}