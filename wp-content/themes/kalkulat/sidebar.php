<?php 
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage kalkulat
 * @since 1.0
 * @version 1.0
 */
?>
<?php if(is_active_sidebar( 'blog-sidebar' )) : ?>
<aside class="sidebar">
    <?php 
        dynamic_sidebar( 'blog-sidebar' );
    ?>
</aside>
<?php endif; ?>