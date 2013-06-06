/**************************************************************************************************/
/*
/*		File:
/*			admin.js
/*		Description:
/*			This file contains Javascript for the administrative aspects of the plugin.
/*		Date:
/*			Added on November 8th 2010
/*		Copyright:
/*			Copyright (c) 2009 Matthew Praetzel.
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
(function($) {
		  
	var ayvpp = {
		
		timer : null,
		importing : false,
		
		init : function () {
			this.addToQueue(this.is_importing);
			this.addToQueue(this.reset);
			this.addToQueue(this.impor);
		},
		is_importing : function () {
			var t = this;
			$.ajax({
				async : true,
				type : 'GET',
				url : ayvpp_root+'/wp-admin/admin-ajax.php',
				dataType : 'text',
				data : 'page=ayvpp-import-videos&action=ayvpp_is_importing&_wpnonce='+$('#_wpnonce').val(),
				success : function (m) {
					if(m == '1') {
						t.importing = true;
						$('#wpbody').prepend('<div class="tern_errors"><p>There is currently an import taking place. Please try again later or <a href="admin.php?page=ayvpp-import-videos">click here</a> to reset the import in the database.</p></div>');
						return;
					}
					t.removeFromQueue();
				},
				error : function (m) {
					t.importing = true;
					$('#wpbody').prepend('<div class="tern_errors"><p>There was an error while attemping to import. Please try again later.</p></div>');
				}
			});
		},
		impor : function (o) {
			var t = this,o = o ? o : 1;
			this.timer = setInterval(this.status,1000);
			$.ajax({
				async : true,
				type : 'GET',
				url : ayvpp_root+'/wp-admin/admin-ajax.php',
				dataType : 'text',
				data : 'page=ayvpp-import-videos&action=ayvpp_import&memory='+$('#memory').val()+'&_wpnonce='+$('#_wpnonce').val(),
				success : function (m) {
					clearInterval(t.timer);
					t.status();
					t.removeFromQueue();
				},
				error : function (m) {
					t.removeFromQueue();
					clearInterval(t.timer);
				}
			});
		},
		reset : function () {
			var t = this;
			$.ajax({
				async : true,
				type : 'GET',
				url : ayvpp_root+'/wp-admin/admin-ajax.php',
				dataType : 'text',
				data : 'page=ayvpp-import-videos&action=ayvpp_file&_wpnonce='+$('#_wpnonce').val(),
				success : function (a) {
					t.removeFromQueue();
				},
				error : function () {
					t.removeFromQueue();
				}
			});
		},
		status : function () {
			var t = this;
			$.ajax({
				async : true,
				type : 'GET',
				url : ayvpp_root+'/wp-admin/admin-ajax.php',
				dataType : 'text',
				data : 'page=ayvpp-import-videos&action=ayvpp_status&_wpnonce='+$('#_wpnonce').val(),
				success : function (m) {
					var a=[],m = m.split('<->');
					$.each(m,function () {
						if(this.length > 0) {
							a[a.length] = this;
						}
					});
					$('#ayvpp_list').html(a.join('<br />'));
					$('#ayvpp_total').html('Total Videos Imported: '+$('#ayvpp_list .imported').length);
					
					if($('#tern_wp_ayvpp_complete').get(0) && t.timer) {
						clearInterval(t.timer);
						$('#wpbody').prepend('<div class="tern_alerts"><p>Your import is complete!</p></div>');
					}
					
				},
				error : function () {
				}
			});
		},
		queue : [],
		addToQueue :
		function (f,a) {
			this.queue.push([f,a]);
			if(!this.iq) {
				this.startQueue();
			}
		},
		startQueue :
		function () {
			if(this.queue.length > 0) {
				this.iq = true;
				var a = this.queue[0][1] ? this.queue[0][1] : [];
				this.queue[0][0].apply(this,a);
				return;
			}
			this.iq = false;
		},
		removeFromQueue :
		function () {
			this.queue.splice(0,1);
			this.startQueue();
		}
	
	}

	$(document).ready(function() {
		$('#ayvpp_import').bind('click',function() {
			ayvpp.init();
			$('#ayvpp_import').unbind('click').fadeOut(function () { $(this).remove(); });
			return false;
		
		});
	});
		
})(jQuery);