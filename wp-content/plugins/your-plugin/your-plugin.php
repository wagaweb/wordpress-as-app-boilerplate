<?php

namespace YourNameSpace;

use FisPressShop\includes\Activator;
use FisPressShop\includes\Deactivator;
use FisPressShop\includes\Error_Handler;
use FisPressShop\includes\Exception_Handler;
use FisPressShop\includes\Plugin;

/**
 * The plugin bootstrap file
 *
 * @link              http://www.foo.bar
 * @since             0.0.1
 * @package           YourPlugin
 *
 * @wordpress-plugin
 * Plugin Name:       Your Plugin
 * Plugin URI:        http://www.waboot.com/
 * Description:       Sample Plugin
 * Version:           0.1.0
 * Author:            Jon Doe
 * Author URI:        http://www.jon.doe/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       your-plugin
 * Domain Path:       /languages
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/********************************************************/
/****************** PLUGIN BEGIN ************************
/********************************************************/

// Custom plugin autoloader function
spl_autoload_register( function($class){
	$prefix = "YourNameSpace\\";
	$plugin_path = plugin_dir_path( __FILE__ );
	$base_dir = $plugin_path."src/";
	// does the class use the namespace prefix?
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		return;
	}
	// get the relative class name
	$relative_class = substr($class, $len);
	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
	// if the file exists, require it
	if (file_exists($file)) {
		require_once $file;
	}
});