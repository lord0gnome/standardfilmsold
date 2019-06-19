<?php
function add_rewrite_rules($wp_rewrite) 
{
	$new_rules = array(
		// 'submissions/(best|recent)/([^/]+)/page/([0-9]{1,})/?$' => 'index.php?pagename=submissions/'.$wp_rewrite->preg_index(1).'&countries='.$wp_rewrite->preg_index(2).'&paged='.$wp_rewrite->preg_index(3)
	);
	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules', 9);

function query_vars($public_query_vars)
{
    $public_query_vars[] = "countries";

    return $public_query_vars;
}
add_filter('query_vars', 'query_vars');