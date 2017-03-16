<?php 
	$count = 0; 
   $query_args = array('post_type' => 'sh_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['team_category'] = $cat;
   $query = new WP_Query($query_args) ;
   $settings  = _WSH()->option();
   $top_heading_img= get_template_directory_uri()."/images/head-top.png";
   $top_heading_img = sh_set( $settings, 'top_heading_img' ) ? sh_set( $settings, 'top_heading_img' ) : $top_heading_img;
   ob_start() ;?>
<?php if($query->have_posts()): ?> 

<!--======= TEAM =========-->
<div class="team-section">

	<div class="container"> 
	  <!--======= TITTLE =========-->
	  <div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
		<h3><?php echo balanceTags($title);?></h3>
		<p><?php echo balanceTags($text);?></p>
	  </div>

	  <div class="row">
		
		  <!--======= TEAM ROW =========-->
		  <ul class="row">
			
			<?php  while($query->have_posts()): $query->the_post();
				   global $post ; 
				   $meta = _WSH()->get_meta() ; 
			?>
			
			<!--======= TEAM =========-->
			<li class="col-md-3 col-sm-4 col-xs-6">
			  <div class="team"> 
			  <?php the_post_thumbnail('270x288', array('class' => 'img-responsive'));?>	
			  <div class="team-over"> 
				  <!--======= SOCIAL ICON =========-->
				  <?php if($socials = sh_set($meta, 'sh_team_social')): //printr($socials);?>
				  <ul class="social_icons animated-6s fadeInUp">
					<?php foreach($socials as $key => $social):?>
					<li class="facebook"><a href="<?php echo sh_set($social, 'social_link');?>"><i class="fa <?php echo sh_set($social, 'social_icon');?>"></i></a></li>
					<?php endforeach;?>
				  </ul>
				  <?php endif;?>
				</div>
				
				<!--======= TEAM DETAILS =========-->
				<div class="team-detail">
				  <h6><?php the_title();?></h6>
				  <p><?php echo sh_set($meta, 'designation');?></p>
				</div>
			  </div>
			</li>
			
			<?php $count++; endwhile;?>
			
		  </ul>
		
	  </div>
	</div>
</div>

<?php endif;?>

<?php wp_reset_postdata();
return ob_get_clean();