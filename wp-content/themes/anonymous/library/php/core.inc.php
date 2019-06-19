<?php

	function anonymous_head_cleanup()
	{
		// category feeds
		// remove_action( 'wp_head', 'feed_links_extra', 3 );
		// post and comment feeds
		// remove_action( 'wp_head', 'feed_links', 2 );

		// EditURI link
		remove_action( 'wp_head', 'rsd_link' );
		// windows live writer
		remove_action( 'wp_head', 'wlwmanifest_link' );
		// index link
		remove_action( 'wp_head', 'index_rel_link' );
		// previous link
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		// start link
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		// links for adjacent posts
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

		// WP version
		remove_action( 'wp_head', 'wp_generator' );
		// remove WP version from css
		add_filter( 'style_loader_src', 'anonymous_remove_wp_ver_css_js', 9999 );
		// remove Wp version from scripts
		add_filter( 'script_loader_src', 'anonymous_remove_wp_ver_css_js', 9999 );

		// remove admin bar
		add_filter('show_admin_bar', '__return_false');

		//change admin footer text
		add_filter('admin_footer_text', 'remove_footer_admin');
	}

	function remove_footer_admin()
	{
		echo "";
	}

	// remove WP version from RSS
	function anonymous_rss_version() { return ''; }

	// remove WP version from scripts
	function anonymous_remove_wp_ver_css_js( $src )
	{
		if ( strpos( $src, 'ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}

	// remove injected CSS for recent comments widget
	function anonymous_remove_wp_widget_recent_comments_style()
	{
		if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) )
			remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}

	// remove injected CSS from recent comments widget
	function anonymous_remove_recent_comments_style()
	{
		global $wp_widget_factory;
		if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']))
			remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}

	// remove injected CSS from gallery
	function anonymous_gallery_style($css)
	{
		return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
	}


	/*********************
	SCRIPTS & ENQUEUEING
	*********************/

	function anonymous_scripts_and_styles()
	{

		global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

		$detect = new Mobile_Detect();
  		$deviceType = ($detect->isMobile() ? 'mobile' : 'desktop');

		if (!is_admin()) {

			// modernizr (without media query polyfill)
			//wp_register_script( 'anon-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

			// register main stylesheet
			wp_register_style( 'anon-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

			// ie-only style sheet
			//wp_register_style( 'anon-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

	  		// comment reply script for threaded comments
	  		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			  wp_enqueue_script( 'comment-reply' );
	  		}

			//adding scripts file in the footer
			wp_register_script( 'anon-js', get_stylesheet_directory_uri() . '/library/js/scripts.'.$deviceType.'.js', array(), '', true );

			// enqueue styles and scripts
			//wp_enqueue_script( 'anon-modernizr' );
			wp_enqueue_style( 'anon-stylesheet' );
			//wp_enqueue_style( 'anon-ie-only' );

			//$wp_styles->add_data( 'anon-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

			/*
			I recommend using a plugin to call jQuery
			using the google cdn. That way it stays cached
			and your site will load faster.
			*/
			//wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'anon-js' );

		}
	}

	/*********************
	THEME SUPPORT
	*********************/

	// Adding WP 3+ Functions & Theme Support
	function anonymous_theme_support()
	{
		// wp thumbnails (sizes handled in functions.php)
		add_theme_support( 'post-thumbnails' );

		// default thumb size
		set_post_thumbnail_size(125, 125, true);

		// wp custom background (thx to @bransonwerner for update)
		add_theme_support( 'custom-background',
		    array(
		    'default-image' => '',    // background image default
		    'default-color' => '',    // background color default (dont add the #)
		    'wp-head-callback' => '_custom_background_cb',
		    'admin-head-callback' => '',
		    'admin-preview-callback' => ''
		    )
		);

		// rss thingy
		add_theme_support('automatic-feed-links');

		// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

		// adding post format support
		add_theme_support( 'post-formats',
			array(
				'aside',             // title less blurb
				'gallery',           // gallery of images
				'link',              // quick link to other site
				'image',             // an image
				'quote',             // a quick quote
				'status',            // a Facebook like status update
				'video',             // video
				'audio',             // audio
				'chat'               // chat transcript
			)
		);

		// wp menus
		add_theme_support( 'menus' );

		// registering wp3+ menus
		register_nav_menus(
			array(
				'main-nav' => __( 'The Main Menu', 'anontheme' ),   // main nav in header
				'footer-links' => __( 'Footer Links', 'anontheme' ) // secondary nav in footer
			)
		);
	} /* end anon theme support */


	/*********************
	RELATED POSTS FUNCTION
	*********************/

	// Related Posts Function (call using anonymous_related_posts(); )
	function anonymous_related_posts()
	{
		echo '<ul id="anon-related-posts">';
		global $post;
		$tags = wp_get_post_tags( $post->ID );
		if($tags)
		{
			foreach( $tags as $tag )
				$tag_arr .= $tag->slug . ',';

			$args = array(
				'tag' => $tag_arr,
				'numberposts' => 5, /* you can change this to show more */
				'post__not_in' => array($post->ID)
			);
			$related_posts = get_posts( $args );
			if($related_posts) {
				foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
					<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; }
			else { ?>
				<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'anontheme' ) . '</li>'; ?>
			<?php }
		}
		wp_reset_postdata();
		echo '</ul>';
	} /* end anon related posts function */

	/*********************
	PAGE NAVI
	*********************/

	// Numeric Page Navi (built into the theme by default)
	function anonymous_page_navi()
	{
		global $wp_query;
		$bignum = 999999999;
		if ( $wp_query->max_num_pages <= 1 )
		return;
		echo '<nav class="pagination">';
		echo paginate_links( array(
			'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
			'format'       => '',
			'current'      => max( 1, get_query_var('paged') ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => '&larr;',
			'next_text'    => '&rarr;',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) );
		echo '</nav>';
	} /* end page navi */

	/*********************
	RANDOM CLEANUP ITEMS
	*********************/

	// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
	function anonymous_filter_ptags_on_images($content)
	{
		return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}

	// This removes the annoying […] to a Read More link
	function anonymous_excerpt_more($more)
	{
		global $post;
		// edit here if you like
		return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'anontheme' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'anontheme' ) .'</a>';
	}

	/*********************
	LOGIN CUSTO
	*********************/

	// function custom_login_css() {
	//   echo '<link rel="stylesheet" type="text/css" href="/wp-content/themes/' .get_template().'/library/css/login.css">';
	// }
	// add_action('login_head', 'custom_login_css');

	//-----------------------------------------------------o Clean scripts call

	add_filter('wp_default_scripts', 'remove_jquery_migrate');
	function remove_jquery_migrate(&$scripts)
	{
		if(!is_admin())
		{
			$scripts->remove('jquery');
		}
	}

	remove_action('wp_head', 'print_emoji_detection_script', 7);
	add_action('wp_print_scripts', '_deregister_scripts', 99);
	function _deregister_scripts()
	{
		if (!is_admin())
		{
			$list = array(
				//'jquery-ui-core',
				//'jquery-ui-tabs',
				'jquery-ui-dialog',
				//'jquery-ui-datepicker',
				'jquery-ui-autocomplete',
				'jquery-ui-slider',
				'jquery-ui-sortable',
				'jquery-ui-draggable',
				'jquery-ui-droppable',
				'jquery-ui-resizable',
				//'thickbox',
				'wpdk-script',
				'wpdk-jquery-ui-timepicker',
				'wpdk-jquery-validation',
				'wpdk-jquery-validation-additional-method',
			);
			wp_deregister_script($list);
		}
	}

	function remove_core_updates() {
		global $wp_version; return(object) array('last_checked'=> time(), 'version_checked'=> $wp_version);
	}

	// Disable update for prod
	if (defined('ENV') && ENV !== 'dev') {
		add_filter('pre_site_transient_update_core','remove_core_updates');
		add_filter('pre_site_transient_update_plugins','remove_core_updates');
		add_filter('pre_site_transient_update_themes','remove_core_updates');
	}