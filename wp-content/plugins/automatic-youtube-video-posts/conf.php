<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			conf.php
//		Description:
//			This file configures the Wordpress Plugin - Automatic YouTube Video Posts Plugin
//		Actions:
//			1) initialize pertinent variables
//			2) load classes and functions
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
$tern_wp_youtube_options = array(
	'user'				=>	'',
	'channels'			=>	array(),
	//'category'		=>	false,
	//'author'			=>	1,
	'display_meta'		=>	1,
	'words'				=>	20,
	'publish'			=>	1,
	'rss'				=>	0,
	//'videos'			=>	array(),
	//'deleted'			=>	array(),
	//'twitter'			=>	0,
	//'twitter_user'		=>	'',
	//'twitter_password'	=>	'',
	//0'twitter_text'		=>	'I have posted a new video here: %twitter_link%',
	'limit'				=>	4,
	'pages'				=>	0,
	'dims'				=>	array(506,304),
	'related'			=>	1,
	'inlist'			=>	0,
	'cron'				=>	6,
	'last_import'		=>	'',
	'is_importing'		=>	false,
	'version'			=>	''
);
$tern_wp_youtube_fields = array(
	'Youtube ID:'			=>	'_tern_wp_youtube_video',
	'Youtube Publish Date:'	=>	'_tern_wp_youtube_published',
	'Youtube Author:'		=>	'_tern_wp_youtube_author'
);
$tern_wp_youtube_array = array();
$tern_wp_youtube_version = 206;
//                                *******************************                                 //
//________________________________** FILE CLASS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
require_once(dirname(__FILE__).'/class/file.php');
$getFILE = new fileClass;
//                                *******************************                                 //
//________________________________** LOAD CLASSES              **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
$l = $getFILE->directoryList(array(
	'dir'	=>	dirname(__FILE__).'/class/',
	'rec'	=>	true,
	'flat'	=>	true,
	'depth'	=>	1
));
if(is_array($l)) {
	foreach($l as $k => $v) {
		require_once($v);
	}
}
//                                *******************************                                 //
//________________________________** LOAD CORE FILES           **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
$l = $getFILE->directoryList(array(
	'dir'	=>	dirname(__FILE__).'/core/',
	'rec'	=>	true,
	'flat'	=>	true,
	'depth'	=>	1
));
if(is_array($l)) {
	foreach($l as $k => $v) {
		require_once($v);
	}
}
unset($l,$k,$v);
//                                *******************************                                 //
//________________________________** CHECK DIRECTORIES         **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
if(!is_file(WP_CONTENT_DIR.'/cache/ayvpp.txt') and !$getFILE->createFile('ayvpp.txt','',WP_CONTENT_DIR.'/cache')) {
	$getWP->addError('Automatic YouTube Video Posts Plugin file ('.WP_CONTENT_DIR.'/cache/ayvpp.txt) either does not exist or is not writable. You cannot properly use the "Import" aspects of this plugin until this is resolved.');
}
if(!$getFILE->isWritableDirectory(WP_CONTENT_DIR.'/cache/timthumb')) {
	$getWP->addError('Automatic YouTube Video Posts Plugin folder ('.WP_CONTENT_DIR.'/cache/timthumb) either does not exist or is not writable. You cannot properly use the "thumbnail" aspects of this plugin until this is resolved.');
}
//                                *******************************                                 //
//________________________________** INITIALIZE PLUGIN         **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('init','WP_ayvpp_init',0);
function WP_ayvpp_init() {
	global $getWP,$tern_wp_youtube_post_defaults;
	$o = $getWP->getOption('tern_wp_youtube',$tern_wp_youtube_options);
	
	$tern_wp_youtube_post_defaults = array(
		'post_author'		=>	$o['author'],
		'post_category'		=>	array($o['category']),
		'comment_status'	=>	'open',
		'ping_status'		=>	'open',
		'post_status'		=>	$o['publish'] ? 'publish' : 'draft'
	);
}

/****************************************Terminate Script******************************************/
?>