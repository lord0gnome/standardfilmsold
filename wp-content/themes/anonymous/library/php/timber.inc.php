<?php
if (!class_exists('Timber'))
{
	add_action( 'admin_notices', function()
	{
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . admin_url('plugins.php#timber') . '">' . admin_url('plugins.php') . '</a></p></div>';
	});
	return;
}

function add_to_context($context)
{
	$template = get_template_directory_uri();
	$context['path_images'] = $template . "/library/images/";
	$context['path_videos'] = $template . "/library/videos/";

	$context['env'] = ENV;
	$context['menu'] = new TimberMenu('Main menu v2');
	$context['footer'] = new TimberMenu('follow-us');
	$context['is_ajax'] = is_ajax();

	$context['pll__'] = TimberHelper::function_wrapper('pll__');

	$detect = new Mobile_Detect(); // TODO avoid duplicate of new mobiledetect (core.inc.php l99)
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
	$context['device_type'] = $deviceType;

	return $context;
}
add_filter('timber_context', 'add_to_context');


// FILTERS
add_filter('get_twig', 'add_to_twig');

function add_to_twig($twig)
{
	$filter = new Twig_SimpleFilter('slugify', '_slugify');
	$wiredrive = new Twig_SimpleFilter('parse_wiredrive', '_parse_wiredrive');

	$twig->addFilter($filter);
	$twig->addFilter($wiredrive);

	return $twig;
}

function _slugify($text)
{
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) return 'n-a';

	return $text;
}

function _parse_wiredrive($text)
{
	if (empty($text)) return;

	$src    = array();
	$width  = array();
	$height = array();

	$iframe = str_replace('&controls=1', '&controls=0', $text);

	preg_match('/src="([^"]*)"/i', $iframe, $src);
	preg_match('/width="([^"]*)"/i', $iframe, $width);
	preg_match('/height="([^"]*)"/i', $iframe, $height);

	return "<div class='wiredrive-iframe' data-src='$src[1]' data-class='quality-$height[1]' data-width='$width[1]' data-height='$height[1]'></div>";
}