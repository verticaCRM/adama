<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

ini_set('memory_limit','512M');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bbrokers_adama');

/** MySQL database username */
define('DB_USER', 'bbrokers_dba');

/** MySQL database password */
define('DB_PASSWORD', 'ddhk0na4Z!');

/** MySQL hostname */
define('DB_HOST', 'yf.alsonetworks.com');

define('API_USER','api');
define('API_PASS','gOKKzdL2Iu6U+K%j-H7#NCM5j');
define('API_HOST','adama.businessbrokerscrm.com/crm');


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
define('AUTH_KEY',         '+`i#ewuY?KT6Qm>[@YZJu2UN~V_:GF>$[^Csv!Dj+?V9<7Cf1,i]maQ}a[B-l)2r');
define('SECURE_AUTH_KEY',  'v)r1KN^Ae-L%I_Z~~V*zpgDtj wO@6orYc)_ACeCiw7n {=4qCIhpz/z:K]t+&Up');
define('LOGGED_IN_KEY',    '-7}EoVPck*VG3|%6=Qi*]mLFhRMQJIkH*5GM<*CTS<kq-r-i9Kl]MT-@UQZ`!WDZ');
define('NONCE_KEY',        '|,ZY>`:A*NewTj|yrgx|8|/R}w?>>D)qg/|Ont@j]+o}AR+?B3p?$_[K2dSD>3Iv');
define('AUTH_SALT',        '3)4$axQ(2+e=nkm+LKxMi/$Uy[qag6i-|-$/=)-+53Z{-S@+L%-I:-_=}}6QzkU4');
define('SECURE_AUTH_SALT', 'D4*6Y)T*5 |kw|YtR7Ku^;>pY1e|uZ44^gW7Wb+,n)0zeD.2$p8w3+^}@ifg^[eq');
define('LOGGED_IN_SALT',   '+DD91voEC,##8UI5709d0<,lm2Vr==bLS>s~If7~Y/TY9PnlYB-R)-:lPY0dUU2N');
define('NONCE_SALT',       'ba_%|#;!@#w3f+$5j)=G/A?=!brfOvqF+nMksRHx+tzi(GdI-;]z<Gm9@cZpkfUM');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bbcrmFE_';

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
