<?php

/**
 * Plugin Name: Membership by Supsystic
 * Description: Create online membership community with custom user profiles, roles, front end registration / login. Members Directory, Activity, Groups and more
 * Version: 1.1.29
 * Author: supsystic.com
 * Author URI: https://supsystic.com
 * Text Domain: membership-by-supsystic
 * Domain Path: /app/lang/
 **/

require_once dirname(__FILE__). '/defines.php';
require_once dirname(__FILE__). '/app/Membership.php';
global $scMembership;
$scMembership = new SupsysticMembership('1.1.29');
$scMembership->run();