<p>
	<input type="button" id="toggle_megamenu" name="add-custom-menu-item" value="<?php _e('Show Mega Menu Options', SH_NAME); ?>" class="button-secondary submit-add-to-menu">
</p>

<div id="megamenu_options" style="display:none;width:94%;" class="link-to-original">
   

	
		<p class="option row menu-item-submenu_type<?php echo $item_id; ?> select_type">
			
			<label class="field">
				<span><?php _e('Submenu Type', SH_NAME ); ?></span>
	
			<?php $submenu_type = array('default_dropdown'=>__('Standard Dropdown', SH_NAME),  'sh_menu_widgets_area'=>__('Widgets area', SH_NAME)); 					
			if( $depth == 0 ) $submenu_type['multicolumn_dropdown'] = __('Multicolumn Dropdown', SH_NAME);
			$value = get_post_meta($item_id, '_sh_menu_item_submenu_type', true); ?>		
	
				<select class="select" name="menu_item_submenu_type[<?php echo $item_id; ?>]">
					<?php foreach( $submenu_type as $k => $sub ): 
						
						$selected = ( $value == $k ) ? ' selected="selected"' : '';?>
						<option value="<?php echo esc_attr( $k ); ?>"<?php echo $selected; ?>><?php echo $sub; ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</p>
		
	<?php if( $depth == 0 ): ?>		
		<p class="">
	
			<label for="menu-columns" class="field"><span><?php _e('Columns', SH_NAME); ?>:</span>
				<select id="megamenu_columns" name="_sh_menu_columns[<?php echo $item_id; ?>]">
				<?php
				$columns = range(1, 12,1);
				foreach($columns as $k=>$v){ 
					$selected = (get_post_meta($item_id, '_sh_menu_columns', true) == $v) ? ' selected="selected"' : ''; ?>
						<option value="<?php echo esc_attr( $v ); ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
				<?php } ?>
				</select>
			</label>
		</p>

	<?php endif; ?>

    <p class="">

        <label class="field" for="menu-sidebars"><span><?php _e('Select Sidebar', SH_NAME); ?>:</span>

            <select name="_sh_menu_sidebar[<?php echo $item_id; ?>]">
				<option value="0"><?php _e('No Sidebar', SH_NAME); ?></option>
				<?php foreach($wp_registered_sidebars as $k=>$v):
                    $selected = (get_post_meta($item_id, '_sh_menu_sidebar', true) == $k) ? ' selected="selected"' : '';?>
                    <option value="<?php echo esc_attr( $k ); ?>" <?php echo $selected; ?>><?php echo $v['name']; ?></option>
                <?php endforeach; ?>

            </select>

        </label>

    </p>

    <div class="clear"></div>

</div>