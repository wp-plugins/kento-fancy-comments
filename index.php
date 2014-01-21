<?php
/*
Plugin Name: Kento Fancy Comments
Plugin URI: http://kentothemes.com
Description: Post Like Button For WordPress like Facebook
Version: 1.0
Author: KentoThemes
Author URI: http://kentothemes.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


wp_enqueue_script('jquery');
define('FANCY_COMMENTS_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
wp_enqueue_style('fancy-comments-style', FANCY_COMMENTS_PLUGIN_PATH.'css/style.css');

wp_enqueue_script('fancy-comments-ajax-js', plugins_url( '/js/fancy-comments-ajax.js' , __FILE__ ) , array( 'jquery' ));
wp_localize_script( 'fancy-comments-ajax-js', 'fancy_comments_ajax', array( 'fancy_comments_ajaxurl' => admin_url( 'admin-ajax.php')));



function fancy_comments()
	{	

		$comment_id = (int)$_POST['comment_id'];
		$comment_id_meta = get_comment( $comment_id ); 
		$comment_author  = $comment_id_meta->comment_author ;
		$comment_id_email_avatar = $comment_id_meta->comment_author_email;
		$comment_author_url  = $comment_id_meta->comment_author_url ;
		
		
		$comment_user = get_user_by( 'email', $comment_id_email_avatar );
		$comment_user_id = $comment_user->ID;
		
		
		if(empty($comment_author_url))
			{
				$comment_author_url = get_the_author_meta(user_url ,$comment_user_id);
			}
		
		
		
		
		echo "<div class='fancy-comments-avatar'>". get_avatar( $comment_id_email_avatar, 180 )."</div>";
		echo "<div class='fancy-comments-info'>";
		echo "<div class='fancy-comments-name'><strong>".$comment_author."</strong></div>";
		echo "<div class='fancy-comments-url'>".$comment_author_url."</div>";
		echo "<div id='fancy-comments-description' class='fancy-comments-description'>".get_the_author_meta(description ,$comment_user_id)."</div>";
		echo "</div>";
		
		die();
	}
add_action('wp_ajax_fancy_comments', 'fancy_comments');
add_action('wp_ajax_nopriv_fancy_comments', 'fancy_comments');








function fancy_comments_holder($comments_template)
	{	
	
	
		$kfc_popup_top = get_option( 'kfc_popup_top' );
		$kfc_select_class = get_option( 'kfc_select_class' );
		
		
		$comments_template.=  '<div id="fancy-comments" class="fancy-comments"></div>';
		$comments_template.=  '';
		$comments_template.=  '<span id="kfc-popup-top" class="kfc-popup-top-value">'.$kfc_popup_top.'</span>';
		$comments_template.=  '<span id="kfc-select-class" class="kfc-select-class-value">'.$kfc_select_class.'</span>';		
		
	

	return $comments_template;

	}

add_filter( "the_content", "fancy_comments_holder" );




/////////////////////////////
add_action('admin_init', 'kento_fancy_comments_init' );
add_action('admin_menu', 'kento_fancy_comments_menu');

 function kento_fancy_comments_init(){
	register_setting( 'kento_fancy_comments_plugin_options', 'kfc_popup_top');
	register_setting( 'kento_fancy_comments_plugin_options', 'kfc_select_class');	
		
    }
function kento_fancy_comments_settings(){
	include('fancy-comment-admin.php');	
}

function kento_fancy_comments_menu() {
	add_menu_page(__('Kento Fancy Comments','kfc'), __('KFC Settings','kfc'), 'manage_options', 'kfc_settings', 'kento_fancy_comments_settings');
}







 ?>