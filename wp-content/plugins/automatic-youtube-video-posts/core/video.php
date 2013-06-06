<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			video.php
//		Description:
//			This file compiles YouTube videos, video images and video meta.
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
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_filter('the_content','WP_ayvpp_content');
add_filter('post_thumbnail_html','WP_ayvpp_thumbnail');
add_filter('post_thumbnail_size','WP_ayvpp_thumbnail_size');
//add_filter('the_content_feed','WP_ayvpp_content_rss');
//                                *******************************                                 //
//________________________________** RENDER VIDEO              **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_content($c) {
	global $getWP,$post,$tern_wp_youtube_options;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	$v = get_post_meta($post->ID,'_tern_wp_youtube_video',true);
	if(is_single() and $v) {
		$s = $o['display_meta'] ? tern_wp_youtube_video(false).tern_wp_youtube_video_meta(false) : tern_wp_youtube_video(false);
	}
	elseif($o['inlist'] and !empty($v)) {
		$s = tern_wp_youtube_video(false);
	}
	
	return $s.$c;
}
function WP_ayvpp_content_rss($c) {
	global $getWP,$post,$tern_wp_youtube_options;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);

	$v = get_post_meta($post->ID,'_tern_wp_youtube_video',true);
	if($o['rss'] and !empty($v)) {
		$s = tern_wp_youtube_video(false);
	}
	return $s.$c;
}
function WP_ayvpp_thumbnail_size($s) {
	global $tern_wp_youtube_image_size;
	$tern_wp_youtube_image_size = $s;
	return $s;
}
function WP_ayvpp_thumbnail($html) {
	global $post,$tern_wp_youtube_image_size,$_wp_additional_image_sizes;
	
	$s = $tern_wp_youtube_image_size;
	if(isset($_wp_additional_image_sizes[$s]['width'])) {
		$w = intval($_wp_additional_image_sizes[$s]['width']);
		$h = intval($_wp_additional_image_sizes[$s]['height']);
		$c = intval($_wp_additional_image_sizes[$s]['crop']);
	}
	else {
		$w = get_option("{$s}_size_w");
		$h = get_option("{$s}_size_h");
		$c = get_option("{$s}_crop");
	}
	$c = $c ? '1' : '0';
	
	$m = get_post_meta($post->ID,'_tern_wp_youtube_video',true);
	if($m) {
		$html = '<img src="'.get_bloginfo('wpurl').'/wp-content/plugins/automatic-youtube-video-posts/tools/timthumb.php?src=http://img.youtube.com/vi/'.$m.'/0.jpg&w='.$w.'&h='.$h.'&zc='.$c.'" alt="" title="'.$i.'" />';
	}
	return $html;
}
function tern_wp_youtube_video($e=true) {
	global $getWP,$post,$tern_wp_youtube_options,$post;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	$v = get_post_meta($post->ID,'_tern_wp_youtube_video',true);
	$s = '<iframe title="YouTube video player" width="'.$o['dims'][0].'" height="'.$o['dims'][1].'" src="'.tern_wp_youtube_video_link($v,false).'" frameborder="0" allowfullscreen allowTransparency="true"></iframe>';
	if($e) { echo $s; }
	return $s;
}
function tern_wp_youtube_video_meta($e=true) {
	global $post;
	$a = get_post_custom($post->ID);
	$s = '<div class="tern_wp_youtube_video_meta_data"><div class="tern_wp_youtube_video_meta">';
	$s .= tern_wp_youtube_author_link($a['_tern_wp_youtube_author'][0],false);
	$s .= empty($a['_tern_wp_youtube_published'][0]) ? '' : '<span>'.get_the_time('D, F j, Y g:ia').'</span>';
	$s .= '<label>URL:</label><input type="text" value="'.tern_wp_youtube_video_link($a['_tern_wp_youtube_video'][0],false).'" onmouseup="this.select();" /><br />';
	$s .= '<label>Embed:</label><input type="text" value="'.htmlentities(tern_wp_youtube_video(false)).'" onmouseup="this.select();" />';
	$s .= '</div></div>';
	if($e) { echo $s; }
	return $s;
}
function tern_wp_youtube_video_link($i,$e=true) {
	global $getWP,$tern_wp_youtube_options;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	$l = 'http://www.youtube.com/embed/'.$i;
	$l .= $o['related'] ? '' : '?rel=0';
	if($e) { echo $l; }
	return $l;
}
function tern_wp_youtube_video_watch_link($i,$e=true) {
	$l = 'http://www.youtube.com/watch?v='.$i;
	if($e) { echo $l; }
	return $l;
}
function tern_wp_youtube_author_link($i,$e=true) {
	$l = '<a href="http://www.youtube.com/user/'.$i.'" target="_blank">'.$i.'</a>';
	if($e) { echo $l; }
	return $l;
}
function tern_wp_youtube_image($i=false,$e=true) {
	global $post;
	if(!$i) {
		$i = get_post_meta($post->ID,'_tern_wp_youtube_video',true);
	}
	if($i) {
		$l = '<img src="http://img.youtube.com/vi/'.$i.'/0.jpg" alt="" title="'.$i.'" />';
		if($e) { echo $l; }
		return $l;
	}
	return false;
}
function tern_wp_youtube_thumb($i=false,$e=true) {
	global $post;
	if(!$i) {
		$i = get_post_meta($post->ID,'_tern_wp_youtube_video',true);
	}
	if($i) {
		$l = '<img src="http://img.youtube.com/vi/'.$i.'/default.jpg" alt="" title="'.$i.'" />';
		if($e) { echo $l; }
		return $l;
	}
	return false;
}
function tern_wp_youtube_list() {
	global $getWP,$wpdb,$post,$tern_wp_youtube_options;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	//
	$page = empty($_GET['page']) ? (tern_wp_youtube_page()-1)*$o['limit'] : (intval($_GET['page'])-1)*$o['limit'];
	
	$p = $wpdb->get_results("select ID from $wpdb->posts as p, $wpdb->postmeta as m where p.ID = m.post_id and m.meta_key = '_tern_wp_youtube_video' order by p.post_date desc limit ".$page.','.$o['limit']);
	$t = $wpdb->get_var("select COUNT(*) from $wpdb->posts as p, $wpdb->postmeta as m where p.ID = m.post_id and m.meta_key = '_tern_wp_youtube_video'");
	//
	if(!empty($p)) {
		$n = new pagination(array(
			'total'	=>	$t,
			'limit'	=>	$o['limit'],
			'url'	=>	get_permalink(),
			'seo'	=>	$o['pages']
		));
?>	
	<ul class="tern_wp_post_list category-<?php echo $o['category'];?>">
<?php
		foreach($p as $post) {
			$post = get_post($post->ID);
			setup_postdata($post);
			$i = get_post_meta($post->ID,'_tern_wp_youtube_video',true);
?>
			<li class="tern_wp_post post<?php echo $c?>">
				<div class="tern_wp_post_head">
					<h3 id="post-<?php the_ID(); ?>">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h3>
					<small><?php the_time('F '); ?><span><?php the_time('j'); ?></span><?php the_time(' Y'); ?></small>
				</div>
				<div class="tern_wp_post_entry">
					<div class="tern_wp_post_image">
						<a href="<?php the_permalink() ?>"><?php tern_wp_youtube_thumb(); ?></a>
					</div>
					<?php the_content('read more...'); ?>
				</div>
				<div class="tern_wp_post_footer">
					Filed in <?php the_category(', ','single'); ?>   |   Comments (<?php echo comments_number('0','1','%');?>)
				</div>
			</li>
<?php
			$c++;
		}
?>
	</ul>
<?php
		$n = new pagination(array(
			'total'	=>	$t,
			'limit'	=>	$o['limit'],
			'url'	=>	get_category_link($o['category']),
			'seo'	=>	$o['pages']
		));
	}
	else {
		echo '<h3>Sorry, there is nothing here to see yet.</h3>';
	}
}
function tern_wp_youtube_page() {
	$u = explode('/',$_SERVER['REQUEST_URI']);
	foreach($u as $k => $v) {
		if(empty($v)) {
			unset($u[$k]);
		}
	}
	$u = array_values($u);
	$v = $u[count($u)-1];
	$v = ereg('^[0-9]+$',$v) ? $v : 1;
	return $v;
}

/****************************************Terminate Script******************************************/
?>