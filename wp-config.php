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
define('DB_NAME', 'lighttv');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '}G;aT|zS%#4QgGKAD%P(+BMl`=MlG4oZAqLg7EFs.G.m}8dR#y(y}|bz%+y^yN84');
define('SECURE_AUTH_KEY',  '+xb?^I~rq%J+N#uOtu2qi_Zoym-YO@{MV7p^1;@[r5C`hVK2xkZ$V7<cTPZgc@gV');
define('LOGGED_IN_KEY',    'qQ#VsDUCw^+ls*]3d^e*T,3rtcV=(b:m/SujhO?>,;Z;|94]];FR+#fDYZqnnXEl');
define('NONCE_KEY',        'W7qC*az9b@KJv>*X}o@E>f?g~+=KZmS9_%6IB4VKe#(ta9 D|m-I.2*lY-c?HJp$');
define('AUTH_SALT',        '~yp#ESFcRI{q-uGpsH4pfW)8e!eYpIeeFNjI0,wQni1-|d98<Br`,NYpj*1:xpOK');
define('SECURE_AUTH_SALT', 's2`3_{r?_D[MOpg01%$0#n7/{#KE*vb_vE97Yx=t{I1GYRfW,Uz4(3`Yk5xP+ug/');
define('LOGGED_IN_SALT',   '.}q-&U7G^0]gu|<%Z/t)c5=$?!sm;r)sW0eJf3hNTX.s1I2%a?-R*)l~OWG}.|]H');
define('NONCE_SALT',       'QjXwG148xv2*h7=O;hv1^)L{0i7h;&jbTzV,bY(UnB+N3$r|3ed}=k 8tBYT}.Vu');

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
