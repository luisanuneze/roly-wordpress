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
define( 'DB_NAME', 'wordpress_roly' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Abc123.' );

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
define( 'AUTH_KEY',         'kXC:QR1C7!znVT?l)oSe)]z&0!~?qM`IEB518$( 9k`8Gg#BrdiI@TuyMVN<&6cG' );
define( 'SECURE_AUTH_KEY',  '/6>8GoxCfCH|caxQwkm(vChOt$p!Js^uT|).w3mH[PwUCc0 /8NwCtqthM{;nF)j' );
define( 'LOGGED_IN_KEY',    'ij{4&jK42XtWhi%]n|l42rBx;e1YSz+=iLeL`=Dh6UJc9 X(J}({.#!kDL]X(JPH' );
define( 'NONCE_KEY',        '{J}.V.A1|Y-{TuFH2,!_&%35%d<!Hb;l|I:eP&o-BuRghN*I3O4NUiQo.vH;2HUt' );
define( 'AUTH_SALT',        '5s<}V1?~6`<V(B2O&R!TA7,dCQ> 9w6f!+#64@0hK@VERb<p^c5 SaU+tMo+{Pq{' );
define( 'SECURE_AUTH_SALT', 'di<bfO,7=BjDRs&29!&Onk ~|/vgAHAf^zJY^sQ&%5FU XK4e^Ef&<do;_4?{lw%' );
define( 'LOGGED_IN_SALT',   'TE GR+(peWm.LNE^5N.3*]ms?6+[(5N_2slg[|Q-gIPZG>6l0WNKWNznSH{W1Og_' );
define( 'NONCE_SALT',       '6MM0m4])]!nrlz|Q0L!)cD{Um,]4e!Qm[*th7B,=&,qY.P[]^Z&$GpeA`pKp%CQ6' );

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
