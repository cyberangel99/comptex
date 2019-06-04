<?php
/**
 * The template for displaying the footer
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage kalkulat
 * @since 1.0
 * @version 1.0
 */

?>  
    <?php 
        $cta_title      = get_theme_mod('cta_title');
        $cta_sub_title  = get_theme_mod('cta_sub_title');
        $cta_btn        = get_theme_mod('cta_btn');
        $cta_btn_url        = get_theme_mod('cta_btn_url');
        if(!empty($cta_title)  || !empty($cta_sub_title) || !empty($cta_btn) || !empty($cta_btn_url)) : 
    ?>
	<div class="get-started-area base-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8">
	                <div class="get-started-text">
                        <?php 
                            if(!empty($cta_title)) :
                                print '<h3>'.$cta_title.'</h3>'; 
                            endif;
                            if(!empty($cta_sub_title)) :
                                print '<span>'.$cta_sub_title.'</span>'; 
                            endif;
                        ?>
	                </div>
	            </div>
                <?php 
                   if(!empty($cta_btn)) :
                        print '<div class="col-md-4">
                            <div class="get-started-button text-right">
                                <a href="'.$cta_btn_url.'" class="kal-button btn-large">'.$cta_btn.'</a>
                            </div>
                        </div>'; 
                    endif; 
                ?>
	        </div>
	    </div>
	</div>
    <?php endif; ?>
        
    <footer>
        <?php if(is_active_sidebar( 'footer-shop-sidebar' )) : ?>
        <div class="main-footer">
            <div class="container">
                <div class="row">
                    <?php 
                        dynamic_sidebar( 'footer-shop-sidebar' );
                    ?>
                </div>
            </div>
        </div><!--/.main-footer-->
        <?php endif; ?>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="copyright-text">
                            <?php 
                                $copyright = get_theme_mod('copyright');

                                if(!empty($copyright)) : 
                                    print esc_html( $copyright );
                                else: 
                                    print ''.esc_html__( '&copy; Copyright 2019 Themelayer. All rights reserved.', 'kalkulat' );
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="footer-menu text-right">
                            <?php 
                            wp_nav_menu( array( 
                                    'theme_location'    => 'footer_menu',
                                    'menu_class'        => 'footer-menu-list',
                                    'menu_id'           => 'footer_navbar',
                                    'fallback_cb'       => ' '
                                ) );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer() ?>
</body>
</html>