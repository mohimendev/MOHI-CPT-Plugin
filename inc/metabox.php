<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Portfolio Metabox
 */
function mohi_portfolio_metabox_register() {
    $options = get_option( 'mohicpt_portfolio_settings' );
    $mohi_enable_metabox = isset( $options['enable_project_details'] ) ? $options['enable_project_details'] : 1;

    if ( $mohi_enable_metabox == 1 ) {
        add_meta_box(
            'mohi_portfolio_settings',
            esc_html__( 'Project Details', 'mohi-cpt' ),
            'mohi_portfolio_metabox_html',
            'mohicpt_portfolio',
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'mohi_portfolio_metabox_register' );

/**
 * Portfolio Metabox HTML Input Fields
 */
function mohi_portfolio_metabox_html( $post ) {
    $mohi_client_name  = get_post_meta( $post->ID, '_mohi_client_name', true );
    $mohi_project_url  = get_post_meta( $post->ID, '_mohi_project_url', true );
    $mohi_project_date = get_post_meta( $post->ID, '_mohi_project_date', true );

    wp_nonce_field( 'mohi_portfolio_metabox_nonce', 'mohi_portfolio_nonce' );
    ?>
    <div class="mohi-metabox-wrapper">
        <p>
            <label for="mohi_client_name"><strong><?php esc_html_e( 'Client Name:', 'mohi-cpt' ); ?></strong></label><br>
            <input type="text" id="mohi_client_name" name="mohi_client_name" value="<?php echo esc_attr( $mohi_client_name ); ?>" class="widefat" placeholder="<?php esc_attr_e( 'e.g. John Doe', 'mohi-cpt' ); ?>">
        </p>
        <p>
            <label for="mohi_project_url"><strong><?php esc_html_e( 'Project Live Link:', 'mohi-cpt' ); ?></strong></label><br>
            <input type="url" id="mohi_project_url" name="mohi_project_url" value="<?php echo esc_url( $mohi_project_url ); ?>" class="widefat" placeholder="https://example.com">
        </p>
        <p>
            <label for="mohi_project_date"><strong><?php esc_html_e( 'Completion Date:', 'mohi-cpt' ); ?></strong></label><br>
            <input type="date" id="mohi_project_date" name="mohi_project_date" value="<?php echo esc_attr( $mohi_project_date ); ?>" class="widefat">
        </p>
    </div>
    <?php
}

/**
 * Metabox Data Save
 */
function mohi_portfolio_save_metabox_data( $post_id ) {
    // Nonce check
    $nonce = isset( $_POST['mohi_portfolio_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['mohi_portfolio_nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'mohi_portfolio_metabox_nonce' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save Data with unslash and sanitization
    if ( isset( $_POST['mohi_client_name'] ) ) {
        update_post_meta( $post_id, '_mohi_client_name', sanitize_text_field( wp_unslash( $_POST['mohi_client_name'] ) ) );
    }
    
    if ( isset( $_POST['mohi_project_url'] ) ) {
        update_post_meta( $post_id, '_mohi_project_url', esc_url_raw( wp_unslash( $_POST['mohi_project_url'] ) ) );
    }

    if ( isset( $_POST['mohi_project_date'] ) ) {
        update_post_meta( $post_id, '_mohi_project_date', sanitize_text_field( wp_unslash( $_POST['mohi_project_date'] ) ) );
    }
}
add_action( 'save_post', 'mohi_portfolio_save_metabox_data' );