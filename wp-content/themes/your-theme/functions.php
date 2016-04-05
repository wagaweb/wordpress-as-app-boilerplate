<?php
define("YT_TEXTDOMAIN","fashionis"); //[EDIT HERE]

$youtheme_includes = array(
	'inc/template-functions.php', //Custom template tags for this theme.
	'inc/template-tags.php', //Custom template tags for this theme.
	'inc/init.php', //Theme init
	'inc/hooks.php', //WC Template functions
	'inc/stylesheets.php', //Custom styles
	'inc/scripts.php', //Custom scripts
);

foreach ($youtheme_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', YT_TEXTDOMAIN), $file), E_USER_ERROR); //[EDIT HERE - YOURTHEME_TEXTDOMAIN]
	}
	require_once $filepath;
}
unset($file, $filepath);