<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Portfolio Settings, Sections, and Fields
 */
function mohi_portfolio_setting_page() {

    register_setting(
        'mohi_portfolio',
        'mohicpt_portfolio_settings',
        'mohi_portfolio_sanitize_setting'
    );

    add_settings_section(
        'mohi_portfolio_section_setting',
        '',
        'mohi_portfolio_callback',
        'mohi_portfolio'
    );

    add_settings_field(
        'mohi_portfolio_shortcode',
        esc_html__( 'Portfolio Shortcode', 'mohi-cpt' ),
        'mohi_portfolio_shortcode_callback',
        'mohi_portfolio',
        'mohi_portfolio_section_setting'
    );

    add_settings_field(
        'mohi_portfolio_project_details',
        esc_html__( 'Project Details', 'mohi-cpt' ),
        'mohi_portfolio_project_details_callback',
        'mohi_portfolio',
        'mohi_portfolio_section_setting'
    );
}
add_action( 'admin_init', 'mohi_portfolio_setting_page' );


/**
 * Settings Section Description Callback
 */
function mohi_portfolio_callback() {
    echo '<p>' . esc_html__( 'Your Portfolio controls given below', 'mohi-cpt' ) . '</p>';
}


/**
 * Sanitize Portfolio Settings Input
 */
function mohi_portfolio_sanitize_setting( $input ) {
    $output = array();
    $output['enable_project_details'] = ( isset( $input['enable_project_details'] ) && '1' === $input['enable_project_details'] ) ? 1 : 0;
    return $output;
}


/**
 * Render Portfolio Shortcode Field
 */
function mohi_portfolio_shortcode_callback() {
    $shortcode_text = '[mohicpt_portfolio]';
    ?>
    <div style="display: flex; align-items: center; gap: 12px; margin-top: 5px;">
        <code id="mohi-portfolio-sc" style="background: #f0f0f1; padding: 10px 14px; font-family: monospace; font-weight: 600; font-size: 14px; color: #1f0505; border: 1px solid #1f0505; letter-spacing: 0.5px;"><?php echo esc_html( $shortcode_text ); ?></code>

        <button type="button" id="mohi-portfolio-copy-btn" class="button button-secondary" style="height: 35px; font-weight: 500;">
            <?php esc_html_e( 'Copy', 'mohi-cpt' ); ?>
        </button>
    </div>

    <p class="description" style="margin-top: 8px;">
        <?php esc_html_e( 'You can easily display your Portfolios in any pages, sections and builders', 'mohi-cpt' ); ?>
    </p>
    <?php
}


/**
 * Portfolio Project Details Toggle Callback
 */
function mohi_portfolio_project_details_callback() {
    $options = get_option( 'mohicpt_portfolio_settings' );
    $value   = isset( $options['enable_project_details'] ) ? $options['enable_project_details'] : 1;
    ?>
    <label class="mohi-switch">
        <input type="hidden" name="mohicpt_portfolio_settings[enable_project_details]" value="0">
        <input type="checkbox" name="mohicpt_portfolio_settings[enable_project_details]" value="1" <?php checked( 1, $value ); ?>>
        <span class="mohi-slider round"></span>
    </label>

    <p class="description" style="margin-top: 8px;">
        <?php esc_html_e( 'Easily show or hide the project details section on your single portfolio layout.', 'mohi-cpt' ); ?>
    </p>
    <?php
}


/**
 * Render Custom Saving Confirmation Admin Notice
 */
function mohi_portfolio_admin_notice() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

    if ( $page !== 'portfolio_options' ) {
        return;
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $updated = isset( $_GET['settings-updated'] ) ? sanitize_text_field( wp_unslash( $_GET['settings-updated'] ) ) : '';

    if ( ! empty( $updated ) ) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p>
                <strong><?php echo esc_html__( 'Success!', 'mohi-cpt' ); ?></strong>
                <?php echo esc_html__( 'Portfolio options saved successfully.', 'mohi-cpt' ); ?>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'mohi_portfolio_admin_notice' );   