<?php  
   $count = 1; 
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ; 
   ob_start() ;?>
<?php if( $query->have_posts() ):?>

<!--======= CLIENTS FEEDBACK =========-->
<section class="blog">

	<div class="container"> 
	  
		<!--======= TITTLE =========-->
		<div class="tittle">
			<h3><?php echo balanceTags($title);?></h3>
		</div>

		<ul class="row">

		<?php while($query->have_posts()): $query->the_post();

			global $post;
			$post_meta = _WSH()->get_meta(); ?>

			<!--======= BLOG 3 =========-->
			<li class="col-md-4 col-xs-6">
				<div class="b-inner"> 
				  	
				  	<?php the_post_thumbnail('270x288', array('class' => 'img-responsive'));?>	

				  	<div class="b-details">
						<div class="post-admin"> 
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 54 ); ?>
							<h6><?php esc_html_e('By ', SH_NAME); the_author();?></h6>
							<span class="pull-right"><i class="fa fa-comment-o"></i> <?php comments_number( '0', '1', '%' ); ?></span> 
							<?php $likes = get_post_meta(get_the_id(), '_sh_like_it', true); ?>
							<span class="pull-right"><i class="fa fa-heart-o"></i> 
							<?php echo (int)$likes; ?> &nbsp; &nbsp;| &nbsp;&nbsp;</span> 
						</div>
						
						<div class="bottom-sec"> 
						  	<span><i class="fa fa-calendar"></i> <?php echo get_the_date('M d, Y');?></span> 
						  	<a title="<?php the_title_attribute(); ?>" class="font-montserrat" href="<?php the_permalink();?>"><?php the_title();?></a>
							<hr>
							<p><?php echo _sh_trim(get_the_content(), $text_limit);?></p>
						</div>
					</div>
				
				</div>
			</li>

		<?php endwhile;?>

		</ul>
	</div>

</section>

<?php endif;?>		

<?php wp_reset_postdata();
return ob_get_clean();