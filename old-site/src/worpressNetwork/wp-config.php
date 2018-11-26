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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home1/wewillfi/public_html/worpressNetwork/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'wewillfi_wordpress');

/** MySQL database username */
define('DB_USER', 'wewillfi_network');

/** MySQL database password */
define('DB_PASSWORD', 'Rwbwreia123&');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'A8[@NxYTO42lJn$WH[Kv349@kKN(vC9X}r]3O:!{PMM4o]0lS}6N2Vv.69y&Cqfo');
define('SECURE_AUTH_KEY',  '.b~nBn=)~[]z.5@X;V?TUv9oW5.cH9iA_fYT/MUytEgyjN!aew_)Xj-]fF;G%k6f');
define('LOGGED_IN_KEY',    'zo}o|MI(e*!55[75]SjZr#w~`80Sb6oEaDc>~osO_Uk`yZUh>fkb01;GY#Z$Nbb1');
define('NONCE_KEY',        'V*e ,j.m^y&zb;aXTP%WRIL|LiB>CC?q_$2!dq@#of1x$[<=F{ ,KplKv6=NRFuy');
define('AUTH_SALT',        'kS9SX,)M[YN/0QQDB$prz4s;qbEn2,Hm,D#fS@@nhk%HCM6&zh:/CAKei@]6o8X;');
define('SECURE_AUTH_SALT', 'y}mZYHPG9-aHsNY))Feu vf3R4~*WWAJ:mAhk|e~VO8i!m:A$~/Y_q}2K<6[l|{X');
define('LOGGED_IN_SALT',   'D&~CgDQ23o0~u|:s0T?>l|wzCc*-Vm~#!Bwi2 eSEf7zC!jV[yNG8l:#Y,><><34');
define('NONCE_SALT',       'i@`$bW+ged^7ULi)!I[q){ ^d1/sM!h4]*-W[:uL0?7(g+rmuHvz$`bm|N0VeOU{');

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

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'spacearcaders.co.uk');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('COOKIE_DOMAIN', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
