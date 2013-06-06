<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			settings.php
//		Description:
//			This file compiles and processes the plugin's various settings pages.
//		Actions:
//			1) compile overall plugin settings form
//			2) process and save plugin settings
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
if(!isset($_GET['page']) or $_GET['page'] !== 'ayvpp-settings') {
	return;
}
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('init','WP_ayvpp_settings_actions');
//                                *******************************                                 //
//________________________________** ACTIONS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_settings_actions() {
	global $getWP,$tern_wp_youtube_options;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	if(!wp_verify_nonce($_REQUEST['_wpnonce'],'tern_wp_youtube_nonce') or !current_user_can('manage_options')) {
		return;
	}
	
	switch($_REQUEST['action']) {
	
		case 'update' :
			$getWP->updateOption('tern_wp_youtube',$tern_wp_youtube_options,'tern_wp_youtube_nonce');
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
function WP_ayvpp_settings() {
	global $getWP,$tern_wp_youtube_options,$notice,$ternSel;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Youtube Video Posts Settings</h2>
	<?php if(!empty($notice)) { ?><div id="notice" class="error"><p><?php echo $notice ?></p></div><?php } ?>
	<form method="post" action="">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="publish">Automatically publish posts:</label></th>
				<td>
					<input type="radio" name="publish" value="1" <?php if($o['publish']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="publish" value="0" <?php if(!$o['publish']) { echo 'checked'; }?> /> no<br />
					<span class="setting-description">This option will make posts immediately viewable to the public.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="display_meta">Display YouTube video meta:</label></th>
				<td>
					<input type="radio" name="display_meta" value="1" <?php if($o['display_meta']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="display_meta" value="0" <?php if(!$o['display_meta']) { echo 'checked'; }?> /> no<br />
					<span class="setting-description">This option will display or hide the YouTube video post meta such as the author and post date when viewing your video post.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="words">Number of words before Wordpress' "More" tag:</label></th>
				<td>
					<input type="text" name="words" class="regular-text" value="<?php echo $o['words'];?>" />
					<span class="setting-description">This defines the number of words after which the excerpt will cut-off.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="dims">Video dimensions:</label></th>
				<td>
					<input type="text" name="dims[]" class="regular-text" value="<?php echo $o['dims'][0];?>" /> x <input type="text" name="dims[]" class="regular-text" value="<?php echo $o['dims'][1];?>" />
					<span class="setting-description">This defines the dimensions of the videos placed in their respective posts.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="related">Display related videos:</label></th>
				<td>
					<input type="radio" name="related" value="1" <?php if($o['related']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="related" value="0" <?php if(!$o['related']) { echo 'checked'; }?> /> no<br />
					<span class="setting-description">If set to yes, related videos (chosen by YouTube) will be displayed at the end of videos.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="inlist">Display videos in post lists:</label></th>
				<td>
					<input type="radio" name="inlist" value="1" <?php if($o['inlist']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="inlist" value="0" <?php if(!$o['inlist']) { echo 'checked'; }?> /> no<br />
					<span class="setting-description">If set to yes, videos assigned to posts will be displayed in the posts truncated content in post loops.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="cron">Import the latest videos every:</label></th>
				<td>
					<?php echo $ternSel->create(array(
						'data'		=>	array(1,6,12,24),
						'name'		=>	'cron',
						'selected'	=>	array((int)$o['cron'])
						
					)); ?> hours<br />
					<span class="setting-description">Set this to determine how many hours to wait between imports. PLEASE NOTE: THIS PLUGIN USES PSEUDO CRON JOBS. IT IS NOT AN ACTUAL CRON JOB. THEREFORE UNLESS SOMEONE VISITS YOUR SITE AT OR AFTER THE SPECIFIED AMOUNT OF TIME IN THIS SETTING THE VIDEOS WILL NOT BE IMPORTED UNTIL THE NEXT VISIT.<br /><br />If you just can't wait <a href="admin.php?page=ayvpp-import-videos">click here</a>.</span>
				</td>
			</tr>
		</table>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('tern_wp_youtube_nonce');?>" />
		<input type="hidden" name="_wp_http_referer" value="<?php wp_get_referer(); ?>" />
	</form>
</div>
<?php
}

/****************************************Terminate Script******************************************/
?>