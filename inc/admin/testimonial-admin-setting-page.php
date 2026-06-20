<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Testimonial Settings, Sections, and Fields
 */
function mohi_testimonial_setting_page() {
    register_setting(
        'mohi_testimonial',
        'mohicpt_testimonial_settings',
        'mohi_testimonial_sanitize_setting'
    );

    add_settings_section(
        'mohi_testimonial_section_setting',
        '',
        'mohi_testimonial_callback',
        'mohi_testimonial'
    );

    add_settings_field(
        'mohi_testimonial_shortcode',
        esc_html__( 'Testimonial Shortcode', 'mohi-cpt' ),
        'mohi_testimonial_shortcode_callback',
        'mohi_testimonial',
        'mohi_testimonial_section_setting'
    );
}
add_action( 'admin_init', 'mohi_testimonial_setting_page' );


/**
 * Settings Section Description Callback
 */
function mohi_testimonial_callback() {
    echo '<p>' . esc_html__( 'Your testimonial controls given below', 'mohi-cpt' ) . '</p>';
}


/**
 * Sanitize Testimonial Settings Input Array
 */
function mohi_testimonial_sanitize_setting( $input ) {
    return is_array( $input ) ? array_map( 'sanitize_text_field', $input ) : sanitize_text_field( $input );
}


/**
 * Render Testimonial Shortcode Field
 */
function mohi_testimonial_shortcode_callback() {
    $shortcode_text = '[mohicpt_testimonial]';
    ?>
    <div style="display: flex; align-items: center; gap: 12px; margin-top: 5px;">
        <code id="mohi-testimonial-sc" style="background: #f0f0f1; padding: 10px 14px; font-family: monospace; font-weight: 600; font-size: 14px; color: #1f0505; border: 1px solid #1f0505; letter-spacing: 0.5px;"><?php echo esc_html( $shortcode_text ); ?></code>

        <button type="button" id="mohi-testimonial-copy-btn" class="button button-secondary" style="height: 35px; font-weight: 500;">
            <?php esc_html_e( 'Copy', 'mohi-cpt' ); ?>
        </button>
    </div>

    <p class="description" style="margin-top: 8px;">
        <?php esc_html_e( 'You can easily display your testimonials in any pages, sections and builders', 'mohi-cpt' ); ?>
    </p>
    <?php
}


/**
 * Render Saving Confirmation Admin Notice
 */
function mohi_testimonial_admin_notice() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

    if ( $page !== 'testimonial_options' ) {
        return;
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $updated = isset( $_GET['settings-updated'] ) ? sanitize_text_field( wp_unslash( $_GET['settings-updated'] ) ) : '';

    if ( ! empty( $updated ) ) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p>
                <strong><?php echo esc_html__( 'Success!', 'mohi-cpt' ); ?></strong>
                <?php echo esc_html__( 'Testimonial options saved successfully.', 'mohi-cpt' ); ?>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'mohi_testimonial_admin_notice' );