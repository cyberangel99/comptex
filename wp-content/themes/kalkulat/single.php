<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
						the_post_navigation( array(
				            'prev_text'          => esc_html__( 'Prev', 'kalkulat' ),
				            'next_text'          => esc_html__( 'Next', 'kalkulat' ),
				            'screen_reader_text' => ' ',
				        ) );
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

<?php get_footer('two') ?>