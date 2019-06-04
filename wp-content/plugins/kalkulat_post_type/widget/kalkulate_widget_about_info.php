<?php
// Register and load the widget
function kalkulate_about_info_load_widget() {
    register_widget( 'kalkulate_about_info_widget' );
}
add_action( 'widgets_init', 'kalkulate_about_info_load_widget' );
 
// Creating the widget 
class kalkulate_about_info_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'kalkulate_about_info_widget', 
 
// Widget name will appear in UI
__('kalkulat About Info', 'kalkulat'), 
 
// Widget description
array( 'description' => __( 'add contact info and social links', 'kalkulat' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
	extract($args);

	$old_class_name = (isset($instance[ 'old_class_name' ]) ? $instance[ 'old_class_name' ] : 'col-md-4');
	$new_class_name = (isset($instance[ 'new_class_name' ]) ? $instance[ 'new_class_name' ] : '');
	$title 		= (isset($instance[ 'title' ]) ? $instance[ 'title' ] : '');
	$address 	= (isset($instance[ 'address' ]) ? $instance[ 'address' ] : '');
	$phone 		= (isset($instance[ 'phone' ]) ? $instance[ 'phone' ] : '');
	$mail 		= (isset($instance[ 'mail' ]) ? $instance[ 'mail' ] : '');
	$website 	= (isset($instance[ 'website' ]) ? $instance[ 'website' ] : '');

	$contact_title 	= (isset($instance[ 'contact_title' ]) ? $instance[ 'contact_title' ] : '');
	$facebook 		= (isset($instance[ 'facebook' ]) ? $instance[ 'facebook' ] : '');
	$twitter 		= (isset($instance[ 'twitter' ]) ? $instance[ 'twitter' ] : '');
	$google_plus 	= (isset($instance[ 'google_plus' ]) ? $instance[ 'google_plus' ] : '');

	
	$widget_width = !empty($instance['new_class_name']) ? $instance['new_class_name'] : "";
    $old_widget_width = !empty($instance['old_class_name']) ? $instance['old_class_name'] : "";
    if(!empty($widget_width) && $widget_width != ''){
        $before_widget = str_replace($old_widget_width, ''. $widget_width . ' ', $before_widget);
    }


echo $before_widget;
echo $args['before_title'] . $title . $args['after_title'];
?>
<ul class="contact-info">
	<?php 
		if($address != null){
			print '<li><span><i class="fa fa-home"></i>'.$address.'</span></li>';
		}
		if($phone != null){
			print '<li><span><i class="fa fa-phone"></i>'.$phone.'</span></li>';
		}
		if($mail != null){
			print '<li><span><i class="fa fa-envelope-o"></i>'.$mail.'</span></li>';
		}
		if($website != null){
			print '<li><span><i class="fa fa-share-square-o"></i>'.$website.'</span></li>';
		}
	?>
</ul>
<?php 
	if($contact_title != null){
		print '<h3 class="section-header section-title">'.$contact_title.'</h3>';
	}
?>
<ul class="social-media">
	<?php 
		if($facebook != null){
			print '<li><a href="'.esc_url($facebook).'" class="facebook"><i class="icon-facebook"></i></a></li>';
		}
		if($twitter != null){
			print '<li><a href="'.esc_url($twitter).'" class="twitter"><i class="icon-twitter"></i></a></li>';
		}
		if($google_plus != null){
			print '<li><a href="'.esc_url($google_plus).'" class="google-plus"><i class="icon-googleplus"></i></a></li>';
		}
	?>
</ul>
<?php
	echo $after_widget;
}
         
// Widget Backend 
public function form( $instance ) {
	$old_class_name = (isset($instance[ 'old_class_name' ]) ? $instance[ 'old_class_name' ] : 'col-md-4');
	$new_class_name = (isset($instance[ 'new_class_name' ]) ? $instance[ 'new_class_name' ] : '');
	$title 			= (isset($instance[ 'title' ]) ? $instance[ 'title' ] : '');

	$facebook 		= (isset($instance[ 'facebook' ]) ? $instance[ 'facebook' ] : '');
	$twitter 		= (isset($instance[ 'twitter' ]) ? $instance[ 'twitter' ] : '');
	$google_plus 	= (isset($instance[ 'google_plus' ]) ? $instance[ 'google_plus' ] : '');

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
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'kalkulat' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php esc_html_e( 'Facebook:', 'kalkulat' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php esc_html_e( 'Twitter:', 'kalkulat' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'google_plus' ); ?>"><?php esc_html_e( 'Google Plus:', 'kalkulat' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'google_plus' ); ?>" name="<?php echo $this->get_field_name( 'google_plus' ); ?>" type="text" value="<?php echo esc_attr( $google_plus ); ?>" />
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['old_class_name'] = ( ! empty( $new_instance['old_class_name'] ) ) ? strip_tags( $new_instance['old_class_name'] ) : 'col-md-4';
$instance['new_class_name'] = ( ! empty( $new_instance['new_class_name'] ) ) ? strip_tags( $new_instance['new_class_name'] ) : '';
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
$instance['google_plus'] = ( ! empty( $new_instance['google_plus'] ) ) ? strip_tags( $new_instance['google_plus'] ) : '';
return $instance;
}
} // Class wpb_widget ends here