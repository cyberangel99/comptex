<?php
/**
* Template Name: Page Cart
*
* @package WordPress
* @subpackage kalkulat
* @since 1.0
* @version 1.0
*/
get_header('three'); ?>

<?php kalkulate_page_title(); ?>	

	<div class="main-wrap mt90 mb70">
		<div class="container">
			<?php
				if(have_posts()){
					while(have_posts()) : the_post();
						the_content();
					endwhile;
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
			?>
		</div>
	</div>

<?php get_footer(); ?>