<?php
/*
Plugin Name: Minimal Coming Soon & Maintenance Mode
Plugin URI: http://www.69signals.com/minimal-coming-soon-maintenance-mode-plugin.php
Description: Simply awesome coming soon & maintenance mode plugin for your WordPress blog. Try it to know why there is no other plugin like this one.
Version: 0.1
Author: akshitsethi
Author URI: http://www.69signals.com
Domain Path: /languages/
License: GPLv3

Minimal Coming Soon & Maintenance Mode Plugin
Copyright (C) 2014, akshitsethi - support@69signals.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Setting up the plugin base over here.
 * Required .JS and .CSS files are included.
 * Including the required files if the user is admin.
 * Defining constants and activation hook.
 */
define ('SIGNALS_CSMM_URL', plugins_url ('', __FILE__));
define ('SIGNALS_CSMM_PATH', plugin_dir_path (__FILE__));

// Options for the plugin.
$signals_csmm_options = get_option ('signals_csmm_options');

// Include the settings page if the admin panel is active.
if (is_admin()) {
	include (SIGNALS_CSMM_PATH . 'library/settings.php');
}

function csSignalsAdminTemplate() {

	// Registering .JS and .CSS files over here.
	wp_register_style ('csmm-admin-base', SIGNALS_CSMM_URL . '/content/css/admin.css', FALSE, '0.1');

	wp_register_script ('csmm-admin-base', SIGNALS_CSMM_URL . '/content/js/admin.js', 'jquery', '0.1');
	wp_register_script ('csmm-jscolor', SIGNALS_CSMM_URL . '/content/js/colorpicker/jscolor.js', 'jquery', '0.1');

	// Calling the files in the step.
	wp_enqueue_style ('csmm-admin-base');

	wp_enqueue_script ('csmm-admin-base');
	wp_enqueue_script ('csmm-jscolor');

	// For the upload option using media uploader.
	wp_enqueue_media();

}


// Loading the admin panel scripts and styles only on the settings page.
function csSignalsLoadAdmin() {

	add_action ('admin_enqueue_scripts', 'csSignalsAdminTemplate');

}

/**
 * On plugin activation.
 * Setting default options for the plugin. A seperate table is created for storing analytics, likes, subscriptions.
 */
function csSignalsPluginActivation() {

	// Setting default options for the plugin. The user still has to feed in the right ID for their facebook application.
	$default_opts = array (
		'status' 				=> 2,
		'template' 				=> 'naked',
		'title' 				=> 'Maintenance Mode',
		'header_text' 			=> 'Maintenance Mode',
		'secondary_text' 		=> 'We are performing scheduled maintenance task on our servers because of which the website will be unavailable. In the meantime, you can subscribe to our mailing list and get notified about our important events.',
		'exclude_se' 			=> 2,
		'mailchimp_api' 		=> '',
		'mailchimp_list' 		=> '',
		'ignore_template'		=> 2,
		'bg_cover' 				=> '',
		'bg_color' 				=> '',
		'header_font' 			=> 'Arial',
		'header_font_size' 		=> '32',
		'header_font_color' 	=> '000000',
		'secondary_font' 		=> 'Arial',
		'secondary_font_size' 	=> '14',
		'secondary_font_color' 	=> '333333',
		'disable_settings' 		=> 2,
		'custom_html' 			=> '',
		'custom_css' 			=> ''
	);

	update_option ('signals_csmm_options', $default_opts);

}

register_activation_hook (__FILE__, 'csSignalsPluginActivation');


// For creating a seperate menu for the plugin and adding items to it.
function csSignalsAddMenu() {

	if (is_admin() && current_user_can ('manage_options')) {
		// Adding to the plugin panel link to the settings menu.
		$signals_csmm_menu = add_options_page (
			__('Coming Soon & Maintenance Mode', 'signals'),
			__('Maintenance Mode', 'signals'),
			'manage_options',
			'maintenance_mode_options',
			'csSignalsAdminSettings'
		);

		// Loading the JS conditionally.
		add_action ('load-' . $signals_csmm_menu, 'csSignalsLoadAdmin');
	}

}

add_action ('admin_menu', 'csSignalsAddMenu');


// Cleaning the input from unwanted strings.
if (!function_exists ('csSignalsCleanInput')) {
	function csSignalsCleanInput ($input) {

		$search = array (
			'@<script[^>]*?>.*?</script>@si',   // strip out javascript
			'@<[\/\!]*?[^<>]*?>@si',            // strip out HTML tags
			'@<style[^>]*?>.*?</style>@siU',    // strip style tags properly
			'@<![\s\S]*?--[ \t\n\r]*>@'         // strip multi-line comments
		);

		$output = preg_replace ($search, '', $input);
		return stripslashes ($output);

	}
}


function csSignalsPluginInit() {

	global $signals_csmm_options;

	// Localization.
	load_plugin_textdomain ('signals', FALSE, SIGNALS_CSMM_PATH . 'languages');

	// Not for the backend. Only modifies the frontend of the system.
	if (!is_admin()) {
		if (1 == $signals_csmm_options['status']) {
			/**
			 * Fix for the cache plugins.
			 * Clearing the plugin caches.
			 * W3 Total Cache and WP Super Cache
			 */
			if (function_exists ('wp_cache_clear_cache')) {
				ob_end_clean();
				wp_cache_clear_cache();
			}

			if (function_exists ('w3tc_pgcache_flush')) {
				ob_end_clean();
				w3tc_pgcache_flush();
			}

			/**
			 * A lot of checks are going on over here.
			 * We are checking for admin role, crawler status, and important wordpress pages to bypass.
			 * If the admin decides to exclude search engine from viewing the plugin, the website will be shown.
			 */
			if (FALSE === strpos ($_SERVER['PHP_SELF'], 'wp-login.php')
				&& FALSE === strpos ($_SERVER['PHP_SELF'], 'wp-admin/')
				&& FALSE === strpos ($_SERVER['PHP_SELF'], 'async-upload.php')
				&& FALSE === strpos ($_SERVER['PHP_SELF'], 'upgrade.php')
				&& FALSE === strpos ($_SERVER['PHP_SELF'], '/plugins/')
				&& FALSE === strpos ($_SERVER['PHP_SELF'], '/xmlrpc.php')) {

				// Checking for the search engine option.
				if (1 == $signals_csmm_options['exclude_se']) {
					if (!csSignalsCheckReferrer()) {
						/**
						 * Using the nocache_headers() to ensure that different nocache headers are sent to different browsers.
						 * We don't want any browser to cache the maintainance page.
						 * Also, output buffering is turned on.
						 */
						nocache_headers();
						ob_start();

						// The template file for the plugin.
						include (SIGNALS_CSMM_PATH . 'library/templates/' . $signals_csmm_options['template'] . '/html.php');

						ob_flush();
						exit();
					}
				} else {
					/**
					 * Using the nocache_headers() to ensure that different nocache headers are sent to different browsers.
					 * We don't want any browser to cache the maintainance page.
					 * Also, output buffering is turned on.
					 */
					nocache_headers();
					ob_start();

					// The template file for the plugin.
					include (SIGNALS_CSMM_PATH . 'library/templates/' . $signals_csmm_options['template'] . '/html.php');

					ob_flush();
					exit();
				}
			}
		}
	}

}

add_action ('init', 'csSignalsPluginInit');


// To check the referrer.
function csSignalsCheckReferrer() {

	// List of crawlers to check for.
	$crawlers = array(
		'Abacho'          => 'AbachoBOT',
		'Accoona'         => 'Acoon',
		'AcoiRobot'       => 'AcoiRobot',
		'Adidxbot'        => 'adidxbot',
		'AltaVista robot' => 'Altavista',
		'Altavista robot' => 'Scooter',
		'ASPSeek'         => 'ASPSeek',
		'Atomz'           => 'Atomz',
		'Bing'            => 'bingbot',
		'BingPreview'     => 'BingPreview',
		'CrocCrawler'     => 'CrocCrawler',
		'Dumbot'          => 'Dumbot',
		'eStyle Bot'      => 'eStyle',
		'FAST-WebCrawler' => 'FAST-WebCrawler',
		'GeonaBot'        => 'GeonaBot',
		'Gigabot'         => 'Gigabot',
		'Google'          => 'Googlebot',
		'ID-Search Bot'   => 'IDBot',
		'Lycos spider'    => 'Lycos',
		'MSN'             => 'msnbot',
		'MSRBOT'          => 'MSRBOT',
		'Rambler'         => 'Rambler',
		'Scrubby robot'   => 'Scrubby',
		'Yahoo'           => 'Yahoo'
	);

	// Checking for the crawler over here.
	if (csSignalsStrArray ($_SERVER['HTTP_USER_AGENT'], $crawlers)) {
		return TRUE;
	}

	return FALSE;

}


// Function to match the user agent with the crawlers array.
function csSignalsStrArray ($str, $array) {

	$regexp = '~(' . implode ('|', array_values ($array)) . ')~i';
	return (bool) preg_match ($regexp, $str);

}