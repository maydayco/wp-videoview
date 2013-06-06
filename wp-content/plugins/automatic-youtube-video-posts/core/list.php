<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			list.php
//		Description:
//			This file compiles and processes the plugin's video list.
//		Actions:
//			1) compile video list
//			2) process video list form actions
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
if(!isset($_GET['page']) or $_GET['page'] !== 'ayvpp-video-posts') {
	return; 
}
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('init','WP_ayvpp_list_actions');
//                                *******************************                                 //
//________________________________** ACTIONS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_list_actions() {
	global $getWP,$tern_wp_youtube_options,$wpdb,$tern_wp_youtube_post_defaults;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	if(!wp_verify_nonce($_REQUEST['_wpnonce'],'tern_wp_youtube_nonce') or !current_user_can('manage_options')) {
		return;
	}
	
	$videos = $wpdb->get_col("select post_id from $wpdb->postmeta where meta_key='_tern_wp_youtube_video'");
	
	$action = empty($_REQUEST['action']) ? $_REQUEST['action2'] : $_REQUEST['action'];
	switch($action) {
		
		case 'delete' :
			foreach((array)$_REQUEST['videos'] as $v) {
				$p = get_post($v);
				if($p->post_status != 'trash' and !wp_delete_post($v)) {
					$getWP->addError('There was an error while deleting a video post "'.get_the_title($v).'". Please try again.');
				}
			}
			break;
		
		case 'publish' :
			foreach((array)$_REQUEST['videos'] as $v) {
				if(!$wpdb->query("update $wpdb->posts set post_status='publish' where ID=".$v)) {
					$getWP->addError('There was an error while publishing your video post "'.get_the_title($v).'". Please try again.');
				}
			}
			break;
		
		case 'draft' :
			foreach((array)$_REQUEST['videos'] as $v) {
				if(!$wpdb->query("update $wpdb->posts set post_status='draft' where ID=".$v)) {
					$getWP->addError('There was an error while drafting your video post "'.get_the_title($v).'". Please try again.');
				}
			}
			break;
			
		case 'refresh' :
			
			foreach((array)$videos as $v) {
				if(!wp_delete_post($v,true)) {
					$getWP->addError('There was an error while deleting a video post "'.get_the_title($v).'". Please try again.');
				}
			}
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
function WP_ayvpp_video_posts() {
	global $getWP,$tern_wp_youtube_options,$wpdb;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	//$videos = get_option('tern_wp_youtube_videos');
	//$videos = is_array($videos) ? $videos : array();
	
	$videos = $wpdb->get_col("select post_id from $wpdb->postmeta where meta_key='_tern_wp_youtube_video'");
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Video Posts</h2>
	<p>Below you can delete, publish or draft your video posts.</p>
	
	<p>Let's talk about this video list a little. This list displays all the videos that have been found in your YouTube channels and playlists. For each of these videos a WordPress post has been created. From this list you can manipulate the WordPress post by publishing, drafting or deleting it. When deleting a post you are simply moving it to the trash. Any of these actions taken does not affect the list of videos below PROVIDED THAT YOU NEVER PERMANENTLY DELETE THE POST CREATED. You cannot delete a video from the list below unless you reset the list below or manually delete a post from the trash. Publishing, deleting or drafting only affects the post associated with the YouTube video. Remember this list is simply a reference to the videos that this plugin has found in your YouTube channels and playlists. However, upon the permanent deletion of a post the import may republish the deleted video post automatically. If you wish to hide a video post from your blog, set the post to draft or move it to the trash.</p>
	
	<form method="post" action="">
		<p>The following button will delete all videos from the list below and all WordPress posts associated with the videos below. THIS MAY TAKE SOME TIME.</p>
		<input type="submit" value="Completely Refresh Videos" name="refresh" class="button-primary action" />
		<input type="hidden" name="action" value="refresh" />
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('tern_wp_youtube_nonce');?>" />
	</form>
	<br /><br />
	<form id="tern_wp_youtube_list_fm" method="post" action="">
		<div class="tablenav">
			<?php
				$paged = $_GET['paged'] ? $_GET['paged'] : 1;
				$num = 10;
				$paging_text = paginate_links(array(
					'total'		=>	ceil(count($videos)/$num),
					'current'	=>	$paged,
					'base'		=>	'admin.php?page=ayvpp-video-posts&%_%',
					'format'	=>	'paged=%#%'
				));
				if($paging_text) {
					$paging_text = sprintf( '<span class="displaying-num">' . __( 'Displaying %s&#8211;%s of %s' ) . '</span>%s',
						number_format_i18n(($paged-1)*$num+1),
						number_format_i18n(min($paged*$num,count($videos))),
						number_format_i18n(count($videos)),
						$paging_text
					);
				}
			?>
			<div class="tablenav-pages"><?php echo $paging_text; ?></div>
			<div class="alignleft actions">
				<select name="action">
					<option value="" selected="selected">Bulk Actions</option>
					<option value="delete">Delete</option>
					<option value="publish">Publish</option>
					<option value="draft">Draft</option>
				</select>
				<input type="submit" value="Apply" name="doaction" class="button-secondary action" />
			</div>
			<br class="clear" />
		</div>
		<table class="widefat fixed" cellspacing="0">
			<thead>
			<tr class="thead">
				<th scope="col" id="cb" class="manage-column column-cb check-column"><input type="checkbox" /></th>
				<th scope="col" id="image" class="manage-column column-img" style="width:150px;">Preview</th>
				<th scope="col" id="video-id" class="manage-column column-id" style="width:20%;">Video I.D.</th>
				<th scope="col" id="title" class="manage-column column-title" style="width:20%;">Video Title</th>
				<th scope="col" id="url" class="manage-column column-url">URL</th>
				<th scope="col" id="post-id" class="manage-column column-post-id">Post ID</th>
			</tr>
			</thead>
			<tfoot>
			<tr class="thead">
				<th scope="col" class="manage-column column-cb check-column"><input type="checkbox" /></th>
				<th scope="col" class="manage-column column-img">Preview</th>
				<th scope="col" class="manage-column column-id">Video I.D.</th>
				<th scope="col" class="manage-column column-title">Video Title</th>
				<th scope="col" class="manage-column column-url">URL</th>
				<th scope="col" class="manage-column column-post-id">Post ID</th>
			</tr>
			</tfoot>
			<tbody id="fields" class="list:fields field-list">
				<?php
					$videos = array_slice($videos,($paged-1)*$num,$num);
					foreach($videos as $v) {
						$p = get_post($v);
						$k = get_post_meta($v,'_tern_wp_youtube_video',true);
						$d = empty($d) ? ' class="alternate"' : '';
				?>
						<tr id='field-<?php echo $k;?>'<?php echo $d;?>>
							<th scope='row' class='check-column'><input type='checkbox' name='videos[]' id='field_<?php echo $k;?>' value='<?php echo $v;?>' /></th>
							<td class="image column-image">
								<?php tern_wp_youtube_thumb($k); ?>
							</td>
							<td class="id column-id">
								<strong><?php echo $k;?></strong>
								<div class="row-actions">
									<?php
										$s = '';
										if($p->ID and $p->post_status != 'trash') {
											$s = '<span class="edit"><a href="admin.php?page=ayvpp-video-posts&videos%5B%5D='.$v.'&action=delete&_wpnonce='.wp_create_nonce('tern_wp_youtube_nonce').'">Delete</a></span>';
										}
										if($p->ID and $p->post_status != 'publish') {
											$s .= empty($s) ? '' : ' | ';
											$s .= '<span class="edit"><a href="admin.php?page=ayvpp-video-posts&videos%5B%5D='.$v.'&action=publish&_wpnonce='.wp_create_nonce('tern_wp_youtube_nonce').'">Publish</a></span>';
										}
										if($p->ID and $p->post_status != 'draft') {
											$s .= empty($s) ? '' : ' | ';
											$s .= '<span class="edit"><a href="admin.php?page=ayvpp-video-posts&videos%5B%5D='.$v.'&action=draft&_wpnonce='.wp_create_nonce('tern_wp_youtube_nonce').'">Draft</a></span>';
										}
										echo $s;
									?>
								</div>
							</td>
							<td class="title column-title">
								<span class="field_titles"><?php echo $p->post_title; ?></span>
							</td>
							<td class="url column-url">
								<a href="<?php tern_wp_youtube_video_watch_link($k); ?>" target="_blank"><?php tern_wp_youtube_video_watch_link($k); ?></a>
							</td>
							<td class="post-id column-post-id">
								<?php echo $v; ?>
							</td>
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
					<option value="publish">Publish</option>
					<option value="draft">Draft</option>
				</select>
				<input type="submit" value="Apply" name="doaction2" class="button-secondary action" />
			</div>
			<br class="clear" />
		</div>
		<input type="hidden" id="page" name="page" value="ayvpp-video-posts" />
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('tern_wp_youtube_nonce');?>" />
	</form>
</div>
<?php
}

/****************************************Terminate Script******************************************/
?>