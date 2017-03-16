<?php
/*
Template Name: Broker Search
*/

//ini_set('display_errors','on');
//error_reporting(E_ALL);

global $wp_query,$url;
//echo get_locale();
//die;
if(is_user_logged_in()){
//...only if logged in?...
$userdata = get_userdata(get_current_user_id());
}

get_header();
?>
<section id="content" class="container" style="margin-top:20px">
 
	<div class="portfolio_group">
		<div id="business_container" class="article-page" style="display:inline-block;width:100%">


<h1 class="article-page-head"><?php echo get_the_title();?></h1>
<?php

////////////////////
 echo get_the_content();
 
$json = x2apicall(array('_class'=>'Brokers/'));
$brokers =json_decode($json);

if($brokers){
	echo "<div style='display:inline-block;width:100%'>"; //this is so the page doesn't scroll endlessly.
//////////////////

$altcss = "#dddddd";
foreach ($brokers AS $broker){ //The l

	if("Active" == $broker->c_status){
		$phone_mobile = $broker->c_mobile;
		$phone_office = $broker->c_office;		
		$altcss = ($altcss == "#dddddd")?"#dddddd":"#dddddd";
		$altclass = ($altcss == "#dddddd")?"":"";
		$butclass = ($altcss == "")?"altbrokerprofilebutton":"brokerprofilebutton";
?>
<div id="broker-<?php echo $broker->id;?>" class="brokeritem" style="padding:10px;margin-bottom:12px;min-height:230px; width:75%; display:inline-block; ">
 <div class="row">
  <div class="col-md-4" style="display:inline-block; clear:none;height:auto; width:135px;"  >
	<?php
		if($broker->c_profilePicture){
			$json = x2apicall(array('_class'=>'Media/by:fileName='.$broker->c_profilePicture.".json"));
			$brokerimg =json_decode($json);
			echo '<div style="float:left;width:130px;height:130px;overflow:hidden;margin:10px 10px 10px 1px;"><img src="http://'.$apiserver.'/uploads/media/'.$brokerimg->uploadedBy.'/'.$brokerimg->fileName.'" style="width:100%"  style="clear:both" /></div>';	
		}else{

		//print_r($broker);

		echo '<div style="float:left; width:130px;height:130px;overflow:hidden;margin:10px 10px 10px 1px;"><img src="http://'.$apiserver.'/uploads/media/marc/broker-'.$broker->c_gender.'.png" style="width:100%"  /></div>';
	
	}
?>

    <div  style="display:block;margin-top:7px;" > 
      <i style="color:steelblue"  class="fa fa-phone-square"></i> &nbsp;<? _e('','bbcrm');?></label> <?php echo $phone_office; ?><br>
	  <i style="color:steelblue"  class="fa fa-envelope-o"></i> &nbsp;<? _e('Email','bbcrm');?></label> <?php echo $broker_email; ?></br>
	</div>
  </div>		  
		  
		  
		  <div  class="col-md-8" style="display:inline-block;float:left; clear:none;" >
					<h3><div class="property_detail"><label><? _e('Name','bbcrm');?>:</label> <?php echo $broker->name; ?></div></h3>
					<p><span class="badge outline radius blue">Owner/Business Broker</span></p>
					<p>Don Pippin Jr is the Sunbelt Business Brokers office owner for Lafayette, LA. Don brings an array of experience in both Lafayette-based and out-of-state business ventures, including real estate development and franchise acquisitions. Don has business savvy from extensive marketing&#8230;</p>
		           
		            <form method=POST action="/<?php echo get_locale();?>/agent-profile/">
		              <input type=hidden name=eid value="<?php echo $broker->nameId; ?>">
		              <input style="margin:0 !important;background-color:#1e5da5 !important;padding:8px;" class="<?php echo $butclass;?>" 
		              type=submit value="<?php printf("Read %s's Full bio",$broker->name);?>">
		             </form>
		</div>
	</div>	  
</div>
	
<!--portfolioitem-->
<div style="clear:both"></div>
<?php 
		} //end if active
	}
}
?>
</div>
</div>
<!-- 
<aside id="sidebar" class="" style="vertical-align:top;width:25%" role="complementary">
	<ul>
<?php 
if(is_user_logged_in()){
$userdata = get_userdata(get_current_user_id());
$json = x2apicall(array('_class'=>'Contacts/by:email='.urlencode($userdata->user_email).".json"));
$buyer =json_decode($json);
$json = x2apicall(array('_class'=>'Brokers/by:nameId='.urlencode($buyer->c_broker).".json"));
$buyerbroker =json_decode($json);
$json = x2apicall(array('_class'=>'Media/by:fileName='.$buyerbroker->c_profilePicture.".json"));
$brokerimg =json_decode($json);

if($buyerbroker->name){
?>
<h2><?php _e("Your Broker");?></h2>
<?php
if($brokerimg->fileName){
?>
<img src="<?php echo "http://".$apiserver."/uploads/media/".$brokerimg->uploadedBy."/".$brokerimg->fileName;?>" height=170 />
<?php
}
?>
<h3><?php echo $buyerbroker->name;?></h3>
Cell phone:<?php echo $buyerbroker->c_mobile;?><br>
Office phone:<?php echo $buyerbroker->c_office;?><br>
<?php 
} 
get_sidebar();
} 
 ?>
	</ul>
</aside>
#bc-->

</div>

	</div>
</section><!-- #primary .widget-area -->

<?php
get_footer();
?>
