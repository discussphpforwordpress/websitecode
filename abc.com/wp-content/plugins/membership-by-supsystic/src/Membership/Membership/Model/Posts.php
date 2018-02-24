<?php

class Membership_Membership_Model_Posts extends Membership_Base_Model_Base
{
	public function getUserPosts($userId)
	{
		
		$query = $this->preparePrefix(
			"SELECT
				p.id,
				p.post_content as content,
				p.post_date as created_at
			FROM {$this->db->prefix}posts AS p
			WHERE p.post_author = %d AND p.post_status = 'publish'  AND p.post_type = 'post'
			ORDER BY p.post_date DESC
		");

		return $this->db->get_results(
			$this->db->prepare($query, array($userId)),
			ARRAY_A
		);
	}

	public function createUpdate($userId, $content)
	{
		$query = $this->getQueryBuilder()
			->insertInto($this->getTable('updates'))
			->fields(array('user_id', 'content'))
			->values(array('%s', '%s'))
			->build();

		$this->db->query(
			$this->db->prepare($query, array($userId, $content))
		);

		return $this->db->insert_id;
	}

    public function pageExists($page) {

        $query = $this->preparePrefix(
            "SELECT
				*
			FROM {$this->db->prefix}posts AS p
			WHERE p.post_name = %s
		");

        $result = $this->db->get_results(
            $this->db->prepare($query, array($page)),
            ARRAY_A
        );

        return !empty($result);
    }
}