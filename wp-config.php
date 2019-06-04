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
define( 'DB_NAME', 'comptex' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'uJRVJ;(G(`*t[zQW v!);XF3s %)+2ZfVaHJ+9_jB{4= l@`o{Tc zVmTFX16gCr' );
define( 'SECURE_AUTH_KEY',  '0?=s6jAu}5a/WaSXj4u9G`4dZdr^ok7:y>F1%>.G6zg>Z=nCPjxMxBwS=`vBy$6-' );
define( 'LOGGED_IN_KEY',    'drxJVo vLTT-7Q%Tu}G]d~T<Eev_}I`b,N=Sb;7gUMB1q$P/%u3TZ[@nn;T{MlAE' );
define( 'NONCE_KEY',        '=E}9DRmYL_eJ_lO&@{;wI?5Q.D/?/N{O?mgD#gJ~@t.!EOJZZ[<N%v]CCS`b%.xi' );
define( 'AUTH_SALT',        'pb917V/wX@I%NNFl~2S6g,jG@SHtIReqL.*RTDL-$NcHvM@Li?=,r0.q0=!6IJbO' );
define( 'SECURE_AUTH_SALT', 'jX46a(7m@&`{TusIL{N.?.]c-GqjL*}xU$XH:yDHRq27BL=SM0:e9sy`J)%]hb7T' );
define( 'LOGGED_IN_SALT',   'ln9#MER=5fDe5<{TXW`G_H-k[Qui-wU/(&sf$iuv,GV=z[Fbe5rHaz49mQ#C9L2s' );
define( 'NONCE_SALT',       'eOmy%vyml/CQMtj3974ueBe.!HuR4.}oP1h@8p?^?33rSsB!dB?u0VQ5c/y(;|7N' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
