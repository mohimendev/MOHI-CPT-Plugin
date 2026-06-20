<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue Frontend Assets Safely for MOHI-CPT
 */
function mohi_cpt_enqueue_assets() {
    $post = get_post();
    $has_shortcode = $post && (
        has_shortcode( $post->post_content, 'mohicpt_portfolio' ) ||
        has_shortcode( $post->post_content, 'mohicpt_testimonial' )
    );

    if (
        is_post_type_archive( array( 'mohicpt_portfolio', 'mohicpt_testimonial' ) ) ||
        is_singular( array( 'mohicpt_portfolio', 'mohicpt_testimonial' ) ) ||
        $has_shortcode
    ) {
        $asset_url = plugin_dir_url( dirname( __FILE__ ) );

        wp_enqueue_style( 'mohi-bootstrap', $asset_url . 'assets/css/bootstrap.min.css', array(), '5.3.8' );
        wp_enqueue_style( 'mohi-bootstrap-icons', $asset_url . 'assets/css/bootstrap-icons.css', array(), '1.11.3' );
        wp_enqueue_style( 'mohi-style', $asset_url . 'assets/css/style.css', array( 'mohi-bootstrap', 'mohi-bootstrap-icons' ), MOHI_CPT_VERSION );

        wp_enqueue_script( 'mohi-bootstrap', $asset_url . 'assets/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.8', true );
    }
}
add_action( 'wp_enqueue_scripts', 'mohi_cpt_enqueue_assets' );

/**
 * Enqueue Admin Assets with Strict Page Scope
 */
function mohi_cpt_enqueue_admin_assets( $hook ) {

    $allowed_hooks = array(
    'toplevel_page_mohicpt',
    'mohi-cpt_page_portfolio_options',
    'mohi-cpt_page_testimonial_options',
    );

    if ( ! in_array( $hook, $allowed_hooks, true ) ) {
        return;
    }

    $asset_url = plugin_dir_url( dirname( __FILE__ ) );

    wp_enqueue_style('mohi-cpt-admin-style',$asset_url . 'assets/css/admin-style.css', array(),MOHI_CPT_VERSION);

    wp_enqueue_script('mohi-cpt-admin',$asset_url . 'assets/js/admin.js', array(),MOHI_CPT_VERSION,true);

    wp_localize_script( 'mohi-cpt-admin', 'mohiCptAdmin', array('copied' => __( 'Copied!', 'mohi-cpt' ),) );
}
add_action( 'admin_enqueue_scripts', 'mohi_cpt_enqueue_admin_assets' );