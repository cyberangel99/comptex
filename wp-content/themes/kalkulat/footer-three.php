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
        $footer_two_logo = get_theme_mod('footer_two_logo');
        $footer_two_text = get_theme_mod('footer_two_text');
        $facebook        = get_theme_mod('facebook');
        $twitter         = get_theme_mod('twitter');
        $google_plus     = get_theme_mod('google_plus');
        $pinterest       = get_theme_mod('pinterest');
    ?>
    <footer class="footer-three">
        <div class="container">
            <?php if(is_active_sidebar( 'footer-sidebar-two' )) : ?>
            <div class="main-footer">
                <div class="row">
                    <?php 
                        dynamic_sidebar( 'footer-sidebar-two' );
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
                        <div class="footer-menu payment-footer text-right">
                            <!-- paypal -->
                            <?php 
                                $paypal_status = get_theme_mod( 'paypal_status' );
                                if($paypal_status != false) :
                            ?>
                                <i class="fa fa-cc-paypal"></i>
                            <?php endif; ?>
                            <!-- visa -->
                            <?php 
                                $visa_status = get_theme_mod( 'visa_status' );
                                if($visa_status != false) :
                            ?>
                                <i class="fa fa-cc-visa"></i>
                            <?php endif; ?>
                            <!-- mastercard -->
                            <?php 
                                $mastercard_status = get_theme_mod( 'mastercard_status' );
                                if($mastercard_status != false) :
                            ?>
                                <i class="fa fa-cc-mastercard"></i>
                            <?php endif; ?>
                            <!-- amex -->
                            <?php 
                                $amex_status = get_theme_mod( 'amex_status' );
                                if($amex_status != false) :
                            ?>
                                <i class="fa fa-cc-amex"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer() ?>
</body>
</html>