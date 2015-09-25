=== WP-Juicebox ===
Contributors: juicebox
Tags: Juicebox, photos, photo, images, image, posts, post, pages, page, plugin, gallery, galleries, media
Requires at least: 2.8
Tested up to: 3.5.1
Stable tag: 1.2.0.1

Allows you to easily create Juicebox galleries with WordPress.

== Description ==

The WP-Juicebox plugin allows you to easily create [Juicebox](http://www.juicebox.net/) galleries with WordPress. Juicebox is a free, customizable image gallery. Images and captions can be loaded from the WordPress Media Library or from Flickr.

Get full instructions and support at the [WP-Juicebox Homepage](http://www.juicebox.net/support/wp-juicebox/).

== Installation ==

= Installation =

1. Download the WP-Juicebox plugin. Unzip the plugin folder on your local machine.
2. Upload the complete plugin folder into your WordPress blog's `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress
4. If the the `/wp-content/uploads/juicebox/` folder does not exist, create it and give it write permissions (777) using an FTP program.

= Requirements =

Before installing, please confirm your web server meets the following requirements. If you are not sure, contact your web host tech support.

* WordPress Version 2.8 or higher.
* PHP version 5.2.0 or higher.
* The `/wp-content/uploads/juicebox/` folder must exist and have full access permissions (777).
* PHP DOM extension is enabled (this is the default, however some web hosts may disable this extension).
* Active theme must call the [wp_head](http://codex.wordpress.org/Plugin_API/Action_Reference/wp_head) function in it's header.php file.

== Changelog ==

= 1.2.0.1 =
* Added support for 'Include Featured Image' in 'Media Library' galleries
* Fixed bug preventing Dashboard menu links from being displayed in certain installations
* Pro Options are now case-insensitive
* Removed <meta> 'viewport' tag from <head> section
* 'Delete All Galleries' button changed to 'Delete All Data' as button now cleanly removes all plugin-related data rather than just resetting options

= 1.2.0 =
* Upgraded Juicebox-Lite to v1.2.0
* Added support for 'Picasa Web Album' as source of images
* Added support for WordPress installations on https:// secure servers
* XML file now created dynamically so no need to edit gallery or post to rebuild static XML file
* Made distinction between pages and posts throughout plugin
* Gallery Id displayed in 'Add Juicebox Gallery' pop-up window
* Fixed bug allowing multiple gallery shortcodes to be entered into each post
* Fixed bug whereby duplicate calls were made to certain methods
* Fixed bug whereby corrupt NextGEN Gallery installation caused NextGEN-sourced gallery to fail
* Fixed 'PHP Deprecated' message
* Fixed 'PHP Notice' in WordPress Debug Mode
* Fixed W3C Markup Validation issue on admin page
* Fixed compatibility issue with WordPress v3.5 Beta 2

= 1.1.1 =
* Upgraded Juicebox-Lite to v1.1.1
* Added support for 'NextGEN Gallery' as source of images
* Added ability to delete all galleries and reset Gallery Id to zero
* Added ability to set/reset default values for gallery options
* Improved and restructured code
* Bugfixes

= 1.1.0 =
* Upgraded Juicebox-Lite to v1.1.0
* Improved escaping of XML entities
* Fixed bug whereby phantom XML file could be generated
* Fixed bug relating to single quote in gallery title
* Fixed bug causing error message when XML file does not exist
* Fixed bug causing error message with incorrectly formatted Pro Options
* Fixed compatibility issues with other plugins
* Scripts now called inside appropriate hooks
* Removed redundant code

= 1.0.2 =
* Upgraded Juicebox-Lite to v1.0.2

= 1.0.1 =
* Initial release

== Upgrade to Juicebox-Pro ==

[Juicebox-Pro](http://www.juicebox.net/download/) supports advanced customization options, no branding, unlimited images and more. To upgrade the WP-Juicebox plugin to Juicebox-Pro, [check here](http://www.juicebox.net/support/wp-juicebox/#pro).

== Credits ==

WP-Juicebox developed by [Juicebox](http://www.juicebox.net/).

== Terms Of Use ==

WP-Juicebox may be used for personal and/or commercial projects. [View Terms of Use](http://www.juicebox.net/terms/)
