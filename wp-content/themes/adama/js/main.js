/*-----------------------------------------------------------------------------------*/
/* 		Mian Js Start 
/*-----------------------------------------------------------------------------------*/
var $ = jQuery;
jQuery(document).ready(function($) {
"use strict"
/*-----------------------------------------------------------------------------------*/
/*    STICKY NAVIGATION
/*-----------------------------------------------------------------------------------*/
$("header.sticky").sticky({topSpacing:0});
/*-----------------------------------------------------------------------------------*/
/* 	MENU
/*-----------------------------------------------------------------------------------*/
$().ownmenu();
/*-----------------------------------------------------------------------------------*/
/* 	FLEX SLIDER
/*-----------------------------------------------------------------------------------*/
$('.flex-banner').flexslider({
    animation: "fade",
	slideshow: true,                //Boolean: Animate slider automatically
    slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
    animationSpeed: 500,            //Integer: Set the speed of animations, in milliseconds
	autoPlay : true
});
/*-----------------------------------------------------------------------------------*/
/* 	WOW ANIMATION
/*-----------------------------------------------------------------------------------*/
var wow = new WOW({
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       10,          // distance to the element when triggering the animation (default is 0)
    mobile:       false,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
}});
wow.init();
/*-----------------------------------------------------------------------------------*/
/*    Parallax
/*-----------------------------------------------------------------------------------*/
jQuery.stellar({
    horizontalScrolling: false,
    scrollProperty: 'scroll',
    positionProperty: 'position'
});

	/*-----------------------------------------------------------------------------------*/
	/*    PRICE RANGE
	/*-----------------------------------------------------------------------------------*/
	$(function(){
		try {
			var min_price = $('#price-range').data('min');
			var max_price = $('#price-range').data('max');
			$("#price-range").noUiSlider({
			  range: {
				  'min': [ min_price ],
				  'max': [ max_price ]
			  },
			  start: [min_price, max_price],
				   connect:true,
				   serialization:{
					   lower: [
					 $.Link({
					  target: function(val) {
						  $("#price-min").text(val);
						  $('input[name=min_price]').val(val);
						  //return $("#price-min");
					  }
					})],
			   upper: [
					  $.Link({
					  target: function( val ) {
						  //$("#price-max")
						  $("#price-max").text(val);
						  $('input[name=max_price]').val(val);
					  }
					})],
			   format: {
				  // Set formatting
					  decimals: 0,
					  prefix: '$'
			  }}
			});
		}catch(e) {
			console.log(e);
		}
	
	});
	
	
	$('#location').keyup(function(e) {
		e.preventDefault();
		var value = $(this).val();
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {action: '_sh_ajax_callback', subaction: 'location_results', value: value},
			success: function(res){
				$('.location-result').html(res);
				$('.location-result').slideDown('slow');
			}
		});
	});
	
	$('.location-result').on('click', 'span.location-link', function(e){
		$('#location').val($(this).text());
		$('.location-result').slideUp('slow');
	});
});
/*-----------------------------------------------------------------------------------*/
/*    CONTACT FORM
/*-----------------------------------------------------------------------------------*/
function checkmail(input){
  var pattern1=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  	if(pattern1.test(input)){ return true; }else{ return false; }}     
    function proceed(){
    	var name = document.getElementById("name");
		var email = document.getElementById("email");
		var company = document.getElementById("company");
		var web = document.getElementById("website");
		var msg = document.getElementById("message");
		var errors = "";
		  if(name.value == ""){ 
		  	name.className = 'error';
		  return false;}    
		  else if(email.value == ""){
		  email.className = 'error';
		  return false;}
		    else if(checkmail(email.value)==false){
		        alert('Please provide a valid email address.');
		        return false;}
		    else if(company.value == ""){
		        company.className = 'error';
		        return false;}
		   else if(web.value == ""){
		        web.className = 'error';
		        return false;}
		   else if(msg.value == ""){
		        msg.className = 'error';
		        return false;}
		   else 
		  {
    	$.ajax({
			type: "POST",
			url: "submit.php",
			data: $("#contact_form").serialize(),
			success: function(msg){
			//alert(msg);
            if(msg){
                $('#contact_form').fadeOut(1000);
                $('#contact_message').fadeIn(1000);
                document.getElementById("contact_message");
            return true;
        }}
    });
}};
/*-----------------------------------------------------------------------------------*/
/*    Feature Slider
/*-----------------------------------------------------------------------------------*/
$('.prot-slide').owlCarousel({
    loop:true,
	autoPlay:6000, //Set AutoPlay to 6 seconds 
    items:3,
    margin:30,	
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsiveClass:true,
	loop:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
		960:{
            items:2,
            nav:false
        },
        1400:{
            items:3,
            nav:true,
            loop:false
        }}
});
/*-----------------------------------------------------------------------------------*/
/*    Parthner Slider
/*-----------------------------------------------------------------------------------*/
$('.parthner-slide').owlCarousel({
    loop:true,
	autoPlay:6000, //Set AutoPlay to 6 seconds 
    items:5,
    margin:30,	
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsiveClass:true,
	loop:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }}
});

/*-----------------------------------------------------------------------------------*/
/*    TEXTI SLIDER
/*-----------------------------------------------------------------------------------*/
$('.testi-slide').owlCarousel({
    loop:true,
	autoPlay:6000, //Set AutoPlay to 6 seconds 
    items:1,
    margin:10,	
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsiveClass:true,
	loop:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false
        }}
});

/*----------------------------------------------------
flex-slider
----------------------------------------------------*/
$(window).load(function() {
  // The slider being synced must be initialized first
  if( $('#carousel').length ) {
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 138,
    itemMargin: 0,
    asNavFor: '#slider'
  });
  }
  if( $('#slider').length ) {
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
  }
});


$(function() {
	$("#_print_this").on('click', function() {
		console.log('in');
		//Print ele2 with default options
		$.print('.print');
	});

});

/* ==========================================================================
   When document is ready, do
   ========================================================================== */
   
$(document).ready(function() {

	$('ul.social_icons > li > a[data-color]').hover(function(e){
		$(this).css('background-color', $(this).data('color') );
	},
	function(e){
		$(this).css('background-color', 'transparent' );
	});		   

   	$('#contact_form').submit(function(){

   		var action = $(this).attr('action');

   		$("#message").slideUp(750,function() {
   			$('#message').hide();

   			$('button#submit').attr('disabled','disabled');
   			$('img.loader').css('visibility', 'visible');

   			$.post(action, {
   				contact_name: $('#contact_name').val(),
   				contact_email: $('#contact_email').val(),
   				contact_company: $('#contact_company').val(),
   				contact_subject: $('#contact_subject').val(),
   				receiver_email: $('#receiver_email').val(),
   				contact_message: $('#contact_message').val(),
   				verify: $('#verify').val()
   			},
   			function(data){
   				document.getElementById('message').innerHTML = data;
   				$('#message').slideDown('slow');
   				$('#contact_form img.loader').css('visibility', 'hidden' );

   				$('#submit').removeAttr('disabled');
   				if(data.match('success') != null) $('#contact_form').slideUp('slow');

   			}
   			);

   		});

   		return false;

   	});


});
/*-----------------------------
	Likelist
	-----------------------------*/

(function($){
	var wow_themes = {			
			count: 0,
			tweets: function( options, selector ){
				
				options.action = '_sh_ajax_callback';
				options.subaction = 'tweets';

				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data:options,
					//dataType:"json",
					success: function(res){
						
						$(selector).html( res );	
					}
				});
				
			},
			wishlist: function(options, selector)
			{
				options.action = '_sh_ajax_callback';
				
				if( $(selector).data('_sh_add_to_wishlist') === true ){
					wow_themes.msg( 'You have already done this job', 'error' );
					return;
				}
				
				$(selector).data('_sh_add_to_wishlist', true );
				wow_themes.loading(true);
				
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data:options,
					dataType:"json",
					success: function(res){
						try{
							var newjason = res;
							if( newjason.code === 'fail'){
								$(selector).data('_sh_add_to_wishlist', false );
								wow_themes.loading(false);
								wow_themes.msg( newjason.msg, 'error' );
							}else if( newjason.code === 'exists'){
								$(selector).data('_sh_add_to_wishlist', true );
								wow_themes.loading(false);
								wow_themes.msg( newjason.msg, 'error' );
							}else if( newjason.code === 'success' ){
								wow_themes.loading(false);
								$(selector).data('_sh_add_to_wishlist', true );
								$(selector).children('span').text(newjason.value);
								wow_themes.msg( newjason.msg, 'success' );
							}else if( newjason.code === 'del' ){
								wow_themes.loading(false);
								$(selector).data('_sh_add_to_wishlist', true );
								$(selector).parents('tbody').remove();
								wow_themes.msg( newjason.msg, 'success' );
							}
							
							
						}
						catch(e){
							wow_themes.loading(false);
							$(selector).data('_sh_add_to_wishlist', false );
							wow_themes.msg( 'There was an error while adding product to whishlist '+e.message, 'error' );
							
						}
					}
				});
			},
			loading: function( show ){
				if( $('.ajax-loading' ).length === 0 ) {
					$('body').append('<div class="ajax-loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i></div>');
				}
				
				if( show === true ){
					$('.ajax-loading').show('slow');
				}
				if( show === false ){
					$('.ajax-loading').hide('slow');
				}
			},
			
			msg: function( msg, type ){
				if( $('#pop' ).length === 0 ) {
					$('body').append('<div style="display: none;" id="pop"><div class="pop"><div class="alert"><p></p></div></div></div>');
				}
				if( type === 'error' ) {
					type = 'danger';
				}
				var alert_type = 'alert-' + type;
				
				$('#pop > .pop p').html( msg );
				$('#pop > .pop > .alert').addClass(alert_type);
				
				$('#pop').slideDown('slow').delay(5000).fadeOut('slow', function(){
					$('#pop .pop .alert').removeClass(alert_type);
				});
				
				
			},
			
	};
	
	$.fn.tweets = function( options ){
		
		var settings = {
				screen_name	:	'wordpress',
				count		:	3,
				template	:	'blockquote'
			};
			
			options = $.extend( settings, options );
			
			wow_themes.tweets( options, this );
			
			
	};

	$('.add_to_likelist, ._like_it').click(function(e) {

		e.preventDefault();
				
		var opt = {subaction:'like_it', data_id:$(this).attr('data-id')};
		wow_themes.wishlist( opt, this );
	
		
	});/**wishlist end*/	

	$('.add_to_wishlist, a[rel="product_del_wishlist"]').click(function(e) {
		e.preventDefault();
		
		if( $(this).attr('rel') === 'product_del_wishlist' ){
			if( confirm( 'Are you sure! you want to delete it' ) ){
				var opt = {subaction:'wishlist_del', data_id:$(this).attr('data-id')};
				wow_themes.wishlist( opt, this );
			}
		}else{
			var opt = {subaction:'wishlist', data_id:$(this).attr('data-id')};
			wow_themes.wishlist( opt, this );
		}
		
	});/**wishlist end*/

})(jQuery);
