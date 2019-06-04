<?php
/**
* Template Name: Header Five
*
* @package WordPress
* @subpackage kalkulat
* @since 1.0
* @version 1.0
*/
get_header('five'); ?>

	<div class="main-wrap main-wrap-box-view">
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

<?php get_footer('two'); ?>