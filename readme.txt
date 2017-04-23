=== Vimeo Downloads ===
Contributors: Bob Easton
Requires at least: 2.7
Tested up to: 4.1
License: GPL2
License URI: http://www.gnu.org/copyleft/gpl.html

Creates the bulk of a post containing a Vimeo video, complete with download links. The videos are \\\"private\\\" videos belong to a Vimeo PRO account.

== Description ==
The outline is pretty simple:

- specify the ID of the desired video
- ask Vimeo what download file links are available
- wrap them in some HTML that makes them pretty
- BAM! Present them to the viewer

Plugin users will need several \"tokens\" from their Vimeo Pro API Apps account..
Details at: http://www.bob-easton.com/wordpressmembershipsites/vimeo-downloads-plugin/

== Installation ==
Standard WordPress install.
Plugins > Add New > Upload the .zip file > Activate

THEN, find the Settings > Vimeo Downloads page and configure with API tokens.

== Screenshots ==
1. Settings page - http://www.bob-easton.com/wordpressmembershipsites/wp-content/uploads/2015/01/vd-settings.png
2. Typical usage - http://www.bob-easton.com/wordpressmembershipsites/wp-content/uploads/2015/01/vd-2.png
3. Typical result - http://www.bob-easton.com/wordpressmembershipsites/wp-content/uploads/2015/01/vd-3.png

== Changelog ==
0.4
Extended text in button labels.  HD ->  HD High Definition, etc.
0.3
Sorted results, ascending by file size.
0.2
Options page added. Account parameters are now held in the database, via a Settings page, instead of being hard coded in the plugin module.
0.1
Basic code. All parameters contained within.
Operates as a shortcode processor.