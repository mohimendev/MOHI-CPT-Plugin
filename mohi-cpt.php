<?php

/**
 * Plugin Name: MOHI CPT
 * Plugin URI:  
 * Description: Registers Portfolio and Testimonial Custom Post Types with default fallback templates and Shortcodes.
 * Version:     1.0.2
 * Author:      Mohimen
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mohi-cpt
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

define( 'MOHI_CPT_PATH', plugin_dir_path( __FILE__ ) );
define( 'MOHI_CPT_VERSION', '1.0.0' ); // 

// Core Files - Using require_once for safer loading
require_once MOHI_CPT_PATH . 'inc/enqueue.php'; 
require_once MOHI_CPT_PATH . 'inc/cpt.php';
require_once MOHI_CPT_PATH . 'inc/template-loader.php';
require_once MOHI_CPT_PATH . 'inc/metabox.php';

// Admin Menus & Pages
require_once MOHI_CPT_PATH . 'inc/admin/admin-menu.php';
require_once MOHI_CPT_PATH . 'inc/admin/admin-page.php';
require_once MOHI_CPT_PATH . 'inc/admin/mohi-cpt-admin-setting-page.php';
require_once MOHI_CPT_PATH . 'inc/admin/portfolio-admin-setting-page.php';
require_once MOHI_CPT_PATH . 'inc/admin/testimonial-admin-setting-page.php';

// Shortcodes
require_once MOHI_CPT_PATH . 'inc/shortcodes/testimonials-shortcode.php';
require_once MOHI_CPT_PATH . 'inc/shortcodes/portfolio-shortcode.php';