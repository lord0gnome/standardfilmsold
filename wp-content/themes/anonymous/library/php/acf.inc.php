<?php

function home_relationship_result($title, $post, $field, $post_id){

	$cover = get_field('cover', $post->ID);

	return "<div class='thumbnail'><img src='$cover' style='object-fit:cover; height:100%;'/></div>$title";
}

add_filter('acf/fields/relationship/result/name=movies', 'home_relationship_result', 10, 4);


function home_relationship_query( $args, $field, $post_id ) {

	// only show post with preview video
	$args['meta_query'] = array(
							'relation'	  => 'OR',
							array(
								'key'	  => 'video_preview_mp4',
								'value'   => '',
								'compare' => '!='
							),
							array(
								'key'	  => 'video_preview_webm',
								'value'   => '',
								'compare' => '!='
							)
						);

	// return
    return $args;

}

add_filter('acf/fields/relationship/query/name=movies', 'home_relationship_query', 10, 3);

// Add ACF options page for seo content
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Share image',
		'menu_title'	=> 'Share image',
		'menu_slug' 	=> 'share-image',
		'redirect'		=> false,
		'icon_url'      => 'dashicons-format-image',
	));
}