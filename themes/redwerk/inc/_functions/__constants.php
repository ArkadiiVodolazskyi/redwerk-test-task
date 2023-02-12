<?php

// TODO: remove
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// define( 'WP_DEBUG', true );
// define( 'WP_DEBUG_LOG', true );
// define( 'WP_DEBUG_DISPLAY', true );

define("B_THEME_ROOT", get_stylesheet_directory_uri());
define("CSS_DIR", B_THEME_ROOT . "/assets/css");
define("JS_DIR", B_THEME_ROOT . "/assets/js");
define("IMG_DIR", B_THEME_ROOT . "/assets/img");
define("LIBS_DIR", B_THEME_ROOT . "/assets/libs");
define("FONTS_DIR", B_THEME_ROOT . "/assets/fonts");
define("UPLOADS_DIR", wp_get_upload_dir()['baseurl']);

define('SITE_NAME', get_bloginfo('name'));
define('WORDPRESS_SMTP_AUTH', false);
define('WORDPRESS_SMTP_SECURE', '');
define('WORDPRESS_SMTP_HOST', 'mailhog');
define('WORDPRESS_SMTP_PORT', '1025');
define('WORDPRESS_SMTP_USERNAME', null);
define('WORDPRESS_SMTP_PASSWORD', null);
define('WORDPRESS_SMTP_FROM', 'redwerk.local@mail.com');
define('WORDPRESS_SMTP_FROM_NAME', SITE_NAME);

date_default_timezone_set('UTC');
$email_delay = esc_attr(get_option('email_delay')) ?: 20;
define("EMAIL_DELAY_MINUTES", $email_delay);

// TODO: remove
// define('WP_CRON_LOCK_TIMEOUT', 5);
// define('DISABLE_WP_CRON', 'true');
// define( 'ALTERNATE_WP_CRON', true );