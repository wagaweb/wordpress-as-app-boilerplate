<?php

/**
 * Enqueue scripts and styles.
 */
function yt_styles() {
	$version = filemtime(get_stylesheet_directory()."/style.css");
	wp_enqueue_style( 'yt-style', get_stylesheet_uri(), false, $version );
}
add_action( 'wp_enqueue_scripts', 'yt_styles' );