<?php

class Membership_Installer_Model_Installer extends Membership_Base_Model_Base
{
    /**
     * Loads updates from the file and update the database.
     * @param string $file Path to updates file.
     */
    public function updateFromFile($file)
    {
        if (!is_readable($file)) {
            throw new RuntimeException(
                sprintf('File "%s" is not readable.', $file)
            );
        }

        if (false === $content = file_get_contents($file)) {
            throw new RuntimeException(
                sprintf('Failed to read file "%s".', $file)
            );
        }
        
        $this->update($content);
    }
    
    /**
     * Prepares the data before run queries.
     * Replaces the '%prefix%' placeholder to the valid database prefix.
     * @param string $data
     * @return string
     */
    public function prepare($data)
    {
        return str_replace(array('%prefix%', '%wp_prefix%', '%wp_base_prefix%'), array($this->getPrefix(), $this->db->prefix, $this->db->base_prefix), $data);
    }

    /**
     * Updates the database.
     * @param string $data
     * @throws Exception
     */
    public function update($data)
    {
        $data = $this->prepare($data);
        $data = array_filter(explode(';', $data));
        foreach ($data as $query) {
			$query = trim($query);
			if($query) {
				$query = $this->db->query($query);
				if ($query === false) {
					if (! current(explode(' ', $this->db->last_query)) === "ALTER") {
						throw new Exception('Query: ' . $this->db->last_query . ' <br>  Error: ' . $this->db->last_error);
					}
				}
			}
        }
	}

	public function updateUserGroupCreator() {
		$queryForUpdate = $this->preparePrefix("
			UPDATE {prefix}groups_users gu SET is_creator = 1
			WHERE gu.id IN
			(
				SELECT id
				FROM (
					SELECT MIN(id) AS id, group_id, SUM(is_creator)
					FROM {prefix}groups_users
					WHERE group_role = 'administrator'
					GROUP BY group_id
					HAVING SUM(is_creator) = 0
				) gu1
			)
		");

		$idArr = $this->db->query($queryForUpdate);
		return true;
	}
}