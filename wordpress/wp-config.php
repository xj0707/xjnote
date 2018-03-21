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
define('DB_PASSWORD', '123321');

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
define('AUTH_KEY',         '8aYs}O!xl{b0&6[c>2K7-OGGw:4M )>ZdPlOj.`wiU!Kd(;-PJCE~gi<JVC?FTEo');
define('SECURE_AUTH_KEY',  '_3.l|A-^TE-C&]z6;XvT$H$Q,ID^~MWfjw1BtUJV*^sqwR*H#3J~`mmN{]G/cnm>');
define('LOGGED_IN_KEY',    'JayK{n4JBww}l$fFHa<vFV{v*{5^ Kshn}#}5`FtHO?*J3zEx9J!Ru1MVZZv~%J>');
define('NONCE_KEY',        '5iy {?n_KUdY}!i67:kTVPU^mt$GooSuOR>ZPsN$*R%m~K}vWEiB)TzP:Y^%96YH');
define('AUTH_SALT',        'm;sLXvB[3$jjjmy1PNbR?aL3+LLZLMHMs8h$1?kX!qZn-.;`P|(:lq^%KX{#Yo~c');
define('SECURE_AUTH_SALT', '*c`(|fsE&A5h^.Vk{VOUwpT-qcjJL/$L.O?Y[q6>x4vp{.t#3:82fOOQ*:f=Lc;8');
define('LOGGED_IN_SALT',   'NS5fIO0Zvgt,F$Zjx*-~Fm[X60<!x -zc}3w<zS@LQ11Y_X dMhSnI&0gd^k1;Q>');
define('NONCE_SALT',       '2;[q:Ek/R XwE8]4Rd3?Y- nk&Ud{%&+Tm{mwJ1 ih}WK9X9FmQF21EkkoGOHdgW');

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
