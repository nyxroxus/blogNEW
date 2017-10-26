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
define('AUTH_KEY',         ']!+g) }b5KE8n_xjEH^IVyA/6Po!DXp^x+>.]F#Y`NVzJ<-X7:D+MdAEu5V@UEU~');
define('SECURE_AUTH_KEY',  'jh1Mn,{)NxBDb8Ui7P0+xmPac)SG5*&^[WDhHXa&6CM/4f1/,ay)fgf%XE,R|7I{');
define('LOGGED_IN_KEY',    'dhyRT7Kn;%iVuEdpD9MGHa@fN;^L/(c*S|Vz}vDN*A/fqm;LX7JK0417wNN^e(b[');
define('NONCE_KEY',        ':{5@h}*H;d%j6).j>E%wd:BFy3*}~E]#ZnH<K=-vwOLb$WJ>Tb[(RP2A0@CKE$];');
define('AUTH_SALT',        'rRKX$=i3&@hjRwL0`V5&`neAkp&rI;Sa?{kr)O!2KN%3x[q)AGlqPzU+#,r|1k,H');
define('SECURE_AUTH_SALT', 'M!/e52T;0M@[~oh7R{jEzJ,MbX_nhXd[lZn.Jk/[m@GVz?,wJn G}Ai+4{x~ee/s');
define('LOGGED_IN_SALT',   'cHOHx?9ll]GPh>=aN}_lx|W)y|})cy7nn8TXl?ok!?uZj9&y09c-)MsH4TnW|HJ@');
define('NONCE_SALT',       'ktQ=k,?*)q>2lAhz$(:n7DT|<f_qEq[Wdm>X|@Ksm_)g_Kl7o`4=e,Omac.a40-c');

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
