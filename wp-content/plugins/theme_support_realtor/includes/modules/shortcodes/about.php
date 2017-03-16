<?php //$Img_ids = explode(',' , $images); 
//$col_md = ( $img ) ? 'col-ld-6 col-md-6 col-sm-6 ' : 'col-ld-12 col-md-12 col-sm-12 ';
ob_start() ;?>


    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview text-center clearfix">
                <small><?php echo $author;?></small>
                <a title="" href="<?php echo $title_link;?>">
                    <h2 class="post-title"><?php echo urldecode( base64_decode( $title ));?></h2>
                </a>
                <p class="post-meta"><?php echo urldecode( base64_decode( $tagline ));?></p>

                <?php if( $img ): ?>
                    <div class="media-element entry">
                        <img src="<?php echo esc_url( $img ); ?>" class="img-responsive" alt="<?php echo esc_attr(urldecode( base64_decode( $title )));?>">

                        <div class="magnifier purple"></div>
                    </div><!-- end media -->
				<?php endif;?>
                
                <div class="desc">
                    <?php echo urldecode( base64_decode( $content ));;?>
                </div><!-- end desc -->
            </div><!-- end post-preview -->
        </div><!-- end col-lg-8 -->
    </div><!-- end row -->

<?php return ob_get_clean();


