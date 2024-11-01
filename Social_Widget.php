<?php
/*
Plugin Name: Social Icon Link
Description: This plugin easily make you able to add three different Social links and their icon on widget area.
According to this these three icon will be appeared on sidebar.
Author: S.B. ACUMEN
Version: 1
*/



class Social_Icon_Link extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'social_icon_link', // Base ID
			__('Social Links', 'text_domain'), // Name
			array( 'description' => __( 'Social Links', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$fb_link = apply_filters( 'widget_title', $instance['fb_link'] );
		$tw_link = apply_filters( 'widget_title', $instance['tw_link'] );
		$gp_link = apply_filters( 'widget_title', $instance['gp_link'] );
		
		echo $args['before_widget'];
		if ( ! empty( $fb_link ) ){
			echo "<a href=\"$fb_link\" target=\"_blank\"><img src=\"$instance[fb_icon_url]\" /></a>";
		}
		if ( ! empty( $tw_link ) ){
			echo "<a href=\"$tw_link\" target=\"_blank\"><img src=\"$instance[tw_icon_url]\" /></a>";
			
		}
		if ( ! empty( $gp_link ) ){
			echo "<a href=\"$gp_link\" target=\"_blank\"><img src=\"$instance[gp_icon_url]\" /></a>";
			
		}
			
		echo $args['after_widget'];
		
	
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		//FB
		if ( isset( $instance[ 'fb_link' ] ) ) {
			$title_fb = $instance[ 'fb_link' ];
		}
		if ( isset( $instance[ 'fb_icon_url' ] ) ) {
			$fb_icon = $instance[ 'fb_icon_url' ];
		}
		//TW
		if ( isset( $instance[ 'tw_link' ] ) ) {
			$title_tw = $instance[ 'tw_link' ];
		}
		if ( isset( $instance[ 'tw_link' ] ) ) {
			$tw_icon = $instance[ 'tw_icon_url' ];
		}
		// GP
		if ( isset( $instance[ 'gp_link' ] ) ) {
			$title_gp = $instance[ 'gp_link' ];
		}
		if ( isset( $instance[ 'tw_link' ] ) ) {
			$gp_icon = $instance[ 'gp_icon_url' ];
		}
		
		
		if(function_exists( 'wp_enqueue_media' )){
			wp_enqueue_media();
		}else{
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
		}
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'fb_link' ); ?>"><?php _e( 'FB LINK:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'fb_link' ); ?>" name="<?php echo $this->get_field_name( 'fb_link' ); ?>" type="text" value="<?php echo esc_attr( $title_fb ); ?>">
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('fb_icon_url'); ?>">Image</label><br />
			
			<input class="fb_icon_url" type="text" id="<?php echo $this->get_field_id( 'fb_icon_url' ); ?>" name=<?php echo $this->get_field_name( 'fb_icon_url' ); ?> value="<?php echo esc_attr( $fb_icon ); ?>" />
			<a href="#" class="button custom_media_upload_fb"><?php _e('Upload', 'THEMENAME'); ?></a>
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'tw_link' ); ?>"><?php _e( 'TWITTER LINK:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'tw_link' ); ?>" name="<?php echo $this->get_field_name( 'tw_link' ); ?>" type="text" value="<?php echo esc_attr( $title_tw ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('tw_icon_url'); ?>">Image</label><br />
			
			<input class="tw_icon_url" type="text" id="<?php echo $this->get_field_id( 'tw_icon_url' ); ?>" name=<?php echo $this->get_field_name( 'tw_icon_url' ); ?> value="<?php echo esc_attr( $tw_icon ); ?>" />
			<a href="#" class="button custom_media_upload_tw"><?php _e('Upload', 'THEMENAME'); ?></a>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'gp_link' ); ?>"><?php _e( 'GOOGLE PLUG LINK:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'gp_link' ); ?>" name="<?php echo $this->get_field_name( 'gp_link' ); ?>" type="text" value="<?php echo esc_attr( $title_gp ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('gp_icon_url'); ?>">Image</label><br />
			
			<input class="gp_icon_url" type="text" id="<?php echo $this->get_field_id( 'gp_icon_url' ); ?>" name=<?php echo $this->get_field_name( 'gp_icon_url' ); ?> value="<?php echo esc_attr( $gp_icon ); ?>" />
			<a href="#" class="button custom_media_upload_gp"><?php _e('Upload', 'THEMENAME'); ?></a>
		</p>
		<script>
			jQuery(document).ready( function(){
			jQuery('.custom_media_upload_fb').click(function(e) {
    e.preventDefault();

    var custom_uploader = wp.media({
        title: 'upload icon',
        button: {
            text: 'update'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();

        jQuery('.fb_icon_url').val(attachment.url);
        jQuery('.custom_media_id').val(attachment.id);
    })
    .open();
});

jQuery('.custom_media_upload_tw').click(function(e) {
    e.preventDefault();

    var custom_uploader = wp.media({
        title: 'upload icon',
        button: {
            text: 'update'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();

        jQuery('.tw_icon_url').val(attachment.url);
        jQuery('.custom_media_id').val(attachment.id);
    })
    .open();
});
jQuery('.custom_media_upload_gp').click(function(e) {
    e.preventDefault();

    var custom_uploader = wp.media({
        title: 'upload icon',
        button: {
            text: 'update'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery('.gp_icon_url').val(attachment.url);
        jQuery('.custom_media_id').val(attachment.id);
    })
    .open();
});
			 
	});
		</script>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
	print_r($instance);
		$instance = array();
		$instance['fb_link'] = ( ! empty( $new_instance['fb_link'] ) ) ? strip_tags( $new_instance['fb_link'] ) : '';
		$instance['fb_icon_url'] = ( ! empty( $new_instance['fb_icon_url'] ) ) ? strip_tags( $new_instance['fb_icon_url'] ) : '';
		
		
		$instance['tw_link'] = ( ! empty( $new_instance['tw_link'] ) ) ? strip_tags( $new_instance['tw_link'] ) : '';
		$instance['tw_icon_url'] = ( ! empty( $new_instance['tw_icon_url'] ) ) ? strip_tags( $new_instance['tw_icon_url'] ) : '';
		
		
		$instance['gp_link'] = ( ! empty( $new_instance['gp_link'] ) ) ? strip_tags( $new_instance['gp_link'] ) : '';
		$instance['gp_icon_url'] = ( ! empty( $new_instance['gp_icon_url'] ) ) ? strip_tags( $new_instance['gp_icon_url'] ) : '';

		return $instance;
	}

} // class Foo_Widget
add_action( 'widgets_init', create_function('', 'return register_widget("Social_Icon_Link");') );?>
