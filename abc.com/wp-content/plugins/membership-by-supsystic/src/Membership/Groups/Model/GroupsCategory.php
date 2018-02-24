<?php
class Membership_Groups_Model_GroupsCategory extends Membership_Base_Model_Base {

	public function getGroupCategoryList($sortOrderField = 'name') {
		$query = $this->preparePrefix("
				SELECT id, name
				FROM {prefix}groups_category AS g
				ORDER BY " . $sortOrderField
				);

		return $this->db->get_results($query,ARRAY_A);
	}

	public function add($categoryName) {
		$insertQuery = $this->preparePrefix("INSERT INTO {prefix}groups_category(`name`) VALUES('%s')");

		$this->db->query(
			$this->db->prepare($insertQuery, array($categoryName))
		);
		return $this->db->insert_id;
	}

	public function update($id, $categoryName) {
		$insertQuery = $this->preparePrefix(" UPDATE {prefix}groups_category SET `name` = '%s' WHERE `id`='%s' ");
		return $this->db->query(
			$this->db->prepare($insertQuery, array($categoryName, $id))
		);
	}

	public function remove($id) {
		$removeQuery = $this->preparePrefix("DELETE FROM {prefix}groups_category WHERE `id`='%s'");
		return $this->db->query(
			$this->db->prepare($removeQuery, array($id))
		);
	}
}