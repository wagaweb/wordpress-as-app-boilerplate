<?php

$configs = [];

$configs[] = "vendor/autoload.php";

if ( defined('WP_CLI') && WP_CLI ) {
	$configs[] = "configs/cli-config.php";
	$configs[] = "configs/local-salts.php";
}else{
	if($_SERVER['HTTP_HOST'] == "local.bar.baz"){ //[EDIT HERE]
		$configs[] = "configs/local-config.php";
		$configs[] = "configs/local-salts.php";
	}elseif(($_SERVER['HTTP_HOST'] == "staging.bar.baz")){
		$configs[] = "configs/staging-config.php";
		$configs[] = "configs/staging-salts.php";
	}else{
		$configs[] = "configs/prod-config.php";
		$configs[] = "configs/prod-salts.php";
	}
}

foreach ($configs as $file) {
	if ( file_exists( dirname( __FILE__ ) . '/'.$file ) ) {
		require_once $file;
	}else{
		die("{$file} not found!");
	}
}

define( 'WP_MEMORY_LIMIT', '1024M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');