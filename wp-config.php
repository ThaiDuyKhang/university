<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'university' );

/** Database username */
define( 'DB_USER', 'khangne' );

/** Database password */
define( 'DB_PASSWORD', 'Th@1ankhang' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '[QO:SpOB^=8D|7vfPQ;2DZ(!Cre%7wYn`w*VY`iw4!k9!dhfD6LB^<T7 x_%?E!b' );
define( 'SECURE_AUTH_KEY',  'm>~}9D7P{U!tj~dLe/>^`uxIP&n&#PqOx~)-m<Cqo+{|feJ;g}~Yi(ntq9VeX*9(' );
define( 'LOGGED_IN_KEY',    '>=*sw6o.XEELzdQUm&!l:[?t6)u5s+$Xd6hMkT)+>#p,Ws+6vpB4y!{hz _qLn{7' );
define( 'NONCE_KEY',        '@r9Lk.K*rDzYAG]W]o&2fvW.WX,niI3)!ab0`M;_V?`,x49[fn{vDv;/N:`JO&<O' );
define( 'AUTH_SALT',        '-zwc2tU9:4~$[L;?=qFpFq=2WA<#~TGBd/Us-{t0;(c13Ml P+Sx=Q+L6%z?xmT%' );
define( 'SECURE_AUTH_SALT', '96?~7&C^iy$&ISgv]F.1z,m5aiFS9r=81zj21K=6*4CV%b;0wX^Y0T=:]a#}.qo!' );
define( 'LOGGED_IN_SALT',   'D`yDU9_uS&},9]F#_AayX?p#4m-A*pqY7lhxt4ww@=(=Z4%Px(!?A*YNcO9;vjG{' );
define( 'NONCE_SALT',       '~iCOG}:M#xNm|ot 2q{4SRiZ@pT3!FbmN0E3bITZ[nkXO]bJ]6 _*N,*IuCvnq#e' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'un_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
