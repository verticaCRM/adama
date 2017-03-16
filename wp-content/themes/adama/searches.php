<?php $settings = get_option( SH_NAME.'_theme_options' );?>

<?php if( have_posts() ):
	while(have_posts()): the_post(); ?>

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
		     <div class="pull-right margin-t-20"> <span><i class="fa fa-comment-o"></i><?php comments_number();?></span> | <span><i class="fa fa-heart-o"></i> 26 Likes </span> | <span><i class="fa fa-eye"></i> 30 Viewers </span> </div>
		    
		    </div>
		    <p><?php echo get_the_excerpt();?></p>
		</li>

	<?php endwhile; 

else: ?>

	<li class="blog_post" style="border: none;">
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SH_NAME ); ?></p>
		<aside>
			<?php get_search_form(); ?>
		</aside>
	</li>

<?php endif; ?>