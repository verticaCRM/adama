<?php
$count = 1;  
ob_start() ;
$options = _WSH()->option();
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $options, 'top_heading_img' ) ? sh_set( $options, 'top_heading_img' ) : $top_heading_img;
?>
<!--======= PARTHNER =========-->
<section class="parthner">
  <div class="container"> 
    <!--======= TITTLE =========-->
    <div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
      <h3><?php echo balanceTags($title);?></h3>
      <p><?php echo balanceTags($text);?></p>
    </div>

    <!--======= PARTHNERS =========-->
    <?php if($clients = sh_set(sh_set($options, 'brand_or_client'), 'brand_or_client')):?>

      <div class="parthner-slide">
        
        <?php foreach($clients as $key => $value):?>
          
          <?php if(sh_set($value, 'tocopy') || $count > $num) continue;?>
          <div class="part"> <a href="<?php echo esc_url(sh_set($value, 'client_link'));?>"> <img src="<?php echo sh_set($value, 'brand_img');?>" alt="" > </a> </div>
          <?php $count++; 
        
        endforeach;?>
      
    </div>

    <?php endif;?>
  </div>
</section>

<?php  return ob_get_clean();