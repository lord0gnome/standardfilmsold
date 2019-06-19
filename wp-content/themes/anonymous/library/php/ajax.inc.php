<?php
/*
 * HOME
 */
function load_associate_video() {

	$post_limit = 4;

	$terms = explode(' ', $_POST['terms']);

	// WP_Query arguments
	$query_args = array(
		'post_type'      => array('movie'),
		'post_status'    => array('publish'),
		'post__not_in'   => array($_POST['id']),
		'posts_per_page' => $post_limit,
		'movie_category' => $terms,
		'orderby'        => 'rand',
	);

	// Query
	remove_all_filters('posts_orderby');

	$context = Timber::get_context();
	$context['more_movie'] = Timber::get_posts($query_args);

	// Exclude this movie for next request
	$not_in = array(intval($_POST['id']));

	foreach ($context['more_movie'] as $movie) {
		array_push($not_in, $movie->ID);
	}

	// Load other movie if needed
	$movie_count = count($context['more_movie']);

	if ($movie_count < $post_limit) {
		$diff = $post_limit - $movie_count;

		$movie_args = array(
			'posts_per_page' => $diff,
			'orderby'        => 'rand',
			'post__not_in'   => $not_in,
			'post_type'      => array('movie'),
			'post_status'    => array('publish'),
			'meta_query'     => array(
									array(
										'key'     => 'director',
										'value'   => $_POST['director'],
										'compare' => 'LIKE'
									)
								)
		);

		$context['more_movie'] = array_merge($context['more_movie'], Timber::get_posts($movie_args));
	}

	// IF THERE IS NO MORE MOVIES AVOID BUG
	// Load director if needed
	$movie_count = count($context['more_movie']);

	if ($movie_count < $post_limit) {
		$diff = $post_limit - $movie_count;

		$directors_args = array(
			'post_type'      => array('director'),
			'post_status'    => array('publish'),
			'orderby'        => 'rand',
			'posts_per_page' => $diff
		);

		$context['directors'] = Timber::get_posts($directors_args);
	}

	// Render
	Timber::render(array('partials/home.twig'), $context, 604800);

	die();
}

add_action( 'wp_ajax_load_associate_video', 'load_associate_video' );
add_action( 'wp_ajax_nopriv_load_associate_video', 'load_associate_video' );

/*
 * DIRECTOR
 */

function load_details_video() {
	// Get post
	$context['post'] = Timber::query_post($_POST['id']);

	// Render
	Timber::render(array('partials/movie.twig'), $context, 604800);

	die();
}

add_action( 'wp_ajax_load_details_video', 'load_details_video' );
add_action( 'wp_ajax_nopriv_load_details_video', 'load_details_video' );