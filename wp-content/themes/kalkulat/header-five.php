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
        ?>
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
        <div class="menu-style4 menu-style5 desktop-menu">
            <div class="container-fluid">
                <div class="menu2-wrapper menu4-wrapper">
                        <div class="logo">
                            <?php  
                                $header_logo = get_theme_mod('header_logo');
                            ?>
                            <a href="<?php print esc_url( home_url('/') ); ?>">
                                <img src="<?php (!empty($header_logo) ? print esc_url( $header_logo ) : print get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php esc_attr_e( 'Logo', 'kalkulat' ); ?>">
                            </a>
                        </div>
                    <div id="easy-menu">
                        <nav>
                            <?php 
                                wp_nav_menu( array( 
                                    'theme_location'    => 'main_menu',
                                    'menu_class'        => 'main-menu-list style-two',
                                    'menu_id'           => 'main_navbar',
                                    'fallback_cb'       => ' ' 
                                ) );
                            ?>
                        </nav><!--#easy-menu-->
                        <div class="search-box search-boxx icon-circle">
                            <?php 
                                $menu_search_status = get_theme_mod( 'menu_search_status' );
                                if($menu_search_status != true) :
                            ?>
                                <a href="#!">
                                    <i class="fa fa-search search-icon"></i>
                                </a>
                            <?php endif; ?>

                            <?php if(function_exists('kalkulate_woo_miniCart')) { 
                                print '<div class="product-cart-list">';
                                    kalkulate_woo_miniCart(); 
                                print '</div>';
                                
                            } ?>

                            <div class="top-search-input-wrap">
                                <span class="close-icon"><i class="fa fa-times"></i></span>
                                <div class="top-search-overlay"></div>
                                <form role="search" action="<?php print esc_url( home_url( '/' ) ); ?>" method="get">
                                    <div class="search-wrap">
                                        <div class="search  pull-right educon-top-search">
                                            <div class="sp_search_input">
                                                <input maxlength="200" class="pull-right" placeholder="<?php print esc_attr__( 'Search Here . . .', 'kalkulat' ); ?>" type="text" value="<?php print get_search_query(); ?>" name="s">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!--/.search-box -->
                    </div>
                </div>
            </div>
        </div>
    </div>