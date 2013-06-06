<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			meta.php
//		Description:
//			This file compiles YouTube specific meta fields for posts.
//		Actions:
//			1) add YouTube specific meta fields for posts
//			2) process meta field posted data
//		Date:
//			Added on November 3rd 2010
//		Copyright:
//			Copyright (c) 2010 Matthew Praetzel.
//		License:
//			This software is licensed under the terms of the GNU General Public License v3
//			as published by the Free Software Foundation. You should have received a copy of of
//			the GNU General Public License along with this software. In the event that you
//			have not, please visit: http://www.gnu.org/licenses/gpl-3.0.txt
//
////////////////////////////////////////////////////////////////////////////////////////////////////

/****************************************Commence Script*******************************************/

//                                *******************************                                 //
//________________________________** INITIALIZE                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
$pages = array('post.php','edit.php','post-new.php','page.php','page-new.php');
if(!in_array($GLOBALS['pagenow'],$pages)) {
	return;
}
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('admin_menu','WP_ayvpp_box');
add_action('save_post','WP_ayvpp_save_post');
add_action('publish_post','WP_ayvpp_save_post');
//                                *******************************                                 //
//________________________________** ACTIONS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_save_post($i) {
	$i = wp_is_post_revision($i);
	if(!wp_verify_nonce($_POST['tern_wp_youtube_nonce'],plugin_basename(__FILE__)) or !$i or !current_user_can('edit_post',$i)) {
		return;
	}
	WP_ayvpp_add_meta($i);
}
//                                *******************************                                 //
//________________________________** META BOXES                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_box() {
	add_meta_box('tern_wp_youtube_videos','YouTube Video','WP_ayvpp_meta','post','advanced');
}
function WP_ayvpp_meta() {
	global $post,$tern_wp_youtube_fields;
	foreach($tern_wp_youtube_fields as $k => $v) {
		$w = get_post_meta($post->ID,$v,true);
		echo '<label for"'.$v.'">'.$k.'</label><br />';
		echo '<input type="text" name="'.$v.'" id="'.$v.'" size="30" value="'.$w.'" />';
	}
	echo '<input type="hidden" name="tern_wp_youtube_nonce" id="tern_wp_youtube_nonce" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
}

/****************************************Terminate Script******************************************/
?>