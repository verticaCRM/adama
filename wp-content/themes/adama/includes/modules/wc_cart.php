

<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
					<li>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="image">
                                    	<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				
											if ( ! $_product->is_visible() )
												echo balanceTags($thumbnail);
											else
												printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
										?>
                                    </td>
                                    <td class="name">
                                    <?php
										if ( ! $_product->is_visible() )
											echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
										else
											echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );?>
									</td>
                                    <td class="remove">
										<?php
                                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><i class="icon-cancel-1"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
				
		<?php }
        		}?>
                <table>
                    <tbody>
                        <tr>
                            <td><b><?php esc_html_e('Sub-Total:', SH_NAME);?></b></td>
                            <td>
                                <?php
                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php esc_html_e('Total:', SH_NAME);?></b></td>
                            <td><?php echo WC()->cart->get_cart_total(); ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php $cart_page = get_option( 'woocommerce_cart_page_id' );?>
                <?php if( $cart_page ): ?>
                	<a class="btn btn-block btn-primary btn-sm" href="<?php echo get_permalink( $cart_page ); ?>" title="<?php echo get_the_title( $cart_page ); ?>"><?php esc_html_e('CHECKOUT', SH_NAME); ?></a>				
                <?php endif; ?>
                </li>
<?php return ;?>
