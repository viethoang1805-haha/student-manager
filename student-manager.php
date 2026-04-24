<?php
/**
 * Plugin Name: Student Manager
 * Description: Quản lý sinh viên
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

// include file
require_once plugin_dir_path(__FILE__) . 'includes/cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/metabox.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';

// load css
function sm_enqueue_assets() {
    wp_enqueue_style('sm-style', plugin_dir_url(__FILE__) . 'assets/style.css');
}
add_action('wp_enqueue_scripts', 'sm_enqueue_assets');