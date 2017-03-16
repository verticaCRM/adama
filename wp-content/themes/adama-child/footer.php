<?php
$options = _WSH()->option();
//print_r($options);
$bg = sh_set( $options, 'footer_bg' );
?>

<!--======= FOOTER =========-->
<footer class="theme-color1-dk" <?php if($bg):?>style="background-image: url('<?php echo esc_url($bg); ?>');"<?php endif;?>>
  
  <div class="container"> 

    <!--======= NEWSLETTER =========-->
    <?php if(sh_set($options, 'footer_top')):?>

      <?php dynamic_sidebar('footer-top-sidebar'); ?>

    <?php endif;?>
    <?php if(sh_set($options, 'footer_middle')):?>

      <ul class="row">

       <?php dynamic_sidebar('footer-sidebar'); ?>

     </ul>

   <?php endif;?>

  </div>

</footer>

<!--======= RIGHTS =========-->
<?php if(sh_set($options, 'footer_bottom')):?>
	
  <div class="rights">
    <div class="container">
      <p class="font-montserrat"><?php echo balanceTags(sh_set($options, 'copy_right'));?></p>
    </div>
  </div>
  
<?php endif;?>

</div>

<?php wp_footer(); ?>

</body>

</html>
