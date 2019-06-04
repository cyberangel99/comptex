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
        <!-- == Menu area  ==-->
        <div class="white-bg desktop-menu">
            <div class="container">
                <div class="menu-logo">
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
                                'fallback_cb'       => ' '
                            ) );
                        ?>
                    </nav>
                </div>
            </div>
        </div>
        <!-- /.Menu-area  -->
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
        </nav><!--/.mobile-background-nav-->
    </header><!--/.kalkulat-header-->