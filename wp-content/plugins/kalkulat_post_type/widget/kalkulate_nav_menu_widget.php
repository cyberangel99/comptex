<?php
// Register and load the widget
function kalkulate_Nav_Menu_Widget_load_widget() {
    register_widget( 'kalkulate_Nav_Menu_Widget' );
}
add_action( 'widgets_init', 'kalkulate_Nav_Menu_Widget_load_widget' );

class kalkulate_Nav_Menu_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'description' => __( 'Add a navigation menu to your sidebar.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'kalkulate_Nav_Menu_Widget', __('kalkulate Navigation Menu'), $widget_ops );
	}
	public function widget( $args, $instance ) {
        extract($args);
        $widget_width = !empty($instance['new_class_name']) ? $instance['new_class_name'] : "";
        $old_widget_width = !empty($instance['old_class_name']) ? $instance['old_class_name'] : "";
        if(!empty($widget_width) && $widget_width != ''){
            $before_widget = str_replace($old_widget_width, ''. $widget_width . ' ', $before_widget);
        }
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		/* This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $before_widget;

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu'        => $nav_menu
		);

		
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );
        echo $after_widget;
    }
    
	public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['old_class_name'] = ( ! empty( $new_instance['old_class_name'] ) ) ? strip_tags( $new_instance['old_class_name'] ) : '';
        $instance['new_class_name'] = ( ! empty( $new_instance['new_class_name'] ) ) ? strip_tags( $new_instance['new_class_name'] ) : '';

		
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
    }
    
	public function form( $instance ) {
		global $wp_customize;
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
        $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
        
        $old_class_name =  (isset($instance[ 'old_class_name' ]) ? $instance[ 'old_class_name' ] : 'col-md-4');
		$new_class_name =  (isset($instance[ 'new_class_name' ]) ? $instance[ 'new_class_name' ] : '');

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
        ?>
        <!-- repalce class -->
		<p>
			<label for="<?php echo $this->get_field_id( 'old_class_name' ); ?>"><?php _e( 'Old Class Name:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'old_class_name' ); ?>" name="<?php echo $this->get_field_name( 'old_class_name' ); ?>" type="text" value="<?php echo esc_attr( $old_class_name ); ?>" />
		</p>
		<!-- new class class -->
		<p>
			<label for="<?php echo $this->get_field_id( 'new_class_name' ); ?>"><?php _e( 'New Class Name:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'new_class_name' ); ?>" name="<?php echo $this->get_field_name( 'new_class_name' ); ?>" type="text" value="<?php echo esc_attr( $new_class_name ); ?>" />
		</p>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
					<button type="button" class="button"><?php _e( 'Edit Menu' ) ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}