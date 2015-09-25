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
define('DB_NAME', 'mixjunkies');

/** MySQL database username */
define('DB_USER', getenv("MYSQL_USER"));

/** MySQL database password */
define('DB_PASSWORD', getenv("MYSQL_PASS"));

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
define('AUTH_KEY',         ';0wDKP9dy{HE+5p|zA!zU&szq(_AEiU%m8M3l@Kiz<3C*& 9{qBhDIt)V2)aLXjg');
define('SECURE_AUTH_KEY',  'dZIp@t-n&Mgu1TKA04?<+ }&)Q*A8-)6s%9Ks Dxblvn(Kq66qVspygY-T3)F9e&');
define('LOGGED_IN_KEY',    'Pe8?*fBHeJ#^ [wXY$rDWd@cWy@cV{gn^DBzJr?odYMBN~.q-wph2<)g2(.uFd$N');
define('NONCE_KEY',        'O38*^V3aLa+Nw)-2J)l~ 5n{v_F|qu|&u|Hj+Znz RC`6S9s35.-WatrUw.L_WO8');
define('AUTH_SALT',        '#ZF5v>Pmr#!e BdLQ^#VE]NMi?W*t--q&j+3C4s||X.Yv9;$_l.q<tE]|j]3~&/+');
define('SECURE_AUTH_SALT', '9#3]G:gsAPPcFZ.N-;Qhq^]7;LE#J[qQTVAJ0v@$Mr7[*x5EFU`-xS+2Q(&I$Wn~');
define('LOGGED_IN_SALT',   '++50m6%D<F^w)a6?WuE|_P|:+Y6_*s9.,v;a&L*SXo3 +*L3bwV]?T5[OWG@sGQ*');
define('NONCE_SALT',       '/cM-c%ThV,:OzJJU$j-V?){2j}&H8%,*Sx2K8z<smHZDb<pj=a-IL+cTOfaPq]EW');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
