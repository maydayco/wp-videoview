<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			admin.php
//		Description:
//			This file runs the plugin's administrative tasks.
//		Actions:
//			1) enqueue syles and scripts
//			2) compile administrative menus
//			3) compile and render errors
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
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('admin_menu','WP_ayvpp_menu');
add_action('admin_enqueue_scripts','WP_ayvpp_scripts');
add_action('wp_print_scripts','WP_ayvpp_js');
add_action('admin_enqueue_scripts','WP_ayvpp_styles');
add_action('wp_enqueue_scripts','WP_ayvpp_styles');
add_action('delete_post','WP_ayvpp_delete_posts');
add_action('all_admin_notices','WP_ayvpp_errors');
//                                *******************************                                 //
//________________________________** SCRIPTS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_styles() {
	if(is_admin()) {
		wp_enqueue_style('ayvpp-admin',get_bloginfo('wpurl').'/wp-content/plugins/automatic-youtube-video-posts/css/admin.css');
	}
	else {
		wp_enqueue_style('ayvpp-admin',get_bloginfo('wpurl').'/wp-content/plugins/automatic-youtube-video-posts/css/style.css');
	}
}
function WP_ayvpp_scripts() {
	if(is_admin()) {
		wp_enqueue_script('ayvpp-admin',get_bloginfo('wpurl').'/wp-content/plugins/automatic-youtube-video-posts/js/admin.js');
	}
}
function WP_ayvpp_js() {
	echo '<script type="text/javascript">var ayvpp_root = "'.get_bloginfo('wpurl').'";</script>'."\n";
}
//                                *******************************                                 //
//________________________________** MENUS                     **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_menu() {
	if(function_exists('add_menu_page')) {
		add_menu_page('Youtube Video Posts','Youtube Posts',10,'ayvpp-settings','WP_ayvpp_settings');
		add_submenu_page('ayvpp-settings','Youtube Video Posts','Settings',10,'ayvpp-settings','WP_ayvpp_settings');
		add_submenu_page('ayvpp-settings','Channels/Playlists','Channels/Playlists',10,'ayvpp-channels','WP_ayvpp_channels');
		add_submenu_page('ayvpp-settings','Import Videos','Import Videos',10,'ayvpp-import-videos','WP_ayvpp_import_videos');
		add_submenu_page('ayvpp-settings','Video Posts','Video Posts',10,'ayvpp-video-posts','WP_ayvpp_video_posts');
		add_submenu_page('ayvpp-settings','Reset Settings','Reset Settings',10,'ayvpp-reset','WP_ayvpp_reset');
	}
}
//                                *******************************                                 //
//________________________________** ERRORS                    **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_errors() {
	global $getWP,$tern_wp_youtube_options;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	if(empty($o['channels'])) {
		$getWP->addError('Please remember to add at least one channel to automatically import your video posts.');
	}
	
	$e = $getWP->renderErrors();
	if($e) {
		echo '<div class="tern_errors">'.$e.'</div>';
	}
	
	$a = $getWP->renderAlerts();
	if($a) {
		echo '<div class="tern_alerts">'.$a.'</div>';
	}
}

/****************************************Terminate Script******************************************/
?>