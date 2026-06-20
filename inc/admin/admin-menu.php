<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Admin Menu and Submenu Pages Safely
 */
function mohi_cpt_menu() {

    // Register Top Level Menu
    add_menu_page(
        __( 'MOHI CPT', 'mohi-cpt' ),
        __( 'MOHI CPT', 'mohi-cpt' ),
        'manage_options',
        'mohicpt',
        'mohi_cpt_page',
        'dashicons-admin-settings',
        25
    );

    // Register Portfolio Settings Submenu Page
    add_submenu_page(
        'mohicpt',
        __( 'Portfolio Options', 'mohi-cpt' ),
        __( 'Portfolios', 'mohi-cpt' ),
        'manage_options',
        'portfolio_options',
        'mohi_portfolio_page_options'
    );

    // Register Testimonial Settings Submenu Page
    add_submenu_page(
        'mohicpt',
        __( 'Testimonial Options', 'mohi-cpt' ),
        __( 'Testimonials', 'mohi-cpt' ),
        'manage_options',
        'testimonial_options',
        'mohi_testimonial_page_options'
    );
}
add_action( 'admin_menu', 'mohi_cpt_menu' );