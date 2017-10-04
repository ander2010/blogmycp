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
define('DB_NAME', 'blogmycp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'flash');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'yuof]+?>SHSR%CEs^w_mH~Q!yDH9/U%> r+5YSXsP~Xv2&Mz/rK$Wza) Wv%c7wB');
define('SECURE_AUTH_KEY',  'S}<OtlJy]aK8<~<ukn>WCiwiRR.y:uQ<>uz{T A[AcB(wyIf}A5e/Xr$j-ILsgXV');
define('LOGGED_IN_KEY',    'yoU4<(2_.?6}VlU?AWw, >Hym(hH%w?qa=A$E#V2w)VD2?C9xJ]q-1==3]/j@?9?');
define('NONCE_KEY',        'm][W {Iw<brcAmK,1zA$!^_=Pso*?uP%dSP))8o7Qm:Zi19UGMCXm v@dAg2@OP*');
define('AUTH_SALT',        '2*$kNA7hQ<7Ij@<N)Dh&cBt6/Z:j;wZ2(ie{ea4-I[N&dcS0Ic[uTNx#LA?PMt`M');
define('SECURE_AUTH_SALT', 'IjpZDr ECRWgF~Fm@**ezvvC/OJFp.r.E[8=BXk3DaG_#,f1<+GW$uQ>~Y2f2l7w');
define('LOGGED_IN_SALT',   'dR{6s%0@Ty}`N{_Q&%;H5jq0~uu7{de=f-_L(|6!CaYzjs)NmRfd=&IiZkWia>)Y');
define('NONCE_SALT',       '.?FbIzG;CDbXScvgNhg9vDgqHO>Gli*$}~>.c>]%S&;j/O*0x|RcfWmA_-%Dk$;|');

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
