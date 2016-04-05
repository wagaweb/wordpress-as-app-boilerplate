<?php
// ** MySQL settings ** //

define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

$table_prefix  = 'wp_';

// ** Debug settings ** //

define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);
define('SCRIPT_DEBUG', true);
define('SAVEQUERIES', true);

// ** WP settings ** //

define( 'WP_POST_REVISIONS', true ); // FALSE to disable revisions
define( 'MEDIA_TRASH', true ); // enabling "trash" for media items
define( 'DISALLOW_FILE_EDIT', true ); // disable editing theme/plugin files from wp-admin

define('WP_SITEURL', 'http://'.$_SERVER['HTTP_HOST']."/wp");
define('WP_HOME', 'http://'.$_SERVER['HTTP_HOST']);
define('WP_DEFAULT_THEME', 'fashionis');
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content');
define('WP_CONTENT_URL', 'http://'.$_SERVER['HTTP_HOST'].'/wp-content');
define('WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins');
define('WP_PLUGIN_URL', 'http://'.$_SERVER['HTTP_HOST'].'/wp-content/plugins');