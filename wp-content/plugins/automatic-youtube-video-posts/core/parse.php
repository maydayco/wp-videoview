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
//________________________________** INITIALIZE VARIABLES      **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
$tern_wp_youtube_vids = array();
ini_set(max_execution_time,600);
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
if($GLOBALS['pagenow'] != 'admin-ajax.php') {
	add_action('init','WP_ayvpp_add_posts',10);
}
add_action('publish_post','WP_ayvpp_update_meta');
add_action('save_post','WP_ayvpp_update_meta');
//                                *******************************                                 //
//________________________________** POST FUNCTIONS            **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_add_posts($x=1,$n=20,$f=false) {
	global $getWP,$getFIX,$tern_wp_youtube_options,$tern_wp_youtube_o,$tern_wp_users,$tern_wp_youtube_videos,$tern_wp_youtube_keys,$wpdb;
	$tern_wp_youtube_o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	WP_ayvpp_reset_file();

	//no channels have been specified
	if(empty($tern_wp_youtube_o['channels'])) {
		return;
	}
	
	//currently there is an import taking place
	if($tern_wp_youtube_o['is_importing'] and $tern_wp_youtube_o['is_importing'] !== false and $tern_wp_youtube_o['is_importing'] !== $r) {
		if($n == '*') {
			die('There is an import currently taking place. Please try again later.');
		}
		return;
	}
	
	//it is not yet time to import
	if(!$f and (($tern_wp_youtube_o['last_import']+($tern_wp_youtube_o['cron']*3600)) > time() and !empty($tern_wp_youtube_o['last_import']) and $n != '*')) {
		return;
	}
	
	//get all existing imported videos
	$tern_wp_youtube_videos = $wpdb->get_col("select meta_value from $wpdb->postmeta where meta_key='_tern_wp_youtube_video'");
	$x = empty($x) ? 1 : (int)$x;
	
	//keep other imports from happening
	if(!$r or $r !== $tern_wp_youtube_o['is_importing']) {
		$tern_wp_youtube_o['is_importing'] = $r = wp_create_nonce('ayvpp-'.time());
		$tern_wp_youtube_o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_o,true);	
	}
	
	//import
	WP_ayvpp_add_import_posts($x,$n,$r);
	
	//finish import
	$tern_wp_youtube_o['is_importing'] = false;
	if($n != '*') {
		$tern_wp_youtube_o['last_import'] = time();
	}
	$getWP->getOption('tern_wp_youtube',$tern_wp_youtube_o,true);
	unset($GLOBALS['tern_wp_youtube_o'],$GLOBALS['tern_wp_youtube_videos'],$GLOBALS['tern_wp_youtube_vids']);
	
	return true;
	
}
function WP_ayvpp_add_import_posts($x=1,$n=20,$r=false) {

	global $getWP,$getFILE,$tern_wp_users,$tern_wp_youtube_o,$tern_wp_youtube_videos,$tern_wp_youtube_keys,$tern_wp_youtube_vids,$tern_wp_youtube_post_defaults,$tern_wp_youtube_feed,$tern_wp_youtube_channels,$wpdb;

	//deal with memory issues
	if($n == '*' and !WP_ayvpp_check_memory()) {
		return false;
	}
	
	//perform import
	$total = $n == '*' ? $x+49 : $x+$n;
	$y = 0;
	foreach((array)$tern_wp_youtube_o['channels'] as $v) {
		
		$y++;
		$name = $v['name'];
		
		//if a channel does not have a type or channel set
		if(empty($v['type']) or empty($v['channel'])) {
			WP_ayvpp_update_file('Please set either a type or channel for "'.$v['name'].'".');
			continue;
		}
		
		//if type is playlist and we're looking for additional videos round from a channel
		if($v['type'] == 'playlist' and $x > 1) {
			continue;
		}
		
		//if a channel is already maxed out
		if($tern_wp_youtube_channels[$name]) {
			continue;
		}
		
		//parse videos
		$tern_wp_youtube_vids = array();
		WP_ayvpp_parse_videos($v['channel'],$v['type'],$x,$n);
		
		//notify user of next step
		WP_ayvpp_update_file('<h4>Attempting to download videos '.$x.' through '.$total.' from '.$v['type'].': "'.$v['name'].'"</h4><h5>Feed URL for this query: <a href="'.$tern_wp_youtube_feed.'" target=_blank">'.$tern_wp_youtube_feed.'</a></h5>');

		unset($w,$c);
		if(empty($tern_wp_youtube_vids) and $y >= count($tern_wp_youtube_o['channels']) and count($tern_wp_youtube_channels) == (count($tern_wp_youtube_o['channels'])-1)) {
			return false;
		}
		elseif(empty($tern_wp_youtube_vids)) {
			$tern_wp_youtube_channels[$name] = true;
			continue;
		}

		$c = 0;
		foreach((array)$tern_wp_youtube_vids as $w) {
			
			unset($i,$k,$s,$t,$a,$d,$m,$y,$f,$z,$title);
			
			//get video ID
			$i = explode('/',$w['id']);
			$i = $i[count($i)-1];
			
			/*
			if($w['media:group']['yt:videoid']) {
				$i = $w['media:group']['yt:videoid'];
			}
			else {
				$w = $w['value'] ? $w['value'] : $w;
				$i = explode('/',$w['id']);
				$i = $i[count($i)-1];
			}
			*/
			
			$video = $wpdb->get_var("select meta_value from $wpdb->postmeta where meta_key='$i'");

			if(!empty($i) and strlen($i) > 0 and !$video and !in_array($i,$tern_wp_youtube_videos)) {

				//get info about a video
				$y = new tern_curl();
				$f = $y->get(array(
					'url'		=>	'https://gdata.youtube.com/feeds/api/videos/'.$i.'?v=2',
					'options'	=>	array(
						'RETURNTRANSFER'	=>	true,
						'FOLLOWLOCATION'	=>	true,
						'SSL_VERIFYPEER'	=>	false
					),
					'headers'	=>	array(
						'Accept-Charset'	=>	'UTF-8'
					)
				));

				$f->body = preg_replace("/(<media\:description[^>\/]*>)/","$1<![CDATA[",$f->body);
				$f->body = preg_replace("/(<\/media\:description>)/","]]>$1",$f->body);
				$f->body = preg_replace("/(<title[^>\/]*>)/","$1<![CDATA[",$f->body);
				$f->body = preg_replace("/(<\/title>)/","]]>$1",$f->body);
				$f->body = preg_replace("/(<media\:title[^>\/]*>)/","$1<![CDATA[",$f->body);
				$f->body = preg_replace("/(<\/media\:title>)/","]]>$1",$f->body);
				$z = new ternXML;
				$a = $z->parse($f->body);
				
				//errors
				if($a['errors']) {
					if($a['errors']['error']['code'] == 'too_many_recent_calls') {
						WP_ayvpp_parse_set_error('Google has responded that you have made too many requests for videos.');
					}
					return;
				}
				$a = $a['entry'];

				//compile post content
				$s = '';
				if(!empty($a["media:group"]['media:description'])) {
					$s = $a["media:group"]['media:description']['value'] ? $a["media:group"]['media:description']['value'] : $a["media:group"]['media:description'];
				}
				/*
				elseif(!empty($a['content'])) {
					$s = !empty($a['content']['value']) ? $a['content']['value'] : $a['content'];
				}
				*/

				if(!empty($s) and !is_array($s)) {
					//replace links
					$s = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.#!-]*(\?\S+)?)?)?)@',"<a href=\"$1\" target=\"_blank\" rel=\"nofollow\">$1</a>",$s);
					
					//add linebreaks
					$s = preg_replace("/[\r\n]/",'<br />',$s);
					
					//add more tag
					$s = explode(' ',(string)$s);
					if($tern_wp_youtube_o['words'] and count($s) > $tern_wp_youtube_o['words']) {
						$s = array_merge(array_splice($s,0,$tern_wp_youtube_o['words']),array('<!--more-->'),$s);
					}
					$s = implode(' ',$s);
				}
				else {
					$s = '';
				}

				//get keywords
				$t = isset($w['media:group']['media:keywords']) ? $w['media:group']['media:keywords'] : '';
				
				//get title
				//if(!empty($a["media:group"]['media:title'])) {
				//	$title = $a["media:group"]['media:title'];
				//}
				//elseif(!empty($a['title'])) {
					$title = is_array($a['title']) ? $a['title']['value'] : $a['title'];
					//$title = "sssaatest";
				//}
				//$title = apply_filters("post_title_save_pre",utf8_decode($title));
				
				if(!empty($title)) {
					$a = array(
						'post_title'					=>	$title,
						'post_content'					=>	$s,
						'_tern_wp_youtube_author'		=>	$w['author']['name'],
						'tags_input'					=>	$t,
						'post_date'						=>	gmdate('Y-m-d H:i:s',strtotime($w['published'])),
						'post_author'					=>	$v['author'],
						'post_category'					=>	$v['categories']
					);
					
					$a['id'] = WP_ayvpp_insert_post(array_merge($tern_wp_youtube_post_defaults,$a),$i);
					if($a['id']) {
						if($n == '*') {
							WP_ayvpp_update_file('<span class="imported">'.($x+$c).'. '.$title.'</span>');
						}
						$tern_wp_youtube_videos[] = $i;
					}
				}
				else {
					WP_ayvpp_update_file('<span class="req"><b>Error:</b> adding video "'.$i.'"</span>');
				}
			}
			else {
				WP_ayvpp_update_file('<span class="req"><b>Already imported: </b>'.$w['title']['value'].'</span>');
			}
			
			$c++;
		}
		
	}

	if($n == '*' and (int)$total <= 1000) {
		return WP_ayvpp_add_import_posts($x+50,$n,$r);
	}
	
	WP_ayvpp_update_file('<h3 id="tern_wp_ayvpp_complete">Complete!</h3>');
	return true;
	
}
function WP_ayvpp_parse_set_error($e) {
	global $getWP,$tern_wp_youtube_options;
	WP_ayvpp_update_file('<h2 id="tern_wp_ayvpp_complete" class="req"><b>'.$e.'</b></h2>');
	$getWP->addError($e);
	
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	$o['is_importing'] = false;
	$o = $getWP->getOption('tern_wp_youtube',$o,true);
}
function WP_ayvpp_file_contents() {
	global $getFILE;
	return $getFILE->contents(WP_CONTENT_DIR.'/cache/ayvpp.txt');
}
function WP_ayvpp_reset_file() {
	global $getFILE;
	$getFILE->createFile('ayvpp.txt','',WP_CONTENT_DIR.'/cache');
}
function WP_ayvpp_update_file($c) {
	global $getFILE;
	$d = WP_ayvpp_file_contents();
	$d .= empty($d) ? $c : '<->'.$c;
	$getFILE->createFile('ayvpp.txt',$d,WP_CONTENT_DIR.'/cache');
}
function WP_ayvpp_check_memory() {

	$max = isset($_GET['memory']) ? (int)$_GET['memory'] : 32;

	$l = ini_get('memory_limit');
	preg_match("/[0-9]+/",$l,$m);
	$memory = (int)$m[0];
	$limit = (int)$m[0]*1048576;
	
	if(memory_get_usage() > ($limit-5242880)) {
		$memory += 5;
		if($memory <= $max) {
			ini_set('memory_limit',$memory.'M');
			$limit = $memory*1048576;
			return true;
		}
		return false;
	}
	
	return true;
}
function WP_ayvpp_insert_post($a,$i) {
	global $wpdb,$tern_wp_youtube_array;
	$tern_wp_youtube_array = array_merge($a,array('_tern_wp_youtube_video'=>$i,'_tern_wp_youtube_published'=>$a['post_date']));
	$p = wp_insert_post($a);
	WP_ayvpp_add_meta($p);
	unset($GLOBALS['wpdb']->last_result);
	return $p;
}
function WP_ayvpp_delete_posts($i) {
	global $getWP,$tern_wp_youtube_options,$tern_wp_youtube_fields;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	$videos = $getWP->getOption('tern_wp_youtube_videos',array());
	$y = get_post_meta($i,'_tern_wp_youtube_video',true);
	if($videos[$y]) {
		$videos[$y]['id'] = false;
		foreach($tern_wp_youtube_fields as $v) {
			delete_post_meta($i,$v);
		}
	}
}
function WP_ayvpp_add_meta($i) {
	global $tern_wp_youtube_fields,$tern_wp_youtube_array;
	foreach($tern_wp_youtube_fields as $v) {
		delete_post_meta($i,$v);
		if(!empty($tern_wp_youtube_array[$v]) or !empty($_POST[$v])) {
			$m = empty($tern_wp_youtube_array[$v]) ? $_POST[$v] : $tern_wp_youtube_array[$v];
			update_post_meta($i,$v,$m);
		}
	}
	$m = get_post_meta($i,'_thumbnail_id',true);
	if(!wp_is_post_revision($i) and (!$m or empty($m) or (is_string($m) and strlen($m) < 1))) {
		update_post_meta($i,'_thumbnail_id',$tern_wp_youtube_array['_tern_wp_youtube_video']);
	}
	unset($m);
	return true;
}
function WP_ayvpp_update_meta($i) {
	global $tern_wp_youtube_fields,$tern_wp_youtube_array;
	
	$i = wp_is_post_revision($i) ? wp_is_post_revision($i) : $i;
	if(!wp_verify_nonce($_POST['tern_wp_youtube_nonce'],plugin_basename(__FILE__)) or !$i or !current_user_can('edit_post',$i)) {
		return;
	}
	
	foreach($tern_wp_youtube_fields as $v) {
		delete_post_meta($i,$v);
		if(!empty($tern_wp_youtube_array[$v]) or !empty($_POST[$v])) {
			$m = empty($tern_wp_youtube_array[$v]) ? $_POST[$v] : $tern_wp_youtube_array[$v];
			update_post_meta($i,$v,$m);
		}
	}
	$m = get_post_meta($i,'_thumbnail_id',true);
	if((!$m or empty($m) or (is_string($m) and strlen($m) < 1))) {
		update_post_meta($i,'_thumbnail_id',$tern_wp_youtube_array['_tern_wp_youtube_video']);
	}
	unset($m);
	return true;
}
function WP_ayvpp_parse_videos($v,$t='channel',$i=1,$n=20) {
	global $tern_wp_youtube_vids,$tern_wp_youtube_feed;

	$z = $n == '*' ? 50 : $n;
	
	$tern_wp_youtube_feed = false;
	if($t == 'channel') {
		$tern_wp_youtube_feed = 'http://gdata.youtube.com/feeds/api/users/'.$v.'/uploads?orderby=published&max-results='.$z.'&start-index='.$i;
	}
	elseif($t == 'playlist') {
		$tern_wp_youtube_feed = 'http://gdata.youtube.com/feeds/api/playlists/'.$v.'?v=2';
	}
	if(!$tern_wp_youtube_feed) {
		unset($tern_wp_youtube_vids);
		return false;
	}
	$c = new tern_curl();
	$r = $c->get(array(
		'url'		=>	$tern_wp_youtube_feed,
		'options'	=>	array(
			'RETURNTRANSFER'	=>	true,
			'FOLLOWLOCATION'	=>	true
		),
		'headers'	=>	array(
			'Accept-Charset'	=>	'UTF-8'
		)
	));
	$r->body = preg_replace("/(<media\:description[^>\/]*>)/","$1<![CDATA[",$r->body);
	$r->body = preg_replace("/(<\/media\:description>)/","]]>$1",$r->body);
	$r->body = preg_replace("/(<title[^>\/]*>)/","$1<![CDATA[",$r->body);
	$r->body = preg_replace("/(<\/title>)/","]]>$1",$r->body);
	$r->body = preg_replace("/(<media\:title[^>\/]*>)/","$1<![CDATA[",$r->body);
	$r->body = preg_replace("/(<\/media\:title>)/","]]>$1",$r->body);
	$r->body = preg_replace("/(<content[^>\/]*>)/","$1<![CDATA[",$r->body);
	$r->body = preg_replace("/(<\/content>)/","]]>$1",$r->body);

	$x = new ternXML;
	$a = $x->parse($r->body);
	
	if($a['errors']) {
		if($a['errors']['error']['code'] == 'too_many_recent_calls') {
			WP_ayvpp_parse_set_error('Google has responded that you have made too many requests for videos.');
		}
		return;
	}

	if(empty($a['feed']['entry']) and empty($a['feed']['entry']['value'])) {
		return;
	}
	else {
		$a = empty($a['feed']['entry']['value']) ? $a['feed']['entry'] : $a['feed']['entry']['value'];
	}
	
	if($a['id']) { 
		$a = array($a);
	}

	$tern_wp_youtube_vids = $a;
	
	unset($c,$r,$x,$a);
	
	return true;
}

/****************************************Terminate Script******************************************/
?>
