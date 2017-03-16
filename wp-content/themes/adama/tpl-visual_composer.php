<?php /* Template Name: VC Page */
get_header() ;
$meta = _WSH()->get_meta();
$meta1 = _WSH()->get_meta('_sh_header_settings');
?>
<?php if(sh_set($meta1, 'bread_crumb')):?>
<?php $header_bg_image = sh_set( $meta1, 'bg_image' ) ? ' style=background-image:url('.$meta1['bg_image'].');' : ''; ?>
<!--======= BANNER =========-->
<div class="sub-banner" <?php if($header_bg_image):?>style="background-image: url('<?php echo esc_url($header_bg_image); ?>');"<?php endif;?>>
<div class="overlay">
  <div class="container">
	<h1><?php if(sh_set($meta1, 'header_title')) echo  balanceTags( sh_set($meta1, 'header_title') ); else wp_title('');?></h1>
	<ol class="breadcrumb">
	  <li class="pull-left"><?php if(sh_set($meta1, 'header_title')) echo  balanceTags( sh_set($meta1, 'header_title') ); else wp_title('');?></li>
	  <?php echo get_the_breadcrumb();?>	
	</ol>
  </div>
</div>
</div>

<?php endif;?>
<?php //if( !sh_set( $meta, 'is_home' ) ) get_template_part( 'includes/modules/header/header', 'single' ); ?>
	<?php while( have_posts() ): the_post(); ?>
	     <?php the_content(); ?>
	<?php endwhile;  ?>
<?php get_footer() ; ?>