<?php
/**
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 *
 */

// WP_Query arguments
$query_args = array(
	'post_type'      => array('director'),
	'post_status'    => array('publish'),
	'posts_per_page' => -1
);

/*$categories = get_categories( array(
'orderby' => 'name',
'order'   => 'ASC',
'hide_empty' => '1'
) );*/




//print_r($categories);

// Context
$context = Timber::get_context();

// Query
$context['posts'] = Timber::get_posts($query_args);

// Page id
$context['id'] = "directors";

$categories = get_terms('director_category');
$context['categories'] = $categories;

Timber::render(array('directors.twig'), $context, 604800);