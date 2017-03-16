<?php
/*
Template Name: Broker Search
*/

//ini_set('display_errors','on');
//error_reporting(E_ALL);

global $wp_query,$url;

//die;
if(is_user_logged_in()){
//...only if logged in?...
$userdata = get_userdata(get_current_user_id());
}

get_header();
?>
<section id="content" class="container" style="margin-top:20px">
   <div class="portfolio_group">
		<div id="business_container" class="article-page" style="">


<h1 class="article-page-head"><?php echo get_the_title();?></h1>
<?php

////////////////////
the_content();
 
$json = x2apicall(array('_class'=>'Brokers/?_order=-c_position'));
$brokers =json_decode($json);

if($brokers){
	echo "<div style='display:inline-block'>"; //this is so the page doesn't scroll endlessly.
//////////////////

$altcss = "#dddddd";
foreach ($brokers AS $broker){ //The l

	if("Active" == $broker->c_status){
		$phone_mobile = $broker->c_mobile;
		$phone_office = $broker->c_office;
		$broker_email = $broker->c_email;
        $broker_description = $broker->description;
		$broker_position = $broker->c_position;		
		$altcss = ($altcss == "#dddddd")?"#dddddd":"#dddddd";
		$altclass = ($altcss == "#dddddd")?"":"";
		$butclass = ($altcss == "")?"altbrokerprofilebutton":"brokerprofilebutton";
?>
<div id="broker-<?php echo $broker->id;?>" class="brokeritem" 
     style="padding:10px;margin-bottom:12px;min-height:230px; width:555px; display:inline-block; vertical-align:top !important; ">

  <div  style="display:inline-block; clear:none;height:auto; width:155px;vertical-align: top; "  >
	<?php
		if($broker->c_profilePicture){
			$json = x2apicall(array('_class'=>'Media/by:fileName='.urlencode($broker->c_profilePicture).".json"));
			$brokerimg =json_decode($json);
			echo '<div style="display:inline-block;width:130px;height:auto;overflow:hidden;margin:22px 10px 10px 1px;"><img src="http://'.$apiserver.'/uploads/media/'.$brokerimg->uploadedBy.'/'.$brokerimg->fileName.'" style="width:100%"  style="clear:both" /></div>';	
		}else{

		//print_r($broker);

		echo '<div style="display:inline-block; width:130px;height:auto;overflow:hidden;margin:22px 10px 10px 1px;"><img src="http://'.$apiserver.'/uploads/media/marc/broker-'.$broker->c_gender.'.png" style="width:100%"  /></div>';
	
	}
?>

 <div class="theme-color1-dk" style="display:block;margin-top:7px;" > 
      <i class="fa fa-phone-square"></i> &nbsp;<? _e('','bbcrm');?> <?php echo $phone_office; ?><br>
      <i class="fa fa-mobile-phone"></i> &nbsp;<? _e('','bbcrm');?> <?php echo $phone_mobile; ?><br>
	  <a class="theme-color1-dk"  style="text-decoration:none;" href="mailto:<?php echo $broker_email; ?>"><i style="padding-right:7px;" class="fa fa-envelope-o"></i> Email</a> </br>
	</div>
  </div>		  
		  
		  
		  <div  class="" style="display:inline-block;width:350px;" >
					<div class="theme-color1-dk property_detail"><h3><label><? _e('','bbcrm');?></label><?php echo $broker->name; ?></h3></div>
					<div class="theme-color1-dk theme-border1-dk"  style="border: 1px solid ;padding: 5px;border-radius: 3px;width: 130px;text-align: center;margin-bottom: 6px;"> <? _e('','bbcrm');?> <?php echo $broker_position; ?><br></div>
					<div style="height:102px; position:relative; width:90%; overflow:hidden;">
					<? _e('','bbcrm');?> <?php echo $broker_description; ?>
					
					<div style="position:absolute;z-index:200;bottom:0; width:100%;height:240px;background: -moz-linear-gradient(top,rgba(255,255,255,0) 0%, rgba(255,255,255,0) 80%, rgba(255,255,255,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,rgba(255,255,255,0) 0%,rgba(255,255,255,0) 80%,rgba(255,255,255,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,rgba(255,255,255,0) 0%,rgba(255,255,255,0) 80%,rgba(255,255,255,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#ffffff ',GradientType=0 );">
             </div>
		
					
		             
					</div>
		       <form method=POST action="<?php echo get_permalink($bbcrm_option["bbcrm_pageselect_broker"]);?>">
		              <input type=hidden name=eid value="<?php echo $broker->nameId; ?>">
		              <input class="theme-color2-lt theme-background1-dk theme-border2-lt <?php echo $butclass; ?>" style="padding: 8px 12px; width: 40%;" type=submit value="Read Full Bio">
                </form>	    
</div>		            
		
</div>
	
<!--portfolioitem-->
<?php 
		} //end if active
	}
}

echo do_shortcode('[featuredsearch]');

?>

</div>
</div>

</section><!-- #primary .widget-area -->

<?php
get_footer();
?>
?>
