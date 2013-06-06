<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			twitter.php
//		Description:
//			This file compiles and processes the plugin's twitter settings pages.
//		Actions:
//			1) compile twitter settings form
//			2) process and save twitter settings
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
if(!isset($_GET['page']) or $_GET['page'] !== 'ayvpp-twitter-settings') {
	return;
}
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('init','WP_ayvpp_twitter_actions');
//                                *******************************                                 //
//________________________________** ACTIONS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_twitter_actions() {
	global $getWP,$tern_wp_youtube_options;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	if(!wp_verify_nonce($_REQUEST['_wpnonce'],'tern_wp_youtube_nonce') or !current_user_can('manage_options')) {
		return;
	}
	
	switch($_REQUEST['action']) {
	
		case 'update' :
			$_POST['twitter'] = empty($_POST['twitter']) ? 0 : 1;
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
function WP_ayvpp_twitter_settings() {
	global $getWP,$tern_wp_youtube_options,$notice;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Social Networking Settings</h2>
	<?php if(!empty($notice)) { ?><div id="notice" class="error"><p><?php echo $notice ?></p></div><?php } ?>
	<form method="post" action="">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="twitter">Update my status on twitter when importing a video?</label></th>
				<td>
					<input type="radio" name="twitter" value="1" <?php if($o['twitter']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="twitter" value="o" <?php if(!$o['twitter']) { echo 'checked'; }?> /> no<br />
					<span class="setting-description">This will update you twitter status with a link to this video.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="twitter_user">Your Twitter email:</label></th>
				<td>
					<input type="text" name="twitter_user" class="regular-text" value="<?php echo $o['twitter_user'];?>" />
					<span class="setting-description">This is the user name you use to log into your Twitter account.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="twitter_password">Your Twitter password:</label></th>
				<td>
					<input type="password" name="twitter_password" class="regular-text" value="<?php echo $o['twitter_password'];?>" />
					<span class="setting-description">This is the password you use to log into your Twitter account.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="twitter_password">Your Twitter status text:</label></th>
				<td>
					<input type="text" name="twitter_text" class="regular-text" value="<?php echo $o['twitter_text'];?>" />
					<span class="setting-description">This is the format for your status. Put %twitter_link% where you'd like the link to your new post to go. e.g. I've posted a new video here: %twitter_link%</span>
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