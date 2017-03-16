jQuery(document).ready(function($){

	"use strict";
	$('#toggle_megamenu').live('click', function(){

		var parent_div = $(this).parents('div.menu-item-settings');

		$('#megamenu_options', parent_div).slideToggle();

	});

	$('#megamenu_columns').live('change', function(){

		var value = $(this).val();

		var parent_div = $(this).parents('div#megamenu_options');

		var html = '';

		if(value > 1) {html += '<option value="2">2/'+value+'</option>';}

		if(value > 3) {html += '<option value="4">4/'+value+'</option>';}

		if(value > 5) {html += '<option value="6">6/'+value+'</option>';}

		if(value > 7) {html += '<option value="8">8/'+value+'</option>';}

		$('#megamenu_devide', parent_div).html(html);

	});

});