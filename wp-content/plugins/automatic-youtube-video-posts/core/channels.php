<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			channels.php
//		Description:
//			This file compiles lists, creates and saves configurable YouTube channels.
//		Actions:
//			1) List all YouTube channels added
//			2) Create new YouTube channels
//		Date:
//			Added on July 27, 2012
//		Copyright:
//			Copyright (c) 2012 Matthew Praetzel.
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
if(!isset($_GET['page']) or $_GET['page'] !== 'ayvpp-channels') {
	return; 
}
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('init','WP_ayvpp_channel_actions');
add_action('init','WP_ayvpp_channel_styles');
add_action('init','WP_ayvpp_channel_scripts');
//                                *******************************                                 //
//________________________________** SCRIPTS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_channel_styles() {
	wp_enqueue_style('thickbox');
}
function WP_ayvpp_channel_scripts() {
	global $terncal_setting_pages;
	wp_enqueue_script('thickbox');
	wp_enqueue_script('ayvpp-channels',get_bloginfo('wpurl').'/wp-content/plugins/automatic-youtube-video-posts/js/channels.js',array('jquery'));
}
//                                *******************************                                 //
//________________________________** ACTIONS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_channel_actions() {
	global $getWP,$tern_wp_youtube_options,$wpdb,$tern_wp_youtube_post_defaults;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	if(!wp_verify_nonce($_REQUEST['_wpnonce'],'tern_wp_youtube_nonce') or !current_user_can('manage_options')) {
		return;
	}
	
	$action = empty($_REQUEST['action']) ? $_REQUEST['action2'] : $_REQUEST['action'];
	switch($action) {
		
		case 'delete' :
			foreach($_REQUEST['items'] as $v) {
				unset($o['channels'][$v]);
			}
			$o = $getWP->getOption('tern_wp_youtube',$o,true);
			$getWP->addAlert(__('You have successfully deleted your channel/playlist.','ayvpp'));
			break;
			
		case 'add' :
			if(!empty($_REQUEST['item']) or $_REQUEST['item'] === 0 or $_REQUEST['item'] === '0') {
				$i = $_REQUEST['item'];
			}
			else {
				foreach($o['channels'] as $v) {
					if($v['channel'] == $_POST['channel']) {
						$getWP->addError('You have already added the channel: "'.$_POST['channel'].'".');
						break 2;
					}
				}
				$i = array_keys($o['channels']);
				$i = $i[count($i)-1]+1;
			}
			if(empty($_POST['name']) or empty($_POST['channel']) or empty($_POST['type']) or empty($_POST['categories']) or empty($_POST['author'])) {
				$getWP->addError('Please fill out all the fields for a channel/playlist.');
				return;
			}

			$o['channels'][$i] = array(
				'id'				=>	intval($i),
				'name'				=>	$_POST['name'],
				'channel'			=>	$_POST['channel'],
				'type'				=>	$_POST['type'],
				'categories'		=>	$_POST['categories'],
				'author'			=>	$_POST['author']
			);
			$o = $getWP->getOption('tern_wp_youtube',$o,true);
			WP_ayvpp_add_posts(1,20,true);
			break;
			
		default :
			break;
	}
	
}
//                                *******************************                                 //
//________________________________** CHANNELS                  **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_channels() {
	global $getWP,$tern_wp_youtube_options,$notice;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
?>
<div class="wrap WP_ayvpp_styling">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Channels / Playlists <a href="#TB_inline?width=400&height=600&inlineId=WP_ayvpp_add_item" id="add_item" class="thickbox button add-new-h2"><?php _e('Add New','ayvpp'); ?></a></h2>
	
	<form id="tern_wp_youtube_channel_fm" method="post" action="">
		
		<div class="tablenav">
			<div class="alignleft actions">
				<select name="action">
					<option value="" selected="selected">Bulk Actions</option>
					<option value="delete">Delete</option>
				</select>
				<input type="submit" value="Apply" name="doaction" class="button-secondary action" />
			</div>
		</div>
		
		<table class="widefat fixed" cellspacing="0">
			<thead>
			<tr class="thead">
				<th scope="col" id="cb" class="manage-column column-cb check-column"><input type="checkbox" /></th>
				<th scope="col" id="channel" class="manage-column column-name" style="width:150px;">Name</th>
				<th scope="col" id="channel" class="manage-column column-channel" style="width:150px;">Channel/Playlist</th>
				<th scope="col" id="type" class="manage-column column-type" style="width:20%;">Type</th>
				<th scope="col" id="cat" class="manage-column column-cat" style="width:20%;">Catgories</th>
				<th scope="col" id="author" class="manage-column column-author">Author</th>
			</tr>
			</thead>
			<tfoot>
			<tr class="thead">
				<th scope="col" class="manage-column column-cb check-column"><input type="checkbox" /></th>
				<th scope="col" class="manage-column column-name">Name</th>
				<th scope="col" class="manage-column column-channel">Channel/Playlist</th>
				<th scope="col" class="manage-column column-type">Type</th>
				<th scope="col" class="manage-column column-cat">Catgories</th>
				<th scope="col" class="manage-column column-author">Author</th>
			</tr>
			</tfoot>
			<tbody id="fields" class="list:fields field-list">
				<?php foreach($o['channels'] as $k => $v) { $d = empty($d) ? ' class="alternate"' : ''; ?>
					<tr id='field-<?php echo $k;?>'<?php echo $d;?>>
						<th scope='row' class='check-column'><input type='checkbox' name='channels[]' id='field_<?php echo $k;?>' value='<?php echo $k;?>' /></th>
						<td class="column-name">
							<strong><?php echo $v['name']; ?></strong>
							<div class="row-actions">
								<span class='edit WP_ayvpp_edit'><a href="#TB_inline?width=400&height=600&inlineId=WP_ayvpp_add_item" class="thickbox"><?php _e('Edit','ayvpp'); ?></a></span> | 
								<span class="edit"><a href="admin.php?page=ayvpp-channels&items%5B%5D=<?php echo $k; ?>&action=delete&_wpnonce=<?php echo wp_create_nonce('tern_wp_youtube_nonce'); ?>">Delete</a></span>
							</div>
						</td>
						<td class="column-channel"><?php echo $v['channel']; ?></td>
						<td class="column-type"><?php echo $v['type']; ?></td>
						<td class="column-cat">
							<?php unset($c,$d,$e);foreach($v['categories'] as $w) {
								$d = get_category((int)$w);
								$c .= empty($c) ? '' : ',';
								$e .= empty($e) ? '' : ',';
								$c .= $d->name;
								$e .= $d->term_id;
							}echo $c; ?>
							<input type="hidden" value="<?php echo $e; ?>" />
						</td>
						<td class="column-author"><input type="hidden" value="<?php echo $v['author']; ?>" /><?php $a = get_userdata($v['author']);echo $a->display_name; ?></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		
		<div class="tablenav">
			<div class="alignleft actions">
				<select name="action2">
					<option value="" selected="selected">Bulk Actions</option>
					<option value="delete">Delete</option>
				</select>
				<input type="submit" value="Apply" name="doaction2" class="button-secondary action" />
			</div>
			<br class="clear" />
		</div>
		
		<input type="hidden" id="page" name="page" value="ayvpp-channels" />
		<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('tern_wp_youtube_nonce');?>" />
	</form>
	
	<div id="WP_ayvpp_add_item" class="add_item">
		<form id="WP_ayvpp_add_item_form" method="post" action="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=ayvpp-channels">
			<fieldset>
				<h2><?php _e('Add a new channel or playlist','ayvpp'); ?>:</h2>
				<label><?php _e('Name','ayvpp'); ?>:</label>
				<input type="text" name="name" class="regular-text" />
				<label><?php _e('Channel/Playlist','ayvpp'); ?>:</label>
				<p class="description">Enter just the name of the channel or the ID of the playlist.</p>
				<input type="text" name="channel" class="regular-text" />
				<label><?php _e('Type','ayvpp'); ?>:</label>
				<select name="type">
					<option value="channel">Channel</option>
					<option value="playlist">Playlist</option>
				</select>
			</fieldset>
			<fieldset>
				<h2><?php _e('Add videos from this channel/playlist to the following categories','ayvpp'); ?>:</h2>
				<?php foreach((array)get_categories(array('hide_empty'=>0)) as $k => $v) { ?>
				<label>
					<input type="checkbox" name="categories[]" class="chk" value="<?php echo $v->term_id; ?>" /> <?php echo $v->name; ?>
				</label>
				<?php } ?>
			</fieldset>
			<fieldset>
				<h2><?php _e('Attribute videos from this channel to what author?','ayvpp'); ?>:</h2>
				<label><?php _e('Author','ayvpp'); ?>:</label>
				<?php wp_dropdown_users(array('name'=>'author')); ?>
			</fieldset>
			
			<input type="submit" value="Add Channel" class="button-secondary action btn" />
			
			<input type="hidden" name="item" />
			<input type="hidden" name="action" value="add" />
			<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('tern_wp_youtube_nonce'); ?>" />
		</form>
	</div>
	
</div>
<?php
}

/****************************************Terminate Script******************************************/
?>