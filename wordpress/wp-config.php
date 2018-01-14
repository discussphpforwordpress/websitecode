<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'o@MvP~;a~;(`]t5Z:k;]<W:jd83l )4B#M-QTi8=`KWYUar(~!m=78Il`)=%ubCR');
define('SECURE_AUTH_KEY',  'z}!(6<*}>2{Lx`!o^$P^tT&;nf9rGL;>S|vzq!K|( .#VP>d*`v!&UbvKABm/q99');
define('LOGGED_IN_KEY',    '[|#PA;]t@nGe@u~`7_E2}f}Gt+3.DTGZ<{Lq4e^D(CC6 sw!Hi/8tC`rfx-+bo?+');
define('NONCE_KEY',        '~V-4HFXM`#i1u;`e/U*y:vWMq-P$u{7t>,Jdb@U))QT9]2TJpBCgmz|5!aBM;?-&');
define('AUTH_SALT',        's2[+EMI,l-=;lD[PU+wt]`7FjIDB$?dv(~mX-C6HD*:cEbytjo{%=u>.GkWcxYy3');
define('SECURE_AUTH_SALT', 'Q`M+|S+dS(>a23 Bjl_h`s^*Fp|=90?q7GXf3TwqFIihAL]5K|zUY|BV&*1k<1Nx');
define('LOGGED_IN_SALT',   '^U8oT9[UBB7o!?}?sz((wnocQPyE%5ky+d`?RM::!QK|M(l~GCT:[*S`w_a6y~7j');
define('NONCE_SALT',       'gwTHAWqg))DwE3?F@*-=wHRtdm3n9 D_mv<>QLC48v N>V9(q3fx_bQ|E2(W674T');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

define('WPLANG', 'zh_CN');

define("FS_METHOD", "direct");

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
