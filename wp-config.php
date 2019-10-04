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

define('DB_NAME', 'id5516274_parsial');



/** MySQL database username */

define('DB_USER', 'id5516274_parsial');



/** MySQL database password */

define('DB_PASSWORD', 'maftuh203');



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

define('AUTH_KEY',         'oan*53/xY&+ ~Uz|1VPM%~`vL(xm,^e]IwlZ=<@,YAxd4FELoZ</Ba(+/)ul+x}<');

define('SECURE_AUTH_KEY',  '.Y1/L*pnSJMk)3=4;+Nd>>qb{vInRw+io {|+S{}366LgzOE&<Cot*=%1^Xq]Z5@');

define('LOGGED_IN_KEY',    '?e4d]UmClR<VX;PUxKw`m5k~.bOc!aUo1=F_O^r7$i=4kPOPkof80WCpspt/pznR');

define('NONCE_KEY',        '-20wbl8cSk?f3u>ZsI]>?=pLE{o~+NW#{Is]YBQcE3auBn3gl;BFVbeU&-!U#&R/');

define('AUTH_SALT',        't,!`$e_WLm|[>viCtS5]n$OzRL.%9`7 LYT}aw<ra52@ fjaNQTy%f&S7o9y#@qM');

define('SECURE_AUTH_SALT', 'Vd+5!Ux0f`!(Xokc^9PcwS7!(i8FYxKGgd*6p7>](}X<b8stIE7#49<XuVpeu&Zt');

define('LOGGED_IN_SALT',   '@jdGruv)*,O)h& q5xT_]Fm@o v}mCYF*,Hh`L`-.3S{w[M)q/@LD+lFdR&X.W  ');

define('NONCE_SALT',       'gJpnq{D*8hO;+@Yg??(D*yxf8`+BX{ovv;ch j_OgW}knL%  _l$|ipE%k9{09>@');



/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix  = 'psl';



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

/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

