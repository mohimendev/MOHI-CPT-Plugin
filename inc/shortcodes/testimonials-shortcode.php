<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Shortcode to Display Testimonials
 */
function mohi_testimonial_shortcode( $atts ) {

    $atts = shortcode_atts(
        array(
            'posts' => 4,
        ),
        $atts
    );

    $args = array(
        'post_type'      => 'mohicpt_testimonial', // Fixed: was 'testimonial' (unprefixed)
        'posts_per_page' => intval( $atts['posts'] ),
        'post_status'    => 'publish',
    );

    $query = new WP_Query( $args );

    ob_start();

    if ( $query->have_posts() ) : ?>

        <div class="container my-5">
            <div class="row g-4">

                <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm custom-card">

                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top img-fluid' ) ); ?>
                                </a>
                            <?php endif; ?>

                            <div class="card-body">

                                <div class="portfolio-categories mb-3">
                                    <?php
                                    // Fixed: was 'portfolio_category' (unprefixed)
                                    $terms = get_the_terms( get_the_ID(), 'mohicpt_category' );
                                    if ( $terms && ! is_wp_error( $terms ) ) :
                                        foreach ( $terms as $term ) : ?>
                                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
                                               class="text-decoration-none border border-light-subtle px-2 py-1 shadow-sm text-dark"
                                               style="font-size: 12px; display: inline-block; background: #fff;">
                                                <?php echo esc_html( $term->name ); ?>
                                            </a>
                                        <?php endforeach;
                                    endif; ?>
                                </div>

                                <h5 class="display-8 fw-bold mb-4"><?php the_title(); ?></h5>

                                <p class="card-text text-muted small mb-2">
                                    <a class="text-decoration-none text-dark"
                                       href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                                       title="<?php echo esc_attr( get_the_author() ); ?>">
                                        <i class="far fa-user me-2"></i><?php the_author(); ?>
                                    </a>
                                    &nbsp;|&nbsp;
                                    <a href="<?php the_permalink(); ?>" class="text-muted text-decoration-none">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?php echo esc_html( get_the_date( 'd M, Y' ) ); ?>
                                    </a>
                                    <br>

                                    <span class="comment-link-wrapper">
                                        <i class="bi bi-chat-left text-decoration-none me-1"></i>
                                        <?php comments_popup_link(
                                            esc_html__( 'Leave a comment', 'mohi-cpt' ),
                                            esc_html__( '1 Comment', 'mohi-cpt' ),
                                            esc_html__( '% Comments', 'mohi-cpt' ),
                                            'comment-link'
                                        ); ?>
                                    </span>
                                </p>

                                <p class="card-text text-muted small">
                                    <?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?>
                                </p>

                                <a href="<?php the_permalink(); ?>" target="_black" class="btn btn-outline-dark btn-sm text-decoration-none">
                                    <?php esc_html_e( 'View Testimonial', 'mohi-cpt' ); ?>
                                </a>

                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </div>

    <?php else : ?>
        <div class="col-12 text-center">
            <p><?php esc_html_e( 'No testimonials found.', 'mohi-cpt' ); ?></p>
        </div>
    <?php endif;

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'mohicpt_testimonial', 'mohi_testimonial_shortcode' ); // Fixed: was 'my_testimonial' (unprefixed)