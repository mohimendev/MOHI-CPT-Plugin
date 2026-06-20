<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Register Custom Post Types
 */
function mohi_register_custom_post_types() {

    $options = get_option( 'mohi_general_settings' );

    $enable_portfolio    = isset( $options['enable_portfolio'] ) ? $options['enable_portfolio'] : 1;
    $enable_testimonials = isset( $options['enable_testimonials'] ) ? $options['enable_testimonials'] : 1;

    // Portfolio CPT
    $portfolio_args = array(
        'labels' => array(
            'name'          => esc_html__( 'Portfolios', 'mohi-cpt' ),
            'singular_name' => esc_html__( 'Portfolio', 'mohi-cpt' ),
            'all_items'     => esc_html__( 'All Portfolios', 'mohi-cpt' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'custom-fields', 'comments' ),
        'show_in_rest' => true,
    );

    if ( $enable_portfolio == 1 ) {
        register_post_type( 'mohicpt_portfolio', $portfolio_args );
    }

    // Testimonials CPT
    $testimonial_args = array(
        'labels' => array(
            'name'          => esc_html__( 'Testimonials', 'mohi-cpt' ),
            'singular_name' => esc_html__( 'Testimonial', 'mohi-cpt' ),
            'all_items'     => esc_html__( 'All Testimonials', 'mohi-cpt' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-editor-quote',
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'custom-fields', 'comments' ),
        'show_in_rest' => true,
    );

    if ( $enable_testimonials == 1 ) {
        register_post_type( 'mohicpt_testimonial', $testimonial_args );
    }
}
add_action( 'init', 'mohi_register_custom_post_types' );


/**
 * 2. Register Taxonomies
 */
function mohi_register_taxonomy() {

    $options = get_option( 'mohi_general_settings' );
    $enable_portfolio    = isset( $options['enable_portfolio'] ) ? $options['enable_portfolio'] : 1;
    $enable_testimonials = isset( $options['enable_testimonials'] ) ? $options['enable_testimonials'] : 1;

    $object_types = array();
    if ( $enable_portfolio == 1 ) {
        $object_types[] = 'mohicpt_portfolio';
    }
    if ( $enable_testimonials == 1 ) {
        $object_types[] = 'mohicpt_testimonial';
    }

    if ( empty( $object_types ) ) {
        return;
    }

    // Category Taxonomy
    $labels = array(
        'name'              => esc_html__( 'Categories', 'mohi-cpt' ),
        'singular_name'     => esc_html__( 'Category', 'mohi-cpt' ),
        'search_items'      => esc_html__( 'Search Categories', 'mohi-cpt' ),
        'all_items'         => esc_html__( 'All Categories', 'mohi-cpt' ),
        'parent_item'       => esc_html__( 'Parent Category', 'mohi-cpt' ),
        'parent_item_colon' => esc_html__( 'Parent Category:', 'mohi-cpt' ),
        'edit_item'         => esc_html__( 'Edit Category', 'mohi-cpt' ),
        'update_item'       => esc_html__( 'Update Category', 'mohi-cpt' ),
        'add_new_item'      => esc_html__( 'Add New Category', 'mohi-cpt' ),
        'new_item_name'     => esc_html__( 'New Category Name', 'mohi-cpt' ),
        'menu_name'         => esc_html__( 'Categories', 'mohi-cpt' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'mohicpt-category' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'mohicpt_category', $object_types, $args );

    // Tags Taxonomy
    $tag_labels = array(
        'name'          => esc_html__( 'Tags', 'mohi-cpt' ),
        'singular_name' => esc_html__( 'Tag', 'mohi-cpt' ),
        'search_items'  => esc_html__( 'Search Tags', 'mohi-cpt' ),
        'all_items'     => esc_html__( 'All Tags', 'mohi-cpt' ),
        'edit_item'     => esc_html__( 'Edit Tag', 'mohi-cpt' ),
        'update_item'   => esc_html__( 'Update Tag', 'mohi-cpt' ),
        'add_new_item'  => esc_html__( 'Add New Tag', 'mohi-cpt' ),
        'new_item_name' => esc_html__( 'New Tag Name', 'mohi-cpt' ),
        'menu_name'     => esc_html__( 'Tags', 'mohi-cpt' ),
    );

    $tag_args = array(
        'hierarchical'      => false,
        'labels'            => $tag_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'mohicpt-tag' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'mohicpt_project_tag', $object_types, $tag_args );
}
add_action( 'init', 'mohi_register_taxonomy' );