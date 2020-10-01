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
define( 'DB_NAME', 'alura' );

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
define( 'AUTH_KEY',         '1@i]-oZr )sb%-v?Y@+z0]W]Mjw-yr2J!JJObA^aeD.WK2`k|l9Mfl $8FX,ObTi' );
define( 'SECURE_AUTH_KEY',  'cwF{sz nD?/ZCi~qZ_Ci-0K=dn=bD/ts)uFFsgcw$eK4pHiJ5>9.%r.eh9:e83(2' );
define( 'LOGGED_IN_KEY',    'sw<X@^^HDKvw8_.maZUy@&ZZz/^mdD`O@s(eT#e^^*/YW.-j)GRan~lS_r9%@naO' );
define( 'NONCE_KEY',        'QE,,a7qdSa_U4`mW<Z.F)3~WxL`G(Vh}nbs{&iq_eh&a.+5@!L`j?y!ZmRgq-*)J' );
define( 'AUTH_SALT',        'pzdN?RbQxYOST;.y hXS3PP8+R3=94<IaJ1n~uc<C}<:=c.4gPGE^slVD!zc[sz6' );
define( 'SECURE_AUTH_SALT', 'JGtLI^L{{._6MLge50Rjiek[F=^hOiav=S4;N>z~}1 )|PkGz=)W*M9##&u_^DY&' );
define( 'LOGGED_IN_SALT',   '!y8?uL55j2 J:^%&]X94nod.XH1Wl$(x3UZ.6yxo&yMr+Y5Aheq.1*&.fqFD{:QS' );
define( 'NONCE_SALT',       'iIWB&SR3]sx,@0@vt]c!L{,!4T5c04V1KP(eXlCR?&1M1194(F,D ;Jdowuc]?D|' );

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
