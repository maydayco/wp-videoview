<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			inport.php
//		Description:
//			This file manually imports videos.
//		Actions:
//			1) compile import form
//			2) process and save ikmported videos
//		Date:
//			Added on November 3rd 2011
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
if((!isset($_GET['page']) or $_GET['page'] !== 'ayvpp-import-videos') and $GLOBALS['pagenow'] != 'admin-ajax.php') {
	return;
}
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
//add_action('init','WP_ayvpp_import_actions');
add_action('wp_ajax_ayvpp_is_importing','WP_ayvpp_import_actions');
add_action('wp_ajax_ayvpp_import','WP_ayvpp_import_actions');
add_action('wp_ajax_ayvpp_file','WP_ayvpp_import_actions');
add_action('wp_ajax_ayvpp_status','WP_ayvpp_import_actions');
//                                *******************************                                 //
//________________________________** ACTIONS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_import_actions() {
	global $getWP,$tern_wp_youtube_options,$tern_wp_youtube_vids,$getFILE;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);

	if(!wp_verify_nonce($_REQUEST['_wpnonce'],'tern_wp_youtube_nonce') or !current_user_can('manage_options')) {
		return;
	}
	
	switch($_REQUEST['action']) {
	
		case 'ayvpp_is_importing' :
			if($o['is_importing'] and $o['is_importing'] !== false) {
				die('1');
			}
			die(0);
	
		case 'ayvpp_import' :
			
			WP_ayvpp_add_posts(1,'*');
			$o['is_importing'] = false;
			$o = $getWP->getOption('tern_wp_youtube',$o,true);
			
			die('Your import is complete!');
			
		case 'ayvpp_status' :
		
			die($getFILE->contents(WP_CONTENT_DIR.'/cache/ayvpp.txt'));
		
		case 'ayvpp_file' : 
			$f = $getFILE->createFile('ayvpp.txt','',WP_CONTENT_DIR.'/cache');
			if($f === true) {
				die('true');
			}
			else {
				die('false');
			}
		
		default :
			break;
		
	}
	
}
//                                *******************************                                 //
//________________________________** SETTINGS                  **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_import_videos() {
	global $getWP,$tern_wp_youtube_options,$notice;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Import Videos</h2>
	<?php if(!empty($notice)) { ?><div id="notice" class="error"><p><?php echo $notice ?></p></div><?php } ?>
	<p>
		As of version 2.0 you can now import all the videos associated with the channels you've provided up to 1000. YouTube does not allow you to request any videos greater than 1000 for any given channel. This plugin automatically imports the 20 most recent videos per channel. To import all your videos (uo to 1000 per channel) simply click the import button below.
	</p>
	
	<p>
		<b>Important note:</b> Dependent on the number of channels and videos being imported this import may require more memory than what your server allows PHP for a single process. This import script may need to increase PHP's memory limit. Please choose a maximum limit.
	</p>
	<p><b>USE THIS AT YOUR OWN RISK. IT IS IMPORTANT TO KNOW THE LIMITATIONS OF YOUR SERVER.</b></p>
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="memory">Maximum Memory Limit:</label></th>
			<td>
				<select id="memory" name="memory">
					<option value="32">32M</option>
					<option value="37">37M</option>
					<option value="42">42M</option>
					<option value="47">47M</option>
					<option value="52">52M</option>
					<option value="57">57M</option>
					<option value="62">62M</option>
					<option value="67">67M</option>
				</select>
			</td>
		</tr>
	</table>

	<h2>Import!</h2>
	<p>
		You will be notified when your import has finished. DO NOT LEAVE THIS PAGE UNTIL YOU HAVE RECEIVED NOTIFICATION.
	</p>
	<p class="submit">
		<input type="submit" id="ayvpp_import" name="submit" class="button-primary" value="Import All Videos" />
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('tern_wp_youtube_nonce');?>" />
	</p>
	<h3 id="ayvpp_total"></h3>
	<p id="ayvpp_list"></p>
</div>
<?php
}

/****************************************Terminate Script******************************************/
?>