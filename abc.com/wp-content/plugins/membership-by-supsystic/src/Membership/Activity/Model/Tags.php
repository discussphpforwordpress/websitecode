<?php
class Membership_Activity_Model_Tags extends Membership_Base_Model_Base {

    public function parseActivityData($activity) {
		if (preg_match_all('/(?:^|\s)(#[a-z\d-]+)/', $activity['data'], $matches)) {
			$this->insertTags($activity['id'], $matches[1]);
		}
	}

	public function insertTags($activityId, $tags) {

		$insertValues = array();

		foreach ($tags as $tag) {
			$insertValues[] = $this->db->prepare("('%s', '%s')", array($activityId, str_replace('#', '', $tag)));
		}

		$insertValues = implode(',', $insertValues);

		$query = $this->preparePrefix("
			/* @lang sql */
			INSERT
			INTO {prefix}activity_tags (activity_id, tag)
			VALUES $insertValues
		");

		return $this->db->query($query);
	}
}