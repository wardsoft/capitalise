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
define('DB_NAME', 'capitalise2015');

/** MySQL database username */
define('DB_USER', 'capsa');

/** MySQL database password */
define('DB_PASSWORD', 'Xex3j_14');

/** MySQL hostname */
define('DB_HOST', '217.199.163.223');

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
define('AUTH_KEY',         'kw&L%YY-u,`>EXS_xy2>L,a2}tl~}7c`!,R#?RyhYAUM|HW-tOnQhIPo/iqC2^Xs');
define('SECURE_AUTH_KEY',  '--Y#/Tf2Lo =FE^I|:Ko@N4JD0Bs<`[{PZkXQd1m.`:V&i#- Fsr[oy?Y-PNlSq)');
define('LOGGED_IN_KEY',    'L8f]}m/w@0g>D!j`F0{g+8*=r6fDOI?jJ0FgL5Jh,Y G|ep6*3CY9(S|MVdo>saX');
define('NONCE_KEY',        '),j%aDqd+4-]9alER|RHUqY(V*5SK/dhc}J#IGYA%nNL.Fp/w-eqX-Bxi>/.KdEw');
define('AUTH_SALT',        '%4I+~OZ>WqWV(x3T+`<Qp0sz[XA($rPwUV~+^F?imZ3 ||y$q%nTQFv  iNPUMuo');
define('SECURE_AUTH_SALT', 'K|~npHic&fk7aF#l&g.? -|2(~r29(c=|P!Rch~a0ZxR|{t!!KPQpEs<z;(B1poM');
define('LOGGED_IN_SALT',   '~pqX)X>YZith6d tQ#{o`+mJf&M&Du#iXV{5GoKT,S*]OCfpUdPkM]#BZ?[hCGZ_');
define('NONCE_SALT',       '&utsD87Hr<f?|J%@`HT8eqPA~g62pzRE<^g@L_Em$b-9jakdA:WUN;i})~8{/`No');

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
