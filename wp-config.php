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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db41rzgiblnn0c' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '(+MQ>XWcMo?U|~xi%2t+wFo!-iq}0scwZkpovw>V3-g&.>W]6Gd%#j1tT7JkS 1;' );
define( 'SECURE_AUTH_KEY',   '94*&?zVx60SQW$ 6LF&P`Q#)}]D_k/9U0~ AyISXfPGHW_i|2/&nO~}lt^LzeL{&' );
define( 'LOGGED_IN_KEY',     '~vK1`x;?7sU[Q)-B#nemn9ZuU)rV.QP/}(?;VvegKGn3+55:;r.f=L?,5;8aohR`' );
define( 'NONCE_KEY',         '|@f1i<sER,Kao&!.pZ7#6mJ4LN5iMra8?c/x`Qs92l[WG,m%J&$jS3^&+ L+S3Nd' );
define( 'AUTH_SALT',         'P3It}ex~*zw) =,-6H;p|x@_TT`)1$fiw25gNE;J1@4W+@j=h>7Pj*6;yyKVg^<_' );
define( 'SECURE_AUTH_SALT',  'kEzE/0$6mp,p]/hb?<-[q1W+rb:{tf3CuI8])z5t(F0,/&OJpH&hy?jx=_p;~W$n' );
define( 'LOGGED_IN_SALT',    '1((VIRyql@l#P`T>eH/yZAth ,*%s!xS|)zs@yt!Bh_{ f!zNJLv`2%WM4| aF{*' );
define( 'NONCE_SALT',        'nLDxO#6uk/6Hpdsj<`sFFV%-.;8@*:w_yNv>#3~t/#Y9/{B1~5n2c_s^(yFg6C6v' );
define( 'WP_CACHE_KEY_SALT', 'zrv%5Qk`An7QN>1v=ilidm|B-q$3K>KTf,50D[eP%A;[/OH&(UlJ.GwEuT&/K6}!' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_x7rnxxiyxu_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
define( 'WP_ENVIRONMENT_TYPE', 'staging' ); // Added by SiteGround WordPress Staging system
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
