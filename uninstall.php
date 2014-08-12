<?php
/**
 * For uninstalling the plugin completely from the system.
 * @package WordPress
 * @subpackage CSMM
 * @since 0.1
 *
 * Checking whether the file is called by the Wordpress uninstall action or not.
 * If not, then exit and prevent unauthorized access.
 */
if (!defined ('WP_UNINSTALL_PLUGIN')) {
	exit();
} 

// Removing the options set by plugin from the database.
delete_option ('signals_csmm_options');