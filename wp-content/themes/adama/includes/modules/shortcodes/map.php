<?php  
$count = 1; 
$query_args = array('post_type' => 'sh_property' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['property_category'] = $cat;
$query = new WP_Query($query_args) ; 
    // print_r($query);
$markers = '';
$property_icon = '';
$data_posts = '';
?>
<?php if( $query->have_posts() ):?>


    <?php while($query->have_posts()): $query->the_post();
    global $post ;
    $property_meta = _WSH()->get_meta();

    $markers[] = array(sh_set($property_meta, 'address'), sh_set($property_meta, 'lat'), sh_set($property_meta, 'long') ); 

    if(sh_set($property_meta, 'property_type') == 'plaza') $icon = '/images/google-map/marker2-1.png'; elseif(sh_set($property_meta, 'property_type') == 'house') $icon = '/images/google-map/marker1-1.png'; else $icon = '/images/google-map/marker2-2.png';

    $property_icon[] = array(get_template_directory_uri().$icon);?>

    <?php ob_start() ;?>

    <div class="info_content">
      <div class="row m0 imageRow">
         <?php the_post_thumbnail('370x260', array('class' => 'img-responsive'));?>
     </div>
     <div class="row m0 description">
       <h6 class="location"><?php the_title();?></h6>
       <p><i class="fa fa-map-marker"></i><?php echo sh_set($property_meta, 'address');?></p>
       <span class="price-bg  font-montserrat"><?php echo sh_set($property_meta, 'price');?></span>
       <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('more details', SH_NAME);?></a>
   </div>        
</div>
<?php $data_posts[] = array(ob_get_clean()); ?>


<?php endwhile;?>
<?php 
endif;
ob_start();
?>

<!--======= BANNER =========-->
<div id="banner">

    <div id="homeMap"></div>


</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;signed_in=true"></script>
<script type="application/javascript">
// Google Map For Home
(function($) {
    "use strict";

    function init() {    
        var map;    
        var marker;
        var i;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {

            zoom: 0,
            center: new google.maps.LatLng(<?php echo esc_js($lat);?>,<?php echo esc_js($long);?>),
            panControl: false,
            panControlOptions:{
                position: google.maps.ControlPosition.BOTTOM_LEFT
            },
            zoomControl:true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_BOTTOM
            },
            disableDoubleClickZoom: true,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DEFAULT,
            },
            scaleControl: true,
            scrollwheel: false,
            streetViewControl: true,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.RIGHT_BOTTOM
            },
            draggable : true,
            overviewMapControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [ 
            { featureType: "administrative", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -100 }, { lightness: 20 } ] },
            { featureType: "road", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -100 }, { lightness: 40 } ] },
            { featureType: "water", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -10 }, { lightness: 30 } ] },
            { featureType: "landscape.man_made", elementType: "all", stylers: [ { visibility: "simplified" }, { saturation: -60 }, { lightness: 10 } ] },
            { featureType: "landscape.natural", elementType: "all", stylers: [ { visibility: "simplified" }, { saturation: -60 }, { lightness: 60 } ] },
            { featureType: "poi", elementType: "all", stylers: [ { visibility: "off" }, { saturation: -100 }, { lightness: 60 } ] }, 
            { featureType: "transit", elementType: "all", stylers: [ { visibility: "off" }, { saturation: -100 }, { lightness: 60 } ] }
            ]

        }

        map = new google.maps.Map(document.getElementById('homeMap'), mapOptions);
        map.setTilt(45);

    // Multiple Markers
    var markers = <?php echo json_encode( $markers );?>;

    var image = <?php echo str_replace('\\', '', (json_encode( $property_icon )) );?>;
    
    // Info Window Content
    var infoWindowContent = <?php echo json_encode($data_posts);?>;
    
    // Display multiple markers on a map    
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    

    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

        bounds.extend(position);

        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: image[i][0],
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(map, 'click', (function(marker, i) {
            return function() {
                infoWindow.close(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }
    
    

    google.maps.event.addListener(infoWindow, 'domready', function() {

        // Reference to the DIV that wraps the bottom of infowindow
        var iwOuter = $('.gm-style-iw');

        var iwBackground = iwOuter.prev();
        // Removes background shadow DIV
        iwBackground.children(':nth-child(1)').css({'display' : 'none'});

        // Removes white background DIV
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});
        
        // Removes background shadow DIV
        iwBackground.children(':nth-child(3)').css({'display' : 'none'});

        // Removes white background DIV
        iwBackground.children(':nth-child(4)').css({'display' : 'none'});

        // Moves the infowindow 115px to the right.
        iwOuter.parent().parent().css({left: '22px',top: '27px'});
        
        // Moves the shadow of the arrow 76px to the left margin.
        iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

        // Moves the arrow 76px to the left margin.
        iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

        // Changes the desired tail shadow color.
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

        // Reference to the div that groups the close button elements.
        var iwCloseBtn = iwOuter.next();

        // Apply the desired effect to the close button
        iwCloseBtn.css({opacity: '0', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
        
    });
}
google.maps.event.addDomListener(window, 'load', init)

})(jQuery);
</script>

<?php return ob_get_clean();