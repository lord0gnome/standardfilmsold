<?php
/**
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 *
 */

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

// WP_Query arguments
$query_args = array(
	'numberposts' => -1,
	'post_type'      => array('director'),
	'post_status'    => array('publish'),
	'tax_query' => array(
		array(
			'taxonomy' => 'director_category',
			'field'    => 'slug',
			'terms'    => $term->name,
		),
	),
);

// Context
$context = Timber::get_context();

// Query
$context['posts'] = Timber::get_posts($query_args);

// Page id
$context['id'] = $term->name;
$context['mainclass'] = "directors";

$categories = get_terms('director_category');
$context['categories'] = $categories;

Timber::render(array('directors.twig'), $context, 604800);