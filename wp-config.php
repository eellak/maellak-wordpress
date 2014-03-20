<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ma');

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
define('AUTH_KEY',         ',)gBV<BKJ+ORw_Q>VpSu;p)i1~#T(#g+}1>[:~H5PL9KbOjYk+QDZoFg@Y9P}Xu2');
define('SECURE_AUTH_KEY',  'xuM9lETG:/SyC*-zU-|X~Cd?D#IFW8?#+J|>K<:|gCmaRK[S{CR4XJ).&7+utJBL');
define('LOGGED_IN_KEY',    'Ca?0EW-g&d/!5?PVXPH/~U]go:1(Mf[j#CDh;z$CgUarC-cI<gEPTQ+Y2y_@Du5=');
define('NONCE_KEY',        '#M{P{[,Mlq|V`2bIV(*eU;s9Uu=;G,m?)+<7/| !sVz+d(33c._rVAmk2@HN9|O2');
define('AUTH_SALT',        'c+WvGWq*(~^[|C[3#N^LW@b qmsB~(%HUHZl!egh-/su/LDzmU Q$}+<(dI+E}TX');
define('SECURE_AUTH_SALT', ',q@mu4h.hpWszXy]u#dov-?&{>4yWz2.I{.ct6a(^h}[QlRR=3$J50R*9[&hph+2');
define('LOGGED_IN_SALT',   '^%(Z%4n;Pj|f_@+p=e|~<6Mo)*)n5sM1EE95TH+k[y-oh:[sD+QUd{YCKx5$F$tO');
define('NONCE_SALT',       '2b^m`H6,QkrRB*ZK83%kE@kp^ ){.~b71uncwX(2W!+9{YeL-Y6,y#UBbTC&|s}!');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ma_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'el');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
