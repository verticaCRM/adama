<div class="blog-box clearfix">
    <div class="blog-title">
        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
    </div><!-- end blog-title -->
    <div class="meta">
        <span><a href="#" title=""><?php echo get_the_date( 'F j, Y g:i a' ); ?></a></span>
        <span><a href="<?php the_permalink(); ?>#comments" title=""><?php comments_number(); ?></a></span>
        <span><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>" title="<?php the_author_meta( 'display_name' ); ?>"><?php esc_html_e('by : ' , SH_NAME); ?><?php the_author(); ?></a></span>
        <span><?php esc_html_e('in : ' , SH_NAME); ?><?php the_category(', '); ?></span>
        <span><a href="#" title=""><i class="icon-heart-empty"></i> 123 Likes </a></span>
        <span><a href="#" title=""><i class="icon-print"></i> Print </a></span>
    </div><!-- end meta -->
    <div class="blog-img hovereffect">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('600x280', array('class'=>'img-responsive'));?></a>
    </div><!-- end icon -->
    <div class="desc">
        <p> <?php the_excerpt(); ?> </p>
        <a href="<?php the_permalink(); ?>" class="readmore" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Read More' , SH_NAME); ?><i class="icon-angle-double-right"></i></a>
    </div><!-- end desc -->
</div><!-- end blog-wrap -->                   
