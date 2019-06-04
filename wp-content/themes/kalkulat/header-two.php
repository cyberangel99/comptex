<?php
/**
 * The header for our theme
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage kalkulat
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <?php 
        $preloader_status = get_theme_mod( 'preloader_status' );
        if($preloader_status != false) :
    ?>
    <div class="preloader">
        <div class="loader-inner ball-scale-multiple">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <?php endif; ?>
    
    <header class="kalkulat-header">
        <?php 
            $topbar_phone_two = get_theme_mod( 'topbar_phone_two' );
            $topbar_mail_two = get_theme_mod( 'topbar_mail_two' );
            $kalkulate_social_icons = kalkulate_social_icons();
        ?>
        <?php if(!empty($topbar_phone_two) || !empty($topbar_mail_two) || !empty($kalkulate_social_icons)) : ?>
            <div class="topbar-two base-bg">
                <div class="container">
                    <div class="col-sm-8">
                        <div class="contact-phone-email">
                            <?php 
                                if(!empty($topbar_phone_two)) :
                                    print '<span><i class="fa fa-phone"></i> '.$topbar_phone_two.'</span>'; 
                                endif;
                                if(!empty($topbar_mail_two)) :
                                    print '<a href="mailto:<?php print esc_html( $topbar_mail_two ); ?>">
                                        <span>
                                            <i class="fa fa-envelope-o"></i>
                                            '.$topbar_mail_two.'
                                        </span>
                                    </a>';
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-right topbar-social-icons">
                            <?php print kalkulate_social_icons(); ?>
                        </div>
                    </div>
                </div>
            </div> 
        <?php endif; ?>
        <div class="mobile-menu">
            <div class="container">
                <div class="mobile-logo-search-humbarger">
                    <div class="logo">
                        <?php  
                            $header_logo = get_theme_mod('header_logo');
                        ?>
                        <a href="<?php print esc_url( home_url('/') ); ?>">
                            <img src="<?php (!empty($header_logo) ? print esc_url( $header_logo ) : print get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php esc_attr_e( 'Logo', 'kalkulat' ); ?>">
                        </a>
                    </div>
                    <div class="humbarger-button">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
            </div>
        </div><!--/.menu-area-->
        <nav class="mobile-background-nav">
            <div class="mobile-inner">
                <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
                <?php 
                    wp_nav_menu( array( 
                        'theme_location'    => 'main_menu',
                        'menu_class'        => 'menu-accordion',
                        'menu_id'           => 'mobile_navbar',
                        'fallback_cb'       => '' 
                    ) );
                ?>
            </div>
        </nav>
    </header>
    <div class="slider-area">
        <div class="menu2-area desktop-menu white">
            <div class="container">
                <div class="menu2-wrapper">
                    <div class="logo">
                        <?php  
                            $header_logo = get_theme_mod('header_logo');
                        ?>
                        <a href="<?php print esc_url( home_url('/') ); ?>">
                            <img src="<?php (!empty($header_logo) ? print esc_url( $header_logo ) : print get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php esc_attr_e( 'Logo', 'kalkulat' ); ?>">
                        </a>
                    </div>
                    <nav id="easy-menu">
                        <?php 
                            wp_nav_menu( array( 
                                'theme_location'    => 'main_menu',
                                'menu_class'        => 'main-menu-list',
                                'menu_id'           => 'main_navbar',
                                'fallback_cb'       => '' 
                            ) );
                        ?>
                    </nav><!--#easy-menu-->
                </div>
            </div>
        </div>
    </div>