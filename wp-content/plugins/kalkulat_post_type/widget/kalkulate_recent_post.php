<?php 

	
// Register and load the widget
function kalkulate_recent_post_load_widget() {
    register_widget( 'kalkulate_recent_post' );
}
add_action( 'widgets_init', 'kalkulate_recent_post_load_widget' );



 
// Creating the widget 
class kalkulate_recent_post extends WP_Widget {
 
	function __construct() {
		parent::__construct(
		 
		// Base ID of your widget
		'kalkulate_recent_post', 
		 
		// Widget name will appear in UI
		__('kalkulat Recent Post', 'kalkulat'), 
		 
		// Widget description
		array( 'description' => __( 'Add kalkulat Recent Post widget ', 'kalkulat' ), ) 
		);
	}
	 
	// Creating widget front-end
	 
	public function widget( $args, $instance ) {
		extract($args);

		$old_class_name = (isset($instance[ 'old_class_name' ]) ? $instance[ 'old_class_name' ] : 'col-md-4');
		$new_class_name = (isset($instance[ 'new_class_name' ]) ? $instance[ 'new_class_name' ] : '');
		$title 		= (isset($instance['title']) ? $instance['title'] : '');
		$order 		= (isset($instance['order']) ? $instance['order'] : '');
		$post_limit = (isset($instance['post_limit']) ? $instance['post_limit'] : '');

		$widget_width = !empty($instance['new_class_name']) ? $instance['new_class_name'] : "";
	    $old_widget_width = !empty($instance['old_class_name']) ? $instance['old_class_name'] : "";
	    if(!empty($widget_width) && $widget_width != ''){
	        $before_widget = str_replace($old_widget_width, ''. $widget_width . ' ', $before_widget);
	    }
		 
		// before and after widget arguments are defined by themes
		print $before_widget;
		print $args['before_title'] . $title . $args['after_title']; 
		 
		// This is where you run the code and display the output
		$output = '';
			$output .='<div class="footer-block">
                <div class="news-footer">';
					$sevice_query = new WP_Query(array('post_type'=> 'post', 'order'=> $order , 'posts_per_page'=> $post_limit));
            		if($sevice_query->have_posts()) :
						while($sevice_query->have_posts()) : $sevice_query->the_post();
							$output .='<div class="footer-widget usefull-link">
					            <div class="latest-news-item">
					                <div class="image">
					                    '.get_the_post_thumbnail( null, 'kalkulate-widget-recent-post-thumb', array('class'=> 'img-responsive') ).'
					                </div>
					                <div class="text">
					                    <h5><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h5>
					                    <span class="date">'.get_the_time(get_option( 'date_format' )).'</span>
					                </div>
					            </div>
					        </div>';	
						
						endwhile;
					endif;
                $output .='</div>
            </div>';
		print $output;
		

		print $after_widget;
	}
	         
	// Widget Backend 
	public function form( $instance ) {
		$old_class_name = (isset($instance[ 'old_class_name' ]) ? $instance[ 'old_class_name' ] : 'col-md-4');
		$new_class_name = (isset($instance[ 'new_class_name' ]) ? $instance[ 'new_class_name' ] : '');
		$title 		= (isset($instance['title']) ? $instance['title'] : '');
		$order 		= (isset($instance['order']) ? $instance['order'] : '');
		$post_limit = (isset($instance['post_limit']) ? $instance['post_limit'] : '');


		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'old_class_name' ); ?>"><?php _e( 'Old Class Name:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'old_class_name' ); ?>" name="<?php echo $this->get_field_name( 'old_class_name' ); ?>" type="text" value="<?php echo esc_attr( $old_class_name ); ?>" />
		</p>
		<!-- new class class -->
		<p>
			<label for="<?php echo $this->get_field_id( 'new_class_name' ); ?>"><?php _e( 'New Class Name:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'new_class_name' ); ?>" name="<?php echo $this->get_field_name( 'new_class_name' ); ?>" type="text" value="<?php echo esc_attr( $new_class_name ); ?>" />
		</p>
		<p>
			<label for="<?php print $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'kalkulat' ); ?></label>
			<input class="widefat" type="text" id="<?php print $this->get_field_id('title'); ?>" name="<?php print $this->get_field_name('title'); ?>" value="<?php print esc_attr($title); ?>">
		</p>
		<p>
			<label for="<?php print $this->get_field_id('order'); ?>"><?php esc_html_e( 'Order:', 'kalkulat' ); ?></label>
			<input class="widefat" type="text" id="<?php print $this->get_field_id('order'); ?>" name="<?php print $this->get_field_name('order'); ?>" value="<?php print esc_attr($order); ?>">
		</p>
		<p>
			<label for="<?php print $this->get_field_id('post_limit'); ?>"><?php esc_html_e( 'Post limit:', 'kalkulat' ); ?></label>
			<input class="widefat" type="text" id="<?php print $this->get_field_id('post_limit'); ?>" name="<?php print $this->get_field_name('post_limit'); ?>" value="<?php print esc_attr($post_limit); ?>">
		</p>



		<?php 
	}


	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['old_class_name'] = ( ! empty( $new_instance['old_class_name'] ) ) ? strip_tags( $new_instance['old_class_name'] ) : 'col-md-4';
		$instance['new_class_name'] = ( ! empty( $new_instance['new_class_name'] ) ) ? strip_tags( $new_instance['new_class_name'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
		$instance['post_limit'] = ( ! empty( $new_instance['post_limit'] ) ) ? strip_tags( $new_instance['post_limit'] ) : '';
		return $instance;
	}

} // Class wpb_widget ends here


?>