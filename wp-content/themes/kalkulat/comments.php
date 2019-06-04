<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage kalkulat
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * 
 */
 
	if(post_password_required()){
		return;
	} 
?>
<?php if(number_format_i18n( get_comments_number() ) != 0) : ?>
<div class="comments-area">
    <h3 class="comments-title"><?php comments_number( esc_html__( 'No Comment', 'kalkulat' ), esc_html__( 'One Comment', 'kalkulat' ), esc_html__( '% comments', 'kalkulat' ) ); ?></h3>

    <ul class="comment-list">
        <?php 
			if( number_format_i18n( get_comments_number() ) > 0 ) {
				wp_list_comments(array(
            		'style'			=> 'ul',
            		'callback'		=> 'kalkulate_comment_list',
            		'short_ping'	=> true
				));
			}
		?>
    </ul>
	<?php 
	 	the_comments_navigation( array(
	 		'screen_reader_text' => ' '
		) ); 
	?>
</div>
<?php endif; ?>

<!-- Comments Form -->
<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ($req ? " aria-required='true' " : '');
	$required_text = ' ';
	$args = array(
		'class_form'	=> 'send-comment',
		'title_reply'	=> esc_html__( 'Leave A Comment', 'kalkulat' ),
		'submit_button'	=> '<button type="submit" class="kal-button base-bg">'.esc_html__( 'Submit', 'kalkulat' ).'</button>',
		'comment_field'	=> '<div class="form-group">
								<textarea name="comment" placeholder="'.esc_html__( 'Comment', 'kalkulat' ).'" '.$aria_req.' rows="10"></textarea>	
							</div>',
		'fields'		=> apply_filters( 'comment_form_default_fields', array(
			'author'    => '<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<input type="text" class="form-control" name="author" value="'.esc_attr( $commenter['comment_author'] ).'" '.$aria_req.' placeholder="'.esc_html__( 'Name *', 'kalkulat' ).'">
									</div>',
					'email'		=> '<div class="col-sm-6">
										<input type="email" class="form-control" name="email" value="'.esc_attr( $commenter['comment_author_email'] ).'" '.$aria_req.' placeholder="'.esc_html__( 'Email *', 'kalkulat' ).'">
									</div>
								</div>
							</div>'
		)),
		'label_submit'	=> esc_html__( 'Submit', 'kalkulat' ),
	);
	comment_form( $args );
?>

