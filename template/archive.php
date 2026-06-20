<?php 

if(! defined('ABSPATH')){
    exit;
}

get_header(); ?>

<div class="container my-5">

    <!-- Archive Header -->
    <div class="row mb-5">
        <div class="col-12 text-center">
        <?php
            if ( is_post_type_archive() ) {
                echo '<h1 class="display-5 fw-bold text-dark">' . esc_html( post_type_archive_title( '', false ) ) . '</h1>';
            } else {
                the_archive_title( '<h1 class="display-5 fw-bold text-dark">', '</h1>' );
            } ?>
            <?php the_archive_description('<div class="text-muted">', '</div>'); ?>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-12">
            <div class="row g-3">
                <?php if ( have_posts() ): 
                while ( have_posts() ) : the_post(); ?>
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm custom-card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large', ['class' => 'card-img-top img-fluid']); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="portfolio-categories mb-3">
                                    <?php
                                    // Fixed: was 'portfolio_category' (unprefixed)
                                    $mohi_terms = get_the_terms( get_the_ID(), 'mohicpt_category' );

                                    if ( $mohi_terms && ! is_wp_error( $mohi_terms ) ) :
                                        foreach ( $mohi_terms as $term ) : ?>
                                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" 
                                            class="text-decoration-none border border-light-subtle px-2 py-1 shadow-sm text-dark" 
                                                style="font-size: 12px; display: inline-block; background: #fff;">
                                                <?php echo esc_html( $term->name ); ?>
                                            </a>
                                        <?php endforeach;
                                        endif;
                                    ?>
                                </div>

                                <h5 class="display-8 fw-bold mb-4"><?php echo esc_html( get_the_title() ); ?></h5>

                                <p class="card-text text-muted small mb-2">
                                    <a class="text-decoration-none text-dark" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
                                        <i class="bi bi-person me-2"></i><?php echo esc_html( get_the_author() ); ?>
                                    </a>                    
                                    &nbsp;|&nbsp;
                                    
                                    <a href="<?php the_permalink(); ?>" class="text-muted text-decoration-none">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?php echo esc_html( get_the_date('d M, Y') ); ?>
                                    </a>
                                    
                                    <br>
                                    <span class="text-muted"><i class="bi bi-chat-left me-1"></i></span>
                                    <?php comments_popup_link( esc_html__( 'Leave a comment', 'mohi-cpt' ), esc_html__( '1 Comment', 'mohi-cpt' ), esc_html__( '% Comments', 'mohi-cpt' ), 'comment-link' ); ?>                               
                                </p>

                                <p class="card-text text-muted small">
                                    <?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?>
                                </p>
                                <a href="<?php the_permalink(); ?>" target="_black" class="btn btn-outline-dark btn-sm"><?php esc_html_e( 'View Project', 'mohi-cpt' ); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; else : ?>
                    <div class="col-12 text-center">
                        <p><?php esc_html_e('No projects found.', 'mohi-cpt') ?></p>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="mt-5">
                <?php the_posts_pagination(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>