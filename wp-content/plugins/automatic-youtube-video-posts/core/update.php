<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			update.php
//		Description:
//			This file runs the plugin's updates.
//		Actions:
//			1) update database fields and files
//		Date:
//			Added on March 22nd 2011
//		Copyright:
//			Copyright (c) 2011 Matthew Praetzel.
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
add_action('init','WP_ayvpp_update');
//                                *******************************                                 //
//________________________________** UPDATE                    **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_update() {
	global $getWP,$tern_wp_youtube_options,$tern_wp_youtube_version;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	$videos = get_option('tern_wp_youtube_videos');

	if(empty($o['version']) or $o['version'] < $tern_wp_youtube_version) {
		
		//update video field from old videos field
		if(!empty($o['videos'])) {
			foreach((array)$o['videos'] as $k => $v) {
				if(!isset($videos[$k])) {
					$videos[$k] = array();
					$videos[$k] = $v['id'];
				}
			}
			$getWP->getOption('tern_wp_youtube_videos',$videos,true);
		}
		
		//update video field to new style
		if(!empty($videos)) {
			foreach((array)$videos as $k => $v) {
				if(!$v['id']) {
					unset($p,$t,$w,$x);
					$p = get_post($v);
					if($p) {
						$t = wp_get_post_tags($p->ID);
						foreach($t as $x) {
							$w .= empty($w) ? $x->name : ','.$x->name;
						}
						$videos[$k] = array(
							'id'							=>	$p->ID,
							'post_title'					=>	$p->post_title,
							'post_content'					=>	$p->post_content,
							'_tern_wp_youtube_author'		=>	get_post_meta($p->ID,'_tern_wp_youtube_author',true),
							'tags_input'					=>	$w,
							'post_date'						=>	$p->post_date
						);
					}
				}
			}
			$getWP->getOption('tern_wp_youtube_videos',$videos,true);
		}
		
	}
	
	$o['version'] = $tern_wp_youtube_version;
	$getWP->getOption('tern_wp_youtube',$o,true);
	
}

/****************************************Terminate Script******************************************/
?>