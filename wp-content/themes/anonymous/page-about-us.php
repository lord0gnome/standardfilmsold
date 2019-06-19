<?php

$post = new TimberPost();
$context = Timber::get_context();
$context['id']   = 'about-us';
$context['post'] = $post;

$social_links = array(get_field("facebook_link"));

if (!empty(get_field("twitter_link")))
	array_push($social_links, get_field("twitter_link"));

if (!empty(get_field("instagram_link")))
	array_push($social_links, get_field("twitter_link"));

$context['links'] = count($social_links);

Timber::render(array('page-about.twig', 'page.twig'), $context, 604800);