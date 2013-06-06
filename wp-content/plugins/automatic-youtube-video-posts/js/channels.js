/**************************************************************************************************/
/*
/*		File:
/*			channels.js
/*		Description:
/*			This file contains Javascript for the administrative aspects of the plugin's channel editor.
/*		Date:
/*			Added on July 27, 2012
/*		Copyright:
/*			Copyright (c) 2012 Matthew Praetzel.
/*		License:
/*			License:
/*			This software is licensed under the terms of the GNU General Public License v3
/*			as published by the Free Software Foundation. You should have received a copy of of
/*			the GNU General Public License along with this software. In the event that you
/*			have not, please visit: http://www.gnu.org/licenses/gpl-3.0.txt
/*
/**************************************************************************************************/

/*-----------------------
	Initialize
-----------------------*/
(function($) { $(document).ready(function () {
	
	$('.WP_ayvpp_edit').bind('mousedown',function () {
		$('#WP_ayvpp_add_item_form').find('[name=item]').val($(this).parents('tr').find('input').val());
		$('#WP_ayvpp_add_item_form').find('[name=name]').val($(this).parents('tr').find('.column-name strong').text());
		$('#WP_ayvpp_add_item_form').find('[name=channel]').val($(this).parents('tr').find('.column-channel').text());
		$('#WP_ayvpp_add_item_form').find('[name=type]').val($(this).parents('tr').find('.column-type').text());
		$('#WP_ayvpp_add_item_form').find('[name=author]').val($(this).parents('tr').find('.column-author input').val());
		
		var c = $(this).parents('tr').find('.column-cat input').val().split(',');
		$('#WP_ayvpp_add_item_form input.chk').each(function() {
			if($.inArray($(this).val(),c) !== -1) {
				$(this).attr('checked',true);
			}
			else {
				$(this).attr('checked',false);
			}
		});
		
	});
		
}); })(jQuery);