<?php

/**
*  This class will remove default comment_form() tag and replace with the shortcode.
*/
class wpad_remove_default_comment_tag {
	
	function __construct() {

		add_filter( 'comments_array', array( $this , 'remove_default_comment_list' ) , 100 , 2 );
		add_filter( 'comment_form_default_fields', array( $this , 'remove_default_comment_fields' ) );
		add_filter( 'comment_form_defaults', array( $this , 'remove_comment_field'  ) );
		add_filter( 'comment_form_field_comment', array( $this , 'comment_form_field_comment' )  );
		add_filter( 'cancel_comment_reply_link' , array( $this , 'cancel_comment_reply_link' )  );
		add_action( 'comment_form_before' , array( $this , 'add_shortcode_before_comment' )  );
		add_filter( 'comments_template' , array( $this , 'disable_comment_template' ) , 1 , 1 );

		// Remove default admin bar comment link
		add_action( 'wp_before_admin_bar_render', array( $this , 'wpad_remove_admin_bar_links' ) );

		// Add WPAD Comment link to the admin bar
		add_action( 'admin_bar_menu', array( $this , 'toolbar_link_to_comment' ), 999 );

		// Remove comment column from pages
		add_filter( 'manage_pages_columns' , array( $this , 'remove_pages_count_columns' ) );

		// Remove comment column from posts
		add_filter( 'manage_posts_columns' , array( $this , 'remove_posts_count_columns' ) );
		
	}

	function remove_posts_count_columns( $columns ) {
	  	unset( $columns['comments'] );
	 	return $columns;
	}

	function remove_pages_count_columns( $defaults ){

		unset($defaults['comments']);
		return $defaults;

	}

	function toolbar_link_to_comment( $wp_admin_bar ){

		$pending_comments = get_comments( array( 'status' => 'hold' ) );
		$no_of_comments = count( $pending_comments );

		$args = array(
			'id'    => 'wpad_pending_comment',
			'title' => $no_of_comments,
			'href'  => admin_url('/admin.php?page=wp_advance_comment'),
			'meta'  => 	array( 
							'class' => 'wpad_pending_comment',
							'title' => $no_of_comments . ' pending comment(s)'
						)
		);
		$wp_admin_bar->add_node( $args );

	}

	function wpad_remove_admin_bar_links(){

		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('comments'); 

	}

	function disable_comment_template( $theme_template ){

		global $post;

		/*
		** Hide comment form for Woocommerce products
		*/

		if( $post->post_type != 'product' && !class_exists( 'WooCommerce' ) ){
			$new_path = plugin_dir_path( __FILE__ ) . 'inc/shortcode_form.php';
			return $new_path;
		}

		/*
		** Dont't display comment form for product post type
		*/

		if( $post->post_type != 'product' ){
			$new_path = plugin_dir_path( __FILE__ ) . 'inc/shortcode_form.php';
			return $new_path;
		}

		return $theme_template;
	}

	function check_woocommerce( $post ){

		if( $post->post_type == 'product' && class_exists( 'WooCommerce' ) ){
			return true;
		} else {
			return false;
		}

	}

	function cancel_comment_reply_link( $text ){

		global $post;
		$check = $this->check_woocommerce( $post );

		if( $check === true ){
			return $text;
		}

		return '';
	}

	function comment_form_field_comment( $comment ){

		global $post;
		$check = $this->check_woocommerce( $post );

		if( $check === true ){
			return $comment;
		}

		$comment = '';
		return $comment;
	}

	/*
	** Removes the Comment textarea
	*/

	function remove_comment_field( $defaults ){

		global $post;
		$check = $this->check_woocommerce( $post );

		if( $check === true ){
			return $defaults;
		}

		$defaults['fields'] = '';
		$defaults['comment_field'] = '';
		$defaults['must_log_in'] = '';
		$defaults['logged_in_as'] = '';
		$defaults['comment_notes_before'] = '';
		$defaults['comment_notes_after'] = '';
		$defaults['id_form'] = '';
		$defaults['id_submit'] = '';
		$defaults['class_submit'] = '';
		$defaults['name_submit'] = '';
		$defaults['title_reply'] = '';
		$defaults['title_reply_to'] = '';
		$defaults['cancel_reply_link'] = '';
		$defaults['label_submit'] = '';
		$defaults['submit_button'] = '';
		$defaults['submit_field'] = '';
		$defaults['format'] = '';
		return $defaults;

	}

	/*
	** Removes the default comment list
	*/

	function remove_default_comment_list( $comments, $post_id ){

		global $post;
		$check = $this->check_woocommerce( $post );

		if( $check === true ){
			return $comments;
		}

		$comments = array();
		return $comments;
	}

	/*
	** It removes the default comment fields ( Name, Website , Email etc ... )
	*/

	function remove_default_comment_fields( $fields ){

		global $post;
		$check = $this->check_woocommerce( $post );

		if( $check === true ){
			return $fields;
		}

		$fields['author'] = '';
		$fields['email'] = '';
		$fields['url'] = '';
		return $fields;

	}

	function check_comment_disable_all_posts( $comment_forms , $post ){

		if( !empty($comment_forms) ){

			foreach( $comment_forms as $key => $value ){

				if( !empty( $comment_forms[$key] ) && $comment_forms[$key] == 'none' ){

					return $comment_forms[$key];

				}

			}

		}

		return null;

	}

	function add_shortcode_before_comment(){

		global $post;
		$check = $this->check_woocommerce( $post );

		if( $check === true ){
			return;
		}

		$comment_forms = get_option('wpad_comment_forms_on_posts');

		$id = $this->check_post_ids( $comment_forms , $post );

		if( $id == null ){
			$id = $this->check_all_post( $comment_forms , $post );
		}

		if( $id == null ){
			$id = $this->check_default_comment_selected( $comment_forms , $post );
		}

		if( $id == null ){

			$id = $this->check_comment_disable_all_posts( $comment_forms , $post );
		}

		if( !empty($id) && is_numeric($id) ){
			echo do_shortcode('[wpad-comment-form id="' . $id . '"]');
		} 
		elseif( $id == 'none' ) {
			return;
		} 
		else {
			$this->notice_no_comment_form_selected();
		}

	}

	function warning_css(){

		echo '<style>.wpad_notice {
			    border: 1px solid;
			    margin: 10px 0px;
			    padding:15px 10px 15px 30px;
			    background-repeat: no-repeat;
			    background-position: 10px center;
			}
			.wpad_notice {
			    color: #9F6000;
			    background-color: #FEEFB3;
			}</style>';

	}

	function notice_no_comment_form_selected(){

		if( current_user_can( 'administrator' ) ){
			
			$this->warning_css();
			echo "<div class='wpad_notice'>You haven't added any comment forms or the comment form is disabled on this page. This message was generated by the WP Advanced Comment. This message is shown to the administrator only.</div>";
		}

	}

	function check_default_comment_selected( $comment_forms , $post ){

		if( !empty($comment_forms) ){

			foreach( $comment_forms as $key => $value ){

				if( !empty( $comment_forms[$key]['show_on_all'] ) ){

					return $comment_forms[$key]['show_on_all'];

				}

			}

		}

		return null;

	}

	function check_all_post( $comment_forms , $post ){
		
		if( !empty($comment_forms) ){

			foreach( $comment_forms as $key => $value ){

				if( !empty( $comment_forms[$key]['enable_certain_pages']['all_posts'] ) ){

					foreach( $comment_forms[$key]['enable_certain_pages']['all_posts'] as $key1 => $post_type ){

						if( $post_type == $post->post_type ){

							return $key;

						}

					}

				}

			}

		}

		return null;

	}

	function check_post_ids( $comment_forms , $post ){

		if( !empty($comment_forms) ){

			foreach( $comment_forms as $key => $value ){

				if( !empty( $comment_forms[$key]['enable_certain_pages']['post_ids'] ) ){

					foreach( $comment_forms[$key]['enable_certain_pages']['post_ids'] as $post_id => $comment_form_id ){

						$id = $this->check_wpml_intall( $post );

						if( $id == $post_id ){

							return $comment_forms[$key]['enable_certain_pages']['post_ids'][$post_id];

						}

					}

				}

			}

		}

		return null;

	}

	function check_wpml_intall( $post ){

		if ( function_exists('icl_object_id') ) {
		    return $parent_id = icl_object_id( $post->ID, $post->post_type , false,'en');
		} else {
			return $post->ID;
		}

	}

}

$wpad_remove_default_comment_tag = new wpad_remove_default_comment_tag();