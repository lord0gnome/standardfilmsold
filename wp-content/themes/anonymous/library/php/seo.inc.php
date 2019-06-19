<?php

use Timber\ImageHelper;

function add_custom_meta_des() {
	global $post;

	$url       = get_permalink();
	$title     = get_bloginfo('name') . ' | '. get_the_title();
	$site_name = get_bloginfo('name');

	if (is_single() && isset($post) && $post->post_type == "movie") {

		$src       = array();
		$webString = array();
		$image     = ImageHelper::resize(get_field('cover'), 600, 315);
		$video     = get_field(get_field('custom_file_mp4__webm'));

		// Video URL
		if (get_field('custom_file_mp4__webm') === 'wiredrive')
			preg_match('/src="([^"]*)"/i', get_field('wiredrive'), $src);

		if (isset($src[1])) {
			$iframe = file_get_contents($src[1]);
			preg_match('/"web":({.*?})/i', $iframe, $webString);

			if (isset($webString)) {
				$webObject = json_decode($webString[1]);
				$videoUrl = $webObject->url;
			}
		} else {
			$videoUrl = get_field('video_full_mp4');
		}

		// Facebook
		echo '<meta property="og:type" content="website" />';
		echo '<meta property="og:url" content="' . $url . '" />';
		echo '<meta property="og:title" content="' . $title .'" />';
		echo '<meta property="og:image" content="' . $image . '" />';
		echo '<meta property="og:site_name" content="' . $site_name . '" />';
		echo '<meta property="og:description" content="' . get_the_title() . (!empty(get_field('subtitle')) && !empty(get_field('director')) ? ' | ' : '') . get_field('subtitle') . (!empty(get_field('director')) ? ' by ' . get_field('director')[0]->post_title : '') . '" />';

		if (isset($videoUrl)) {
			echo "\n".'<meta property="og:video" content="' . $videoUrl . '" />';
			echo "\n".'<meta property="og:video:type" content="video/mp4" />'."\n";
		}

		// Twitter
		echo '<meta name="twitter:card" content="summary" />';
		echo '<meta name="twitter:url" content="' . $url . '" />';
		echo '<meta name="twitter:title" content="' . $title . '" />';
		echo '<meta name="twitter:image" content="' . $image . '" />';
		echo '<meta name="twitter:site" content="' . $site_name . '" />';

	} else if (is_single() && isset($post) && $post->post_type == "director") {

		$image = ImageHelper::resize(get_field('director_cover'), 600, 315);

		echo '<meta property="og:type" content="website" />';
		echo '<meta property="og:url" content="' . $url . '" />';
		echo '<meta property="og:title" content="' . $title .'" />';
		echo '<meta property="og:image" content="' . $image . '" />';
		echo '<meta property="og:site_name" content="' . $site_name . '" />';
		echo '<meta property="og:description" content="' . get_bloginfo('description') . '" />';

		echo '<meta name="twitter:card" content="summary" />';
		echo '<meta name="twitter:url" content="' . $url . '" />';
		echo '<meta name="twitter:title" content="' . $title . '" />';
		echo '<meta name="twitter:image" content="' . $image . '" />';
		echo '<meta name="twitter:site" content="' . $site_name . '" />';

	} else {

		$url = is_home() ? get_home_url() : get_permalink();
		$title = is_home() ? get_bloginfo('name') : $title;
		$image = ImageHelper::resize(get_field('share_img', 'option'), 600, 315);

		echo '<meta property="og:type" content="website" />';
		echo '<meta property="og:url" content="' . $url . '"/>';
		echo '<meta property="og:title" content="' . $title . '" />';
		echo '<meta property="og:image" content="' . $image . '" />';
		echo '<meta property="og:site_name" content="' . $site_name . '" />';
		echo '<meta property="og:description" content="' . get_bloginfo('description') . '" />';

		echo '<meta name="twitter:card" content="summary" />';
		echo '<meta name="twitter:url" content="' . $url . '" />';
		echo '<meta name="twitter:title" content="' . $title . '" />';
		echo '<meta name="twitter:image" content="' . $image . '" />';
		echo '<meta name="twitter:site" content="' . $site_name . '" />';

	}
}

add_action( 'wp_head', 'add_custom_meta_des', 4 );