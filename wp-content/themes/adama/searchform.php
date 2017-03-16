<form action="<?php echo home_url(); ?>" method="get" class="searchForm m0">

	<div class="input-group">

		<input type="text" class="form-control" name="s" placeholder="<?php esc_html_e('Search',  SH_NAME); ?>" value="<?php echo get_search_query(); ?>">

		<span class="input-group-addon p0">

		<button type="submit"><i class="fa fa-search"></i></button>

		</span> 
	
	</div>

</form>