<?php
add_action('wp_ajax_saveshare', 'cunjo_share_callback');
function cunjo_share_callback() {
	global $wpdb;
		$idz = $_POST['id'];
		if(empty($idz)) {
			echo 'noid';
		}
		else {
			$ShareBarSettings = array('layout' => 'bottom_tab', 'color' => 'black', 'width' => '100', 'position' => 'center', 'icons' => '',);
			json_encode($ShareBarSettings);
			$ShareBarSocials = array('Facebook','Twitter','Google','Linkedin','Pinterest','Digg');
			$ShareLineSettings = array('layout' => 'simple', 'color' => '32', 'width' => '50', 'position' => 'center', 'icons' => 'shiny',);
			json_encode($ShareLineSettings);
			$ShareLineSocials = array('Facebook','Twitter','Google','Linkedin','Pinterest','Digg');
			update_option( 'ShareBarSettings', $ShareBarSettings );
			update_option( 'ShareBarSocials', $ShareBarSocials );
			update_option( 'ShareLineSettings', $ShareLineSettings );
			update_option( 'ShareLineSocials', $ShareLineSocials );
			update_option( 'shareID', $idz );
			echo get_main();
		}
	
	die();
}
//activate widgets
add_action('wp_ajax_activateshare', 'cunjo_share_activate');
function cunjo_share_activate() {
	global $wpdb;
		$type = $_POST['type'];
		if(empty($type)) {
			echo 'no';
		}
		else {
			if($type == 'Bar') {
				update_option( 'ShareBarActive', 1 );
			}
			elseif($type == 'Line') {
				update_option( 'ShareLineActive', 1 );
			}
			echo 'activated';
		}
	
	die();
}
//deactivate widgets
add_action('wp_ajax_deactivateshare', 'cunjo_share_deactivate');
function cunjo_share_deactivate() {
	global $wpdb;
		$type = $_POST['type'];
		if(empty($type)) {
			echo 'no';
		}
		else {
			if($type == 'Bar') {
				update_option( 'ShareBarActive', 0 );
			}
			elseif($type == 'Line') {
				update_option( 'ShareLineActive', 0 );
			}
			echo 'deactivated';
		}
	
	die();
}
//build bar
add_action('wp_ajax_buildbar', 'cunjo_share_buildbar');
function cunjo_share_buildbar() {
	global $wpdb;
		$step = $_POST['step'];
		if(empty($step)) {
			echo 'no';
		}
		else{
			echo get_barbuilder($step);
		}
	
	die();
}
//build line
add_action('wp_ajax_buildline', 'cunjo_share_buildline');
function cunjo_share_buildline() {
	global $wpdb;
		$step = $_POST['step'];
		if(empty($step)) {
			echo 'no';
		}
		else{
			echo get_linebuilder($step);
		}
	
	die();
}

?>