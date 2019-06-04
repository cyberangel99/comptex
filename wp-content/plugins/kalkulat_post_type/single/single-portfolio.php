<?php get_header('three'); ?>

<?php kalkulate_page_title(); ?>

<div class="single-product-main-content mt90 mb70">
    <div class="container">
        <?php if(have_posts()) : 
            while(have_posts()) : the_post();
        ?>
            <div class="row">
                <div class="col-md-12">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="image">
                            <?php the_post_thumbnail( 'full'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt40">
                <div class="col-md-12">
                    <p><?php print get_the_content(); ?></p>
                </div>
            </div>
            <hr class="kal-separator"/>
            <div class="row">
                <div class="col-md-12">
                    <div class="our-product-information">
                        <?php 
                            $portfolio_designer = get_post_meta( get_the_ID(), '__kalkulate__portfolio_designer', true );
                            $portfolio_client = get_post_meta( get_the_ID(), '__kalkulate__portfolio_client', true );
                            $portfolio_tools = get_post_meta( get_the_ID(), '__kalkulate__portfolio_tools', true );
                        ?>

                        <!-- designer data -->
                        <?php if(!empty($portfolio_designer)) : ?>
                            <div class="single">
                                <strong><?php esc_html_e( 'Designer :', 'kalkulat' ); ?></strong>
                                <?php print $portfolio_designer; ?>
                            </div>
                        <?php endif; ?>

                        <!-- client data -->
                        <?php  if(!empty($portfolio_client)) : ?>
                            <div class="single">
                                <strong><?php esc_html_e( 'CLIENT :', 'kalkulat' ); ?></strong>
                                <?php print $portfolio_client; ?>
                            </div>
                        <?php endif; ?>

                        <!-- portfolio date -->
                        <div class="single">
                            <strong><?php esc_html_e( 'DATE :', 'kalkulat' ); ?></strong>
                            <?php the_time(get_option( 'date_format' )); ?>
                        </div>

                        <!-- portfolio tag -->
                        <?php if(has_tag()) : ?>
                            <div class="single">
                                <strong><?php esc_html_e( 'Tags :', 'kalkulat' ); ?></strong>
                                <?php the_tags('', ', '); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- portfolio tools -->
                        <?php if(!empty($portfolio_tools)) : ?>
                            <div class="single">
                                <strong><?php esc_html_e( 'Tools :', 'kalkulat') ?></strong>
                                <?php print $portfolio_tools; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <hr class="kal-separator"/>
            <div class="most-viewed-project pdt70">
                <?php 
                    $mostview_title = get_theme_mod( 'mostview_title' );
                    $mostview_subtitle = get_theme_mod( 'mostview_subtitle' );
                    if(!empty($mostview_title) || !empty($mostview_subtitle)) :
                ?>
                <div class="section-heading text-center">
                    <h2><?php print $mostview_title; ?></h2>
                    <p><?php print $mostview_subtitle; ?></p>
                </div>
                <?php endif; ?>
                <div class="row row-eq-rs-height">
                    <?php 
                        $query_most_view = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 3, 'meta_key' => '__kalkulate__post_views_count', 'orderby' => 'meta_value_num' ) ); 
                    ?>
                    <?php 
                        if($query_most_view->have_posts()) :
                            while($query_most_view->have_posts()) : $query_most_view->the_post(); ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="work-item">
                                        <div class="portfolio-thumb">
                                            <a class="image-popup-vertical-fit" href="<?php print get_the_post_thumbnail_url( null, 'kalkulate-portfolio-two-thumb' ) ?>">
                                                <?php print get_the_post_thumbnail( null, 'kalkulate-portfolio-two-thumb', array('class'=> 'img-responsive')) ?>
                                                <div class="portfolio-icon">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </div>
                                            </a>
                                            <div class="portfolio-icon2">
                                                <a href="<?php print get_the_permalink(); ?>">
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h4><a href="<?php print get_the_permalink(); ?>"><?php print get_the_title() ?></a></h4>
                                            <span class="category"><?php print get_post_meta( get_the_ID(), '__kalkulate__portfolio_sub_title', true ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        endif;  
                    ?>
                </div>
            </div>
        <?php 
            endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</div>

<?php get_footer() ?>