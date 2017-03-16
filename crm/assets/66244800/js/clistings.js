$(document).ready(function(){
	
	$("#Clistings_c_listing_country_c").on('change',function(){
	
		$.ajax({
		            url:"/site/dynamicDropdown",
		            type:"GET",
		            data:{"val":$(this).val(),"dropdownId":"1001"},
		            success:function(data){
		            	$("#Clistings_c_listing_region_c").html(data);
						},
						failure:function(data){
							console.log ("FAILURE");
							console.log(data);
						}
		})
	});
	
	$("#Clistings_c_listing_region_c").on('load change',function(){
	
		$.ajax({
		            url:"/site/dynamicDropdown",
		            type:"GET",
		            data:{"val":$(this).val(),"dropdownId":"1002"},
		            success:function(data){
		            	$("#Clistings_c_listing_town_c").html(data);
						},
						failure:function(data){
							console.log ("FAILURE");
							console.log(data);
						}
		})
	
	});

});
