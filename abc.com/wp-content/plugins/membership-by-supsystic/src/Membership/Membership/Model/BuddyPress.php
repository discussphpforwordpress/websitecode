<?php

class Membership_Membership_Model_BuddyPress extends Membership_Base_Model_Base {

	public function getBuddyPressFields() {

		$fields = $this->getData("
			SELECT 
			    f.id, f.type, f.name, f.parent_id, f.description, f.is_default_option, f.is_required, g.name as section
			FROM
			    {$this->db->prefix}bp_xprofile_fields AS f
			        LEFT JOIN
			    {$this->db->prefix}bp_xprofile_groups AS g ON (f.group_id = g.id)
			ORDER BY f.id ASC
		");

		return $fields;
	}

	public function getBuddyPressTypesConversion() {
		return array(
			'textbox' => 'text',
			'url' => 'text',
			'multiselectbox' => 'scroll',
			'checkbox' => 'checkbox',
			'selectbox' => 'drop',
			'radio' => 'radio',
			'datebox' => 'date',
			'textarea' => 'text',
			'number' => 'numeric'
		);
	}

	/**
	 * Insert filled BuddyPress fields per user to membership fields table
	 */
	public function insertBuddyPressFields() {

		return $this->query("
			INSERT IGNORE INTO {prefix}fields (user_id, name, privacy)
			SELECT
			    user_id,
			    CONCAT('bp-field-', field_id) AS name,
			    'public' AS privacy
			FROM
			    {$this->db->prefix}bp_xprofile_data;
		");
	}

	/**
	 * Insert BuddyPress fields data to membership fields data table
	 */
	public function insertBuddyPressFieldsData() {

		/**
		 * Remove all BuddyPress fields data to avoid duplicate if it's run more than once
		 */
		$this->query("
			DELETE FROM {prefix}fields_data WHERE field_id IN (
				SELECT
					mbsf.id
				FROM
					 {$this->db->prefix}bp_xprofile_data as fd
				LEFT JOIN  {$this->db->prefix}bp_xprofile_fields as f ON (f.id = fd.field_id)
				LEFT JOIN  {prefix}fields as mbsf ON (mbsf.user_id = fd.user_id AND mbsf.name = CONCAT('bp-field-', fd.field_id))
			)
		");

		/**
		 * Insert field with single value. textbox, url, number, textarea, datebox
		 */
		$this->query("
			INSERT INTO {prefix}fields_data (field_id, data)
			SELECT
				mbsf.id as field_id,
				fd.value as data
			FROM
				 {$this->db->prefix}bp_xprofile_data as fd
			LEFT JOIN  {$this->db->prefix}bp_xprofile_fields as f ON (f.id = fd.field_id)
			LEFT JOIN  {prefix}fields as mbsf ON (mbsf.user_id = fd.user_id AND mbsf.name = CONCAT('bp-field-', fd.field_id))
			WHERE f.type IN ('textbox', 'url', 'number', 'textarea', 'datebox') AND mbsf.id IS NOT NULL
		");

		/**
		 * Insert fields where value based on selected option. radio, selectbox
		 */
		$this->query("
			INSERT INTO {prefix}fields_data (field_id, data)
			SELECT
				mbsf.id,
		        CONCAT('bp-field-', f2.id)
			FROM
				 {$this->db->prefix}bp_xprofile_data as fd
			LEFT JOIN {$this->db->prefix}bp_xprofile_fields as f ON (f.id = fd.field_id)
		    LEFT JOIN  {prefix}fields AS mbsf ON (mbsf.user_id = fd.user_id AND mbsf.name = CONCAT('bp-field-', fd.field_id))
		    LEFT JOIN {$this->db->prefix}bp_xprofile_fields AS f2 ON (f2.type = 'option' AND f2.name = fd.value)
			WHERE f.type IN ('radio', 'selectbox')  AND mbsf.id IS NOT NULL
		");

		/**
		 * Insert fields where value based on selected option and values serialized. multiselectbox, checkbox
		 */
		$this->query("
			INSERT INTO {prefix}fields_data (field_id, data)
			SELECT
			    mbsf.id as field_id,
				CONCAT('bp-field-', f2.id) AS data
			FROM
				{$this->db->prefix}bp_xprofile_data as fd
			LEFT JOIN
			    {$this->db->prefix}bp_xprofile_fields AS f ON (fd.field_id = f.id)
			LEFT JOIN {$this->db->prefix}bp_xprofile_fields AS f2 ON (f2.type = 'option' AND fd.value RLIKE CONCAT('\"', f2.name, '\"'))
			LEFT JOIN  {prefix}fields as mbsf ON (mbsf.user_id = fd.user_id AND mbsf.name = CONCAT('bp-field-', fd.field_id))
			WHERE f.type IN ('multiselectbox', 'checkbox') AND mbsf.id IS NOT NULL
			ORDER BY field_id
		");

	}

	/**
	 * Convert BuddyPress user fields to Membership fields format.
	 *
	 * @param $bpFields
	 *
	 * @return array
	 */
	public function prepareFieldsForMerge($bpFields) {

		if (!$bpFields) {
			return $bpFields;
		}

		$fields = array();

		$typesConversion = $this->getBuddyPressTypesConversion();

		foreach ($bpFields as $field) {
			if ($field['parent_id'] === '0') {
				$fields[$field['id']] = array(
					'label' => $field['name'],
					'name' => 'bp-field-' . $field['id'],
					'description' => $field['description'],
					'type' => $typesConversion[$field['type']],
					'enabled' => true,
					'required' => $field['is_required'] === '1',
					'registration' => $field['is_required'] === '1',
					'section' => $field['section']
				);
			} else {
				$fields[$field['parent_id']]['options'][] = array(
					'id' => 'bp-field-' . $field['id'],
					'name' => $field['name'],
					'checked' => $field['is_default_option'] === '1',
				);
			}
		}

		return $fields;
	}

	/**
	 * Copy BuddyPress groups to Membership groups.
	 */
	public function insertBuddyPressGroups() {

		/**
		 * Get only such groups that not already inserted.
		 */
		$groups = $this->getData("
			SELECT 
			    g.id,
			    g.name,
			    g.slug,
			    g.description,
			    g.status AS type,
			    g.slug AS alias,
			    gm.meta_value AS invitations,
			    mgs.value
			FROM
			    {$this->db->prefix}bp_groups AS g
			        LEFT JOIN
			    {$this->db->prefix}bp_groups_groupmeta AS gm ON (g.id = gm.group_id
			        AND gm.meta_key = 'invite_status')
			        LEFT JOIN
			    {prefix}groups_settings AS mgs ON (mgs.setting = 'bp-id'
			        AND mgs.value = g.id)
			WHERE
			    mgs.value IS NULL
		");

		$groupsModel = $this->getModel('Groups', 'Groups');

		foreach ($groups as $group) {

			$groupId = $groupsModel->createGroup(array(
				'name' => $group['name'],
				'description' => $group['description'],
				'alias' => $group['alias'],
			));

			$this->query("
				INSERT INTO {prefix}groups_users (group_id, group_role, user_id, approved)
				SELECT
					'%d',
				    CASE
				        WHEN gm.is_admin = 1 THEN 'administrator'
				        WHEN gm.is_mod = 1 THEN 'administrator'
				        ELSE 'user'
				    END AS group_role,
				    gm.user_id,
				    CASE
				        WHEN gm.is_confirmed = 1 THEN 1
				        ELSE 0
				    END AS approved
				FROM
				    {$this->db->prefix}bp_groups_members AS gm
				WHERE gm.group_id = '%d'
			", array(
				$groupId,
				$group['id']
			));

			$this->query("
				INSERT INTO {prefix}groups_followers (group_id, user_id)
				SELECT
					'%d',
				    gm.user_id
				FROM
				    {$this->db->prefix}bp_groups_members AS gm
				WHERE gm.group_id = '%d' 
			", array(
				$groupId,
				$group['id']
			));

			$this->query("
				INSERT INTO {prefix}groups_settings (group_id, setting, value)
					VALUES ('%d', '%s', '%s'), ('%d', '%s', '%s'), ('%d', '%s', '%s')
			", array(
				$groupId,
				'invitations',
				str_replace(array('mods', 'admins', 'members'), array('administrators', 'administrators', 'members-only'), $group['invitations']),
				$groupId,
				'type',
				str_replace(array('public', 'private', 'hidden'), array('open', 'closed', 'private'), $group['type']),
				$groupId,
				'bp-id',
				$group['id']
			));
		}
	}

	/**
	 * Copy BuddyPress friends to Membership friends.
	 */
	public function insertBuddyPressFriends() {

		/**
		 * Copy friends
		 */
		$this->query("
			INSERT IGNORE INTO {prefix}friends (user_id, friend_id)
				SELECT 
					initiator_user_id AS user_id,
					friend_user_id AS friend_id
				FROM
					{$this->db->prefix}bp_friends
				WHERE
					is_confirmed = 1 
				UNION ALL SELECT 
					friend_user_id AS user_id,
					initiator_user_id AS friend_id
				FROM
					{$this->db->prefix}bp_friends
				WHERE
					is_confirmed = 1 
				UNION ALL SELECT 
					initiator_user_id AS user_id,
					friend_user_id AS friend_id
				FROM
					{$this->db->prefix}bp_friends
				WHERE
					is_confirmed = 0
		");

		/**
		 * Make users follow each other
		 */
		$this->query("
            INSERT IGNORE INTO {prefix}followers (user_id, following_id)
				SELECT 
					initiator_user_id AS user_id,
					friend_user_id AS friend_id
				FROM
					{$this->db->prefix}bp_friends
				WHERE
					is_confirmed = 1 
				UNION ALL SELECT 
					friend_user_id AS user_id,
					initiator_user_id AS friend_id
				FROM
					{$this->db->prefix}bp_friends
				WHERE
					is_confirmed = 1 
				UNION ALL SELECT 
					initiator_user_id AS user_id,
					friend_user_id AS friend_id
				FROM
					{$this->db->prefix}bp_friends
				WHERE
					is_confirmed = 0
		");
	}

	public function insertBuddyPressActivity() {

		$lastActivityId = (int) $this->getData('SELECT MAX(id) FROM {prefix}activity', 'one');

		/**
		 * Insert activity without comments
		 */
		$this->query("
			INSERT INTO {prefix}activity (user_id, type, object_id, target_id, data, status, created_at, updated_at)
			SELECT user_id, type, object_id, target_id, data, status, created_at, updated_at FROM (
				SELECT 
					id,
					user_id,
					CASE
						WHEN type = 'activity_update' and component = 'activity' THEN 'post'
						WHEN type = 'activity_update' and component = 'groups' THEN 'group_post'
						WHEN type = 'created_group' THEN 'group_created'
						WHEN type = 'friendship_created' THEN 'friendship'
						
						ELSE type
					END AS type,
					CASE
						WHEN type = 'created_group' THEN (
							SELECT 
								g.id
							FROM
								{prefix}groups_settings AS gs
									LEFT JOIN
								{prefix}groups AS g ON (g.id = gs.group_id)
							WHERE
								setting = 'bp-id' AND gs.value = item_id
						)
						WHEN type = 'activity_update' and component = 'groups' THEN (
							SELECT 
								g.id
							FROM
								{prefix}groups_settings AS gs
									LEFT JOIN
								{prefix}groups AS g ON (g.id = gs.group_id)
							WHERE
								setting = 'bp-id' AND gs.value = item_id
						) 
						ELSE NULL
					END AS object_id,
					CASE
						WHEN type = 'friendship_created' THEN secondary_item_id
						ELSE NULL
					END AS target_id,
					content AS data,
					CONCAT('bpid-', id) AS status, 
					date_recorded AS created_at,
					date_recorded AS updated_at
				FROM
					{$this->db->prefix}bp_activity
				WHERE
					type IN ('created_group' , 'activity_update', 'friendship_created')
				ORDER BY id ASC
			) as a
	    ");

		/**
		 * Insert comments
		 */
		$this->query("
			INSERT INTO {prefix}activity (user_id, type, object_id, data, status, created_at, updated_at)
			SELECT user_id, type, object_id, data, status, created_at, updated_at FROM (
				SELECT 
					a.id,
					a.user_id,
					a.type,
					a2.id AS object_id,
					a.content AS data,
					CONCAT('bpid-', a.id) AS status, 
					a.date_recorded AS created_at,
					a.date_recorded AS updated_at
				FROM
					{$this->db->prefix}bp_activity AS a
						LEFT JOIN
					{prefix}activity AS a2 ON (a2.status = CONCAT('bpid-', a.item_id))
				WHERE
					a.type = 'activity_comment' AND a.item_id = a.secondary_item_id /* select only parent comments */
				ORDER BY a.id ASC
			) as a
	    ");

		/**
		 * Insert comment replies
		 */
		$this->query("
			INSERT INTO {prefix}activity (user_id, type, object_id, data, foreign_id, status, created_at, updated_at)
			SELECT user_id, type, object_id, data, foreign_id, status, created_at, updated_at FROM (
				SELECT 
					a.id,
					a.user_id,
					'activity_comment_reply' AS type,
					a2.id AS object_id,
					a.content AS data,
					CASE
						WHEN a3.id IS NOT NULL THEN a3.id
						WHEN
							a3.id IS NULL
						THEN /* in case if parent comment not found that's mean it's reply on reply and we just set it as reply to closest parent comment */
							(SELECT 
									id
								FROM
									{prefix}activity
								WHERE
									status = (SELECT 
											CONCAT('bpid-',
														(SELECT 
																MIN(id)
															FROM
																{$this->db->prefix}bp_activity
															WHERE
																type = 'activity_comment'
																	AND mptt_left < a.mptt_left
																	AND mptt_right > a.mptt_right
																	AND item_id = a.item_id
														)
													)
												)
							  )
						ELSE NULL
					END AS foreign_id,
					'active' AS status,
					a.date_recorded AS created_at,
					a.date_recorded AS updated_at
				FROM
					{$this->db->prefix}bp_activity AS a
						LEFT JOIN
					{prefix}activity AS a2 ON (a2.status = CONCAT('bpid-', a.item_id))
						LEFT JOIN
					{prefix}activity AS a3 ON (a3.status = CONCAT('bpid-', a.secondary_item_id))
				WHERE
					a.type = 'activity_comment'
						AND a.item_id != a.secondary_item_id
				ORDER BY a.id ASC
			
			) AS a
	    ");

		/**
		 * Remove temporary reference
		 */
		$this->query("
			UPDATE {prefix}activity set status = 'active'
			WHERE status like 'bpid-%%' and id > '%d'
	    ", array($lastActivityId));

	}
}