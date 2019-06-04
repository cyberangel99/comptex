<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage kalkulat
 * @since 1.0
 * @version 1.0
 */
get_header('three'); ?>

    <?php kalkulate_page_title(); ?>

    <div class="blog-main-content mt90 mb70">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php 
                        if(have_posts()) : 
                            while(have_posts()) : the_post();
                                get_template_part( 'template-parts/content', get_post_format() );
                            endwhile;
                            the_posts_pagination(array(
                                'prev_text'             => '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
                                'next_text'             => '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
                                'mid_size'              => 2,
                                'screen_reader_text'    => ' '
                            ));
                        else:
                            get_template_part( 'template-parts/content', 'none' );
                        endif;
                    ?>
                </div>
                <div class="col-md-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>

        </div>
    </div>


<?php get_footer() ?>
