<?php

class Membership_Users_Model_Posts extends Membership_Base_Model_Base
{
    public function getPosts($userId, $limit, $offsetId = null)
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
              p.post_title AS title,
              p.post_date_gmt AS date,
              p.comment_count as comments_count
            FROM {$this->db->prefix}posts AS p
            WHERE p.post_status = 'publish' AND p.post_type = 'post' AND p.post_author = '%d' {$whereQuery}
            ORDER BY p.ID DESC
			LIMIT %d
        ");

        $posts = $this->db->get_results($this->db->prepare($query, $queryParams), ARRAY_A);

        $_posts = array();

        foreach ($posts as $post) {
            $post['link'] = get_post_permalink($post['id']);
            $category = get_the_category($post['id']);
            $postCategory = reset($category);
            $post['category'] = $postCategory->name;
            $_posts[] = $post;
        }

        return $_posts;
    }

    public function countAll($userId, $limit, $offsetId = null)
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
              p.post_title AS title,
              p.post_date_gmt AS date,
              p.comment_count as comments_count
            FROM {$this->db->prefix}posts AS p
            WHERE p.post_status = 'publish' AND p.post_type = 'post' AND p.post_author = '%d' {$whereQuery}
            ORDER BY p.ID DESC
			LIMIT %d
        ");

        $posts = $this->db->get_results($this->db->prepare($query, $queryParams), ARRAY_A);

        $_posts = array();

        foreach ($posts as $post) {
            $post['link'] = get_post_permalink($post['id']);
            $category = get_the_category($post['id']);
            $postCategory = reset($category);
            $post['category'] = $postCategory->name;
            $_posts[] = $post;
        }

        return $_posts;
    }
}