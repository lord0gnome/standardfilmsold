<?php
require 'library/php/Mobile_Detect.php';
require 'library/php/core.inc.php';
require 'library/php/ajax.inc.php';
require 'library/php/timber.inc.php';
require 'library/php/seo.inc.php';
require 'library/php/w3tc.inc.php';
require 'library/php/acf.inc.php';

function anonymous_ahoy()
{
	// let's get language support going, if you need it
	load_theme_textdomain( 'anontheme', get_template_directory() . '/library/translation' );

	// launching operation cleanup
	add_action( 'init', 'anonymous_head_cleanup' );

	// remove WP version from RSS
	add_filter( 'the_generator', 'anonymous_rss_version' );
	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'anonymous_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action( 'wp_head', 'anonymous_remove_recent_comments_style', 1 );
	// clean up gallery output in wp
	add_filter( 'gallery_style', 'anonymous_gallery_style' );

	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'anonymous_scripts_and_styles', 999 );
	// ie conditional wrapper

	// launching this stuff after theme setup
	anonymous_theme_support();

	// cleaning up random code around images
	add_filter( 'the_content', 'anonymous_filter_ptags_on_images' );
	// cleaning up excerpt
	add_filter( 'excerpt_more', 'anonymous_excerpt_more' );

}
add_action( 'after_setup_theme', 'anonymous_ahoy' );


function is_ajax()
{
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		return true;
	else
		return false;
}

/* DON'T DELETE THIS CLOSING TAG */ ?>