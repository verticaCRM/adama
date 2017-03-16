<?php $settings = get_option( SH_NAME.'_theme_options' );?>

<!--======= BLOG 1 =========-->
<li id="post-<?php the_ID(); ?>" <?php post_class('col-sm-12 blog_post');?>>
    <div class="b-inner"> 
      
      <?php if( has_post_thumbnail()): ?>
        <?php the_post_thumbnail('867x430',array('class'=>'img-responsive'));?>
      <?php else: ?>
        <img src="<?php echo esc_url(get_template_directory_uri().'/images/no-image.png'); ?>">
      <?php endif; ?>
      
      <div class="b-details">
       <div class="bottom-sec"> <span><i class="fa fa-calendar"></i><?php echo get_the_date('M d, Y');?></span> <a class="font-montserrat" href="<?php the_permalink();?>"><?php the_title();?></a> </div>
      </div>

    </div>
    
    <div class="post-admin"> <?php echo get_avatar( get_the_author_meta( 'ID' ), 54 ); ?>
    
      <h6><?php the_author();?></h6>
      
      <div class="pull-right margin-t-20"> 
        <span><i class="fa fa-comment-o"></i><?php comments_number();?></span> | 
        
        <?php $likes = get_post_meta(get_the_id(), '_sh_like_it', true); ?>
        <span>
          <a href="javascript:;" class="_like_it" data-id="<?php the_ID(); ?>">
            <i class="fa fa-heart-o"></i> <?php printf( _n( '%s Like', '%s Likes', 0, SH_NAME ),  (int)$likes ); ?> 
          </a>
        </span>
         | 
        <span><i class="fa fa-eye"></i> <?php printf( _n( '%s View', '%s Views', 0, SH_NAME ),  _WSH()->post_views() ); ?> </span> 

      </div>
    
    </div>
    <?php the_excerpt();?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(array('before'=>esc_html__('Read more about '))); ?>" class="btn"><?php esc_html_e('Read More', SH_NAME); ?></a>
</li>
