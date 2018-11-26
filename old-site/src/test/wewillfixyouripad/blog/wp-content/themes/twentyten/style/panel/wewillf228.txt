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
define('DB_NAME', 'wewillf2_wrd1');

/** MySQL database username */
define('DB_USER', 'wewillf2_wrd1');

/** MySQL database password */
define('DB_PASSWORD', 'N8oWEOGpxn');

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
define('AUTH_KEY',         'maaurHTkMEd7rUuqDRSAzzoYNbxS8sXs87tjiBvJi2g8zr4PfYvVdMOTbDVCJx74');
define('SECURE_AUTH_KEY',  'wCMEtTxIoyh3lVZvDkhqBGLnn4VRfHEfaKy8LdvxzeqokSWP7IZdRCpoCPd8Etoy');
define('LOGGED_IN_KEY',    '3J2ULrmvdAL8hyPsZGdBq2y4hzFkx9L6IsrwVlaD5FQp7L3CkEw3h6eKxu5hlkIz');
define('NONCE_KEY',        'GYulIKU4QvTpP1GAyowWZPjl8oNwkKg2kGYJ1vC468mrqkAyUGbDaWzaHE6mfBNc');
define('AUTH_SALT',        'g6PADePEDILEUdVnGDjzBtl6mytcIa3XhEVUjZa3BOidKcA9qmxakE30wxVILIUk');
define('SECURE_AUTH_SALT', '2ucIYHEe2ax9iWHCsjv0yBYlc8RgtxKfYjv7buOP6cwAzl8KaBPxyRgf2K2c6noR');
define('LOGGED_IN_SALT',   '0bqLxb6hTk3wZMd9ASfwSiZgxUyPaPhvMDtMP6r8zD5CnnEin3woOeVSfJjhYCOZ');
define('NONCE_SALT',       '2wSL4Ij8sTwftPkFASK1Z8oWqf1PGu2vy3Ts9FXZE38s3IAwtcN3UOZxQmk4gpXb');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
