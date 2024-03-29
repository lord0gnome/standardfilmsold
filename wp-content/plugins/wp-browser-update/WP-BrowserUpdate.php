<?php
/*
Plugin Name: WP BrowserUpdate
Plugin URI: http://blog.steini.me/wp-browserupdate
Description: This plugin informs website visitors to update their out-dated browser in an unobtrusive way. Go to <a href="http://browser-update.org/" title="browser-update.org" target="_blank">browser-update.org</a> for more information…
Version: 2.4.1
Author: Marco Steinbrecher
Author URI: http://profiles.wordpress.org/macsteini
Min WP Version: 2.0
Max WP Version: 4.6
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl
Text Domain: wp-browser-update
Domain Path: /languages
*/

function wpbu_lang_init() {
load_plugin_textdomain('wp-browser-update', false, basename(dirname(__FILE__)).'/languages/');
}

function wpbu() {
$wpbu_vars = explode(' ', get_option('wp_browserupdate_browsers'));
$wpbu_js = explode(' ', get_option('wp_browserupdate_js'));
$browser = '';

if (!empty($wpbu_vars[0])) $browser .= 'i:'.$wpbu_vars[0].',';
if (!empty($wpbu_vars[1])) $browser .= 'f:'.$wpbu_vars[1].',';
if (!empty($wpbu_vars[2])) $browser .= 'o:'.$wpbu_vars[2].',';
if (!empty($wpbu_vars[3])) $browser .= 's:'.$wpbu_vars[3];

echo '<script type="text/javascript">
var $buoop = {c:2,'.str_replace(',,', ',', 'vs:{'.$browser.'}').',reminder:'.(isset($wpbu_js[0]) ? (int)$wpbu_js[0] : '').',test:'.(isset($wpbu_js[1]) ? $wpbu_js[1] : '').',newwindow:'.(isset($wpbu_js[2]) ? $wpbu_js[2] : '').'};
function $buo_f(){
var e = document.createElement("script");
e.src = "//browser-update.org/update.min.js";
document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
catch(e){window.attachEvent("onload", $buo_f)}
</script>';
}

function wpbu_administration() {
if (isset($_POST['wpbu_submit'])) {
update_option('wp_browserupdate_browsers', $_POST['wpbu_msie'].' '.$_POST['wpbu_firefox'].' '.$_POST['wpbu_opera'].' '.$_POST['wpbu_safari']);
update_option('wp_browserupdate_js', (int)$_POST['wpbu_reminder'].' '.$_POST['wpbu_testing'].' '.$_POST['wpbu_newwindow']);
update_option('wp_browserupdate_css_buorg', $_POST['wpbu_css_buorg']);
update_option('wp_browserupdate_css_buorgdiv', $_POST['wpbu_css_buorgdiv']);
update_option('wp_browserupdate_css_buorga', $_POST['wpbu_css_buorga']);
update_option('wp_browserupdate_css_buorgclose', $_POST['wpbu_css_buorgclose']);
echo '<div class="updated"><p><strong>'.__('Settings saved.', 'wp-browser-update').'</strong></p></div>';
unset($_POST['wpbu_submit']);
}

$wpbu_vars = explode(' ', get_option('wp_browserupdate_browsers'));
$msie = $wpbu_vars[0];
$firefox = $wpbu_vars[1];
$opera = $wpbu_vars[2];
$safari = $wpbu_vars[3];

$wpbu_js = explode(' ', get_option('wp_browserupdate_js'));
$wpbu_reminder = $wpbu_js[0];
$wpbu_testing = $wpbu_js[1];
$wpbu_newwindow = $wpbu_js[2];

$wpbu_css_buorg = get_option('wp_browserupdate_css_buorg');
$wpbu_css_buorgdiv = get_option('wp_browserupdate_css_buorgdiv');
$wpbu_css_buorga = get_option('wp_browserupdate_css_buorga');
$wpbu_css_buorgclose = get_option('wp_browserupdate_css_buorgclose');

$msie_vers = array(10, 9, 8, 7);
$firefox_vers = array(45, 40, 35, 30);
$opera_vers = array(37, 32, 27, 22);
$safari_vers = array(8, 7, 6, 5);

echo '<div class="wrap"><form action="'.$_SERVER['REQUEST_URI'].'" method="post"><h2>WP BrowserUpdate</h2><h3>'.__('Out-dated Browser Versions', 'wp-browser-update').'</h3><p>'.__('Please choose which browser version you consider to be out-dated (of course, this will include all versions below)… If you leave as is, WP BrowserUpdate uses the default values.', 'wp-browser-update').'</p><p>Microsoft Internet Explorer: <select name="wpbu_msie">';

for ($x=0; $x<count($msie_vers); $x++) echo '<option value="'.$msie_vers[$x].'"'.($msie==$msie_vers[$x] ? ' selected="selected"' : '').'>'.$msie_vers[$x].'</option>';

echo '</select> <a href="http://microsoft.com/internetexplorer" title="'.__('Download', 'wp-browser-update').'" target="_blank">'.__('Download', 'wp-browser-update').'</a></p><p>Mozilla Firefox: <select name="wpbu_firefox">';

for ($x=0; $x<count($firefox_vers); $x++) echo '<option value="'.$firefox_vers[$x].'"'.($firefox==$firefox_vers[$x] ? ' selected="selected"' : '').'>'.$firefox_vers[$x].'</option>';

echo '</select> <a href="http://mozilla.com/" title="'.__('Download', 'wp-browser-update').'" target="_blank">'.__('Download', 'wp-browser-update').'</a></p><p>Opera: <select name="wpbu_opera">';

for ($x=0; $x<count($opera_vers); $x++) echo '<option value="'.$opera_vers[$x].'"'.($opera==$opera_vers[$x] ? ' selected="selected"' : '').'>'.$opera_vers[$x].'</option>';

echo '</select> <a href="http://opera.com/" title="'.__('Download', 'wp-browser-update').'" target="_blank">'.__('Download', 'wp-browser-update').'</a></p><p>Apple Safari: <select name="wpbu_safari">';

for ($x=0; $x<count($safari_vers); $x++) echo '<option value="'.$safari_vers[$x].'"'.($safari==$safari_vers[$x] ? ' selected="selected"' : '').'>'.$safari_vers[$x].'</option>';

echo '</select> <a href="http://apple.com/safari" title="'.__('Download', 'wp-browser-update').'" target="_blank">'.__('Download', 'wp-browser-update').'</a></p><p>Google Chrome: '.__('No need to define – handled automatically', 'wp-browser-update').' <a href="http://chrome.google.com/" title="'.__('Download', 'wp-browser-update').'" target="_blank">'.__('Download', 'wp-browser-update').'</a></p><h3>'.__('Script Customizations', 'wp-browser-update').'</h3><p>'.__('After how many hours the message should re-appear (0 = Show all the time)', 'wp-browser-update').':<br /><input type="number" value="'.$wpbu_reminder.'" name="wpbu_reminder" min="0" max="99" step="1" required placeholder="(min: 0, max: 99)" /></p><p>'.__('Open link on notification bar in a new browser window/tab', 'wp-browser-update').':<br /><select name="wpbu_newwindow"><option value="true"'.($wpbu_newwindow=='true' ? ' selected' : '').'>'.__('Yes', 'wp-browser-update').'</option><option value="false"'.($wpbu_newwindow=='false' ? ' selected' : '').'>'.__('No', 'wp-browser-update').'</option></select></p><p>'.__('Always show notification bar (for testing purposes)', 'wp-browser-update').':<br /><select name="wpbu_testing"><option value="true"'.($wpbu_testing=='true' ? ' selected' : '').'>'.__('Yes', 'wp-browser-update').'</option><option value="false"'.($wpbu_testing=='false' ? ' selected' : '').'>'.__('No', 'wp-browser-update').'</option></select></p><h3>'.__('CSS Styles', 'wp-browser-update').'</h3><p>'.sprintf(__('If you do not know about CSS and how to use, leave the following forms empty. For further details, visit the %show-to page%s.', 'wp-browser-update'), '<a href="http://browser-update.org/customize.html" target="_blank">', '</a>').'</p><p>.buorg '.__('Style', 'wp-browser-update').':<br /><textarea name="wpbu_css_buorg" cols="40" rows="10">'.$wpbu_css_buorg.'</textarea></p><p>.buorg div '.__('Style', 'wp-browser-update').':<br /><textarea name="wpbu_css_buorgdiv" cols="40" rows="2">'.$wpbu_css_buorgdiv.'</textarea></p><p>.buorg a '.__('Style', 'wp-browser-update').':<br /><textarea name="wpbu_css_buorga" cols="40" rows="2">'.$wpbu_css_buorga.'</textarea></p><p>#buorgclose '.__('Style', 'wp-browser-update').':<br /><textarea name="wpbu_css_buorgclose" cols="40" rows="10">'.$wpbu_css_buorgclose.'</textarea></p><p class="submit"><input type="submit" name="wpbu_submit" value="'.__('Update Settings', 'wp-browser-update').'" /></p></form></div>';
}

function wpbu_css() {
$wpbu_css_buorg = get_option('wp_browserupdate_css_buorg');
$wpbu_css_buorgdiv = get_option('wp_browserupdate_css_buorgdiv');
$wpbu_css_buorga = get_option('wp_browserupdate_css_buorga');
$wpbu_css_buorgclose = get_option('wp_browserupdate_css_buorgclose');

if (!empty($wpbu_css_buorg) or !empty($wpbu_css_buorgdiv) or !empty($wpbu_css_buorga) or !empty($wpbu_css_buorgclose)) {
echo '<style type="text/css">';
if (!empty($wpbu_css_buorg)) echo "\r\n.buorg {".$wpbu_css_buorg."}";
if (!empty($wpbu_css_buorgdiv)) echo "\r\n.buorg div {".$wpbu_css_buorgdiv."}";
if (!empty($wpbu_css_buorga)) echo "\r\n.buorg a {".$wpbu_css_buorga."}";
if (!empty($wpbu_css_buorgclose)) echo "\r\n#buorgclose {".$wpbu_css_buorgclose."}";
echo "\r\n</style>";
}
}

function wpbu_admin() {
add_options_page('WP BrowserUpdate', 'WP BrowserUpdate', 'manage_options', 'wp-browserupdate', 'wpbu_administration');
}

function wpbu_settings_link($links) {
return array_merge(array('settings' => '<a href="'.admin_url('options-general.php?page=wp-browserupdate').'">'.__('Settings').'</a>'), $links);
}

function wpbu_activation() {
add_option('wp_browserupdate_browsers', '    ');
add_option('wp_browserupdate_js', '0 false true');
add_option('wp_browserupdate_css_buorg', '');
add_option('wp_browserupdate_css_buorgdiv', '');
add_option('wp_browserupdate_css_buorga', '');
add_option('wp_browserupdate_css_buorgclose', '');
}

register_activation_hook(__FILE__, 'wpbu_activation');
add_filter('plugin_action_links_'.basename(dirname(__FILE__)).'/'.basename(__FILE__), 'wpbu_settings_link');
add_action('plugins_loaded', 'wpbu_lang_init');
add_action('wp_footer', 'wpbu');
add_action('wp_head', 'wpbu_css');
add_action('admin_menu', 'wpbu_admin');

?>