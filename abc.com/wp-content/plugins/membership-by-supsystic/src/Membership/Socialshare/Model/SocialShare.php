<?php
class Membership_Socialshare_Model_SocialShare extends Membership_Base_Model_Base {
	protected $socialShareClass = 'SupsysticSocialSharing';
	protected $table;


	public function __construct($environment) {
		parent::__construct($environment);
		$this->table = $this->db->prefix . 'supsystic_ss_projects';
	}

	public function isPluginActive() {
		return class_exists($this->socialShareClass);
	}

	public function getPluginInstallUrl() {
		return add_query_arg(
			array(
				's' => 'Social+Share+Buttons+by+Supsystic',
				'tab' => 'search',
				'type' => 'term',
			),
			admin_url( 'plugin-install.php' )
		);
	}

	public function getWpInstallUrl() {
		return 'https://wordpress.org/plugins/social-share-buttons-by-supsystic/';
	}

	public function getProjectList() {
		$querySel = "SELECT id, title FROM " . $this->table . "
			WHERE settings REGEXP 's:[0-9]+:\"where_to_show\";s:[0-9]+:\"membership\";'
			ORDER BY title ASC";

		$res = $this->db->get_results($querySel, ARRAY_A);
		return $res;
	}
}