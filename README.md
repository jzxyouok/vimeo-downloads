# Vimeo Downloads
Contributors: Bob Easton

Requires at least: 2.7

Tested up to: 4.7

Plugin url: https://www.bob-easton.com/wordpress/vimeo-downloads/

License: GPL2

License URI: http://www.gnu.org/copyleft/gpl.html

The video service provider, Vimeo, offers both video playback and video download services to its PRO members. The links for individual video downloads are buried in "Settings" files for each video and are not at all convenient for blog authors to access. 

This plugin collects and displays download links for Vimeo videos.

**Note Well:** Vimeo provides download links for videos hosted on their "Pro" service. Download links are **NOT** available for videos posted on the Free Vimeo service.

# Description
A simple shortcode, embedded in a post, specifies a Vimeo video ID number.

For example: [vimeo_downloads video_id="nnnnnnnnn"]

The plugin:

1. Requests file download links for the video from Vimeo.
2. Organizes the links by size.
3. Wraps the links in HTML and presents them to the visitor as buttons.

A Settings page is provided to specify several token strings from Vimeo.

**Note Well:** Vimeo provides download links for videos hosted on their "Pro" service. Download links are **NOT** available for videos posted on the Free Vimeo service.

Plugin users will need several tokens from their Vimeo Pro API Apps account.

# Installation
Standard WordPress install.

Plugins > Add New > Upload the .zip file > Activate

**Be sure** to configure the settings.

## Settings
1. Start at the Vimeo Developer's page: https://developer.vimeo.com/
2. Add your "App" at: https://developer.vimeo.com/apps
3. Collect tokens at: https://developer.vimeo.com/apps/102154#authentication
4. THEN, find the Settings > Vimeo Downloads page and configure with API tokens.

# Screenshots
1. Settings page - https://www.bob-easton.com/wordpress/wp-content/uploads/2017/04/vimeo-downloads-settings.png
2. Typical usage - https://www.bob-easton.com/wordpress/wp-content/uploads/2017/04/vimeo-downloads-shortcode.png
3. Typical result - https://www.bob-easton.com/wordpress/wp-content/uploads/2017/04/vimeo-downloads-results.png

# Changelog
### 0.5
Minor refactoring and posted in Github.
### 0.4
Extended text in button labels.  HD ->  HD High Definition, etc.
### 0.3
Sorted results, ascending by file size.
### 0.2
Options page added. Account parameters are now held in the database, via a Settings page, instead of being hard coded in the plugin module.
### 0.1
Basic code. All parameters contained within.

Operates as a shortcode processor.

## Contributions

All feedback, bug reports, and pull requests are welcome.