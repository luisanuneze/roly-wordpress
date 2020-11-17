=== Apollo13 Framework Extensions ===
Contributors: apollo13themes, air-1
Tags: custom post types, shortcodes, elementor widgets, wpbakery page builder support
Requires at least: 4.7
Tested up to: 5.5
Requires PHP: 5.4.0
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds custom post types, shortcodes and some features that are used in themes built on Apollo13 Framework.

== Description ==

**Apollo13 Framework Extensions** adds few features to themes build on Apollo13 Framework. These are:

* Designs Importer,
* shortcodes based on Apollo13 Framework features: writtng effect, count down, socials, scroller, slider, galleries, post grid,
* support for WPBakery Page Builder elements added by Apollo13 Framework,
* custom post types: albums, works & people,
* Export/Import of theme options,
* Custom Sidebar,
* Custom CSS,
* Meta options that are creating content for posts, pages, albums and works,
* Responsive Image resizing ,
* Maintenance mode.

This plugin requires one of themes build on **Apollo13 Framework** theme to be installed.

It is mostly used for:

* [Rife Free](https://apollo13themes.com/rife/free/)
* [Rife Pro](https://apollo13themes.com/rife/)


== Installation ==

1. Upload **Apollo13 Framework Extensions** to the `/wp-content/plugins/` directory
2. Activate the plugin through the **Plugins** menu in WordPress
3. Done!

== Frequently Asked Questions ==

= I installed the plugin but it does not work =

This plugin will only work with themes build on **Apollo13 Framework**.
All themes compatible are listed above in description.



== Changelog ==

= 1.8.6(07.09.2020) =

Tested with WordPress 5.5

Improved:
-JavaScript code changes to make plugin work with upcoming WodrPress versions.

----------------

= 1.8.5(22.07.2020) =

Tested with WordPress 5.4

Fixed:
-Hotfix for issues while importing Designs with Elementor in version 2.9.14 and above

----------------

= 1.8.4(01.04.2020) =

Added:
-Support for better extending admin menu options that is available since WordPress 5.4.
 Now you will be able to use plugins extending menus without conflicts.

----------------

= 1.8.3(24.02.2020) =

Added:
-List of selected files in photo proofing process available in 2 formats

----------------

= 1.8.2(13.11.2019) =

Fixed:
-Error in console when trying to use Scroller widget for Elementor with Rife Free
-Notices in WordPress 5.3 caused by A13FRAMEWORK_Plugin_Installer_Skin

Tested with WordPress 5.3

----------------

= 1.8.1(20.09.2019) =

Fixed:
-Support for Revolution Slider in version 6.0 and above
-typo in script for slider that resulted in error(thanks AndreLIma)

----------------

= 1.8.0(08.08.2019) =

Improved:
-Rewritten theme slider to use anime.js - library that is GPL compatible. This change saves almost 100KB on page load

Fixed:
-Gallery Elementor widget respecting album setting for displaying title/description on items
-Gallery shortcode respecting album setting for displaying title/description on items

----------------

= 1.7.1(05.06.2019) =

Fixed:
-Post list widget for Elementor was listing excluded works and albums
-Shortcode for post list was listing excluded works and albums
-Album slider alternative link not working

----------------

= 1.7.0(15.05.2019) =

Added:
-(for Rife Pro 2.4.0 or higher)Option to change default filter in Post list widget for Elementor
-(for Rife Pro 2.4.0 or higher)Option to disable "All" filter when different default category is chosen in Post list widget for Elementor

Improved:
-Popular posts widget working when using "Post Types Order" plugin
-Resizing images script not resizing images to be bigger then original images

Fixed:
-Text domain on few translations
-Fatal Error when theme widget for Elementor is used with different theme

New translations:
-Czech
-Japanese
-Swedish
-Finnish
-Chinese



== Credits & Copyright ==

= Anime.js, Copyright 2019 Julian Garnier =
Licenses: MIT
Source: https://animejs.com/