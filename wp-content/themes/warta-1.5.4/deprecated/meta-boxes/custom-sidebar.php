<?php
/**
 * Custom Sidebar Meta Box
 * 
 * @package Warta
 */

class Warta_Custom_Sidebar_Meta_Box {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
        $old_value = get_post_meta( $GLOBALS['post']->ID, 'friskamax_custom_sidebar', TRUE);        
        if( empty( $old_value ) ) {
                return;
        } 
            
        if ( $post_type == 'page' ) { //limit meta box to certain post types
            add_meta_box(
                'warta_custom_sidebar_meta_box'
                ,__( 'Custom Sidebar Content', 'warta' )
                ,array( $this, 'render_meta_box_content' )
                ,$post_type
                ,'normal'
                ,'high'
            );
        }
	}

	/**
	 * Save the meta when the post is saved.
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['warta_custom_sidebar_field'] ) )
			return $post_id;

		$nonce = $_POST['warta_custom_sidebar_field'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'warta_custom_sidebar_action' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$mydata = wp_kses_post( $_POST['warta_custom_sidebar'] );

		// Update the meta field.
		update_post_meta( $post_id, 'friskamax_custom_sidebar', $mydata );
	}


	/**
	 * Render Meta Box content.
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'warta_custom_sidebar_action', 'warta_custom_sidebar_field' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = wp_kses_post( get_post_meta( $post->ID, 'friskamax_custom_sidebar', true ) );            

		// Display the form, using the current value.
        wp_editor( $value, 'warta_custom_sidebar' );
	}
}