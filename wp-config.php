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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_rosary' );

/** MySQL database username */
define( 'DB_USER', 'adminwecan' );

/** MySQL database password */
define( 'DB_PASSWORD', '_*8gTYWqM9FHU' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'DT.dOJz:{P]{5}6=C>y(<Q!T%irOkjbpMW.Tmr,#.Z:Fedv6Qw-6p0?Zoam3p`( ' );
define( 'SECURE_AUTH_KEY',  '<VGrQgaM&6R<2V1C67:G eV4L.Ao_8Yf:_=G-PHHf.2.l_~Rr1MJQ!}}[N=FNc#Z' );
define( 'LOGGED_IN_KEY',    'y4NKtGWUP5$R/`$h^A>)eG{RGk:cx-uM3k(}m<PnZ3518D5yX@I3k>7[u,cvv6u]' );
define( 'NONCE_KEY',        'gJ[BcFc*p83:OYRdzEewa#:}w5x0?SQ(I<D:-%2lS>9OYhr)0D^C,i>yG7$)O1l7' );
define( 'AUTH_SALT',        'l|z/VyCY<.hPUl|n`)kPW,H{yL5Uqc]{bvD$=#[2Mwt #]H:qMg-b}E{h|[!}4uW' );
define( 'SECURE_AUTH_SALT', 'c__`]0CSu9&ET|^k)Ti.;IP%}zTVN!X8v9NsNi[O2D=tK)j<{b:(u,8x_J&|QgQ)' );
define( 'LOGGED_IN_SALT',   '/a~%M]WcpnmDsGah];xx]X#w(M`y(Zb(y1qlriZ6Ik>**iGX$erK,@Yk&0#7#6CF' );
define( 'NONCE_SALT',       't?,.4k+$TU1>ev]C=vZAi~86?HY1UbdJ}#%(}Acn;PRosC]+RPiXqTT(Y1bf%{zo' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
