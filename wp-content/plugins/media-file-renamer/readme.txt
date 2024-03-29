=== Media File Renamer ===
Contributors: TigrouMeow
Tags: rename, file, media, management, image, renamer, wpml, wp-retina-2x
Requires at least: 4.2
Tested up to: 4.6
Stable tag: 2.7.9

Auto-rename the files when titles are modified and update and the references (links). Manual Rename is a Pro option. Please read the description.

== Description ==

The Media File Renamer is a WordPress plugin that physically renames media files nicely for a cleaner system and for a better SEO. Please read the description as it contains important information.

**IMPORTANT**. This is originally an *automatic* renamer based on the Media title. This plugin features were all meant to be automatic depending on the title of the Media. Manual Rename (and a few more features) were added two years later, in a Pro version. I add complex features based on requests usually in the Pro to be able to maintain the quality of the plugin and its support.

**HOW IT WORKS**. The plugin automatically renames your media filenames depending on their titles. When files are renamed, the references to it are also updated (posts, pages, custom types and their metadata). A new column in the Media Manager will display to you the new ideal filename and a button will allow you to rename it straight away. You can lock and unlock the renaming automatic process through little icons. There is also a little dashboard called File Renamer in Media that will help you rename all your files at once. Advanced users can change the way the files are renamed by using the plugin's filters (check the FAQ). There is also a LOCK option on every image to avoid the filename to be modified any further.

**PRO VERSION**. The [Pro Version](http://apps.meow.fr/media-file-renamer/) gives a few more features like manual renaming, renaming depending on the post the media is attached to, logging of SQL queries and a few more options. A good process is to actually let the plugin do the renaming automatically (like in the free version) and to do manual renaming for the files that require fine tuning.

**BE CAREFUL**. File renaming is a dangerous process. Before renaming everything automatically, try to rename a few files first and check if all the references to those files have been properly updated on your website. WordPress has so many themes and plugins that this renaming process can't unfortunately cover all the cases, especially if other plugins are using unconventional ways. If references aren't updated properly, please write a nice post (not an angry one) in the support threads :) I will try my best to cover more and more special cases. In any case, always make a **backup** of your database and files before using a plugin that alter your install. Also, it your website seems broken after a few renames, try to **clear your cache**. The cached HTML will indeed not be linked to the new filenames.

**FOR DEVELOPER**. The plugin can be tweaked and reference updates enhanced for your themes/plugins. Have a look [here](https://wordpress.org/plugins/media-file-renamer/faq/).

**JUST TO MAKE SURE**. This plugin will not allow you to change the filename manually in its standard version. The [Pro Version](http://apps.meow.fr/media-file-renamer/) is required. If you are about to *write an angry review* because this feature is not available, please *mention that you read the whole description*.

This plugin works perfectly with WP Retina 2x, WPML and many more. Is has been tested in Windows, Linux, BSD and OSX systems.

Languages: English, French.

== Installation ==

1. Upload `media-file-renamer.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Try it with one file first! :)

== Upgrade Notice ==

Simply replace `media-file-renamer.php` by the new one.

== Frequently Asked Questions ==

Check the FAQ on the official website, here: http://apps.meow.fr/media-file-renamer/faq/. The following is to enhance the plugin for your own install and is aim to advanced users and developers. If you want to quickly try to use the following filters and actions, please have a look a the file called mfrh_custom.php in the plugin, uncomment some code and hack it :)

**Change the way the files are renamed**

If you are willing to customize the way the file are renamed, please use the mfrh_new_filename filter. The $new is the new filename proposed by the plugin, $old is the previous one and $post contains the information about the current attachment.

`
add_filter( 'mfrh_new_filename', 'my_filter_filename', 10, 3 );

function my_filter_filename( $new, $old, $post ) {
  return "renamed-" . $new;
}
`

**Update References**

You can also update the references to the files or URLs which are renamed/modified by using the following filters. If you themes or another plugins are storing those references by yourself, then this is a chance to achieve this :)

The $post is an array containing information about the media (as it is like a post), and you can use the $original_image_url and $new_image_url to do the required renaming:

`
add_action( 'mfrh_url_renamed', 'my_url_renamed', 10, 3 );

function my_url_renamed( $post, $orig_image_url, $new_image_url ) {
  return "renamed-" . $new;
}
`

This is the same as above but it is about the physical filepath on your filesystem:

`
add_action( 'mfrh_media_renamed', 'my_media_renamed', 10, 3 );

function my_media_renamed( $post, $old_filepath, $new_filepath ) {
  return "renamed-" . $new;
}
`

You are welcome to create plugins using Media File Renamer using special rules for renaming. Please tell me you so if you make one and I will list those plugins here.

== Screenshots ==

1. Type in the name of your media, that is all.
2. Special screen for bulk actions.
3. This needs to be renamed.
4. The little lock and unlock icons.
5. Options for the automatic renaming (there are more options than just this).

== Changelog ==

= 2.7.9 =
* Fix: Removed Flattr.

= 2.7.8 =
* Add: Additional cleaning to avoid extensions sometimes written in the title by WP.
* Add: Clean out the english apostrophe 's during the creation of the new filename.
* Info: If you have some time, please give a positive review at https://wordpress.org/support/view/plugin-reviews/media-file-renamer?rate=5#postform. That helps me keeping my motivation to push the plugin forward, so thank you... a lot :)

= 2.7.6 =
* Add: New option to remove the ad, the Flattr button and the information message about the Pro.

= 2.7.4 =
* Fix: Renaming slug was not working well after latest WordPress updates

= 2.7.2 =
* Fix: Use direct links for all my images and links to follow WordPress rules.

= 2.7.1 =
* Info: A file mfrh_custom.php has been added. If you are an advanced users or a developer, please have a look at the FAQ here: https://wordpress.org/plugins/media-file-renamer/faq/. Since I am only one developer, I can't cover all the renaming cases we have (since sometimes plugins keep their own links to the filenames; such as WooCommerce). That will make it easy to advanced users to push Media File Renamer to cover more and more special cases.

= 2.6.9 =
* Change: Modified description and information about the mfrh_url_renamed and mfrh_media_renamed filters.

= 2.6.8 =
* Add: New option to force renaming file (even though the file failed to be renamed). That will help PRO users to fix their broken install, often after a migration for example (often related to change of hosting service using different encoding).

= 2.6.7 =
* Fix: Click on lock/unlock doesn't take you back to the first page anymore.

= 2.6.6 =
* Fix: Little naming issue when numbering + custom filter is used.

= 2.6.0 =
* Add: Lock/Unlock icons in the Media Manager.
* Add: Rename depending on the title of the post the media is attached to.

= 2.5.0 =
* Update: WordPress 4.4.
* Add: Add -2, -3, etc... when filenames are similar. Pro only.

= 2.4.2 =
* Fix: There was a glitch when .jpeg extension were used. Now keep them as .jpeg.

= 2.4.0 =
* Fix: There was a possibility that the image sizes filenames could be overwritten wrongly.

= 2.3.8 =
* Update: Rename the GUID (File Name) is now the default. Too many people think it is a bug while it is not.

= 2.3.6 =
* Add: UTF-8 support for renaming files. Before playing with this, give it a try. Windows-based hosting service will probably not work well with this.

= 2.3.4 =
* Fix: Auto-Rename was renaming files even though it was disabled.
* Update: If Auto-Rename is disabled, the Media Library column is not shown anymore, neither is the dashboard (they are useless in that case).

= 2.3.2 =
* Add: Metadata containing '%20' instead of spaces are now considered too during the renaming.

= 2.3.0 =
* Add: Update the metadata (true by default).

= 2.2.8 =
* Fix: Guid was renamed wrongly in one rare case.

= 2.2.6 =
* Fix: Double extension issue with manual renaming.

= 2.2.4 =
* Fix: Couldn't rename automatically the files without changing the titles, now the feature is back.
* Fix: Better 'explanations' before renaming.
* Fix: Should work with WPML Media now.
* Fix: Manage empty filenames by naming them 'empty'.

= 2.2.2 =
* Add: Option to automatically sync the alternative text with the title.
* Add: Filters and Actions to allow plugins (or custom code) to customize the renaming.
* Fix: Avoid to rename file if title is not changed (annoying if you previously manually updated it).
* Change: Plugin functions are only loaded if the user is using the admin.

= 2.2.0 =
* Add: Many new options.
* Add: Pro version.
* Add: Manual file rename (Pro).
* Update: Use actions for renaming (to facilitate support for more renaming features).

= 2.0.0 =
* Fix: Texts.

= 1.9.8 =
* Fix: Versioning.

= 1.9.4 =
* Add: New option to avoid to modify database (no updates, only renaming).
* Add: New option to force update the GUID (aka "File name"...). Not recommended _at all_.
* Fix: Options were without effect.

= 1.4 =
* Fix: GUID issue.

= 1.3.4 =
* Fix: issue with attachments without metadata.
* Fix: UTF-8 title name (i.e. Japanese or Chinese characters).

= 1.3.0 =
* Add: option to rename the files automatically when a post is published.

= 1.2.2 =
* Fix: the 'to be renamed' flag was not removed in a few cases.

= 1.2.0 =
* Fix: issue with strong-caching with WP header images.
* Fix: now ignore missing files.
* Change: renaming is now part of the Media Library with nice buttons.
* Change: the dashboard has been moved to Tools (users should use the Media Library mostly).
* Change: no bubble counter on the dashboard menu; to avoid plugin to consume any resources.

= 1.0.4 =
* Fix: '<?' to '<?php'.
* Add: French translation.
* Change: Donation button (can be removed, check the FAQ).

= 1.0.2 =
* Fix: Ignore 'Header Image' to avoid related issues.
* Change: Updated screenshots.
* Change: 'To be renamed' filter removed (useless feature).

= 1.0.0 =
* Perfectly stable version :)
* Change: Rename Dashboard enhanced.
* Change: Scanning function now displays the results nicely.
* Change: Handle the media with 'physical' issues.

= 0.9.4 =
* Fix: Works better on Windows (file case).
* Fix: doesn't add numbering when the file exists already - was way too dangerous.
* Change: warns you if the Media title exists.

= 0.9.2 =
* Fix: Removed a 'warning'.

= 0.9 =
* Fix: Media were not flagged "as to be renamed" when the title was changed during editing a post.
* Change: Internal optimization.
* Add: Settings page.
* Add: Option to rename the slug or not (default: yes).

= 0.8 =
* Fix: Works with WP 3.5.
* Change: Update the links in DB directly.

= 0.6 =
* Fix: number of flagged media not updated straight after the mass rename.

= 0.54 =
* Fix: the "file name" in the media info was empty.

= 0.52 =
* Fix: SQL optimization & memory usage huge improvement.

= 0.5 =
* Add: New view "To be renamed" in the Media Library.
* Add: a nice counter to show the number of files that need to be renamed.
* Fix: the previous update (0.4) was actually not containing all the changes.

= 0.4 =
* Support for WPML
* Support for Retina plugins such as WP Retina 2x
* Adds a '-' between the filename and counter in case of similar files
* Mark the media as to be renamed when its name is changed outside the Media Library (avoid all the issues we had before)

= 0.34 =
* The GUID is now updated using the URL of the images and not the post ID + title (http://wordpress.org/support/topic/plugin-media-file-renamer-incorrect-guid-fix-serious-bug?replies=2#post-2239192).

= 0.32 =
* Double-check before physically renaming the files.

= 0.3 =
* Corrections + improvements.
* Handles well the 'special cases' now.

= 0.2 =
* Tiny corrections.

= 0.1 =
* First release.

== Wishlist ==

Do you have suggestions? Feel free to contact me at <a href='http://www.totorotimes.com'>Totoro Times</a>.
