<?php

if(! defined('ABSPATH')){
    exit;
}

get_header(); ?>

<div class="container my-5">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('row justify-content-center'); ?>>
            <div class="col-lg-10">
                
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-4 rounded-4 overflow-hidden shadow">
                        <?php the_post_thumbnail('full', ['class' => 'img-fluid w-100']); ?>
                    </div>
                <?php endif; ?>

                <div class="portfolio-categories mb-3 d-flex flex-wrap gap-2">
                    <?php
                        // Fixed: was 'portfolio_category' (unprefixed)
                        $mohi_terms = get_the_terms( get_the_ID(), 'mohicpt_category' );
                        if ( $mohi_terms && ! is_wp_error( $mohi_terms ) ) :
                        foreach ( $mohi_terms as $term ) : ?>
                        <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" 
                           class="text-decoration-none border border-light-subtle px-3 py-2 shadow-sm text-dark bg-white" 
                           style="font-size: 14px; display: inline-block;">
                           <?php echo esc_html( $term->name ); ?>
                        </a>
                        <?php endforeach;
                        endif;?>
                </div>    

                <h1 class="display-4 fw-bold mb-4"><?php the_title(); ?></h1>

                <div class="post-meta text-muted small mb-4 d-flex flex-wrap align-items-center gap-2">
                    <a class="text-decoration-none text-dark" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                        <i class="far fa-user me-2"></i><?php echo esc_html( get_the_author() ); ?>
                    </a>
                    <span class="text-light-emphasis">|</span>
                    <span class="text-muted">
                        <i class="bi bi-calendar me-1"></i>
                        <?php echo esc_html( get_the_date('d M, Y') ); ?>
                    </span>
                    <span class="text-light-emphasis">|</span>
                    <span class="comment-link">
                        <i class="bi bi-chat-left me-1"></i>
                        <?php comments_popup_link( esc_html__( 'Leave a comment', 'mohi-cpt' ), esc_html__( '1 Comment', 'mohi-cpt' ), esc_html__( '% Comments', 'mohi-cpt' ) ); ?>
                    </span>
                </div>

                <div class="content-area fs-5 leading-relaxed text-dark mb-5">
                    <?php the_content(); ?>
                </div>

                <?php 
                // 1. Get the current post type
                $mohi_current_post_type = get_post_type();

                // 2. Dashboard settings validation
                // Fixed: was 'portfolio_settings' (unprefixed)
                $mohi_portfolio_options = get_option('mohicpt_portfolio_settings');
                $mohi_enable_metabox    = isset($mohi_portfolio_options['enable_project_details']) ? $mohi_portfolio_options['enable_project_details'] : 1;

                // 3. Only show if it's the 'mohicpt_portfolio' post type AND enabled in settings
                // Fixed: was 'portfolio' (unprefixed)
                if ( $mohi_enable_metabox == 1 && $mohi_current_post_type === 'mohicpt_portfolio' ) : 
                ?>
                    <div class="project-details-wrap my-5 p-4 bg-light border rounded-3">
                        <h4 class="fw-bold mb-4"><?php esc_html_e( 'Project Information', 'mohi-cpt' ); ?></h4>
                        
                        <div class="row">
                            <?php 
                            $mohi_client_name  = get_post_meta( get_the_ID(), '_mohi_client_name', true );
                            $mohi_project_url  = get_post_meta( get_the_ID(), '_mohi_project_url', true );
                            $mohi_project_date = get_post_meta( get_the_ID(), '_mohi_project_date', true );
                            ?>

                            <?php if ( ! empty( $mohi_client_name ) ) : ?>
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-briefcase fs-4 text-primary me-3"></i>
                                        <div>
                                            <span class="text-muted small d-block"><?php esc_html_e( 'Client', 'mohi-cpt' ); ?></span>
                                            <strong class="text-dark"><?php echo esc_html( $mohi_client_name ); ?></strong>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $mohi_project_date ) ) : ?>
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-check fs-4 text-primary me-3"></i>
                                        <div>
                                            <span class="text-muted small d-block"><?php esc_html_e( 'Completed Date', 'mohi-cpt' ); ?></span>
                                            <strong class="text-dark">
                                               <?php echo esc_html( date_i18n( 'j F, Y', strtotime( $mohi_project_date ) ) ); ?>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $mohi_project_url ) ) : ?>
                                <div class="col-md-4 mb-3 d-flex align-items-center">
                                    <a href="<?php echo esc_url( $mohi_project_url ); ?>" target="_blank" class="btn btn-dark w-100 py-2 fw-bold shadow-sm">
                                        <i class="bi bi-box-arrow-up-right me-2"></i> <?php esc_html_e('View Live Project', 'mohi-cpt'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php 
                endif;
                ?>

                <footer class="entry-footer mt-5 pt-4 border-top">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div class="post-tags mb-3 mb-md-0 d-flex flex-wrap align-items-center gap-2">
                            <span class="fw-bold text-dark me-1"><i class="bi bi-tags me-1"></i><?php esc_html_e( 'Tags:', 'mohi-cpt' ); ?></span>
                            <?php
                            // Fixed: was 'project_tag' (unprefixed)
                            $mohi_project_tags = get_the_terms( get_the_ID(), 'mohicpt_project_tag' );
                            if ( $mohi_project_tags && ! is_wp_error( $mohi_project_tags ) ) :
                                foreach ( $mohi_project_tags as $tag ) : ?>
                                    <a href="<?php echo esc_url( get_term_link( $tag ) ); ?>" 
                                       class="text-muted border px-2 py-1 rounded text-decoration-none bg-light shadow-none"
                                       style="font-size: 13px;">
                                        #<?php echo esc_html( $tag->name ); ?>
                                        <span class="ms-1 opacity-50" style="font-size: 11px;">(<?php echo esc_html( $tag->count ); ?>)</span>
                                    </a>
                                <?php endforeach;
                            endif; ?>
                        </div>

                        <div class="share-icons d-flex align-items-center gap-3">
                            <span class="fw-bold text-dark small"><?php esc_html_e( 'SHARE:', 'mohi-cpt' ); ?></span>
                            <?php
                                $mohi_post_url   = urlencode( get_permalink() );
                                $mohi_post_title = urlencode( get_the_title() );
                            ?>
                            <div class="social-links d-flex gap-3 h5 mb-0">
                                <a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $mohi_post_url ); ?>" target="_blank" class="text-secondary" title="Facebook"><i class="bi bi-facebook"></i></a>
                                <a href="<?php echo esc_url( 'https://twitter.com/intent/tweet?url=' . $mohi_post_url . '&text=' . $mohi_post_title ); ?>" target="_blank" class="text-secondary" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                                <a href="<?php echo esc_url( 'https://www.linkedin.com/sharing/share-offsite/?url=' . $mohi_post_url ); ?>" target="_blank" class="text-secondary" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </footer>

                <div class="author-box d-flex align-items-center bg-light p-4 rounded-4 mt-5 border shadow-sm">
                    <div class="author-avatar flex-shrink-0 me-4">
                        <?php echo get_avatar( get_the_author_meta('ID'), 90, '', esc_attr( get_the_author() ), array('class' => 'rounded-circle border border-3 border-white shadow-sm') ); ?>
                    </div>
                    <div class="author-info">
                        <h5 class="mb-1 fw-bold text-dark"><?php echo esc_html( get_the_author() ); ?></h5>
                        <p class="mb-0 text-muted small" style="line-height: 1.6;"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
                    </div>
                </div>

                <?php if( comments_open() || get_comments_number()): ?>
                    <div class="mt-5 pt-4">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>

            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>