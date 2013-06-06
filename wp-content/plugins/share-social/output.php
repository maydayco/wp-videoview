<?php
session_start();
function get_license() {
			$settings .= '<div class="final-email">';
			$settings 	.= '<div class="final-description" style="text-align: center">Register for your !Share ID</div>';
			$settings 	.= '<div style="position:relative; margin-top: -21px; text-align: center;"><img src="'. CUNJO_SHARE_URL .'/images/arr-final-register.png" width="40" height="31" style="box-shadow: none;"/></div>';
			$settings 	.= '<div class="register-mess"></div>';
			$settings 	.= '<form action="#" id="register_share">';
			$settings 		.= '<label for="email">Email Address</label>';
			$settings 		.= '<input type="text" id="email" name="email" value="" style="width: 90%;"/><br><br>';
			$settings 		.= '<input type="checkbox" name="terms" value="terms" id="terms"><label for="terms">I agree with <a href="http://cunjo.com/cunjo-share-terms-conditions" target="_blank">Terms & Conditions</a></label><br><br>';
			$settings 		.= '<input type="submit" id="submit_share" class="button activeButton-blue-gray" value="Register Widget" onclick="return register_share()"/><br><br>';
			$settings 	.= '</form>';
			$settings 	.= '<small>* We do not send spam emails and we do not sell email lists! You will only receive updates about Cunjo\'s Share Widget.</small>';
			$settings .= '</div>';
			$settings .= '<div class="final-or">';
			$settings 	.= '<span>or</span>';
			$settings .= '</div>';
			$settings .= '<div class="final-code">';
			$settings 	.= '<div class="final-description-code" style="text-align: center">Insert your !Share ID</div>';
			$settings 	.= '<div style="position:relative; margin-top: -21px; text-align: center;"><img src="'. CUNJO_SHARE_URL .'/images/arr-final-code.png" width="40" height="31" style="box-shadow: none;"/></div>';
			$settings 	.= '<div class="get-mess"></div>';
			$settings 	.= '<form action="" id="register_share">';
			$settings 		.= '<label for="idz">Insert the !Share ID received by email</label>';
			$settings 		.= '<input type="text" id="idz" name="idz" value="" style="width: 90%;"/><br>';
			$settings 		.= '<input type="submit" id="submit_share" class="button activeButton-blue-gray" value="Save your !Share ID" onclick="return get_share()"/><br>';
			$settings 	.= '</form><br>';
			$settings .= '</div>';
						
			$out .= $settings;
			
			return $out;

}
function get_main() {
			$settings .= '<div class="final-email">';
			$settings 	.= '<div class="final-description" style="text-align: center">Share & Message Bar</div>';
			$settings 	.= '<div style="position:relative; margin-top: -21px; text-align: center;"><img src="'. CUNJO_SHARE_URL .'/images/arr-final-register.png" width="40" height="31" style="box-shadow: none;"/></div>';
			$settings 	.= '<div class="register-mess"></div>';
				$settings .= '<ul class="share-select dashboard">';
				$barCheck = get_option('ShareBarActive');
				if(empty($barCheck) || $barCheck == 0) {
					$bar_status_id = 'activate_bar';
					$bar_status_icon = 'disabled';
					$bar_status_title = 'Click to enable';
					$bar_status_text = 'Disabled';
				}
				else {
					$bar_status_id = 'deactivate_bar';
					$bar_status_icon = 'enabled';
					$bar_status_title = 'Click to disable';
					$bar_status_text = 'Enabled';
				}
				$settings	 .= '<li id="'.$bar_status_id.'" class="chooseit share-features" title="'.$bar_status_title.'">';
				$settings 		.= '<div class="statusimg"><div class="status-'.$bar_status_icon.'"></div></div><br /><br />';
				$settings 		.= '<span style="font-size: 16px; font-weight: bold;">'.$bar_status_text.'</span>';
				$settings 		.= '<div class="option-checked"></div>';
				$settings 	 .= '</li>';
				$settings	 .= '<li id="build_bar" class="chooseit attention-features" title="Feature only available for header/footer bar" style="margin-right: 0;">';
				$settings 		.= '<img src="'. CUNJO_SHARE_URL .'/images/builder.png" width="32" height="32" style="margin-top: 25px;"/><br /><br />';
				$settings 		.= '<span style="font-size: 16px; font-weight: bold;">Visual Builder</span>';
				$settings 		.= '<div class="option-checked"></div>';
				$settings 	 .= '</li>';
				$settings .= '</ul>';
			$settings 	.= '<small>*The Share and Message Bar is our famous and flexible floating bar (top, bottom, left & right) witch can hold the social buttons and/or an attention grabber message icon and link</small>';
			$settings .= '</div>';
			$settings .= '<div class="final-or">';
			$settings 	.= '<span>and</span>';
			$settings .= '</div>';
			$settings .= '<div class="final-code">';
			$settings 	.= '<div class="final-description-code" style="text-align: center">Share Simple Buttons</div>';
			$settings 	.= '<div style="position:relative; margin-top: -21px; text-align: center;"><img src="'. CUNJO_SHARE_URL .'/images/arr-final-code.png" width="40" height="31" style="box-shadow: none;"/></div>';
			$settings 	.= '<div class="get-mess"></div>';
				$settings .= '<ul class="share-select dashboard">';
				$lineCheck = get_option('ShareLineActive');
				if(empty($lineCheck) || $lineCheck == 0) {
					$line_status_id = 'activate_line';
					$line_status_icon = 'disabled';
					$line_status_title = 'Click to enable';
					$line_status_text = 'Disabled';
				}
				else {
					$line_status_id = 'deactivate_line';
					$line_status_icon = 'enabled';
					$line_status_title = 'Click to disable';
					$line_status_text = 'Enabled';
				}
				$settings	 .= '<li id="'.$line_status_id.'" class="chooseit share-features" title="'.$line_status_title.'">';
				$settings 		.= '<div class="statusimg"><div class="status-'.$line_status_icon.'"></div></div><br /><br />';
				$settings 		.= '<span style="font-size: 16px; font-weight: bold;">'.$line_status_text.'</span>';
				$settings 		.= '<div class="option-checked"></div>';
				$settings 	 .= '</li>';
				$settings	 .= '<li id="build_line" class="chooseit attention-features" title="Feature only available for header/footer bar" style="margin-right: 0;">';
				$settings 		.= '<img src="'. CUNJO_SHARE_URL .'/images/builder.png" width="32" height="32" style="margin-top: 25px;"/><br /><br />';
				$settings 		.= '<span style="font-size: 16px; font-weight: bold;">Visual Builder</span>';
				$settings 		.= '<div class="option-checked"></div>';
				$settings 	 .= '</li>';
				$settings .= '</ul>';
			$settings 	.= '<small>*The Share Simple Buttons are the social share icons that will appear above/under your post/pages. These are simpler buttons, they will not float, only display as inline.</small>';
			$settings .= '</div>';
			$out .= $settings;
			
			return $out;

}
//bar builder
function get_barbuilder($step) {
	$ShareID = get_option('shareID');
	if($step == 1) {
		$types	.= '<div class="register-mess"></div>';
		$types	.= '<h2>1. Select Bar Type</h2>';
		$types	.= '<ul class="share-select type">';
		$types		 .= '<li id="bar1" class="chooseit bar1-share selected">';
		$types		 	.= '<div class="option-checked"></div>';
		$types		 	.= '<div class="description bar1"><br />The bottom social bar is fixed, it will always stay on the bottom frame of your website. Always in view, will increase the share count. </div>';
		$types		 .= '</li>';
		$types		 .= '<li id="bar2" class="chooseit bar2-share">';
		$types		 	.= '<div class="option-checked"></div>';
		$types		 	.= '<div class="description bar2"><br />The top bar is fixed to the top frame but it will show up only after user scrolls down. Keeping your original header.</div>';
		$types		 .= '</li>';
		$types		 .= '<li id="bar3" class="chooseit bar3-share">';
		$types		 	.= '<div class="option-checked"></div>';
		$types		 	.= '<div class="description bar3"><br />This bar floats on the left side of your website page. Always in view.</div>';
		$types		 .= '</li>';
		$types		 .= '<li id="bar4" class="chooseit bar4-share">';
		$types		 	.= '<div class="option-checked"></div>';
		$types		 	.= '<div class="description bar4"><br />This bar floats on the right side of your website page. Always in view.</div>';
		$types		 .= '</li>';
		$types		 .= '<li id="bar5" class="chooseit bar5-share">';
		$types		 	.= '<div class="option-checked"></div>';
		$types		 	.= '<div class="description bar3"><br />This elegant bar floats on bottom of your website page. Always in view. It has social counter features</div>';
		$types		 .= '</li>';
		$types		 .= '<li id="bar6" class="chooseit bar6-share">';
		$types		 	.= '<div class="option-checked"></div>';
		$types		 	.= '<div class="description bar4"><br />This elegant bar floats on the left side of your website page. Always in view. It has social counter features</div>';
		$types		 .= '</li>';
		$types	.= '</ul>';
		$types	.= '<hr />';
		$types	.= '<div>';
		$types	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
		$types	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(2);">Next Step</div>';
		$types	.= '<div style="clear:both"></div>';
		$types	.= '</div>';
		$javascript = '<script type="text/javascript">jQuery(".share-select.type .chooseit").click(function() {';
		$javascript 	.= 'jQuery(".chooseit:visible").removeClass("selected");';
		$javascript 	.= 'jQuery(this).addClass("selected");';
		$javascript .= '});';
		$javascript .= '';
        $javascript .= '</script>';
		$out .= $types.$javascript;
	}
	elseif($step == 2) {
		$features	.= '<div class="register-mess"></div>';
		$features .= '<h2>2. Select Bar Features</h2>';
		$ltype = $_POST['ltype'];
		$_SESSION['share']['ltype'] = $ltype;
		switch ($ltype)
			{
			case "bar1":
				$features .= '<ul class="share-select features">';
				$features	 .= '<li id="share_features" class="chooseit share-features selected">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/share-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Share Links</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features	 .= '<li id="attention_features" class="chooseit attention-features selected">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/attention-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Attention Grabber</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features .= '</ul>';
				$features	.= '<hr />';
				$features	.= '<div>';
				$features	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
				$features	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(3);">Next Step</div>';
				$features	.= '<div style="clear:both"></div>';
				$features	.= '</div>';
				
				$bar .= '<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="bottom_tab" color="black" width="100" position="center" icons="" message="Your call to action text will show up here!" messageicon="Sharetalk" messagelink="http://cunjo.com"></div>';
				
				$javascript = '<script type="text/javascript">jQuery(".share-select.features .chooseit").click(function() {';
				$javascript 	.= 'if(jQuery(this).hasClass("selected") != true){';
    			$javascript 		.= 'jQuery(this).addClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeIn(500);';
				$javascript 		.= '}else if(jQuery(this).attr("id") == "attention_features"){';
				$javascript 			.= 'jQuery("#Share-message").fadeIn(500);';
				$javascript 			.= 'jQuery("#Share-networks").css("position", "absolute");';
				$javascript 			.= 'jQuery("#Share-networks").css("right", "40px");';
				$javascript 		.= '}';
				$javascript 	.= '}else{';
				$javascript 		.= 'jQuery(this).removeClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeOut(500);';
				$javascript 		.= '}else if(jQuery(this).attr("id") == "attention_features"){';
				$javascript 			.= 'jQuery("#Share-message").fadeOut(500);';
				$javascript 			.= 'jQuery("#Share-networks").css("position", "relative");';
				$javascript 			.= 'jQuery("#Share-networks").css("right", "0px");';
				$javascript 		.= '}';
				$javascript 	.= '}';
				$javascript .= '});</script>';
				$out .= $features.$bar.$javascript;
			break;
			case "bar2":
				$features .= '<ul class="share-select features">';
				$features	 .= '<li id="share_features" class="chooseit share-features selected">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/share-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Share Links</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features	 .= '<li id="attention_features" class="chooseit attention-features selected">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/attention-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Attention Grabber</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features .= '</ul>';
				$features	.= '<hr />';
				$features	.= '<div>';
				$features	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
				$features	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(3);">Next Step</div>';
				$features	.= '<div style="clear:both"></div>';
				$features	.= '</div>';
				$features 	.= '<style>#Share-bar{top: 28px !important;}</style>';
				
				$bar .= '<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="top_tab" color="black" width="100" position="center" icons="" message="Your call to action text will show up here!" messageicon="Sharetalk" messagelink="http://cunjo.com" showat="0"></div>';
				
				$javascript = '<script type="text/javascript">jQuery(".share-select.features .chooseit").click(function() {';
				$javascript 	.= 'if(jQuery(this).hasClass("selected") != true){';
    			$javascript 		.= 'jQuery(this).addClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeIn(500);';
				$javascript 		.= '}else if(jQuery(this).attr("id") == "attention_features"){';
				$javascript 			.= 'jQuery("#Share-message").fadeIn(500);';
				$javascript 			.= 'jQuery("#Share-networks").css("position", "absolute");';
				$javascript 			.= 'jQuery("#Share-networks").css("right", "40px");';
				$javascript 		.= '}';
				$javascript 	.= '}else{';
				$javascript 		.= 'jQuery(this).removeClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeOut(500);';
				$javascript 		.= '}else if(jQuery(this).attr("id") == "attention_features"){';
				$javascript 			.= 'jQuery("#Share-message").fadeOut(500);';
				$javascript 			.= 'jQuery("#Share-networks").css("position", "relative");';
				$javascript 			.= 'jQuery("#Share-networks").css("right", "0px");';
				$javascript 		.= '}';
				$javascript 	.= '}';
				$javascript .= '});</script>';
				$out .= $features.$bar.$javascript;
			break;
			case "bar3":
				$features .= '<ul class="share-select features">';
				$features	 .= '<li id="share_features" class="chooseit share-features selected">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/share-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Share Links</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features	 .= '<li id="attention_features" class="chooseit attention-features disabled" title="Feature only available for header/footer bar">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/attention-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Attention Grabber</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features .= '</ul>';
				$features	.= '<hr />';
				$features	.= '<div>';
				$features	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
				$features	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(3);">Next Step</div>';
				$features	.= '<div style="clear:both"></div>';
				$features	.= '</div>';
				
				$bar .= '<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="sideleft_tab" color="black" width="50" position="center" icons="" ></div>';
				
				$javascript = '<script type="text/javascript">jQuery(".share-select.features .chooseit").click(function() {';
				$javascript 	.= 'if(jQuery(this).hasClass("selected") != true){';
    			$javascript 		.= 'jQuery(this).addClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeIn(500);';
				$javascript 		.= '}';
				$javascript 	.= '}else{';
				$javascript 		.= 'jQuery(this).removeClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeOut(500);';
				$javascript 		.= '}';
				$javascript 	.= '}';
				$javascript .= '});</script>';
				$out .= $features.$bar.$javascript;
			break;
			case "bar4":
				$features .= '<ul class="share-select features">';
				$features	 .= '<li id="share_features" class="chooseit share-features selected">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/share-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Share Links</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features	 .= '<li id="attention_features" class="chooseit attention-features disabled" title="Feature only available for header/footer bar">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/attention-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Attention Grabber</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features .= '</ul>';
				$features	.= '<hr />';
				$features	.= '<div>';
				$features	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
				$features	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(3);">Next Step</div>';
				$features	.= '<div style="clear:both"></div>';
				$features	.= '</div>';
				$bar .= '<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="sideright_tab" color="black" width="50" position="center" icons="" ></div>';
				
				$javascript = '<script type="text/javascript">jQuery(".share-select.features .chooseit").click(function() {';
				$javascript 	.= 'if(jQuery(this).hasClass("selected") != true){';
    			$javascript 		.= 'jQuery(this).addClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeIn(500);';
				$javascript 		.= '}';
				$javascript 	.= '}else{';
				$javascript 		.= 'jQuery(this).removeClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeOut(500);';
				$javascript 		.= '}';
				$javascript 	.= '}';
				$javascript .= '});</script>';
				$out .= $features.$bar.$javascript;
			break;
			case "bar5":
				$features .= '<ul class="share-select features">';
				$features	 .= '<li id="share_features" class="chooseit share-features selected">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/share-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Share Links</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features	 .= '<li id="attention_features" class="chooseit attention-features disabled" title="Feature only available for header/footer bar">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/attention-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Attention Grabber</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features .= '</ul>';
				$features	.= '<hr />';
				$features	.= '<div>';
				$features	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
				$features	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(3);">Next Step</div>';
				$features	.= '<div style="clear:both"></div>';
				$features	.= '</div>';
				
				$bar .= '<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="nice_bottom" color="#fefefe" width="100" position="center" icons="" counter="yes" textcolor="#000"></div>';
				
				$javascript = '<script type="text/javascript">jQuery(".share-select.features .chooseit").click(function() {';
				$javascript 	.= 'if(jQuery(this).hasClass("selected") != true){';
    			$javascript 		.= 'jQuery(this).addClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeIn(500);';
				$javascript 		.= '}else if(jQuery(this).attr("id") == "attention_features"){';
				$javascript 			.= 'jQuery("#Share-message").fadeIn(500);';
				$javascript 			.= 'jQuery("#Share-networks").css("position", "absolute");';
				$javascript 			.= 'jQuery("#Share-networks").css("right", "40px");';
				$javascript 		.= '}';
				$javascript 	.= '}else{';
				$javascript 		.= 'jQuery(this).removeClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeOut(500);';
				$javascript 		.= '}else if(jQuery(this).attr("id") == "attention_features"){';
				$javascript 			.= 'jQuery("#Share-message").fadeOut(500);';
				$javascript 			.= 'jQuery("#Share-networks").css("position", "relative");';
				$javascript 			.= 'jQuery("#Share-networks").css("right", "0px");';
				$javascript 		.= '}';
				$javascript 	.= '}';
				$javascript .= '});</script>';
				$out .= $features.$bar.$javascript;
			break;
			case "bar6":
				$features .= '<ul class="share-select features">';
				$features	 .= '<li id="share_features" class="chooseit share-features selected">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/share-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Share Links</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features	 .= '<li id="attention_features" class="chooseit attention-features disabled" title="Feature only available for header/footer bar">';
				$features 		.= '<img src="'. CUNJO_SHARE_URL .'/images/attention-48.png" width="48" height="48"/>';
				$features 		.= '<br />';
				$features 		.= '<span>Attention Grabber</span>';
				$features 		.= '<div class="option-checked"></div>';
				$features 	 .= '</li>';
				$features .= '</ul>';
				$features	.= '<hr />';
				$features	.= '<div>';
				$features	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
				$features	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(3);">Next Step</div>';
				$features	.= '<div style="clear:both"></div>';
				$features	.= '</div>';
				
				$bar .= '<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="nice_left" color="#fefefe" width="100" position="center" icons="" counter="no" textcolor="#000" offleft="40"></div>';
				
				$javascript = '<script type="text/javascript">jQuery(".share-select.features .chooseit").click(function() {';
				$javascript 	.= 'if(jQuery(this).hasClass("selected") != true){';
    			$javascript 		.= 'jQuery(this).addClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeIn(500);';
				$javascript 		.= '}else if(jQuery(this).attr("id") == "attention_features"){';
				$javascript 			.= 'jQuery("#Share-message").fadeIn(500);';
				$javascript 			.= 'jQuery("#Share-networks").css("position", "absolute");';
				$javascript 			.= 'jQuery("#Share-networks").css("right", "40px");';
				$javascript 		.= '}';
				$javascript 	.= '}else{';
				$javascript 		.= 'jQuery(this).removeClass("selected");';
				$javascript 		.= 'if(jQuery(this).attr("id") == "share_features"){';
				$javascript 			.= 'jQuery("#Share-networks").fadeOut(500);';
				$javascript 		.= '}else if(jQuery(this).attr("id") == "attention_features"){';
				$javascript 			.= 'jQuery("#Share-message").fadeOut(500);';
				$javascript 			.= 'jQuery("#Share-networks").css("position", "relative");';
				$javascript 			.= 'jQuery("#Share-networks").css("right", "0px");';
				$javascript 		.= '}';
				$javascript 	.= '}';
				$javascript .= '});</script>';
				$out .= $features.$bar.$javascript;
			break;
			default:
			  $out .= '<div class="widget-alert">Please select Layout type</div>';
			}
	}
	elseif($step == 3) {
		$settings	.= '<div class="register-mess"></div>';
		$settings	.= '<h2>3. Build !Share</h2>';
		$ltype = $_SESSION['share']['ltype'];
		if($ltype == 'bar2'){$settings .= '<style>#Share-bar{top: 28px !important;}</style>';}
			$features = $_POST['features'];
			$_SESSION['share']['features'] = $features;
			//$features = explode(',', $features);
			foreach($features as $feature) {
				if($feature == 'share_features') {
					$settings .= '<h2>Select Social Networks for your widget:</h2>';
					$settings .= '
							<div class="drag-links">
								<ul id="socialsuse" class="connected list">
									<li class="Facebook"><div class="share-icns"></div><span>Facebook</span></li>
									<li class="Twitter"><div class="share-icns"></div><span>Twitter</span></li>
									<li class="Google"><div class="share-icns"></div><span>Google</span></li>
									<li class="Linkedin"><div class="share-icns"></div><span>Linkedin</span></li>
									<li class="Pinterest"><div class="share-icns"></div><span>Pinterest</span></li>
									<li class="Digg"><div class="share-icns"></div><span>Digg</span></li>
								</ul>
								<div class="between-connected">Drag to activate <img src="'. CUNJO_SHARE_URL .'/images/arrow-drag.png" width="120" height="45" style="box-shadow: none;"/></div>
								<ul class="connected list no2">
									<li class="Myspace"><div class="share-icns"></div><span>Myspace</span></li>
									<li class="Stumbleupon"><div class="share-icns"></div><span>Stumbleupon</span></li>
									<li class="Bebo"><div class="share-icns"></div><span>Bebo</span></li>
									<li class="Blogger"><div class="share-icns"></div><span>Blogger</span></li>
									<li class="Delicious"><div class="share-icns"></div><span>Delicious</span></li>
									<li class="Xing"><div class="share-icns"></div><span>Xing</span></li>
									<li class="Tumblr"><div class="share-icns"></div><span>Tumblr</span></li>
									<li class="Technorati"><div class="share-icns"></div><span>Technorati</span></li>
									<li class="Reddit"><div class="share-icns"></div><span>Reddit</span></li>
									<li class="Netlog"><div class="share-icns"></div><span>Netlog</span></li>
									<li class="Identi"><div class="share-icns"></div><span>Identi</span></li>
									<li class="Friendfeed"><div class="share-icns"></div><span>Friendfeed</span></li>
									<li class="Evernote"><div class="share-icns"></div><span>Evernote</span></li>
									<li class="Diigo"><div class="share-icns"></div><span>Diigo</span></li>
								</ul>
							</div>
				';
				$settings .= '<div style="clear:both"></div><hr />';
				}
				elseif($feature == 'attention_features') {
					$settings .= '<h2 id="headerattention">Setup your Attention Grabber feature:</h2>';
					$settings .= '<label for="att_text">Your Call to Action Text</label> <input type="text" name="att_text" id="att_text"/><br /><br />';
					$settings .= '<label for="att_link">Your Call to Action URL</label> <input type="text" name="att_link" id="att_link"/>  <small>Please provide a protocol, i.e. "http://"</small><br /><br />';
					$settings .= '<label for="att_icon">Your Call to Action Icon</label><br />';
					$settings .= '<ul class="share-select icon" id="att_icon">';
					$settings 	.= '<li id="Sharetalk" class="chooseit Sharetalk-share selected">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Sharetalk"></div></div>';
					$settings 		.= '<span>Chat</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Shareannounce" class="chooseit Shareannounce-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Shareannounce"></div></div>';
					$settings 		.= '<span>Announce</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Shareimportant" class="chooseit Shareimportant-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Shareimportant"></div></div>';
					$settings 		.= '<span>Important</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Sharestar" class="chooseit Sharestar-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Sharestar"></div></div>';
					$settings 		.= '<span>Star</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Shareinfo" class="chooseit Shareinfo-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Shareinfo"></div></div>';
					$settings 		.= '<span>Info</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Sharetalk2" class="chooseit Sharetalk2-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Sharetalk2"></div></div>';
					$settings 		.= '<span>Chat 2</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Shareannounce2" class="chooseit Shareannounce2-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Shareannounce2"></div></div>';
					$settings 		.= '<span>Announce 2</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Shareimportant2" class="chooseit Shareimportant2-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Shareimportant2"></div></div>';
					$settings 		.= '<span>Important 2</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Sharestar2" class="chooseit Sharestar2-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Sharestar2"></div></div>';
					$settings 		.= '<span>Star 2</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Shareinfo2" class="chooseit Shareinfo2-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Shareinfo2"></div></div>';
					$settings 		.= '<span>Info 2</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Shareheart" class="chooseit Shareheart-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Shareheart"></div></div>';
					$settings 		.= '<span>Heart</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Sharebasket" class="chooseit Sharebasket-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Sharebasket"></div></div>';
					$settings 		.= '<span>Basket</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings 	.= '<li id="Shareimportant3" class="chooseit Shareimportant3-share">';
					$settings 		.= '<div class="share-icon-wrap"><div class="Share-message-icon Shareimportant3"></div></div>';
					$settings 		.= '<span>Important 3</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					$settings .= '</ul>';
					$settings .= '<hr />';
				}
			}
			
			$settings .= '<h2 id="headerattention">Design your widget:</h2>';
			if($ltype == 'bar1'){$shareLayout = 'bottom_tab';}elseif($ltype == 'bar2'){$shareLayout = 'top_tab';}elseif($ltype == 'bar3'){$shareLayout = 'sideleft_tab';}elseif($ltype == 'bar4'){$shareLayout = 'sideright_tab';}elseif($ltype == 'button1'){$shareLayout = 'simple';}
			if($ltype == 'bar1' || $ltype == 'bar2' || $ltype == 'bar3' || $ltype == 'bar4') {
			$settings .= '<label for="att_icon">Widget Theme</label><br />';
			$settings .= '<ul class="share-select theme '. $ltype .'" id="att_icon">';
			
			$directories = array('black', 'black-minimal', 'brown', 'dark', 'darkblue', 'darkgreen', 'darkpink', 'darkpurple', 'darkred', 'darkyellow', 'light', 'lightblue', 'lightgreen', 'lightpink', 'lightyellow', 'orange', 'purple', 'red', 'white-minimal');
			foreach($directories as $entry) {
					if($entry == 'black'){$selectedtheme = 'selected';}else{$selectedtheme = '';}
					$settings 	.= '<li id="'. $entry .'" class="chooseit '. $entry .'-share '.$selectedtheme.'">';
					$settings 		.= '<div class="themez '. $entry .'"></div>';
					$settings 		.= '<span>'. ucfirst($entry) .'</span>';
					$settings 		.= '<div class="option-checked"></div>';
					$settings 	.= '</li>';
					if(strpos($entry,'minimal') !== false){
						if (strpos($entry,'white') !== false) {
							$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' {background: #fff !important; border-top: 1px solid #e5e5e5;}';	
							$csscode .= '.showShare.'.$entry.'.'.$shareLayout.' {background: #fff !important; border-top: 1px solid #e5e5e5;}';
						}
						else {
							$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' {background: #000 !important;}';	
							$csscode .= '.showShare.'.$entry.'.'.$shareLayout.' {background: #000 !important;}';
						}
						$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.':before {background-image: none !important; width: 0 !important;}';
						$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.':after {background-image: none !important; width: 0 !important;}';
						$csscode .= '.showShare.'.$entry.'.'.$shareLayout.':before {background-image: none !important; width: 0 !important;}';
						$csscode .= '.showShare.'.$entry.'.'.$shareLayout.':after {background-image: none !important; width: 0 !important;}';
					}
					else {
						$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/middle-'.$shareLayout.'.png) !important;}';
						$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.':before {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/left-'.$shareLayout.'.png) !important;}';
						$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.':after {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/right-'.$shareLayout.'.png) !important;}';
						$csscode .= '.showShare.'.$entry.'.'.$shareLayout.' {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/middle-'.$shareLayout.'.png) !important;}';
						$csscode .= '.showShare.'.$entry.'.'.$shareLayout.':before {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/left-'.$shareLayout.'.png) !important;}';
						$csscode .= '.showShare.'.$entry.'.'.$shareLayout.':after {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/right-'.$shareLayout.'.png) !important;}';
					}
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' .Link-wrap:hover {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/hover-'.$shareLayout.'.png) !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' #Share-logo-wrap:hover {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/hover-'.$shareLayout.'.png) !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' #Share-networks a div.link {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/sprite-'.$shareLayout.'.png) !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' .Share-logo {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/sprite-'.$shareLayout.'.png) !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' #hideShare {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/sprite-'.$shareLayout.'.png) !important;}';
					$csscode .= '.showShare.'.$entry.'.'.$shareLayout.' .maximize-btn {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/sprite-'.$shareLayout.'.png) !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' .Share-message-icon {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/sprite-'.$shareLayout.'.png) !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' .Share-message-link {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/sprite-'.$shareLayout.'.png) !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' .Share-message-link-wrap:hover {background-image: url(http://cunjo.com/!Share/imgs/'.$entry.'/hover-'.$shareLayout.'.png) !important;}';
					if(strpos($entry,'light') !== false || strpos($entry,'white') !== false){$textcolor = '#000'; $galbg = 'rgba(255,255,255,0.8)';}else{$textcolor = '#fff'; $galbg = 'rgba(0,0,0,0.8)';}
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' #Share-message-inside {color: '.$textcolor.' !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' .socialgal {background: '.$galbg.' !important;}';
					$csscode .= '.Share-bar.'.$entry.'.'.$shareLayout.' .messagegal {background: '.$galbg.' !important;}';	
			}
			$settings .= '</ul>';
			}
			$csscode .= '.Share-bar.32.simple {position: relative; height: 42px; !important}';
			$csscode .= '.Share-bar.32.simple .Share-logo {display: inline-block; width: 40px; height: 42px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-shiny-32.png); background-repeat: no-repeat; background-position: -830px 0;}';
			$csscode .= '.Share-bar.32.simple #Share-logo-wrap {display: inline-block; vertical-align: middle; width: 40px; height: 42px;}';
			$csscode .= '.Share-bar.32.simple .Link-wrap {position: relative; display: inline-block; vertical-align: middle; width: 40px; height: 42px;}';
			$csscode .= '.Share-bar.32.simple #Share-networks a div.link {display: block; width: 40px; height: 42px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-shiny-32.png); background-repeat: no-repeat;}';
			$csscode .= '.Share-bar.24.simple {position: relative; height: 39px; !important}';
			$csscode .= '.Share-bar.24.simple .Share-logo {display: inline-block; width: 38px; height: 39px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-shiny-24.png); background-repeat: no-repeat; background-position: -588px 0;}';
			$csscode .= '.Share-bar.24.simple #Share-logo-wrap {display: inline-block; vertical-align: middle; width: 38px; height: 39px;}';
			$csscode .= '.Share-bar.24.simple .Link-wrap {position: relative; display: inline-block; vertical-align: middle; width: 38px; height: 39px;}';
			$csscode .= '.Share-bar.24.simple #Share-networks a div.link {display: block; width: 38px; height: 39px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-shiny-24.png); background-repeat: no-repeat;}';
			if($ltype == 'bar5' || $ltype == 'bar6') {
				$settings .= '<div style="float: left; width: 45%;">';
				$settings .= '<div id="picker" style="float: right;"></div>';
				$settings 	.= '<div style="float: left;"></div>';
				$settings 		.= '<div class="form-item"><label for="color1" style="display: inline-block; width: 100px;">Bar background:</label><input type="text" id="color1" name="color1" class="colorwell" value="#fefefe" style="width:100px"/></div>';
				$settings 		.= '<div class="form-item"><label for="color2" style="display: inline-block; width: 100px;">Bar text color:</label><input type="text" id="color2" name="color2" class="colorwell" value="#000000" style="width:100px"/></div>'; 
				$settings 		.= '<div class="cunjo-prev" style="width: 180px; margin-top: 20px;" onclick="apply_style();">Apply style</div>';
				$settings 	.= '</div>';
				$settings .= '</div>';
				$settings .= '<div style="float: right; width: 50%;">';
				$settings 	.= '<ul class="share-select counter" id="att_iconz">';
				$settings 		.= '<li id="yes" class="chooseit counter-share selected">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/yes-counter.png" width="80" height="48"/>';
				$settings 			.= '<span>Without Counter</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="no" class="chooseit counter-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/no-counter.png" width="80" height="48"/>';
				$settings 			.= '<span>Without Counter</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 	.= '</ul>';
				$settings 	.= '<small>NOTE! Share Icons/Bars with social counters take a lot more time to load because the script "carries" your blog/website url to all social networks APIs to check for social signals and return the counter</small>';
				$settings .= '</div>';
				$settings .= '<div style="clear:both"></div>';
				if($ltype == 'bar6') {
					$settings .= '<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="nice_left" color="#fefefe" width="100" position="center" icons="" counter="yes" textcolor="#000" offleft="40"></div>';
				}
			}
			else {
				$settings .= '<label for="att_iconz">Icons Style</label><br />';
				$settings .= '<ul class="share-select iconz" id="att_iconz">';
				if($ltype == 'bar1' || $ltype == 'bar2' || $ltype == 'bar3' || $ltype == 'bar4') {
				$settings 		.= '<li id="" class="chooseit iconz-share selected">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/theme-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Theme Icons</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="icons" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/shiny-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Shiny Icons</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="variety" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/variety-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Variety Icons</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="satin" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/satin-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Satin Icons</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="shiny2" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/shiny2-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Shiny Icons 2</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="elegant" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/elegant-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Elegant Icons <small style="color: #cb331c">NEW</small></span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="metro" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/metro-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Metro Icons <small style="color: #cb331c">NEW</small></span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				}
				else {
				$settings 		.= '<li id="shiny" class="chooseit icons-share selected">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/shiny-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Shiny Icons</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="variety" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/variety-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Variety Icons</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="satin" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/satin-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Satin Icons</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="shiny2" class="chooseit icons-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/shiny2-icons.png" width="80" height="48"/>';
				$settings 			.= '<span>Shiny Icons 2 <small style="color: #cb331c">NEW</small></span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				}
				$settings .= '</ul>';
			}
			if($ltype == 'button1') {
				$settings .= '<label for="att_icon">Icons Size</label><br />';
				$settings .= '<ul class="share-select theme '. $ltype .'" id="att_icon">';
				$settings 		.= '<li id="32" class="chooseit iconz-share selected" style="width: 150px;">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/32-icons.png" width="80" height="48" style="box-shadow: none;"/>';
				$settings 			.= '<span>Big Icons (32px)</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="24" class="chooseit iconz-share" style="width: 150px;">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/24-icons.png" width="80" height="48" style="box-shadow: none;"/>';
				$settings 			.= '<span>Medium Icons (24px)</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';				
				$settings .= '</ul>';
			}
			if($ltype == 'bar1' || $ltype == 'bar2' || $ltype == 'bar5') {
				$settings .= '<hr />';
				$settings .= '<h2 id="headerattention">Extra Settings:</h2>';
				if($ltype != 'bar5') {
					$settings .= '<div style="display: inline-block; vertical-align: middle; width: 50%;">';
					$settings	 .= '<label>Bar Width: </label> <div id="rangesl"></div> <input id="bar_width" type="text" value="100" style="border: none;width: 50px; font-size: 18px" readonly><span style="font-size: 18px;">%</span>';
					$settings .= '</div>';
				}
				if($ltype == 'bar2') {
					$settings	 .= '<label>Top widget will apear after user scrolls: </label><input id="showat" type="text" value="50" style="border: none;width: 30px; font-size: 18px"><span style="font-size: 18px;">px down</span>';
				}
				$settings .= '<div style="display: inline-block; vertical-align: middle; width: 36%;margin-left: 14%;">';
				$settings	 .= '<label>Position: </label>';
				$settings	 .= '<ul class="share-select position" id="att_iconz">';
				$settings 		.= '<li id="left" class="chooseit left-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/position-left.png" width="80" height="48"/>';
				$settings 			.= '<span>Left</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="center" class="chooseit center-share selected">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/position-center.png" width="80" height="48"/>';
				$settings 			.= '<span>Center</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="right" class="chooseit right-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/position-right.png" width="80" height="48"/>';
				$settings 			.= '<span>Right</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings	 .= '</ul>';
				$settings .= '</div>';
			}
			elseif($ltype == 'bar3' || $ltype == 'bar4' || $ltype == 'bar6') {
				$settings .= '<hr />';
				$settings .= '<h2 id="headerattention">Extra Settings:</h2>';
				if($ltype != 'bar6') {
					$settings .= '<div style="display: inline-block; vertical-align: middle; width: 50%;">';
					$settings	 .= '<label>Bar Height: </label> <div id="rangesl"></div> <input id="bar_width" type="text" value="50" style="border: none;width: 30px; font-size: 18px"><span style="font-size: 18px;">%</span>';
					$settings .= '</div>';
				}
				else {
					$settings .= '<div style="display: inline-block; vertical-align: middle; width: 50%;">';
					$settings	 .= '<label>Bar Margin Left: </label>- <input id="offleft" type="text" value="40" style="border: none;width: 80px; font-size: 18px"><span style="font-size: 18px;">px <br /><small style="font-size: 11px;">NOTE! The left positioning here is not relevant. After you save the settings check if the margin is set properly on your blog\'s theme, if not come back here and ajust the number.</small></span>';
					$settings .= '</div>';
				}
				$settings .= '<div style="display: inline-block; vertical-align: middle; width: 36%;margin-left: 14%;">';
				$settings	 .= '<label>Position: </label>';
				$settings	 .= '<ul class="share-select position" id="att_iconz">';
				$settings 		.= '<li id="top" class="chooseit left-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/position-top.png" width="48" height="80"/>';
				$settings 			.= '<span>Top</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="center" class="chooseit center-share selected">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/position-center2.png" width="48" height="80"/>';
				$settings 			.= '<span>Center</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="bottom" class="chooseit right-share">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/position-bottom.png" width="48" height="80"/>';
				$settings 			.= '<span>Bottom</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings	 .= '</ul>';
				$settings .= '</div>';
			}
			$barCheck = get_option('ShareBarActive');
				if(empty($barCheck) || $barCheck == 0) {
					$settings	.= '<hr />';
					$settings	.= '<div>';
					$settings	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
					$settings	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(5);">Save and Activate</div>';
					$settings	.= '<div style="float: right; margin-right: 20px;" class="cunjo-next" onclick="return get_barform(4);">Save Settings</div>';
					$settings	.= '<div style="clear:both"></div>';
					$settings	.= '</div>';
				}
				else {
					$settings	.= '<hr />';
					$settings	.= '<div>';
					$settings	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
					$settings	.= '<div style="float: right;" class="cunjo-next" onclick="return get_barform(4);">Save Settings</div>';
					$settings	.= '<div style="clear:both"></div>';
					$settings	.= '</div>';
				}
			$css = '<style>'.$csscode.'</style>';
			$javascript .= '<script>';
			if($ltype == 'bar5' || $ltype == 'bar6'){
				$javascript .= '
				jQuery("#offleft").keyup(function() { 
					jQuery("#Share-bar").css("margin-left", "-"+jQuery("#offleft").val()+"px");
				});
				function apply_style(){
					var bgcolor = jQuery("#color1").attr("value");
					var textcolor = jQuery("#color2").attr("value");
					jQuery("#Share-bar").css("background", bgcolor);
					jQuery("#Share-networks .sh-counter").css("color", textcolor);
				}
				jQuery(function() {
					var f = jQuery.farbtastic("#picker");
					var p = jQuery("#picker").css("opacity", 0.25);
					var selected;
					jQuery(".colorwell")
					  .each(function () { f.linkTo(this); jQuery(this).css("opacity", 0.75); })
					  .focus(function() {
						if (selected) {
						  jQuery(selected).css("opacity", 0.75).removeClass("colorwell-selected");
						}
						f.linkTo(this);
						p.css("opacity", 1);
						jQuery(selected = this).css("opacity", 1).addClass("colorwell-selected");
				 });});';
			}
				  $javascript .= '
				  jQuery(function() {
								jQuery(".connected").sortable({
									placeholder: "ui-state-highlight",
									connectWith: ".connected"
								}).bind("sortupdate", function() {
									var iscounter = jQuery(".share-select.counter .chooseit.selected").attr("id");
									if(iscounter == "yes"){var countshow = "0";}else{var countshow = "";}
									jQuery("#Share-networks").empty();
									jQuery("#socialsuse li").each(function(){
										if( jQuery(this).text() == "Facebook"){
											 jQuery("#Share-networks").append(\'<a id="xFacebook" href="http://www.facebook.com/sharer.php?u=http://cunjo.com&t=Cunjo, making a better web" class="Link-wrap"><div class="Facebook-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Facebook</small></div></a>\');
										}
										else if( jQuery(this).text() == "Twitter"){
											 jQuery("#Share-networks").append(\'<a id="xTwitter" href="http://twitter.com/home?status=http://cunjo.com" class="Link-wrap"><div class="Twitter-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Twitter</small></div></a>\');
										}
										else if( jQuery(this).text() == "Linkedin"){
											 jQuery("#Share-networks").append(\'<a id="xLinkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=http://cunjo.com&title=Cunjo, making a better web&ro=false&summary=Cunjo, making a better web&source=" class="Link-wrap"><div class="Linkedin-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Linkedin</small></div></a>\');
										}
										else if( jQuery(this).text() == "Pinterest"){
											 jQuery("#Share-networks").append(\'<a id="xPinterest" href="http://pinterest.com/pin/create/button/?url=http://cunjo.com&media=http://cunjo.com/wp-content/themes/nubpage/inc/images/logo-head.png&description=Cunjo, making a better web" class="Link-wrap"><div class="Pinterest-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Pinterest</small></div></a>\');
										}
										else if( jQuery(this).text() == "Google"){
											 jQuery("#Share-networks").append(\'<a id="xGoogle" href="https://plus.google.com/share?url=http://cunjo.com" class="Link-wrap"><div class="Google-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Google+</small></div></a>\');
										}
										else if( jQuery(this).text() == "Digg"){
											 jQuery("#Share-networks").append(\'<a id="xDigg" href="http://digg.com/submit?phase=2&partner=[partner]&url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Digg-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Digg</small></div></a>\');
										}
										else if( jQuery(this).text() == "Myspace"){
											 jQuery("#Share-networks").append(\'<a id="xMyspace" href="http://www.myspace.com/Modules/PostTo/Pages/?u=http://cunjo.com&t=Cunjo, making a better web&c=%20" class="Link-wrap"><div class="Myspace-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Myspace</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Stumbleupon"){
											 jQuery("#Share-networks").append(\'<a id="xStumbleupon" href="http://www.stumbleupon.com/submit?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Stumbleupon-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Stumbleupon</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Bebo"){
											 jQuery("#Share-networks").append(\'<a id="xBebo" href="http://bebo.com/c/share?Url=http://cunjo.com&Title=Cunjo, making a better web" class="Link-wrap"><div class="Bebo-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Bebo</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Blogger"){
											 jQuery("#Share-networks").append(\'<a id="xBlogger" href="http://www.blogger.com/blog_this.pyra?t=&u=http://cunjo.com" class="Link-wrap"><div class="Blogger-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Blogger</small></div></a>\');
										}
										else if( jQuery(this).text() == "Delicious"){
											 jQuery("#Share-networks").append(\'<a id="xDelicious" href="http://del.icio.us/post?v=4&partner=[partner]&noui&url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Delicious-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Delicious</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Xing"){
											 jQuery("#Share-networks").append(\'<a id="xXing" href="https://www.xing.com/social_plugins/share?url=http://cunjo.com&wtmc=Cunjo, making a better web;&sc_p=xing-share" class="Link-wrap"><div class="Xing-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Xing</small></div></a>\');
										}
										else if( jQuery(this).text() == "Tumblr"){
											 jQuery("#Share-networks").append(\'<a id="xTumblr" href="http://www.tumblr.com/share?v=3&u=http://cunjo.com&t=Cunjo, making a better web" class="Link-wrap"><div class="Tumblr-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Tumblr</small></div></a>\');
										}
										else if( jQuery(this).text() == "Technorati"){
											 jQuery("#Share-networks").append(\'<a id="xTechnorati" href="http://technorati.com/faves?add=http://cunjo.com" class="Link-wrap"><div class="Technorati-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Technorati</small></div></a>\');
										}
										else if( jQuery(this).text() == "Reddit"){
											 jQuery("#Share-networks").append(\'<a id="xReddit" href="http://reddit.com/submit?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Reddit-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Reddit</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Netlog"){
											 jQuery("#Share-networks").append(\'<a id="xNetlog" href="http://www.netlog.com/go/manage/blog/view=add&origin=external&title=Cunjo, making a better web&message=[message]&tags=Cunjo, making a better web&referer=http://cunjo.com" class="Link-wrap"><div class="Netlog-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Netlog</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Identi"){
											 jQuery("#Share-networks").append(\'<a id="xIdenti" href="http://identi.ca/index.php? action=newnotice&status_textarea=Cunjo, making a better web-http://cunjo.com" class="Link-wrap"><div class="Identi-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Identi</small></div></a>\');
										}
										else if( jQuery(this).text() == "Friendfeed"){
											 jQuery("#Share-networks").append(\'<a id="xFriendfeed" href="http://www.friendfeed.com/share?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Friendfeed-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Friendfeed</small></div></a>\');
										}
										else if( jQuery(this).text() == "Evernote"){
											 jQuery("#Share-networks").append(\'<a id="xEvernote" href="http://www.evernote.com/clip.action?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Evernote-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Evernote</small></div></a>\');
										}  
										else if( jQuery(this).text() == "Diigo"){
											 jQuery("#Share-networks").append(\'<a id="xDiigo" href="http://www.diigo.com/post?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Diigo-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Diigo</small></div></a>\');
										} 
									});
									jQuery("#Share-networks").append(\'<div id="socialgal"></div>\');';
								if($ltype == 'bar1' || $ltype == 'bar2'){					
								$javascript .= 'ajustShare();';
								}
								elseif( $ltype == 'bar5') {
									$javascript .= 'var barh = jQuery("#Share-bar").width(); var newbarh = barh + 20; jQuery("#Share-bar").css("width", newbarh+"px"); var html = jQuery("html").width(); var lefthtml = newbarh / 2; jQuery("#Share-bar").css("margin-left", "-"+lefthtml+"px");';
								}
								elseif( $ltype == 'bar6') {
									$javascript .= 'var barh = jQuery("#Share-bar").height(); var newbarh = barh + 21; jQuery("#Share-bar").css("height", newbarh+"px"); var html = jQuery("html").height(); var tophtml = (html - newbarh) / 2; jQuery("#Share-bar").css("top", tophtml+"px");';
								}
								elseif($ltype == 'bar3' || $ltype == 'bar4'){
									$javascript .= "var shareSocial=document.getElementById('!Share').getAttribute('socials');
									jQuery('#Share-networks #socialgal a').each(function() {
									   jQuery(this).appendTo('#Share-networks');
									});
									var socials = shareSocial.split(',');
									var socialsHeight = socials.length * 42;
									var shareHeightpx = jQuery('#Share-bar').height();
									var socialSpace = shareHeightpx - 84;
									var socialgal = document.getElementById('socialgal');
										var notofit = socialSpace / 42;
										var tofit = Math.round(notofit);
										
										var sel = document.querySelectorAll('#Share-networks a');
										var socialz = new Array();
										for (var i=0; i<sel.length; i++) {
											socialz.push(sel[i].getAttribute('id'));
										}
										var listcut = socialz.slice(Math.max(socialz.length - 20, tofit));
										socialgal.setAttribute('class', 'socialgal');
										document.getElementById('Share-networks').appendChild(socialgal);
										for (var i=0; i<listcut.length; i++) {
											socialgal.appendChild(document.getElementById(listcut[i]));
										}
									";
								}	
								$javascript .= '});
								jQuery("#Share-networks a").click(function() {
								  window.open(jQuery(this).getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false;
								});
							});</script>';
							
			$javascript .= '<script type="text/javascript">jQuery(".share-select.icon .chooseit").click(function() {';
			$javascript 	.= 'jQuery(".share-select.icon .chooseit").removeClass("selected");';
			$javascript 	.= 'jQuery(this).addClass("selected");';
			$javascript 	.= 'var oldicon = jQuery("#Share-message-icon").attr("class");';
			$javascript 	.= 'var newicon = jQuery(this).attr("id");';
			$javascript 	.= 'jQuery("#Share-message-icon").removeClass(oldicon);';
			$javascript 	.= 'jQuery("#Share-message-icon").addClass("Share-message-icon "+ newicon);';
			$javascript 	.= '});';
			$javascript .= 'jQuery("#att_text").keyup(function() {';
			$javascript 	.= 'jQuery("#Share-message-inside").html(jQuery(this).val());';
			$javascript .= '});';
			$javascript .= 'jQuery("#att_link").keyup(function() {';
			
			$javascript 	.= 'jQuery(".Share-message-link-wrap").attr("href", jQuery(this).val());';
			$javascript .= '});';
			$javascript .= 'jQuery(".share-select.theme .chooseit").click(function() {';
			$javascript 	.= 'jQuery(".share-select.theme .chooseit").removeClass("selected");';
			$javascript 	.= 'jQuery(this).addClass("selected");';
			$javascript 	.= 'var theme = jQuery(this).attr("id");';
			$javascript 	.= 'jQuery("#Share-bar").attr("class", "");';
			$javascript 	.= 'jQuery("#showShare").attr("class", "");';
			$javascript 	.= 'jQuery("#Share-bar").attr("class", "Share-bar "+ theme +" '.$shareLayout.'");';
			$javascript 	.= 'jQuery("#showShare").attr("class", "showShare "+ theme +" '.$shareLayout.'");';
			$javascript 	.= '});';
			$javascript .= 'jQuery(".share-select.counter .chooseit").click(function() {';
			$javascript 	.= 'jQuery(".share-select.counter .chooseit").removeClass("selected");';
			$javascript 	.= 'jQuery(this).addClass("selected");';
			$javascript 	.= 'var counter = jQuery(this).attr("id");';
			$javascript 	.= 'if(counter == "yes") {';
			$javascript 		.= 'jQuery("#Share-networks .sh-counter").html("0");';
			$javascript 	.= '}';
			$javascript 	.= 'else {';
			$javascript 		.= 'jQuery("#Share-networks .sh-counter").html("");';
			$javascript 	.= '}';
			$javascript 	.= '});';

			$javascript .= 'jQuery(".share-select.iconz .chooseit").click(function() {';
			$javascript 	.= 'jQuery(".share-select.iconz .chooseit").removeClass("selected");';
			$javascript 	.= 'jQuery(this).addClass("selected");';
			$javascript 	.= 'var iconz = jQuery(this).attr("id");';
			$javascript 	.= 'var theme = jQuery(".share-select.theme .chooseit.selected").attr("id");';
			$javascript 	.= 'if(iconz != "") {';
			if($shareLayout == 'simple') {
				$javascript 		.= 'jQuery("#Share-bar #Share-networks a div.link").attr("style", "background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-"+ iconz +".png) !important;");';
			}
			else {
				$javascript 		.= 'jQuery("#Share-bar #Share-networks a div.link").attr("style", "background-image: url(http://cunjo.com/!Share/imgs/"+ theme +"/sprite-"+ iconz +".png) !important;");';
			}
			$javascript 		.= 'jQuery("#Share-bar .Link-wrap").css("border-right", "none").css("-webkit-box-shadow", "none").css("box-shadow", "none");';
			$javascript 	.= '}';
			$javascript 	.= 'else{';
			$javascript 		.= 'jQuery("#Share-bar #Share-networks a div.link").removeAttr("style");';
			$javascript 		.= 'jQuery("#Share-bar .Link-wrap").removeAttr("style");';
			$javascript 	.= '}';
			$javascript 	.= '});';
			if($ltype == 'bar1' || $ltype == 'bar2' || $ltype == 'bar5') {$widthval = 100; $sizetype = 'width'; $positiontype = 'left';}elseif($ltype == 'bar3' || $ltype == 'bar4' || $ltype == 'bar6') {$widthval = 50;$sizetype = 'height';$positiontype = 'top';}
			if($ltype == 'bar1' || $ltype == 'bar2' || $ltype == 'bar3' || $ltype == 'bar4' || $ltype == 'bar5' || $ltype == 'bar6') {
				$javascript .= 'jQuery( "#rangesl" ).slider({
								  min: 20,
								  max: 100,
								  value: '.$widthval.',
								  slide: function( event, ui ) {
									jQuery( "#bar_width" ).attr( "value", ui.value );
									jQuery( "#Share-bar" ).css( "'.$sizetype.'", ui.value +"%" );
									var barwidth = jQuery( "#Share-bar" ).'.$sizetype.'();
									var position = jQuery(".share-select.position .chooseit.selected").attr("id");
									if(position == "left") {
										jQuery( "#Share-bar" ).css( "margin-left", "initial" ).css("left", "8px");
									}
									else if(position == "right") {
										jQuery( "#Share-bar" ).css( "margin-left", "initial" ).css("left", "initial").css("right", "8px");
									}
									else if(position == "center") {
										jQuery( "#Share-bar" ).css( "margin-'.$positiontype.'", "-"+ barwidth / 2 +"px" ).css("'.$positiontype.'", "50%");
									}
									else if(position == "top") {
										jQuery( "#Share-bar" ).css( "margin-top", "initial" ).css("top", "8px");
									}
									else if(position == "bottom") {
										jQuery( "#Share-bar" ).css( "margin-top", "initial" ).css("top", "initial").css("bottom", "8px");
									}';
									
				if($ltype == 'bar1' || $ltype == 'bar2'){					
				$javascript .= 'ajustShare();';
				}
				elseif($ltype == 'bar3' || $ltype == 'bar4'){
					$javascript .= "var shareSocial=document.getElementById('!Share').getAttribute('socials');
					jQuery('#Share-networks #socialgal a').each(function() {
					   jQuery(this).appendTo('#Share-networks');
					});
					var socials = shareSocial.split(',');
					var socialsHeight = socials.length * 42;
					var shareHeightpx = jQuery('#Share-bar').height();
					var socialSpace = shareHeightpx - 84;
					var socialgal = document.getElementById('socialgal');
						var notofit = socialSpace / 42;
						var tofit = Math.round(notofit);
						
						var sel = document.querySelectorAll('#Share-networks a');
						var socialz = new Array();
						for (var i=0; i<sel.length; i++) {
							socialz.push(sel[i].getAttribute('id'));
						}
						var listcut = socialz.slice(Math.max(socialz.length - 20, tofit));
						socialgal.setAttribute('class', 'socialgal');
						document.getElementById('Share-networks').appendChild(socialgal);
						for (var i=0; i<listcut.length; i++) {
							socialgal.appendChild(document.getElementById(listcut[i]));
						}
					";
				}
								
				$javascript .= '}
				}); jQuery( "#bar_width" ).val( jQuery( "#rangesl" ).slider( "value" ) );';
				$javascript .= 'jQuery(".share-select.position .chooseit").click(function() {';
				$javascript 	.= 'jQuery(".share-select.position .chooseit").removeClass("selected");';
				$javascript 	.= 'jQuery(this).addClass("selected");';
				$javascript 	.= 'var position = jQuery(this).attr("id");';
				$javascript 	.= 'var barwidth = jQuery( "#Share-bar" ).'.$sizetype.'();';
				$javascript 	.= 'if(position == "left") {';
				$javascript 		.= 'jQuery( "#Share-bar" ).css( "margin-left", "initial" ).css("left", "8px");';
				$javascript 	.= '}';
				$javascript 	.= 'else if(position == "right") {';
				$javascript 		.= 'jQuery( "#Share-bar" ).css( "margin-left", "initial" ).css("left", "initial").css("right", "8px");';
				$javascript 	.= '}';
				$javascript 	.= 'else if(position == "center") {';
				$javascript 		.= 'jQuery( "#Share-bar" ).css( "margin-'.$positiontype.'", "-"+ barwidth / 2 +"px" ).css("'.$positiontype.'", "50%");';
				$javascript 	.= '}';
				$javascript 	.= 'else if(position == "top") {';
				$javascript 		.= 'jQuery( "#Share-bar" ).css( "margin-top", "initial" ).css("top", "8px");';
				$javascript 	.= '}';
				$javascript 	.= 'else if(position == "bottom") {';
				$javascript 		.= 'jQuery( "#Share-bar" ).css( "margin-top", "initial" ).css("top", "initial").css("bottom", "8px");';
				$javascript 	.= '}';
				$javascript 	.= '});';
			}
			$javascript .= '</script>';
				
			$out .= $settings.$javascript.$css;
	}
	elseif($step == 4 || $step == 5) {
		$_SESSION['share']['socials'] = $_POST['socials'];
		$_SESSION['share']['message'] = $_POST['message'];
		$_SESSION['share']['linx'] = $_POST['linx'];
		$_SESSION['share']['iconx'] = $_POST['iconx'];
		$_SESSION['share']['theme'] = $_POST['theme'];
		$_SESSION['share']['iconz'] = $_POST['iconz'];
		$_SESSION['share']['width'] = $_POST['width'];
		$_SESSION['share']['position'] = $_POST['position'];
		$_SESSION['share']['showat'] = $_POST['showat'];
		$_SESSION['share']['textcolor'] = $_POST['textcolor'];
		$_SESSION['share']['counter'] = $_POST['counter'];
		if($_SESSION['share']['ltype'] == 'bar1'){$layoutz = 'bottom_tab';}elseif($_SESSION['share']['ltype'] == 'bar2'){$layoutz = 'top_tab';}elseif($_SESSION['share']['ltype'] == 'bar3'){$layoutz = 'sideleft_tab';}elseif($_SESSION['share']['ltype'] == 'bar4'){$layoutz = 'sideright_tab';}elseif($_SESSION['share']['ltype'] == 'bar5'){$layoutz = 'nice_bottom';}elseif($_SESSION['share']['ltype'] == 'bar6'){$layoutz = 'nice_left';}
		$ShareBarSettings = array('layout' => $layoutz, 'color' => $_POST['theme'], 'width' => $_POST['width'], 'position' => $_POST['position'], 'icons' => $_POST['iconz'], 'showat' => $_POST['showat'], 'textcolor' => $_POST['textcolor'], 'counter' => $_POST['counter'], 'offleft' => $_POST['offleft']);
		json_encode($ShareBarSettings);
		$ShareBarSocials = $_POST['socials'];
		update_option( 'ShareBarSettings', $ShareBarSettings );
		update_option( 'ShareBarSocials', $ShareBarSocials );
		if(!empty($_POST['message'])) {
			update_option( 'ShareBarMessage', $_POST['message'] );
			update_option( 'ShareBarLink', $_POST['linx'] );
			update_option( 'ShareBarIcon', $_POST['iconx'] );
		}
		else {
			update_option( 'ShareBarMessage', '' );
			update_option( 'ShareBarLink', '' );
			update_option( 'ShareBarIcon', '' );
		}
		if($step == 5) {
			update_option( 'ShareBarActive', 1 );
			echo '!Share Bar settings saved, widget activated! <div style="display:inline-block; vertical-align: middle;float: right;margin-right: 20px;margin-top: 4px;line-height: initial;" class="cunjo-prev" onclick="reloadPage()">&lsaquo; Back to !Share Dashboard</div>';
		}
		else {
			echo '!Share Bar settings saved! <div style="float: right;margin-right: 20px;margin-top: 4px;line-height: initial;" class="cunjo-prev" onclick="reloadPage()">&lsaquo; Back to !Share Dashboard</div>';
		}
	}
	return $out;
}
//line builder
function get_linebuilder($step) {
	$ShareID = get_option('shareID');
	$ShareLineSettings = get_option('ShareLineSettings');
	if($step == 1) {
		$types	.= '<div class="register-mess"></div>';
		$types	.= '<h2>1. Select Buttons Type</h2>';
		$types	.= '<ul class="share-select type">';
		$types		 .= '<li id="button1" class="chooseit button1-share selected">';
		$types		 	.= '<div class="option-checked"></div>';
		$types		 	.= '<div class="description button1"><br />The regular buttons fit in your website content. These sharing icons will be displayed above or below you blog content.</div>';
		$types		 .= '</li>';
		$types		 .= '<li id="button2" class="chooseit button2-share">';
		$types		 	.= '<div class="option-checked"></div>';
		$types		 	.= '<div class="description button1"><br />The regular buttons with counters and hop hover effect. These sharing icons will be displayed above or below you blog content.</div>';
		$types		 .= '</li>';
		$types	.= '</ul>';
		$types	.= '<hr />';
		$types	.= '<div>';
		$types	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
		$types	.= '<div style="float: right;" class="cunjo-next" onclick="return get_lineform(2);">Next Step</div>';
		$types	.= '<div style="clear:both"></div>';
		$types	.= '</div>';
		$javascript = '<script type="text/javascript">jQuery(".share-select.type .chooseit").click(function() {';
		$javascript 	.= 'jQuery(".chooseit:visible").removeClass("selected");';
		$javascript 	.= 'jQuery(this).addClass("selected");';
		$javascript .= '});';
		$javascript .= '';
        $javascript .= '</script>';
		$out .= $types.$javascript;
	}
	elseif($step == 2) {
		$ltype = $_POST['ltype'];
		$_SESSION['share']['ltype'] = $ltype;
		if($ltype == 'button1') {
			$bar ='<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="simple" color="32" width="50" position="center" icons="shiny" ></div>';
			$is_counter = 'no';
		}
		else if($ltype == 'button2') {
			$bar ='<div id="!Share" socials="Facebook,Twitter,Google,Linkedin,Pinterest,Digg" shareID="'.$ShareID.'" layout="simple" color="32" width="50" position="center" icons="shiny" counter="yes"></div>';
			$is_counter = 'yes';
		}
		$settings .= '<div class="register-mess"></div>';
		$settings .= '<div class="simple-preview">';
		$settings	 .= '<div class="button1-preview" id="prewtxt">Widget Preview</div><br />';
		$settings	 .= '<div class="simpl-prev">'.$bar.'</div>';
		$settings .= '</div><hr />';
		$settings .= '<input type="hidden" name="is_counter" id="is_counter" value="'.$is_counter.'" />';
		$settings .= '<h2>Select Social Networks for your widget:</h2>';
		$settings .= '
				<div class="drag-links">
					<ul id="socialsuse" class="connected list">
						<li class="Facebook"><div class="share-icns"></div><span>Facebook</span></li>
						<li class="Twitter"><div class="share-icns"></div><span>Twitter</span></li>
						<li class="Google"><div class="share-icns"></div><span>Google</span></li>
						<li class="Linkedin"><div class="share-icns"></div><span>Linkedin</span></li>
						<li class="Pinterest"><div class="share-icns"></div><span>Pinterest</span></li>
						<li class="Digg"><div class="share-icns"></div><span>Digg</span></li>
					</ul>
					<div class="between-connected">Drag to activate <img src="'. CUNJO_SHARE_URL .'/images/arrow-drag.png" width="120" height="45" style="box-shadow: none;"/></div>
					<ul class="connected list no2">
						<li class="Myspace"><div class="share-icns"></div><span>Myspace</span></li>
						<li class="Stumbleupon"><div class="share-icns"></div><span>Stumbleupon</span></li>
						<li class="Bebo"><div class="share-icns"></div><span>Bebo</span></li>
						<li class="Blogger"><div class="share-icns"></div><span>Blogger</span></li>
						<li class="Delicious"><div class="share-icns"></div><span>Delicious</span></li>
						<li class="Xing"><div class="share-icns"></div><span>Xing</span></li>
						<li class="Tumblr"><div class="share-icns"></div><span>Tumblr</span></li>
						<li class="Technorati"><div class="share-icns"></div><span>Technorati</span></li>
						<li class="Reddit"><div class="share-icns"></div><span>Reddit</span></li>
						<li class="Netlog"><div class="share-icns"></div><span>Netlog</span></li>
						<li class="Identi"><div class="share-icns"></div><span>Identi</span></li>
						<li class="Friendfeed"><div class="share-icns"></div><span>Friendfeed</span></li>
						<li class="Evernote"><div class="share-icns"></div><span>Evernote</span></li>
						<li class="Diigo"><div class="share-icns"></div><span>Diigo</span></li>
					</ul>
				</div>
	';
	$settings .= '<div style="clear:both"></div><hr />';
	$settings .= '<h2 id="headerattention">Positioning:</h2>';
	$settings .= '<ul class="share-select showing" id="att_iconz">';
	$settings 		.= '<li id="above" class="chooseit icons-share selected">';
	$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/above-content.png" width="80" height="48"/>';
	$settings 			.= '<span>Above post/page content</span>';
	$settings 			.= '<div class="option-checked"></div>';
	$settings 		.= '</li>';
	$settings 		.= '<li id="under" class="chooseit icons-share">';
	$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/under-content.png" width="80" height="48"/>';
	$settings 			.= '<span>Under post/page content</span>';
	$settings 			.= '<div class="option-checked"></div>';
	$settings 		.= '</li>';
	$settings 		.= '<li id="both" class="chooseit icons-share">';
	$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/both-content.png" width="80" height="48"/>';
	$settings 			.= '<span>Above & Under post/page content</span>';
	$settings 			.= '<div class="option-checked"></div>';
	$settings 		.= '</li>';
	$settings .= '</ul>';
	$settings .= '<div style="clear:both"></div><hr />';
	
	$settings .= '<h2 id="headerattention">Design your widget:</h2>';
			$csscode .= '.Share-bar.32.simple {position: relative; height: 42px; !important}';
			$csscode .= '.Share-bar.32.simple .Share-logo {display: inline-block; width: 40px; height: 42px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-shiny-32.png); background-repeat: no-repeat; background-position: -830px 0;}';
			$csscode .= '.Share-bar.32.simple #Share-logo-wrap {display: inline-block; vertical-align: middle; width: 40px; height: 42px;}';
			$csscode .= '.Share-bar.32.simple .Link-wrap {position: relative; display: inline-block; vertical-align: middle; width: 40px; height: 42px;}';
			$csscode .= '.Share-bar.32.simple #Share-networks a div.link {display: block; width: 40px; height: 42px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-shiny-32.png); background-repeat: no-repeat;}';
			$csscode .= '.Share-bar.24.simple {position: relative; height: 39px; !important}';
			$csscode .= '.Share-bar.24.simple .Share-logo {display: inline-block; width: 38px; height: 39px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-shiny-24.png); background-repeat: no-repeat; background-position: -588px 0;}';
			$csscode .= '.Share-bar.24.simple #Share-logo-wrap {display: inline-block; vertical-align: middle; width: 38px; height: 39px;}';
			$csscode .= '.Share-bar.24.simple .Link-wrap {position: relative; display: inline-block; vertical-align: middle; width: 38px; height: 39px;}';
			$csscode .= '.Share-bar.24.simple #Share-networks a div.link {display: block; width: 38px; height: 39px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-shiny-24.png); background-repeat: no-repeat;}';

			$settings .= '<label for="att_iconz">Icons Style</label><br />';
			$settings .= '<ul class="share-select iconz" id="att_iconz">';
			if($ltype == 'button1' || $ltype == 'button2') {
			$settings 		.= '<li id="shiny" class="chooseit icons-share selected">';
			$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/shiny-icons.png" width="80" height="48"/>';
			$settings 			.= '<span>Shiny Icons</span>';
			$settings 			.= '<div class="option-checked"></div>';
			$settings 		.= '</li>';
			$settings 		.= '<li id="variety" class="chooseit icons-share">';
			$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/variety-icons.png" width="80" height="48"/>';
			$settings 			.= '<span>Variety Icons</span>';
			$settings 			.= '<div class="option-checked"></div>';
			$settings 		.= '</li>';
			$settings 		.= '<li id="satin" class="chooseit icons-share">';
			$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/satin-icons.png" width="80" height="48"/>';
			$settings 			.= '<span>Satin Icons</span>';
			$settings 			.= '<div class="option-checked"></div>';
			$settings 		.= '</li>';
			$settings 		.= '<li id="shiny2" class="chooseit icons-share">';
			$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/shiny2-icons.png" width="80" height="48"/>';
			$settings 			.= '<span>Shiny Icons 2</span>';
			$settings 			.= '<div class="option-checked"></div>';
			$settings 		.= '</li>';
			$settings 		.= '<li id="elegant" class="chooseit icons-share">';
			$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/elegant-icons.png" width="80" height="48"/>';
			$settings 			.= '<span>Elegant Icons <small style="color: #cb331c">NEW</small></span>';
			$settings 			.= '<div class="option-checked"></div>';
			$settings 		.= '</li>';
			$settings 		.= '<li id="metro" class="chooseit icons-share">';
			$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/metro-icons.png" width="80" height="48"/>';
			$settings 			.= '<span>Metro Icons <small style="color: #cb331c">NEW</small></span>';
			$settings 			.= '<div class="option-checked"></div>';
			$settings 		.= '</li>';
			}
			$settings .= '</ul>';
			if($ltype == 'button1' || $ltype == 'button2') {
				$settings .= '<label for="att_icon">Icons Size</label><br />';
				$settings .= '<ul class="share-select theme '. $ltype .'" id="att_icon">';
				$settings 		.= '<li id="32" class="chooseit iconz-share selected" style="width: 150px;">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/32-icons.png" width="80" height="48" style="box-shadow: none;"/>';
				$settings 			.= '<span>Big Icons (32px)</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';
				$settings 		.= '<li id="24" class="chooseit iconz-share" style="width: 150px;">';
				$settings 			.= '<img src="'. CUNJO_SHARE_URL .'/images/24-icons.png" width="80" height="48" style="box-shadow: none;"/>';
				$settings 			.= '<span>Medium Icons (24px)</span>';
				$settings 			.= '<div class="option-checked"></div>';
				$settings 		.= '</li>';				
				$settings .= '</ul><hr />';
			}
	if(isset($ShareLineSettings['text'])){$txtvalue = $ShareLineSettings['text'];}else{$txtvalue = '!Share:';}
	$settings .= '<h2 id="headerattention">Extra settings:</h2>';
	$settings .= '<label for="share_text">Text before buttons:</label><br />';
	$settings .= '<input type="text" name="share_text" id="share_text" value="'.$txtvalue.'" /><br /><small>Setup your text to be shown before the buttons. If you dont want any text shown clear this field.</small>';
			$lineCheck = get_option('ShareLineActive');
			if(empty($lineCheck) || $lineCheck == 0) {
				$settings	.= '<hr />';
				$settings	.= '<div>';
				$settings	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
				$settings	.= '<div style="float: right;" class="cunjo-next" onclick="return get_lineform(4);">Save and Activate</div>';
				$settings	.= '<div style="float: right; margin-right: 20px;" class="cunjo-next" onclick="return get_lineform(3);">Save Settings</div>';
				$settings	.= '<div style="clear:both"></div>';
				$settings	.= '</div>';
			}
			else {
				$settings	.= '<hr />';
				$settings	.= '<div>';
				$settings	.= '<div style="float: left;" class="cunjo-prev" onclick="reloadPage()">Back to !Share Dashboard</div>';
				$settings	.= '<div style="float: right;" class="cunjo-next" onclick="return get_lineform(3);">Save Settings</div>';
				$settings	.= '<div style="clear:both"></div>';
				$settings	.= '</div>';
			}
			$css = '<style>'.$csscode.'</style>';
			if($ltype == 'button1' || $ltype == 'button2'){$shareLayout = 'simple';}
			$javascript .= '<script>jQuery(function() {
								var is_counter = jQuery("#is_counter").val();
								if(is_counter == "yes") {var countshow = 0;} else {var countshow = "";}
								jQuery(".connected").sortable({
									placeholder: "ui-state-highlight",
									connectWith: ".connected"
								}).bind("sortupdate", function() {
									jQuery("#Share-networks").empty();
									jQuery("#socialsuse li").each(function(){
										if( jQuery(this).text() == "Facebook"){
											 jQuery("#Share-networks").append(\'<a id="xFacebook" href="http://www.facebook.com/sharer.php?u=http://cunjo.com&t=Cunjo, making a better web" class="Link-wrap"><div class="Facebook-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Facebook</small></div></a>\');
										}
										else if( jQuery(this).text() == "Twitter"){
											 jQuery("#Share-networks").append(\'<a id="xTwitter" href="http://twitter.com/home?status=http://cunjo.com" class="Link-wrap"><div class="Twitter-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Twitter</small></div></a>\');
										}
										else if( jQuery(this).text() == "Linkedin"){
											 jQuery("#Share-networks").append(\'<a id="xLinkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=http://cunjo.com&title=Cunjo, making a better web&ro=false&summary=Cunjo, making a better web&source=" class="Link-wrap"><div class="Linkedin-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Linkedin</small></div></a>\');
										}
										else if( jQuery(this).text() == "Pinterest"){
											 jQuery("#Share-networks").append(\'<a id="xPinterest" href="http://pinterest.com/pin/create/button/?url=http://cunjo.com&media=http://cunjo.com/wp-content/themes/nubpage/inc/images/logo-head.png&description=Cunjo, making a better web" class="Link-wrap"><div class="Pinterest-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Pinterest</small></div></a>\');
										}
										else if( jQuery(this).text() == "Google"){
											 jQuery("#Share-networks").append(\'<a id="xGoogle" href="https://plus.google.com/share?url=http://cunjo.com" class="Link-wrap"><div class="Google-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Google+</small></div></a>\');
										}
										else if( jQuery(this).text() == "Digg"){
											 jQuery("#Share-networks").append(\'<a id="xDigg" href="http://digg.com/submit?phase=2&partner=[partner]&url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Digg-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Digg</small></div></a>\');
										}
										else if( jQuery(this).text() == "Myspace"){
											 jQuery("#Share-networks").append(\'<a id="xMyspace" href="http://www.myspace.com/Modules/PostTo/Pages/?u=http://cunjo.com&t=Cunjo, making a better web&c=%20" class="Link-wrap"><div class="Myspace-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Myspace</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Stumbleupon"){
											 jQuery("#Share-networks").append(\'<a id="xStumbleupon" href="http://www.stumbleupon.com/submit?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Stumbleupon-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Stumbleupon</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Bebo"){
											 jQuery("#Share-networks").append(\'<a id="xBebo" href="http://bebo.com/c/share?Url=http://cunjo.com&Title=Cunjo, making a better web" class="Link-wrap"><div class="Bebo-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Bebo</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Blogger"){
											 jQuery("#Share-networks").append(\'<a id="xBlogger" href="http://www.blogger.com/blog_this.pyra?t=&u=http://cunjo.com" class="Link-wrap"><div class="Blogger-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Blogger</small></div></a>\');
										}
										else if( jQuery(this).text() == "Delicious"){
											 jQuery("#Share-networks").append(\'<a id="xDelicious" href="http://del.icio.us/post?v=4&partner=[partner]&noui&url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Delicious-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Delicious</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Xing"){
											 jQuery("#Share-networks").append(\'<a id="xXing" href="https://www.xing.com/social_plugins/share?url=http://cunjo.com&wtmc=Cunjo, making a better web;&sc_p=xing-share" class="Link-wrap"><div class="Xing-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Xing</small></div></a>\');
										}
										else if( jQuery(this).text() == "Tumblr"){
											 jQuery("#Share-networks").append(\'<a id="xTumblr" href="http://www.tumblr.com/share?v=3&u=http://cunjo.com&t=Cunjo, making a better web" class="Link-wrap"><div class="Tumblr-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Tumblr</small></div></a>\');
										}
										else if( jQuery(this).text() == "Technorati"){
											 jQuery("#Share-networks").append(\'<a id="xTechnorati" href="http://technorati.com/faves?add=http://cunjo.com" class="Link-wrap"><div class="Technorati-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Technorati</small></div></a>\');
										}
										else if( jQuery(this).text() == "Reddit"){
											 jQuery("#Share-networks").append(\'<a id="xReddit" href="http://reddit.com/submit?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Reddit-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Reddit</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Netlog"){
											 jQuery("#Share-networks").append(\'<a id="xNetlog" href="http://www.netlog.com/go/manage/blog/view=add&origin=external&title=Cunjo, making a better web&message=[message]&tags=Cunjo, making a better web&referer=http://cunjo.com" class="Link-wrap"><div class="Netlog-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Netlog</small></div></a>\');
										} 
										else if( jQuery(this).text() == "Identi"){
											 jQuery("#Share-networks").append(\'<a id="xIdenti" href="http://identi.ca/index.php? action=newnotice&status_textarea=Cunjo, making a better web-http://cunjo.com" class="Link-wrap"><div class="Identi-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Identi</small></div></a>\');
										}
										else if( jQuery(this).text() == "Friendfeed"){
											 jQuery("#Share-networks").append(\'<a id="xFriendfeed" href="http://www.friendfeed.com/share?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Friendfeed-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Friendfeed</small></div></a>\');
										}
										else if( jQuery(this).text() == "Evernote"){
											 jQuery("#Share-networks").append(\'<a id="xEvernote" href="http://www.evernote.com/clip.action?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Evernote-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Evernote</small></div></a>\');
										}  
										else if( jQuery(this).text() == "Diigo"){
											 jQuery("#Share-networks").append(\'<a id="xDiigo" href="http://www.diigo.com/post?url=http://cunjo.com&title=Cunjo, making a better web" class="Link-wrap"><div class="Diigo-share link"><span class="sh-counter">\'+countshow+\'</span><small>Share on Diigo</small></div></a>\');
										} 
									});
									jQuery("#Share-networks").append(\'<div id="socialgal"></div>\');';
								$javascript .= '});
								jQuery("#Share-networks a").click(function() {
								  window.open(jQuery(this).getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false;
								});
							});</script>';
							
			$javascript .= '<script type="text/javascript">';
			$javascript  .= 'jQuery(".share-select.showing .chooseit").click(function() {';
			$javascript 	.= 'jQuery(".share-select.showing .chooseit").removeClass("selected");';
			$javascript 	.= 'jQuery(this).addClass("selected");';
			$javascript 	.= '});';
			$javascript  .='jQuery(".share-select.icon .chooseit").click(function() {';
			$javascript 	.= 'jQuery(".share-select.icon .chooseit").removeClass("selected");';
			$javascript 	.= 'jQuery(this).addClass("selected");';
			$javascript 	.= 'var oldicon = jQuery("#Share-message-icon").attr("class");';
			$javascript 	.= 'var newicon = jQuery(this).attr("id");';
			$javascript 	.= 'jQuery("#Share-message-icon").removeClass(oldicon);';
			$javascript 	.= 'jQuery("#Share-message-icon").addClass("Share-message-icon "+ newicon);';
			$javascript 	.= '});';
			$javascript .= 'jQuery("#att_text").keyup(function() {';
			$javascript 	.= 'jQuery("#Share-message-inside").html(jQuery(this).val());';
			$javascript .= '});';
			$javascript .= 'jQuery("#att_link").keyup(function() {';
			
			$javascript 	.= 'jQuery(".Share-message-link-wrap").attr("href", jQuery(this).val());';
			$javascript .= '});';
			$javascript .= 'jQuery(".share-select.theme .chooseit").click(function() {';
			$javascript 	.= 'jQuery(".share-select.theme .chooseit").removeClass("selected");';
			$javascript 	.= 'jQuery(this).addClass("selected");';
			$javascript 	.= 'var theme = jQuery(this).attr("id");';
			$javascript 	.= 'jQuery("#Share-bar").attr("class", "");';
			$javascript 	.= 'jQuery("#showShare").attr("class", "");';
			$javascript 	.= 'jQuery("#Share-bar").attr("class", "Share-bar "+ theme +" '.$shareLayout.'");';
			$javascript 	.= 'jQuery("#showShare").attr("class", "showShare "+ theme +" '.$shareLayout.'");';
			$javascript 	.= '});';
			$javascript .= 'jQuery(".share-select.iconz .chooseit").click(function() {';
			$javascript 	.= 'jQuery(".share-select.iconz .chooseit").removeClass("selected");';
			$javascript 	.= 'jQuery(this).addClass("selected");';
			$javascript 	.= 'var iconz = jQuery(this).attr("id");';
			$javascript 	.= 'var theme = jQuery(".share-select.theme .chooseit.selected").attr("id");';
			$javascript 	.= 'if(iconz != "") {';
			if($shareLayout == 'simple') {
				$javascript 		.= 'jQuery("#Share-bar #Share-networks a div.link").attr("style", "background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.'-"+ iconz +".png) !important;");';
			}
			$javascript 		.= 'jQuery("#Share-bar .Link-wrap").css("border-right", "none").css("-webkit-box-shadow", "none").css("box-shadow", "none");';
			$javascript 	.= '}';
			$javascript 	.= 'else{';
			$javascript 		.= 'jQuery("#Share-bar #Share-networks a div.link").removeAttr("style");';
			$javascript 		.= 'jQuery("#Share-bar .Link-wrap").removeAttr("style");';
			$javascript 	.= '}';
			$javascript 	.= '});';
			$javascript .= '</script>';
				
			$out .= $settings.$javascript.$css;
			
	}
	elseif($step == 3 || $step == 4) {
		if($_SESSION['share']['ltype'] == 'button1' || $_SESSION['share']['ltype'] == 'button2'){$layoutz = 'simple';}
		$ShareLineSettings = array('layout' => $layoutz, 'color' => $_POST['theme'], 'position' => $_POST['position'], 'icons' => $_POST['iconz'], 'showing' => $_POST['showing'], 'counter' => $_POST['counter'], 'text' => $_POST['text']);
		json_encode($ShareLineSettings);
		$ShareLineSocials = $_POST['socials'];
		update_option( 'ShareLineSettings', $ShareLineSettings );
		update_option( 'ShareLineSocials', $ShareLineSocials );
		if($step == 4) {
			update_option( 'ShareLineActive', 1 );
			echo '!Share Buttons settings saved, widget activated! <div style="display:inline-block; vertical-align: middle;float: right;margin-right: 20px;margin-top: 4px;line-height: initial;" class="cunjo-prev" onclick="reloadPage()">&lsaquo; Back to !Share Dashboard</div>';
		}
		else {
			echo '!Share Buttons settings saved! <div style="float: right;margin-right: 20px;margin-top: 4px;line-height: initial;" class="cunjo-prev" onclick="reloadPage()">&lsaquo; Back to !Share Dashboard</div>';
		}
	}
	return $out;
}

function show_shareline($ShareLineSettings, $pid, $counters) {
	$shareID = get_option('shareID');
	$shareSocial = get_option('ShareLineSocials');
	$shareColor = $ShareLineSettings["color"];
	$shareLayout = $ShareLineSettings["layout"];
	$sharepos = $ShareLineSettings["position"];
	$icons = $ShareLineSettings["icons"];
	$counter = $ShareLineSettings["counter"];
	$share_text = $ShareLineSettings["text"];
	$oneimage = $_POST["oneimage"];
	$url = get_permalink($pid);
	$title = strip_tags(esc_attr(get_the_title($pid)));
	
	$description = strip_tags(esc_attr(get_the_title($pid)));
	if(is_array($counters) && !empty($counters))
	{
		extract($counters);
	} 
	foreach($shareSocial as $social) {
		switch ($social)
		{
		case "Facebook":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xFacebook" href="http://www.facebook.com/sharer.php?u='.$url.'&amp;t='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Facebook-share2 link">'.$facebookcounter.'<small>Share on Facebook</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Twitter":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xTwitter" href="http://twitter.com/home?status='.$title.' - '.$url.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Twitter-share2 link">'.$twittercounter.'<small>Share on Twitter</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Linkedin":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xLinkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$url.'&amp;title='.$title.'&amp;ro=false&amp;summary='.$description.'&amp;source=" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Linkedin-share2 link">'.$linkedincounter.'<small>Share on Linkedin</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Pinterest":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xPinterest" href="http://pinterest.com/pin/create/button/?url='.$url.'&amp;media='.$oneimage.'&amp;description='.$description.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Pinterest-share2 link">'.$pinterestcounter.'<small>Share on Pinterest</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Google":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xGoogle" href="https://plus.google.com/share?url='.$url.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Google-share2 link">'.$googlecounter.'<small>Share on Google+</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Digg":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xDigg" href="http://digg.com/submit?phase=2&partner=[partner]&url='.$url.'&amp;title='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Digg-share2 link">'.$diggcounter.'<small>Share on Digg</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Myspace":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xMyspace" href="http://www.myspace.com/Modules/PostTo/Pages/?u='.$url.'&amp;t='.$title.'&c=%20" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Myspace-share2 link">'.$myspacecounter.'<small>Share on Myspace</small></div></a>'."\n\t\t".'</li>'."\n";
		  break; 
		case "Stumbleupon":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xStumbleupon" href="http://www.stumbleupon.com/submit?url='.$url.'&amp;title='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Stumbleupon-share2 link">'.$stumblecounter.'<small>Share on Stumbleupon</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;  
		case "Bebo":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xBebo" href="http://bebo.com/c/share?Url='.$url.'&amp;Title='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Bebo-share2 link">'.$bebocounter.'<small>Share on Bebo</small></div></a>'."\n\t\t".'</li>'."\n";
		  break; 
		case "Blogger":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xBlogger" href="http://www.blogger.com/blog_this.pyra?t=&amp;u='.$url.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Blogger-share2 link">'.$bloggercounter.'<small>Share on Blogger</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Delicious":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xDelicious" href="http://del.icio.us/post?v=4&amp;partner=[partner]&amp;noui&amp;url='.$url.'&amp;title='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Delicious-share2 link">'.$deliciouscounter.'<small>Share on Delicious</small></div></a>'."\n\t\t".'</li>'."\n";
		  break; 
		case "Xing":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xXing" href="https://www.xing.com/social_plugins/share?url='.$url.'&amp;wtmc='.$title.';&sc_p=xing-share" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Xing-share2 link">'.$xingcounter.'<small>Share on Xing</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Tumblr":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xTumblr" href="http://www.tumblr.com/share?v=3&amp;u='.$url.'&amp;t='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Tumblr-share2 link">'.$tumblrcounter.'<small>Share on Tumblr</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Technorati":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xTechnorati" href="http://technorati.com/faves?add='.$url.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Technorati-share2 link">'.$technoraticounter.'<small>Share on Technorati</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Reddit":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xReddit" href="http://reddit.com/submit?url='.$url.'&amp;title='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Reddit-share2 link">'.$reditcounter.'<small>Share on Reddit</small></div></a>'."\n\t\t".'</li>'."\n";
		  break; 
		case "Netlog":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xNetlog" href="http://www.netlog.com/go/manage/blog/view=add&amp;origin=external&amp;title='.$title.'&amp;message=[message]&amp;tags='.$description.'&amp;referer='.$url.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Netlog-share2 link">'.$netlogcounter.'<small>Share on Netlog</small></div></a>'."\n\t\t".'</li>'."\n";
		  break; 
		case "Identi":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xIdenti" href="http://identi.ca/index.php?action=newnotice&amp;status_textarea='.$title.'-'.$url.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Identi-share2 link">'.$identicounter.'<small>Share on Identi</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Friendfeed":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xFriendfeed" href="http://www.friendfeed.com/share?url='.$url.'&amp;title='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Friendfeed-share2 link">'.$friendfeedcounter.'<small>Share on Friendfeed</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;
		case "Evernote":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xEvernote" href="http://www.evernote.com/clip.action?url='.$url.'&amp;title='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Evernote-share2 link">'.$evernotecounter.'<small>Share on Evernote</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;  
		case "Diigo":
		  $sharelinks .= "\t\t".'<li>'."\n\t\t\t".'<a id="xDiigo" href="http://www.diigo.com/post?url='.$url.'&amp;title='.$title.'" class="Link-wrap2" onclick="window.open(this.getAttribute(\'href\'),\'windowNew\',\'width=550,height=350,location=no,menubar=no,status=no,toolbar=no\'); return false"><div class="Diigo-share2 link">'.$diigocounter.'<small>Share on Diigo</small></div></a>'."\n\t\t".'</li>'."\n";
		  break;  
		default:
		  $sharelinks .= '';
		}
	}
	if($shareLayout == "simple") {
		if($counter == 'yes') {
			$logotag = '<span class="sh-counter">!Share</span>';
		}
		else {
			$logotag = '<small>!Share</small>';
		}
		$out .= "\n\n";
		$out .= '<div id="Share-bar2" style="clear:both" class="'.$shade.'"><div id="Share-networks2"><ul><li><div id="Share-text">'.$share_text.'</div><div id="Share-text-fix"></div></li>'.$sharelinks.'<li><a href="http://share.cunjo.com" target="_blank" id="Share-logo-wrap2" class="tip"><div class="Share-logo2">'.$logotag.'</div></a></li></ul></div></div>';
		$out .= "\n\n";
	}
	return $out;
}
function print_cunjostyles($ShareLineSettings) {
		$shareColor = $ShareLineSettings["color"];
		$shareLayout = $ShareLineSettings["layout"];
		$sharepos = $ShareLineSettings["position"];
		$icons = $ShareLineSettings["icons"];
		$counter = $ShareLineSettings["counter"];
		$out .= '<style>';
		$out .= '#Share-networks2 a div.link small, #Share-logo-wrap2 div small { background:#000; text-align:center; width:140px; padding:5px; border-left:1px solid #111; border-top:1px solid #111; border-right:1px solid #333; border-bottom:1px solid #333; border-radius:3px; display:none; color:#fff; font-size:12px !important; font-family:Arial !important; text-indent:0;}';
		$out .= '#Share-logo-wrap2 div small {width: 80px;}';
		$out .= '@-moz-keyframes mymove {0%{ -moz-transform:scale(0,0); opacity:0;}50%{ -moz-transform:scale(1.2,1.2); opacity:0.3; }75%{ -moz-transform:scale(0.9,0.9); opacity:0.7;}100%{ -moz-transform:scale(1,1); opacity:1;}}';
		$out .= '@-webkit-keyframes mymove {0%{ -webkit-transform:scale(0,0); opacity:0;}50%{ -webkit-transform:scale(1.2,1.2); opacity:0.3;}75%{ -webkit-transform:scale(0.9,0.9); opacity:0.7;}100%{ -webkit-transform:scale(1,1); opacity:1;}}';
		if($shareLayout == "simple") {
		$out .= '#Share-networks2 a div.link:hover small, #Share-logo-wrap2 div:hover small { z-index: 9999; display:block; position:absolute; bottom: 39px; left: 50%; margin-left:-70px; z-index:9999; -moz-animation:mymove .25s linear;  -webkit-animation:mymove .25s linear; }';
		$out .= '#Share-logo-wrap2 div:hover small {margin-left:-40px;}';
		$out 	.= '.Link-wrap2:hover {opacity: 0.8;}';
		$out 	.= '#Share-text {position: relative; display: inline-block; vertical-align: middle;margin-right: 10px;font-size: 20px;font-family: Tahoma;}';
		$out 	.= '#Share-text-fix {position: relative; display: inline-block; vertical-align: middle;width:0 !important; margin: 0 !important;padding: 0 !important;height: 100% !important;}';
		$shade = "dark";
		if(isset($icons) && $icons != ''){$shareLayouticons = '-'.$icons; $linksborder = '';}else{$shareLayouticons = ''; $linksborder = 'border-bottom: 1px solid rgba(0,0,0,0.2); -webkit-box-shadow: inset 0px -1px 0px 0px rgba(255, 255, 255, 0.2); box-shadow: inset 0px -1px 0px 0px rgba(255, 255, 255, 0.2);';}
		if($shareColor == '24'){
			$out 	.= '#Share-text {font-size: 16px;}';
			$out 	.= '#Share-bar2 {position: relative; margin: 10px 0; height: 42px !important;}';
			$out 	.= '.Share-logo2 {position: initial !important; opacity: 1 !important; display: block !important; width: 28px !important; height: 29px !important; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.$shareLayouticons.'-'.$shareColor.'.png) !important; background-repeat: no-repeat !important; background-position: -588px 0 !important;}';
			$out 	.= '#Share-logo-wrap2 {position: relative !important; opacity: 1 !important; display: inline-block !important; vertical-align: middle  !important; width: 28px  !important; height: 29px  !important;}';
			$out 	.= '.Link-wrap2 {position: relative !important; display: inline-block !important; vertical-align: middle !important; width: 28px !important; height: 29px !important;}';
			$out 	.= '#Share-networks2 a div.link {display: block; width: 28px; height: 29px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.$shareLayouticons.'-'.$shareColor.'.png); background-repeat: no-repeat;}';
			if($counter == 'yes') {
				$out .= '#Share-networks2 a div.link:hover small, #Share-logo-wrap2 div:hover small {bottom: 49px;}';
				$out 	.= '.Link-wrap2 {margin-right: 10px;}';
				$out 	.= '#Share-networks2 a div.link { -webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}';
				$out 	.= '#Share-logo-wrap2 .Share-logo { -webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}';
				$out 	.= '#Share-networks2 .sh-counter {color:#000 !important;text-decoration:none !important;position: absolute;display: block;padding: 0px;background: #fefefe;border: 1px solid #d7d7d7;width: 40px;font-size: 10px;text-align: center;bottom: -8px;left: -6px;}';
				$out 	.= '.Link-wrap2:hover {opacity: 1;}';
				$out 	.= '.Link-wrap2:hover div.link {margin-top: -10px;}';
				$out 	.= '#Share-logo-wrap2:hover .Share-logo2 {margin-top: -10px;}';
			}
		}
		else {
			$out 	.= '#Share-bar2 {position: relative; margin: 10px 0;height:42px !important;}';
			$out 	.= '.Share-logo2 {position: initial !important; opacity: 1 !important; display: block !important; width: 40px !important; height: 42px !important; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.$shareLayouticons.'-'.$shareColor.'.png) !important; background-repeat: no-repeat !important; background-position: -830px 0 !important;}';
			$out 	.= '#Share-logo-wrap2 {position: relative !important; opacity: 1 !important; display: inline-block !important; vertical-align: middle  !important; width: 40px  !important; height: 42px  !important;}';
			$out 	.= '.Link-wrap2 {position: relative !important; display: inline-block !important; vertical-align: middle !important; width: 40px !important; height: 42px !important;}';
			if($counter == 'yes') {
				$out .= '#Share-networks2 a div.link:hover small, #Share-logo-wrap2 div:hover small {bottom: 49px;}';
				$out 	.= '.Link-wrap2 {margin-right: 10px;}';
				$out 	.= '#Share-networks2 a div.link { -webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}';
				$out 	.= '#Share-logo-wrap2 .Share-logo2 { -webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}';
				$out 	.= '#Share-networks2 .sh-counter {color:#000 !important;text-decoration:none !important;position: absolute;display: block;padding: 0px;background: #fefefe;border: 1px solid #d7d7d7;width: 40px;font-size: 10px;text-align: center;bottom: -5px;left: -1px;}';
				$out 	.= '.Link-wrap2:hover {opacity: 1;}';
				$out 	.= '.Link-wrap2:hover div.link {margin-top: -10px;}';
				$out 	.= '#Share-logo-wrap2:hover .Share-logo2 {margin-top: -10px;}';
			}
			$out 	.= '#Share-networks2 a div.link {display: block; width: 40px; height: 42px; background-image: url(http://cunjo.com/!Share/icns/'.$shareLayout.$shareLayouticons.'-'.$shareColor.'.png); background-repeat: no-repeat;}';
		}
		$out 	.= '#showShare2 {display: none;}';
		$out 	.= '#Share-logo-wrap2:hover {opacity: 0.8;}';
		$out 	.= '#Share-networks2 {position: relative; display: inline-block; vertical-align: middle; height: 42px !important;}';
		$out 	.= '#hideShare2 {display:none;}';
		$out 	.= '#Share-networks2:hover .socialgal2 {display: block;}';
	}
		if($shareColor == '24'){
			$out 	.= '.Facebook-share2 {background-position: -28px 0;}';
			$out 	.= '.Twitter-share2 {background-position: -56px 0;}';
			$out 	.= '.Linkedin-share2 {background-position: -84px 0;}';
			$out 	.= '.Pinterest-share2 {background-position: -114px 0;}';
			$out 	.= '.Google-share2 {background-position: -140px 0;}';
			$out 	.= '.Digg-share2 {background-position: -168px 0;}';
			$out 	.= '.Myspace-share2 {background-position: -196px 0;}';
			$out 	.= '.Stumbleupon-share2 {background-position: -224px 0;}';
			$out 	.= '.Bebo-share2 {background-position: -252px 0;}';
			$out 	.= '.Blogger-share2 {background-position: -280px 0;}';
			$out 	.= '.Delicious-share2 {background-position: -308px 0;}';
			$out 	.= '.Xing-share2 {background-position: -336px 0;}';
			$out 	.= '.Tumblr-share2 {background-position: -364px 0;}';
			$out 	.= '.Technorati-share2 {background-position: -392px 0;}';
			$out 	.= '.Reddit-share2 {background-position: -420px 0;}';
			$out 	.= '.Netlog-share2 {background-position: -448px 0;}';
			$out 	.= '.Identi-share2 {background-position: -476px 0;}';
			$out 	.= '.Friendfeed-share2 {background-position: -504px 0;}';
			$out 	.= '.Evernote-share2 {background-position: -532px 0;}';
			$out 	.= '.Diigo-share2 {background-position: -560px 0;}';
		}
		else {
			$out 	.= '.Facebook-share2 {background-position: -30px 0;}';
			$out 	.= '.Twitter-share2 {background-position: -70px 0;}';
			$out 	.= '.Linkedin-share2 {background-position: -110px 0;}';
			$out 	.= '.Pinterest-share2 {background-position: -150px 0;}';
			$out 	.= '.Google-share2 {background-position: -190px 0;}';
			$out 	.= '.Digg-share2 {background-position: -230px 0;}';
			$out 	.= '.Myspace-share2 {background-position: -270px 0;}';
			$out 	.= '.Stumbleupon-share2 {background-position: -310px 0;}';
			$out 	.= '.Bebo-share2 {background-position: -350px 0;}';
			$out 	.= '.Blogger-share2 {background-position: -390px 0;}';
			$out 	.= '.Delicious-share2 {background-position: -430px 0;}';
			$out 	.= '.Xing-share2 {background-position: -470px 0;}';
			$out 	.= '.Tumblr-share2 {background-position: -510px 0;}';
			$out 	.= '.Technorati-share2 {background-position: -550px 0;}';
			$out 	.= '.Reddit-share2 {background-position: -590px 0;}';
			$out 	.= '.Netlog-share2 {background-position: -630px 0;}';
			$out 	.= '.Identi-share2 {background-position: -670px 0;}';
			$out 	.= '.Friendfeed-share2 {background-position: -710px 0;}';
			$out 	.= '.Evernote-share2 {background-position: -750px 0;}';
			$out 	.= '.Diigo-share2 {background-position: -790px 0;}';
		}
		$out .= '#Share-networks2 ul {display: inline-block !important;vertical-align:top !important; height: 42px !important;list-style-type: none !important;list-style: none !important;}';
		$out .= '#Share-networks2 ul li {display: inline !important;float: left !important;list-style-type: none !important;list-style: none !important;clear: none !important;margin:0 !important; height: 42px !important;}';
	$out .= '</style>';
	return $out;
}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
//function convert number
function format_num($num, $precision = 2) {
   if ($num >= 1000 && $num < 1000000) {
    $n_format = number_format($num/1000,$precision).'K';
    } else if ($num >= 1000000 && $num < 1000000000) {
    $n_format = number_format($num/1000000,$precision).'M';
   } else if ($num >= 1000000000) {
   $n_format=number_format($num/1000000000,$precision).'B';
   } else {
   $n_format = $num;
    }
  return $n_format;
} 

?>