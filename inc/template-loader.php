<?php 

if(! defined('ABSPATH')){
    exit;
}


/**
 * Template Fallback Logic for MOHI-CPT
 */
function mohi_cpt_template_loader( $template ) {

    // Define the plugin root directory path safely
    $plugin_root = plugin_dir_path( dirname( __FILE__ ) ); 

    // Template load for Portfolio Archive
    if ( is_post_type_archive( 'mohicpt_portfolio' ) ) {
        $theme_file = get_stylesheet_directory() . '/archive.php';
        if ( ! file_exists( $theme_file ) ) {
            return wp_normalize_path( $plugin_root . 'template/archive.php' );
        }
    }
    
    // Template load for Portfolio Single
    if ( is_singular( 'mohicpt_portfolio' ) ) {
        $theme_file = get_stylesheet_directory() . '/single.php';
        if ( ! file_exists( $theme_file ) ) {
            return wp_normalize_path( $plugin_root . 'template/single.php' );
        }
    }

    // Template load for Testimonial Archive
    if ( is_post_type_archive( 'mohicpt_testimonial' ) ) {
        $theme_file = get_stylesheet_directory() . '/archive.php';
        if ( ! file_exists( $theme_file ) ) {
            return wp_normalize_path( $plugin_root . 'template/archive.php' );
        }
    }
    
    // Template load for Testimonial Single
    if ( is_singular( 'mohicpt_testimonial' ) ) {
        $theme_file = get_stylesheet_directory() . '/single.php';
        if ( ! file_exists( $theme_file ) ) {
            return wp_normalize_path( $plugin_root . 'template/single.php' );
        }
    }

    return $template;
}
add_filter( 'template_include', 'mohi_cpt_template_loader' );