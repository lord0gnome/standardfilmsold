<?php

$post = new TimberPost();
$context = Timber::get_context();
$context['id']   = 'latest';
$context['post'] = $post;

Timber::render(array('page-latest.twig', 'page.twig'), $context, 604800);