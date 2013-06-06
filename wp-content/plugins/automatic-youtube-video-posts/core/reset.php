<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			reset.php
//		Description:
//			This file resets the plugin's various settings pages.
//		Actions:
//			1) compile overall plugin reset form
//			2) process and reset plugin settings
//		Date:
//			Added on April 15th 2011
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
if(!isset($_GET['page']) or $_GET['page'] !== 'ayvpp-reset') {
	return;
}
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('init','WP_ayvpp_reset_actions');
//                                *******************************                                 //
//________________________________** ACTIONS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_reset_actions() {
	global $getWP,$tern_wp_youtube_options,$wpdb;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	if(!wp_verify_nonce($_REQUEST['_wpnonce'],'tern_wp_youtube_nonce') or !current_user_can('manage_options')) {
		return;
	}
	
	switch($_REQUEST['submit']) {
	
		case 'Completely Refresh Videos' :
			$videos = $wpdb->get_col("select post_id from $wpdb->postmeta where meta_key='_tern_wp_youtube_video'");
			foreach((array)$videos as $v) {
				if(!wp_delete_post($v,true)) {
					$getWP->addError('There was an error while deleting a video post "'.get_the_title($v).'". Please try again.');
				}
			}
			break;
			
		case 'Reset this Plugin' :
			$videos = $wpdb->get_col("select post_id from $wpdb->postmeta where meta_key='_tern_wp_youtube_video'");
			foreach((array)$videos as $v) {
				if(!wp_delete_post($v,true)) {
					$getWP->addError('There was an error while deleting a video post "'.get_the_title($v).'". Please try again.');
				}
			}
			$getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options,true);
			break;
			
		case 'Reset this Plugin but keep posts' :
			$getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options,true);
			break;
			
		case 'Reset Import Field in the Database' :
			$o['is_importing'] = false;
			$getWP->getOption('tern_wp_youtube',$o,true);
			break;
		
		default :
			break;
		
	}
	
}
//                                *******************************                                 //
//________________________________** SETTINGS                  **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_reset() {
	global $getWP,$tern_wp_youtube_options,$notice,$ternSel;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Youtube Video Posts Reset</h2>
	<?php if(!empty($notice)) { ?><div id="notice" class="error"><p><?php echo $notice ?></p></div><?php } ?>
	<form method="post" action="">
		<hr />
		<h3>Refreshing your video lists</h3>
		<p>The following button will delete all videos imported and stored from the database and all WordPress posts associated with the videos.</p>
		<p><b>THIS MAY TAKE SOME TIME.</b></p>
		<input type="submit" value="Completely Refresh Videos" name="submit" class="button-primary action" />
		<hr />
		<h3>Plugin stopped importing?</h3>
		<p>When an import does not complete itself properly (usually by attempting to import too many videos) a value in the database needs to be reset.</p>
		<p><b>PLEASE NOTE: IF AN IMPORT IS ACTUALLY TAKING PLACE AND YOU CLICK THIS BUTTON THERE IS THE POSSIBILITY OF CREATING DUPLICATE POSTS.</b></p>
		<input type="submit" value="Reset Import Field in the Database" name="submit" class="button-primary action" />
		<hr />
		<h3>Completely reset this plugin</h3>
		<p>The following button will remove all the settings associated with this plugin as well as delete all videos imported and stored from the database and all WordPress posts associated with the videos.</p>
		<p><b>THIS MAY TAKE SOME TIME.</b></p>
		<input type="submit" value="Reset this Plugin" name="submit" class="button-primary action" />
		<hr />
		<h3>Keep video posts but refresh all plugin settings</h3>
		<p>The following button will remove all the settings associated with this plugin as well as delete all videos imported and stored from the database but will not delete all WordPress posts associated with the videos.</p>
		<input type="submit" value="Reset this Plugin but keep posts" name="submit" class="button-primary action" />
		
		
		
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('tern_wp_youtube_nonce');?>" />
		<input type="hidden" name="_wp_http_referer" value="<?php wp_get_referer(); ?>" />
	</form>
</div>
<?php
}

/****************************************Terminate Script******************************************/
?>