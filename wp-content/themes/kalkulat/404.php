<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage kalkulat
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>

<!-- page title -->
<?php kalkulate_page_title(); ?>

<div class="contact-us-content mt90 mb90">
    <div class="container">
        <div class="error-text text-center">
            <div class="error-404 base-color">
                <?php print esc_html__( '404', 'kalkulat' ) ?>
            </div>
            <p>
            	<?php print esc_html__( 'Oops! That page can&rsquo;t be found. It looks like nothing was found at this location. Maybe try a search?', 'kalkulat' ) ?>
            </p>
            <div class="two-buttons">
                <a href="<?php print esc_url(home_url('/')); ?>" class="kal-button btn-semi-large base-bg"><?php esc_html_e( 'Back to hompage', 'kalkulat' ); ?></a>
            </div>
        </div>
    </div>
</div>


<?php get_footer('two') ?>