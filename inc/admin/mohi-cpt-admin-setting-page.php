<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register General Plugin Settings, Sections, and Fields
 */
function mohi_settings_page() {

    register_setting(
        'mohicpt',
        'mohi_general_settings',
        'mohi_sanitize_settings'
    );

    add_settings_section(
        'mohi_general_section_setting',
        esc_html__( 'General Settings', 'mohi-cpt' ),
        'mohi_CPT_callback',
        'mohicpt'
    );

    add_settings_field(
        'mohi_enable_portfolio',
        esc_html__( 'Enable Portfolio', 'mohi-cpt' ),
        'mohi_portfolio_field_callback',
        'mohicpt',
        'mohi_general_section_setting'
    );

    add_settings_field(
        'mohi_enable_testimonials',
        esc_html__( 'Enable Testimonials', 'mohi-cpt' ),
        'mohi_testimonial_field_callback',
        'mohicpt',
        'mohi_general_section_setting'
    );

    add_settings_field(
        'mohi_permalink_flush',
        esc_html__( 'Reset URL', 'mohi-cpt' ),
        'mohi_flush_field_callback',
        'mohicpt',
        'mohi_general_section_setting'
    );
}
add_action( 'admin_init', 'mohi_settings_page' );


/**
 * Settings Section Callback
 */
function mohi_CPT_callback() {
    echo '<p>' . esc_html__( 'User can easily control MOHI CPT settings from here.', 'mohi-cpt' ) . '</p>';
}


/**
 * Sanitize General Settings Input Array
 */
function mohi_sanitize_settings( $input ) {
    $output = array();
    $output['enable_portfolio']    = ( isset( $input['enable_portfolio'] ) && '1' === $input['enable_portfolio'] ) ? 1 : 0;
    $output['enable_testimonials'] = ( isset( $input['enable_testimonials'] ) && '1' === $input['enable_testimonials'] ) ? 1 : 0;
    return $output;
}


/**
 * Render Toggle Switches
 */
function mohi_portfolio_field_callback() {
    $options = get_option( 'mohi_general_settings' );
    $value   = isset( $options['enable_portfolio'] ) ? $options['enable_portfolio'] : 1;
    ?>
    <label class="mohi-switch">
        <input type="hidden" name="mohi_general_settings[enable_portfolio]" value="0">
        <input type="checkbox" name="mohi_general_settings[enable_portfolio]" value="1" <?php checked( 1, $value ); ?>>
        <span class="mohi-slider round"></span>
    </label>
    <?php
}

function mohi_testimonial_field_callback() {
    $options = get_option( 'mohi_general_settings' );
    $value   = isset( $options['enable_testimonials'] ) ? $options['enable_testimonials'] : 1;
    ?>
    <label class="mohi-switch">
        <input type="hidden" name="mohi_general_settings[enable_testimonials]" value="0">
        <input type="checkbox" name="mohi_general_settings[enable_testimonials]" value="1" <?php checked( 1, $value ); ?>>
        <span class="mohi-slider round"></span>
    </label>
    <?php
}


/**
 * Render Manual Permalink Flush Form
 */
function mohi_flush_field_callback() {
    wp_nonce_field( 'mohi_flush_urls_action', 'mohi_flush_nonce' );
    ?>
    <input type="submit" name="mohi_flush_permalinks" class="button button-secondary" value="<?php esc_attr_e( 'Flush Permalinks', 'mohi-cpt' ); ?>">
    <p class="description"><?php esc_html_e( 'If your Portfolio or Testimonial pages show a 404 error, click this button to reset rules.', 'mohi-cpt' ); ?></p>
    <?php
}


/**
 * Process Rewrite Rules Flush Securely
 */
function mohi_handle_permalink_flush() {
    if ( ! isset( $_POST['mohi_flush_permalinks'] ) ) {
        return;
    }

    $nonce = isset( $_POST['mohi_flush_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['mohi_flush_nonce'] ) ) : '';

    if ( ! wp_verify_nonce( $nonce, 'mohi_flush_urls_action' ) || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    flush_rewrite_rules();

    wp_safe_redirect( admin_url( 'admin.php?page=mohicpt&mohi_status=flushed' ) );
    exit;
}
add_action( 'admin_init', 'mohi_handle_permalink_flush' );


/**
 * Admin Notice
 */
function mohi_flush_success_notice() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

    if ( $page !== 'mohicpt' ) {
        return;
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $settings_updated = isset( $_GET['settings-updated'] ) ? sanitize_text_field( wp_unslash( $_GET['settings-updated'] ) ) : '';
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $mohi_status = isset( $_GET['mohi_status'] ) ? sanitize_text_field( wp_unslash( $_GET['mohi_status'] ) ) : '';

    if ( ! empty( $settings_updated ) || $mohi_status === 'flushed' ) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><strong><?php echo esc_html__( 'Success!', 'mohi-cpt' ); ?></strong> <?php echo esc_html__( 'Action completed successfully.', 'mohi-cpt' ); ?></p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'mohi_flush_success_notice' );