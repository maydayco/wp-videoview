// JavaScript Document
function reloadPage() {
  location.reload()
}
function register_share() {
	jQuery('.register-mess').html('<div class="gen-loading">Emailing you..</div>');
	if (!document.getElementById('terms').checked){
		jQuery('.register-mess').html('<div class="widget-alert" style="margin-bottom: 10px;font-size: 14px">You must agree with our Terms & Conditions!</div>');
	}
	else {
		var email = jQuery('#email').attr('value');
		if(email == '') {
			jQuery('.register-mess').html('<div class="widget-alert" style="margin-bottom: 10px">Please insert your email address!</div>');
		}
		else {
			var data = 'ajaxcall=share&step=sendid&email='+email;
			jQuery.ajax({
				type: "POST",
				url: 'http://share.cunjo.com/wp-content/themes/share/inc/ajaxify.php',
				data: data,
				success: function(data) {
					if(data == 'emailexists') {
						jQuery('.register-mess').html('<div class="widget-alert" style="margin-bottom: 10px">You already have a !Share ID!</div>');
					}
					else if(data == 'goodtogo'){
						jQuery('.register-mess').html('<div class="widget-success">Please check your email Inbox.</div> <small style="margin-bottom: 10px">*It may take up to 5 minutes for the email to arrive so please have patience. Also, the notification might go to spam, so please check your spam folder aswell.</small>');
					}
				}
			});
		}
	}
	return false;
}
function get_share() {
	jQuery('.get-mess').html('<div class="gen-loading">Generating widget..</div>');
	var idz = jQuery('#idz').attr('value');
	if(idz == '') {
		jQuery('.get-mess').html('<div class="widget-alert" style="margin-bottom: 10px">Please insert your !Share ID!</div>');
	}
	else {
		var data = 'ajaxcall=share&step=getshare&idz='+idz;
		jQuery.ajax({
			type: "POST",
			url: 'http://share.cunjo.com/wp-content/themes/share/inc/ajaxify.php',
			data: data,
			success: function(data) {
				if(data == 'noid') {
					jQuery('.get-mess').html('<div class="widget-alert">This ID is not in our database!</div><small style="margin-bottom: 10px">*If you do not have a !Share ID please register for one, FREE, with the left side form.');
				}
				else {
					var data = {action:'saveshare',id:idz};
					jQuery.post(blogVars.ajaxUrl, data, function(response) {
						if(response == 'noid') {
							jQuery('.get-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
						}
						else {
							jQuery( '.cunjo_share' ).hide( 'slide', {direction: 'up'}, 500 );
							setTimeout(function(){jQuery( ".cunjo_share" ).html(response).show( 'slide', {direction: 'up'}, 500 );},1000);
							//jQuery('.get-mess').html('<div class="widget-success2" style="margin-bottom: 10px;">'+response+'</div> ');
							//setTimeout(function(){location.reload();},1000)
						}
					});
				}
			}
		});
	}
	return false;
}
//main dashboard actions
function cunjo_dashboard() {
	jQuery('.share-select.dashboard .chooseit').live('click', function() {
		if(jQuery(this).attr('id') == 'activate_bar'){
			jQuery('.register-mess').html('<div class="gen-loading"></div>');
			var data = {action:'activateshare',type:'Bar'};
			jQuery.post(blogVars.ajaxUrl, data, function(response) {
				if(response == 'no') {
					jQuery('.register-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
				}
				else {
					jQuery('.register-mess').html('');
					jQuery( '#activate_bar .statusimg div' ).removeClass('status-disabled').fadeOut( 500 );
					jQuery( '#activate_bar .statusimg div' ).addClass('status-enabled').fadeIn( 500 );
					jQuery( '#activate_bar span' ).html('Enabled');
					jQuery( '#activate_bar' ).attr('title', 'Click to disable');
					jQuery( '#activate_bar' ).attr('id', 'deactivate_bar');
				}
			});
		}
		else if(jQuery(this).attr('id') == 'activate_line'){
			jQuery('.get-mess').html('<div class="gen-loading"></div>');
			var data = {action:'activateshare',type:'Line'};
			jQuery.post(blogVars.ajaxUrl, data, function(response) {
				if(response == 'no') {
					jQuery('.get-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
				}
				else {
					jQuery('.get-mess').html('');
					jQuery( '#activate_line .statusimg div' ).removeClass('status-disabled').fadeOut( 500 );
					jQuery( '#activate_line .statusimg div' ).addClass('status-enabled').fadeIn( 500 );
					jQuery( '#activate_line span' ).html('Enabled');
					jQuery( '#activate_line' ).attr('title', 'Click to disable');
					jQuery( '#activate_line' ).attr('id', 'deactivate_line');
				}
			});
		}
		else if(jQuery(this).attr('id') == 'deactivate_bar'){
			jQuery('.register-mess').html('<div class="gen-loading"></div>');
			var data = {action:'deactivateshare',type:'Bar'};
			jQuery.post(blogVars.ajaxUrl, data, function(response) {
				if(response == 'no') {
					jQuery('.register-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
				}
				else {
					jQuery('.register-mess').html('');
					jQuery( '#deactivate_bar .statusimg div' ).removeClass('status-enabled').fadeOut( 500 );
					jQuery( '#deactivate_bar .statusimg div' ).addClass('status-disabled').fadeIn( 500 );
					jQuery( '#deactivate_bar span' ).html('Disabled');
					jQuery( '#deactivate_bar' ).attr('title', 'Click to enable');
					jQuery( '#deactivate_bar' ).attr('id', 'activate_bar');
				}
			});
		}
		else if(jQuery(this).attr('id') == 'deactivate_line'){
			jQuery('.get-mess').html('<div class="gen-loading"></div>');
			var data = {action:'deactivateshare',type:'Line'};
			jQuery.post(blogVars.ajaxUrl, data, function(response) {
				if(response == 'no') {
					jQuery('.get-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
				}
				else {
					jQuery('.get-mess').html('');
					jQuery( '#deactivate_line .statusimg img' ).removeClass('status-enabled').fadeOut( 500 );
					jQuery( '#deactivate_line .statusimg div' ).addClass('status-disabled').fadeIn( 500 );
					jQuery( '#deactivate_line span' ).html('Disabled');
					jQuery( '#deactivate_line' ).attr('title', 'Click to enable');
					jQuery( '#deactivate_line' ).attr('id', 'activate_line');
				}
			});
		}
		else if(jQuery(this).attr('id') == 'build_bar'){
			jQuery('.register-mess').html('<div class="gen-loading"></div>');
			var data = {action:'buildbar',step:1};
			jQuery.post(blogVars.ajaxUrl, data, function(response) {
				if(response == 'no') {
					jQuery('.register-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
				}
				else {
					jQuery( '.cunjo_share' ).hide( 'slide', {direction: 'up'}, 500 );
					setTimeout(function(){jQuery( ".cunjo_share" ).html(response).show( 'slide', {direction: 'up'}, 500 );},1000);
				}
			});
		}
		else if(jQuery(this).attr('id') == 'build_line'){
			jQuery('.gen-mess').html('<div class="gen-loading"></div>');
			var data = {action:'buildline',step:1};
			jQuery.post(blogVars.ajaxUrl, data, function(response) {
				if(response == 'no') {
					jQuery('.register-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
				}
				else {
					jQuery( '.cunjo_share' ).hide( 'slide', {direction: 'up'}, 500 );
					setTimeout(function(){jQuery( ".cunjo_share" ).html(response).show( 'slide', {direction: 'up'}, 500 );},1000);
				}
			});
		}
	});
}
//bar form get step
function get_barform(stepz) {
	jQuery('.register-mess').html('<div class="gen-loading"></div>');
	if(stepz == 2) {
	var ltypez = jQuery('.share-select.type .selected').attr('id');
	var data = {action:'buildbar',step:stepz,ltype:ltypez};
	}
	else if(stepz == 3) {
		if(jQuery('.share-select.features li').hasClass('selected')) {
			var featurez= [];
			var i = 0;
			jQuery('.share-select.features .selected').each(function(){
				  featurez[i] = jQuery(this).attr('id');
				  i++;
			});
			var data = {action:'buildbar',step:stepz,features:featurez};
		}
		else {
			jQuery('.register-mess').html('<div class="widget-alert">Please select atleast 1 feature</div>');
			return false;
		}
	}
	else if(stepz == 4 || stepz == 5) {
		var layout = document.getElementById("!Share").getAttribute("layout");
		jQuery('html,body').animate({scrollTop: jQuery("body").offset().top },'slow');
		var socials2 = new Array();
		if(jQuery("#socialsuse").length > 0) {
			jQuery("#socialsuse li").each(function(){
				socials2.push(jQuery(this).text())
			});
		}
		var message2 = '';
		var linx2 = '';
		var iconx2 = '';
		if(jQuery('#att_text').length > 0) {
			message2 = jQuery('#att_text').attr('value');
			linx2 = jQuery('#att_link').attr('value');
			iconx2 = jQuery('.share-select.icon .selected').attr('id');
		}
		if(layout == 'nice_bottom' || layout == 'nice_left') {
			var theme2 = '';
			theme2 = jQuery('#color1').val();
			var textcolor2 = jQuery('#color2').val();
			var width2 = '';
			width2 = 50;
			var counter2 = '';
			if(jQuery(".share-select.counter").length > 0) {
				counter2 = jQuery('.share-select.counter .selected').attr('id');
			}
			var offleft2 = '';
			if(jQuery("#offleft").length > 0) {
				offleft2 = jQuery('#offleft').val();
			}
		}
		else {
			var theme2 = '';
			if(jQuery(".share-select.theme").length > 0) {
				theme2 = jQuery('.share-select.theme .selected').attr('id');
			}
			var width2 = '';
			if(jQuery("#bar_width").length > 0) {
				width2 = jQuery('#bar_width').attr('value');
			}
		}
		var iconz2 = '';
		if(jQuery(".share-select.iconz").length > 0) {
			iconz2 = jQuery('.share-select.iconz .selected').attr('id');
		}
		var position2 = '';
		if(jQuery(".share-select.position").length > 0) {
			position2 = jQuery('.share-select.position .selected').attr('id');
		}
		var showat2 = '';
		if(jQuery("#showat").length > 0) {
			showat2 = jQuery('#showat').attr('value');
		}
		var data = {action:'buildbar',step:stepz,socials:socials2,message:message2,linx:linx2,iconx:iconx2,theme:theme2,iconz:iconz2,width:width2,position:position2,showat:showat2,textcolor:textcolor2,counter:counter2,offleft:offleft2};
	}
	jQuery.post(blogVars.ajaxUrl, data, function(response) {
		if(response == 'no') {
			jQuery('.register-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
		}
		else {
			if(stepz == 2) {
				jQuery( '.cunjo_share' ).hide( 'slide', {direction: 'up'}, 500 );
				setTimeout(function(){jQuery( ".cunjo_share" ).html(response).show( 'slide', {direction: 'up'}, 500 );},500);
				
				var scriptUrl = "http://cunjo.com/!Share_test/js/!Share.js";
				setTimeout(function(){
					jQuery('.register-mess').html('<div class="gen-loading">generating preview..</div>');
					jQuery.getScript(scriptUrl, function() {
						jQuery('.register-mess').html('');
						getShare();
						ajustShare();
					});
				},500);
			}
			else if(stepz == 3) {
				var sharePre = document.getElementById("!Share")
				var shareL = document.getElementById("!Share").getAttribute("layout");
				//sharePre.appendTo("body");
				document.body.insertBefore(sharePre, document.body.childNodes[0]);

				jQuery( '.cunjo_share' ).hide( 'slide', {direction: 'up'}, 500 );
				setTimeout(function(){jQuery( ".cunjo_share" ).html(response).show( 'slide', {direction: 'up'}, 1000 );},500);
				if(shareL == 'nice_left') {
					
					var scriptUrl = "http://cunjo.com/!Share/js/!Share_test.js";
					setTimeout(function(){
						var child = document.getElementById("!Share");
						  child.remove();
						jQuery('.register-mess').html('<div class="gen-loading">generating preview..</div>');
						jQuery.getScript(scriptUrl, function() {
							jQuery('.register-mess').html('');
							getShare();
							ajustShare();
						});
					},500);
				}
			}
			else if(stepz == 4 || stepz == 5) {
				jQuery('.register-mess').html('<div class="widget-success">'+response+'</div>');
			}
		}
	});
}
//bar form get step
function get_lineform(stepz) {
	jQuery('.register-mess').html('<div class="gen-loading"></div>');
	if(stepz == 2) {
		var ltypez = jQuery('.share-select.type .selected').attr('id');
		var data = {action:'buildline',step:stepz,ltype:ltypez};
	}
	else if(stepz == 3 || stepz == 4) {
		jQuery('html,body').animate({scrollTop: jQuery("body").offset().top },'slow');
		var socials2 = new Array();
		if(jQuery("#socialsuse").length > 0) {
			jQuery("#socialsuse li").each(function(){
				socials2.push(jQuery(this).text())
			});
		}
		var theme2 = '';
		if(jQuery(".share-select.theme").length > 0) {
			theme2 = jQuery('.share-select.theme .selected').attr('id');
		}
		var iconz2 = '';
		if(jQuery(".share-select.iconz").length > 0) {
			iconz2 = jQuery('.share-select.iconz .selected').attr('id');
		}
		var position2 = '';
		if(jQuery(".share-select.position").length > 0) {
			position2 = jQuery('.share-select.position .selected').attr('id');
		}
		var showing2 = '';
		if(jQuery(".share-select.showing").length > 0) {
			showing2 = jQuery('.share-select.showing .selected').attr('id');
		}
		var counter2 = jQuery('#is_counter').attr('value');
		var text2 = jQuery('#share_text').attr('value');
		var data = {action:'buildline',step:stepz,socials:socials2,theme:theme2,iconz:iconz2,position:position2,showing:showing2,counter:counter2,text:text2};
	}
	jQuery.post(blogVars.ajaxUrl, data, function(response) {
		if(response == 'no') {
			jQuery('.register-mess').html('<div class="widget-alert">There was an error, please try again later.</div>');
		}
		else {
			if(stepz == 2) {
				jQuery( '.cunjo_share' ).hide( 'slide', {direction: 'up'}, 500 );
				setTimeout(function(){jQuery( ".cunjo_share" ).html(response).show( 'slide', {direction: 'up'}, 500 );},500);
				
				var scriptUrl = "http://cunjo.com/!Share/js/!Share.js";
				setTimeout(function(){
					jQuery('.register-mess').html('<div class="gen-loading">generating preview..</div>');
					jQuery.getScript(scriptUrl, function() {
						jQuery('.register-mess').html('');
						getShare();
						ajustShare();
					});
				},500);
			}
			else if(stepz == 3 || stepz == 4) {
				jQuery('.register-mess').html('<div class="widget-success">'+response+'</div>');
			}
		}
	});
}
jQuery("#bar_width").live('keyup', function() {
  jQuery("#rangesl").slider('option', 'value', parseInt(jQuery(this).val()));
});
//load functions
jQuery(document).ready(function() {
	cunjo_dashboard();
});