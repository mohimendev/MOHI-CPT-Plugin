<?php


if(! defined('ABSPATH')){
    exit;
}


/**
 * Render Main CPT Settings Page HTML
 */
function mohi_cpt_page() {
    // Secure the page by checking user capability explicitly
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Output security fields for the registered setting "mohicpt"
            settings_fields( 'mohicpt' );
            
            // Output setting sections and their fields
            do_settings_sections( 'mohicpt' );
            
            // Output save settings button with correct translation domain
            submit_button( __( 'Save Settings', 'mohi-cpt' ) );
            ?>
        </form>
    </div>
    <?php
}


/**
 * Render Portfolio Options Submenu Page HTML
 */
function mohi_portfolio_page_options() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        
        <?php settings_errors(); ?>

        <form action="options.php" method="post">
            <?php
            settings_fields( 'mohi_portfolio' );
            
            do_settings_sections( 'mohi_portfolio' );
            
            submit_button( __( 'Save Settings', 'mohi-cpt' ) );
            ?>
        </form>
    </div>
    <?php
}


/**
 * Render Testimonial Options Submenu Page HTML
 */
function mohi_testimonial_page_options() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form method="post" action="options.php">
            <?php

            settings_fields( 'mohi_testimonial' ); 

            do_settings_sections( 'mohi_testimonial' );

            submit_button();
            ?>
        </form>
    </div> 
    <?php 
}