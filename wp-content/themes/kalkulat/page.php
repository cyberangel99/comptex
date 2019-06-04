<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage kalkulat
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>

<?php kalkulate_page_title(); ?>

<div class="blog-main-content mt90 mb70">
	<div class="container">
		<div class="row">
	        <div class="col-md-8 blog-page-details-content">
					<?php 
						if(have_posts()) : 
							while(have_posts()) : the_post();
								the_content();
							endwhile;
							 the_posts_pagination(array(
                                'prev_text'             => '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
                                'next_text'             => '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
                                'mid_size'              => 2,
                                'screen_reader_text'    => ' '
                            ));
			                if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
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