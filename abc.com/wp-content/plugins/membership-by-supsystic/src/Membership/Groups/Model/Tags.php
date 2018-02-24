<?php

class Membership_Groups_Model_Tags extends Membership_Base_Model_Base
{
	public function getGroupsTags(array $groupIds) {

		$placeholders = implode(',', array_pad(array(), count($groupIds), "'%d'"));

		$query = $this->preparePrefix("
			SELECT 
				t.id, t.tag AS title, gt.group_id
			FROM {prefix}groups_tags AS gt
			JOIN {prefix}tags as t ON (gt.tag_id = t.id)
			WHERE gt.group_id IN ($placeholders)
		");

		$tags = $this->db->get_results(
			$this->db->prepare($query, $groupIds),
			ARRAY_A
		);

		$_tags = array();

		foreach ($tags as $tag) {
			$_tags[$tag['group_id']][] = array(
				'id' => $tag['id'],
				'title' => $tag['title']
			);
		}

		return $_tags;
	}

	public function getGroupTags($groupId) {
		return $this->getGroupsTags(array($groupId));
	}

	public function groupHasTag($groupId, $tag, $type = 'title') {

		$andWhere = "AND t.tag = '%s'";

		if ($type == 'id') {
			$andWhere = "AND t.id = '%d'";
		}

		$query = $this->preparePrefix("
			SELECT 1
			FROM {prefix}groups_tags AS gt
			LEFT JOIN {prefix}tags AS t ON (t.id = gt.tag_id)
			WHERE gt.group_id = '%d'
			{$andWhere}
		");

		return $this->db->get_var(
			$this->db->prepare($query, array($groupId, $tag))
		);
	}

	public function addTag($groupId, $tag) {

		$query = $this->preparePrefix("
			SELECT t.id
			FROM {prefix}tags AS t
			WHERE t.tag = '%s'
		");

		$tagId =  $this->db->get_var(
			$this->db->prepare($query, $tag)
		);

		if (!$tagId) {
			$query = $this->getQueryBuilder()
			              ->insertInto($this->getTable('tags'))
			              ->fields(array('tag'))
			              ->values(array('%s'));

			$this->db->query(
				$this->db->prepare($query, array($tag))
			);

			$tagId = $this->db->insert_id;
		}


		$query = $this->getQueryBuilder()
		              ->insertInto($this->getTable('groups_tags'))
		              ->fields(array('group_id', 'tag_id'))
		              ->values(array('%d', '%d'));

		$this->db->query(
			$this->db->prepare($query, array($groupId, $tagId))
		);

		return $tagId;
	}

	public function removeTag($tagId, $groupId) {
		return $this->query("
			DELETE FROM {prefix}groups_tags WHERE tag_id = '%d' AND group_id = '%d';
		", array($tagId, $groupId));
	}

	public function getSuggestedGroups($params) {

		$currentUserId = get_current_user_id();
		$limit = isset($params['limit']) ? $params['limit'] : 5;

		$query = $this->preparePrefix("
			SELECT DISTINCT g.id
			FROM {prefix}groups AS g
			LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
			JOIN {prefix}groups_tags AS gt ON (g.id = gt.group_id)
			JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'type' AND (gs.value = 'open' OR gs.value = 'closed'))
			WHERE gu.user_id IS NULL AND gt.tag_id IN (
				SELECT 
					DISTINCT gt.tag_id
				FROM
					{prefix}groups_users AS gu
					LEFT JOIN {prefix}groups_tags AS gt ON (gu.group_id = gt.group_id)
				WHERE
					gu.user_id = '%d'
			) 
			ORDER BY RAND()
			LIMIT %d
		");

		$groups = $this->db->get_col(
			$this->db->prepare($query, array($currentUserId, $currentUserId, $limit))
		);


		if ($groups) {
			$_groups = implode(',', $groups);
			$orderBy = " ORDER BY FIELD (g.id, $_groups)";
			$groups = $this->getModel('Groups', 'Groups')->getGroupsByIds($groups, $currentUserId, $orderBy);
		}

		return $groups;
	}
}