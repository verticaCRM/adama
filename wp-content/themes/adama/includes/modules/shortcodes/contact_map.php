<?php  
   ob_start() ;?>

<!--======= MAP =========-->
<div id="map"></div>


<script src="<?php echo get_template_directory_uri(); ?>/js/mapmarker.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="application/javascript">
// Use below link if you want to get latitude & longitude
// http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude.php 
jQuery(document).ready(function($){
//set up markers 
var myMarkers = {"markers": [{
		
	"latitude": "<?php echo esc_js($lat);?>",
	"longitude":"<?php echo esc_js($long);?>",
	
	"icon": "<?php echo get_template_directory_uri();?>/images/map-locator.png", 
	"baloon_text": '<?php echo esc_js($mark_address);?>'
}]};
	
//set up map options
jQuery("#map").mapmarker({
  zoom  : 17,
  scrollwheel: false,
  navigationControl: false,
	mapTypeControl: false,
	scaleControl: false,
	draggable: false,
  center  : '<?php echo esc_js($mark_address);?>',
  markers : myMarkers
  });
});
</script>

<?php return ob_get_clean();