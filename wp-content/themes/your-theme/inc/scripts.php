<?php

/**
 * Register and include main scripts
 */
function yt_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$wpData = [
		'ajaxurl' => admin_url('admin-ajax.php'),
		'wpurl' => get_bloginfo('wpurl'),
		'isMobile' => function_exists("wb_is_mobile") ? wb_is_mobile() : false,
		'isAdmin' => is_admin(),
		'isDebug' => defined("WP_DEBUG") && WP_DEBUG,
		'wp_screen' => function_exists("get_current_screen") ? get_current_screen() : null,
		'i18n' => []
	];

	$uri = defined("WP_DEBUG") && WP_DEBUG ? get_template_directory_uri() . '/assets/src/js/bundle.js' : get_template_directory_uri() . '/assets/dist/js/main.min.js';
	$path = defined("WP_DEBUG") && WP_DEBUG ? get_template_directory() . '/assets/src/js/bundle.js' : get_template_directory() . '/assets/dist/js/main.min.js';
	$deps = ['jquery','bootstrap','backbone','underscore'];
	$version = filemtime($path);

	wp_register_script( 'yt-main-js', $uri, $deps, $version, true );
	wp_localize_script( 'yt-main-js', 'wpData', $wpData);
	wp_enqueue_script('yt-main-js');
}
add_action( 'wp_enqueue_scripts', 'yt_scripts', 99 );

/**
 * Register and includes vendor scripts
 */
function yt_vendor_scripts(){
	$vendors_scripts = [
		'bootstrap' => [
			'uri' => get_template_directory_uri() . '/assets/vendors/bootstrap-sass/assets/javascripts/bootstrap.min.js',
			'path' => get_template_directory() . '/assets/vendors/bootstrap-sass/assets/javascripts/bootstrap.min.js',
			'deps' => ['jquery'],
			'version' => '3.3.5',
			'enqueue' => true,
			'in_footer' => true
		]
	];

	$to_enqueue = [];
	foreach($vendors_scripts as $name => $param){
		if(!file_exists($param['path'])) continue;
		if(isset($param['version'])){
			$version = $param['version'];
		}else{
			$version = filemtime($param['path']);
		}
		wp_register_script($name,$param['uri'],$param['deps'],$version,$param['in_footer']);
		if(isset($param['enqueue']) && $param['enqueue']){
			$to_enqueue[] = $name;
		}
	}

	if(!empty($to_enqueue)){
		foreach($to_enqueue as $s){
			wp_enqueue_script($s);
		}
	}
}
add_action('wp_enqueue_scripts','yt_vendor_scripts', 98);