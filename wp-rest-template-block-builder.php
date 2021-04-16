<?php
/**
 * Plugin Name: wp-rest-template-block-builder
 * Plugin URI: https://gitlab.rlp.net/jdillenberger/wp-rest-template-block-builder
 * Description: Use REST-API data for your WordPress posts/pages
 * Version:  1.0
 * Author:  Jan Dillenberger
 * License:  GPLv2
*/

defined('ABSPATH') or die();
define('RB_PLUGIN_INDEX', __FILE__);

# HOOKS
include plugin_dir_path(RB_PLUGIN_INDEX) . 'hooks/activation.php';
include plugin_dir_path(RB_PLUGIN_INDEX) . 'hooks/admin-all-blocks.php';
include plugin_dir_path(RB_PLUGIN_INDEX) . 'hooks/admin-menu.php';
include plugin_dir_path(RB_PLUGIN_INDEX) . 'hooks/admin-new-block.php';



