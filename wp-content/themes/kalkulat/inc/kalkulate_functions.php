<?php
/**
* page title
*/
if(!function_exists('kalkulate_page_title')){
	function kalkulate_page_title(){
	?>
		<section class="banner-area blog-grid-banner">
			<div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="banner-text text-center">
	                        <h1><?php (is_home() && is_front_page()) ? esc_html_e('Our Blog','kalkulat') : wp_title($sep = ''); ?></h1>
	                        <?php 
						        $breadcrumb_status = get_theme_mod( 'breadcrumb_status' );
						        if($breadcrumb_status != true) :
						    ?>
								<ul class="kal-breadcumb">
		                            <?php print kalkulate_breadcrumbs(); ?>
		                        </ul>
							<?php endif; ?>
	                    </div>
	                </div>
	            </div>
            </div>
	    </section><!--/.banner-area-->
	<?php
	}
}

/**
* Archive page title
*/
if(!function_exists('kalkulate_archive_page_title')){
	function kalkulate_archive_page_title(){
	?>
		<section class="banner-area blog-grid-banner">
			<div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="banner-text text-center">
	                        <?php if(have_posts()) : 
									the_archive_title( '<h1 class="heading">', '</h1>' );
									the_archive_description( '<div class="taxonomy-description">', '</div>' );
							  	endif; ?> 
	                        <ul class="kal-breadcumb">
	                            <?php print kalkulate_breadcrumbs(); ?>
	                        </ul>
	                    </div>
	                </div>
	            </div>
            </div>
	    </section><!--/.banner-area-->
	<?php
	}
}


/**
* kalkulate breadcrumbs
*/
if (!function_exists('kalkulate_breadcrumbs')) {
	function kalkulate_breadcrumbs(){
			$home = '<li class="breadcrumb-item"><a href="' . esc_url(home_url()) . '" title="' . esc_attr__('Home', 'kalkulat') . '">' . esc_html__('Home', 'kalkulat') . '</a></li>';
			$showCurrent = 1;

			global $post;
			$homeLink = esc_url(home_url());
			if (is_front_page()) {
					return;
			}    // don't display breadcrumbs on the homepage (yet)

			printf( '%s', $home );

			if (is_category()) {
					// category section
					$thisCat = get_category(get_query_var('cat'), false);
					if (!empty($thisCat->parent)) {
							echo get_category_parents($thisCat->parent, true, ' ' . '/' . ' ');
					}
					echo '<li class="breadcrumb-item">' . esc_html__('Archive for category', 'kalkulat') . ' "' . single_cat_title('', false) . '"' . '</li>';
			} elseif (is_search()) {
					// search section
					echo '<li class="breadcrumb-item">' . esc_html__('Search results for', 'kalkulat') . ' "' . get_search_query() . '"' . '</li>';
			} elseif (is_day()) {
					echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
					echo '<li class="breadcrumb-item"><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
					echo '<li class="breadcrumb-item">' . get_the_time('d') . '</li>';
			} elseif (is_month()) {
					// monthly archive
					echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
					echo '<li class="breadcrumb-item">' . get_the_time('F') . '</li>';
			} elseif (is_year()) {
					// yearly archive
					echo '<li class="breadcrumb-item">' . get_the_time('Y') . '</li>';
			} elseif (is_single() && !is_attachment()) {
					// single post or page
					if (get_post_type() != 'post') {
							$post_type = get_post_type_object(get_post_type());
							$slug = $post_type->rewrite;
							echo '<li class="breadcrumb-item"><a href="' . $homeLink . '/?post_type=' . $slug['slug'] . '">' . $post_type->labels->singular_name . '</a></li>';
							if ($showCurrent) {
									echo '<li class="breadcrumb-item">' . get_the_title() . '</li>';
							}
					} else {
							$cat = get_the_category();
							if (isset($cat[0])) {
									$cat = $cat[0];
							} else {
									$cat = false;
							}
							if ($cat) {
									$cats = get_category_parents($cat, true, ' ' . ' ' . ' ');
							} else {
									$cats = false;
							}
							if (!$showCurrent && $cats) {
									$cats = preg_replace("#^(.+)\s\s$#", "$1", $cats);
							}
							echo '<li class="breadcrumb-item">' . $cats . '</li>';
							if ($showCurrent) {
									echo '<li class="breadcrumb-item">' . get_the_title() . '</li>';
							}
					}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
					// some other single item
					$post_type = get_post_type_object(get_post_type());
					if (!empty($post_type)) {
							echo '<li class="breadcrumb-item">' . $post_type->labels->singular_name . '</li>';
					}
			} elseif (is_attachment()) {
					// attachment section
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID);
					if (isset($cat[0])) {
							$cat = $cat[0];
					} else {
							$cat = false;
					}
					if ($cat) {
							echo get_category_parents($cat, true, ' ' . ' ' . ' ');
					}
					echo '<li class="breadcrumb-item"><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
					if ($showCurrent) {
							echo '<li class="breadcrumb-item">' . get_the_title() . '</li>';
					}
			} elseif (is_page() && !$post->post_parent) {
					if ($showCurrent) {
							echo '<li class="breadcrumb-item">' . get_the_title() . '</li>';
					}
			} elseif (is_page() && $post->post_parent) {
					// child page
					$parent_id = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
							$page = get_page($parent_id);
							$breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
							$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
							printf( '%s', $breadcrumbs[$i] );
							if ($i != count($breadcrumbs) - 1) {
									;
							}
					}
					if ($showCurrent) {
							echo '<li class="breadcrumb-item">' . get_the_title() . '</li>';
					}
			} elseif (is_tag()) {
					// tags archive
					echo '<li class="breadcrumb-item">' . esc_html__('Posts tagged', 'kalkulat') . ' "' . single_tag_title('', false) . '"' . '</li>';
			} elseif (is_author()) {
					// author archive
					global $author;
					$userdata = get_userdata($author);
					echo '<li class="breadcrumb-item">' . esc_html__('Articles posted by', 'kalkulat') . ' ' . $userdata->display_name . '</li>';
			} elseif (is_404()) {
					// 404
					echo '<li class="breadcrumb-item">' . esc_html__('Not Found', 'kalkulat') . '</li>';
			} elseif (is_home()) {
					if ($showCurrent) {
							echo '<li class="breadcrumb-item">' . wp_title('', false) . '</li>';
					}
			}

			if (get_query_var('paged')) {
					if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
							echo '<li class="paged-page breadcrumb-item">(';
					}
					echo esc_html__('Page', 'kalkulat') . ' ' . get_query_var('paged');
					if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
							echo ')</li>';
					}
			}
	}
}

/**
* comments list
*/
if(!function_exists('kalkulate_comment_list')){
	function kalkulate_comment_list($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		$avatar = get_avatar( $comment,70,null,null,array('class'=>array('media-object')));
	?>
		<li id="comment-<?php comment_ID(); ?>" class="Block-Comment">
			<?php if($avatar != null) : ?>
			<div class="media-left">
				<?php print get_avatar( $comment,70,null,null,array('class'=>array('media-object'))); ?>
			</div>
			<?php endif; ?>
			<div class="media-body">
				<h4 class="entry-title"><?php print get_comment_author_link(); ?></h4>
				<span class="entry-meta">
					<em>
					<?php comment_date('h:i a'); esc_html_e( ' / ', 'kalkulat' ); comment_date( get_option( 'date_format' ) ); ?>
					</em>
				</span>
				<?php comment_text(); ?>
				<p class="replay">
					<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text'=> '<i class="fa fa-reply"></i> ' . esc_html__('Reply','kalkulat') ) ) ); ?>
				</p>
			</div>
	<?php
	}
}

/**
* kalkulate social icons
*/
if(!function_exists('kalkulate_social_icons')){
	function kalkulate_social_icons(){
		$output = '';
			$facebook = get_theme_mod( 'facebook' );
			$twitter = get_theme_mod( 'twitter' );
			$google_plus = get_theme_mod( 'google_plus' );
			$youtube = get_theme_mod( 'youtube' );
			$pinterest = get_theme_mod( 'pinterest' );
			$linkedin = get_theme_mod( 'linkedin' );
			$skype = get_theme_mod( 'skype' );
			$instagram = get_theme_mod( 'instagram' );
			if(!empty($facebook)){
				$output .='<a href="'.esc_url( $facebook ).'"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
			}
			if(!empty($twitter)){
				$output .='<a href="'.esc_url( $twitter ).'"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
			}
			if(!empty($google_plus)){
				$output .='<a href="'.esc_url( $google_plus ).'"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
			}
			if(!empty($youtube)){
				$output .='<a href="'.esc_url( $youtube ).'"><i class="fa fa-youtube" aria-hidden="true"></i></a>';
			}
			if(!empty($pinterest)){
				$output .='<a href="'.esc_url( $pinterest ).'"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
			}
			if(!empty($linkedin)){
				$output .='<a href="'.esc_url( $linkedin ).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
			}
			if(!empty($skype)){
				$output .='<a href="'.esc_url( $skype ).'"><i class="fa fa-skype" aria-hidden="true"></i></a>';
			}
			if(!empty($instagram)){
				$output .='<a href="'.esc_url( $instagram ).'"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
			}
		return $output;
	}
}


/**
 * Kalkulate Menu
 */
if(!function_exists('kalkulate_menus')){
	function kalkulate_menus(){
		$menu_style = get_theme_mod( 'menu_style' );
		if($menu_style == 'two'){
			?>
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
			   <header class="kalkulat-header home-one-header ">
					<!-- == Top bar  ==-->
					<div class="topbar-area white-bg">
						<div class="container">
							<div class="topbar">
								<div class="logo">
									<?php  
										$header_logo = get_theme_mod('header_logo');
									?>
									<a href="<?php print esc_url( home_url('/') ); ?>">
										<img src="<?php (!empty($header_logo) ? print esc_url( $header_logo ) : print get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php esc_attr_e( 'Logo', 'kalkulat' ); ?>">
									</a>
								</div>
								<?php 
									$topbar_location_icon = get_theme_mod( 'topbar_Location_icon' );
									$topbar_Location = get_theme_mod( 'topbar_Location' );
									$topbar_mail_icon = get_theme_mod( 'topbar_mail_icon' );
									$topbar_mail = get_theme_mod( 'topbar_mail' );
									$topbar_phone_icon = get_theme_mod( 'topbar_phone_icon' );
									$topbar_phone = get_theme_mod( 'topbar_phone' );

									if(!empty($topbar_Location) || !empty($topbar_mail) || !empty($topbar_phone)) :
								?>
								<div class="topbar-contact-info">
									<?php 
										if(!empty($topbar_Location)) :
									?>
									<div class="single-contat-info">
										<?php 
											if($topbar_location_icon != true) :
										?>
										<div class="icon">
											<span>
												<i class="fa fa-map-marker"></i>
											</span>
										</div>
										<?php 
											endif; // close $topbar_Location_icon
										?>
										<div class="text">
											<?php print wp_kses($topbar_Location, array('br' => array())); ?>
										</div>
									</div><!--/.single-contat-info-->
									<?php 
										endif; // close $topbar_Location

										if(!empty($topbar_mail)) :
									?>
									<div class="single-contat-info">
										<?php 
											if($topbar_mail_icon != true) :
										?>
										<div class="icon">
											<a href="mailto:<?php print esc_html( $topbar_mail ); ?>">
												<span>
													<i class="fa fa-envelope-o"></i>
												</span>
											</a>
										</div>
										<?php 
											endif; // close $topbar_Location_icon
										?>
										<div class="text">
											<?php print wp_kses($topbar_mail, array('br' => array())); ?>
										</div>
									</div><!--/.single-contat-info-->
									<?php 
										endif; // $topbar_mail

										if(!empty($topbar_phone)) :
									?>
										<div class="single-contat-info">
											<?php if($topbar_phone_icon != true) : ?>
												<div class="icon">
													<span><i class="fa fa-phone"></i></span>
												</div>
											<?php endif; //topbar_phone_icon ?>
											<div class="text">
												<?php print wp_kses($topbar_phone, array('br' => array())); ?>
											</div>
										</div><!--/.single-contat-info-->
									<?php endif; ?>
								</div>
								<?php 
									endif; // close main condition
								?>
							</div>
						</div>
					</div>
					<!-- /. Top bar  -->
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
									'fallback_cb'       => ' ' 
								) );
							?>
						</div>
				</nav>
				</header>
				<div class="slider-area">
					<div class="menu2-area desktop-menu">
						<div class="container">
							<div class="menu2-wrapper">
								<div class="menu-social">
									<?php print kalkulate_social_icons(); ?>
								</div>
								<nav id="easy-menu">
									<?php 
										wp_nav_menu( array( 
											'theme_location'    => 'main_menu',
											'menu_class'        => 'main-menu-list style-two',
											'menu_id'           => 'main_navbar',
											'fallback_cb'       => ' ' 
										) );
									?>
								</nav><!--#easy-menu-->
							<div class="search-box">
								<?php 
							        $menu_search_status = get_theme_mod( 'menu_search_status' );
							        if($menu_search_status != true) :
							    ?>
									<a href="#!">
										<i class="fa fa-search search-icon"></i>
									</a>
								<?php endif; ?>

									<?php if(function_exists('kalkulate_woo_miniCart')) { 
										?>
										<div class="product-cart-list">
											<?php  kalkulate_woo_miniCart(); ?>
										</div>
									<?php
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

			<?php
		}else if($menu_style == 'three'){
			?>	
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
									'fallback_cb'       => ' ' 
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
											'fallback_cb'       => ' ' 
										) );
									?>
								</nav><!--#easy-menu-->
							</div>
						</div>
					</div>
				</div>
			<?php
		}else if($menu_style == 'four'){
			?>
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
				    <div class="topbar-two bg-gray">
				        <div class="container">
				            <?php if(!empty($topbar_phone_two) && !empty($topbar_mail_two)) : ?>
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
				            <?php endif; ?>
				            <div class="col-sm-4">
				                <div class="text-right topbar-social-icons">
				                    <?php print kalkulate_social_icons(); ?>
				                </div>
				            </div>
				        </div>
				    </div> 
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
				    <div class="menu-style4 desktop-menu">
				        <div class="container">
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

			<?php
		}else if($menu_style == 'five'){
			?>
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
				    <div class="menu-style4 desktop-menu">
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

			<?php
		}else {
			?>
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
								'fallback_cb'       => ' ' 
							) );
						?>
					</div>
				</nav><!--/.mobile-background-nav-->
			</header><!--/.kalkulat-header-->
			<?php
		}
	}
	add_action('kalkulate_after_body', 'kalkulate_menus');
}


/**
 * Kalkulat hex to rgb
 */
if(!function_exists('kalkulat_hextorgba')){
  function kalkulat_hextorgba($hex, $opacity = '1'){
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    return "rgba($r,$g,$b,$opacity)";
  }
}


/**
* Kalkulate inline image
*/
if(!function_exists('kalkulate_background_image_load')){
	function kalkulate_background_image_load(){
		// Header bg
		$header_background = get_theme_mod( 'header_background' );
		if($header_background == ''){
			$header_background = get_template_directory_uri() . '/images/page-title.jpg';
		}

		$custom_css = "
			.blog-grid-banner {
				background-image: url($header_background);
			}
		";

		/**
		 * Set color from customizer
		 */
		$main_color = get_option( 'kal_main_color' );
		if($main_color != false && $main_color !='#1490d7') :
			$custom_css .="
				.t3s {
					transition: all 0.3s ease 0s;
				}

				a:hover, a:focus, a.active {
					color: $main_color;
				}

				.base-color,
					.single-contat-info:hover .icon span,
					.we-do-item:hover .text a,
					.base-bg .kal-button:hover,
					.usefull-link li a:hover,
					.gallery-filter ul li a:hover,
					.gallery-filter ul li a:focus,
					.top-search-input-wrap .search-wrap .search.educon-top-search .sp_search_input::after,
					.slider-button .kal-button:hover {
					color: $main_color;
				}

				.single-contat-info:hover .icon span,
				.owl-theme .owl-controls .owl-page.active span,
				.blog-style-one:hover,
				.blog-style-one:hover .date,
				.base-border,
				.kal-button:hover,
				input[type='text']:focus,
				input[type='password']:focus,
				input[type='date']:focus,
				input[type='url']:focus,
				input[type='search']:focus,
				input[type='text']:focus,
				input[type='email']:focus,
				input[type='time']:focus,
				input[type='text']:focus,
				.form-control:focus,
				textarea:focus,
				textarea.form-control:focus,
				.white .m-contact-btn a,
				.white-bg .m-contact-btn a,
				.tag-list a:hover {
				border-color: $main_color;
				}

				.base-bg,
				#easy-menu ul ul,
				.accordion-toggle:not(.collapsed)::before,
				.progress-item .progress-bg .progress-rate,
				.owl-theme .owl-controls .owl-page.active span,
				.service-item:hover,
				.work-sction::before,
				.social-icons li a::before,
				.usefull-link li a:hover::before,
				.kal-button:hover,
				.preloader,
				.shop-tab .nav-tabs li.active a,
				.white .m-contact-btn a:hover,
				.white-bg .m-contact-btn a:hover,
				.shop-tab .nav-tabs li a:hover {
				background: $main_color;
				}

				.menu2-area.main-menu-fix, .kalkulate-single-intro::before {
				background: $main_color !important;
				}

				.banner-area::before {
					background: ".kalkulat_hextorgba($main_color, 0.7).";
				}
			";
		endif;	

		wp_add_inline_style( 'kalkulat-main-stylesheet', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'kalkulate_background_image_load' );