<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Products extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-products';
    }
	
	public function get_title(){
        return esc_html__( 'TS Products', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'woocommerce-elements' );
    }
	
	public function get_icon(){
		return 'eicon-products';
	}
	
	protected function register_controls(){
		$this->start_controls_section(
            'section_general'
            ,array(
                'label' 	=> esc_html__( 'General', 'themesky' )
                ,'tab'   	=> Controls_Manager::TAB_CONTENT
            )
        );
		
		$this->add_title_and_style_controls();
		
		$this->add_title_alignment_controls( true );
		
		$this->add_control(
            'style'
            ,array(
                'label' 		=> esc_html__( 'Title Style', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'default'
				,'options'		=> array(
									'default' 					=> esc_html__('Default', 'themesky')
									,'title-inside-content' 	=> esc_html__('Inside Content', 'themesky')
								)		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'title_width'
            ,array(
                'label'     	=> esc_html__( 'Title Width (%)', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 100
				,'min'      	=> 1
				,'max'      	=> 100
				,'description' 	=> esc_html__( 'Not available in tablet & mobile', 'themesky' )
				,'selectors' 	=> array(
					'{{WRAPPER}} .style-title-inside-content .shortcode-title' => 'width: {{SIZE}}%;'
				)
            )
        );
		
		$this->add_control(
            'product_type'
            ,array(
                'label' 		=> esc_html__( 'Product type', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'recent'
				,'options'		=> array(
									'recent' 		=> esc_html__('Recent', 'themesky')
									,'sale' 		=> esc_html__('Sale', 'themesky')
									,'featured' 	=> esc_html__('Featured', 'themesky')
									,'best_selling' => esc_html__('Best Selling', 'themesky')
									,'top_rated' 	=> esc_html__('Top Rated', 'themesky')
									,'mixed_order' 	=> esc_html__('Mixed Order', 'themesky')
								)		
                ,'description' 	=> esc_html__( 'Select type of product', 'themesky' )
            )
        );

		$this->add_control(
            'columns'
            ,array(
                'label'     	=> esc_html__( 'Columns', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 4
				,'min'      	=> 1
            )
        );
		
		$this->add_control(
            'limit'
            ,array(
                'label'     	=> esc_html__( 'Limit', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 4
				,'min'      	=> 1
				,'description' 	=> esc_html__( 'Number of Products', 'themesky' )
            )
        );
		
		$this->add_control(
            'product_cats'
            ,array(
                'label' 		=> esc_html__( 'Product categories', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'product_cat'
				)
				,'multiple' 	=> true
				,'sortable' 	=> false
				,'label_block' 	=> true
            )
        );
		
		$this->add_control(
            'ids'
            ,array(
                'label' 		=> esc_html__( 'Specific products', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'post'
					,'name'		=> 'product'
				)
				,'multiple' 	=> true
				,'label_block' 	=> true
            )
        );
		
		$this->add_product_meta_controls();
		
		$this->add_product_color_swatch_controls();

		$this->add_control(
            'show_shop_more_button'
            ,array(
                'label' 		=> esc_html__( 'Show shop more button', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )	
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
			'shop_more_button_link'
			,array(	
				'label'		 		=> esc_html__( 'Shop more button link', 'themesky' )
				,'type'				=> Controls_Manager::URL
				,'default'			=> array( 'url'	=> '', 'is_external' => true, 'nofollow' => true )
				,'show_external' 	=> true
				,'condition'		=> array( 'show_shop_more_button' => '1' )
			)
		);
		
		$this->add_control(
            'shop_more_button_text'
            ,array(
                'label' 		=> esc_html__( 'Shop more button label', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> 'See All'		
                ,'description' 	=> ''
				,'condition'	=> array( 'show_shop_more_button' => '1' )
            )
        );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_slider'
            ,array(
                'label' 	=> esc_html__( 'Slider', 'themesky' )
                ,'tab'   	=> Controls_Manager::TAB_CONTENT
            )
        );
		
		$this->add_product_slider_controls(true, true);
		
		$this->add_control(
            'disable_slider_responsive'
            ,array(
                'label' 		=> esc_html__( 'Disable slider responsive', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )	
                ,'description' 	=> esc_html__( 'You should only enable this option when Columns is 1 or 2', 'themesky' )
            )
        );

		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'title'							=> ''
			,'title_alignment' 				=> ''
			,'style' 						=> 'default'
			,'product_type'					=> 'recent'
			,'columns' 						=> 4
			,'limit' 						=> 4
			,'product_cats'					=> array()
			,'ids'							=> array()
			,'show_image' 					=> 1
			,'show_title' 					=> 1
			,'show_sku' 					=> 0
			,'show_price' 					=> 1
			,'show_short_desc'  			=> 0
			,'show_rating' 					=> 1
			,'show_label' 					=> 1	
			,'show_categories'				=> 0
			,'show_brands'					=> 0
			,'show_add_to_cart' 			=> 1
			,'show_color_swatch'			=> 0
			,'number_color_swatch'			=> 3
			,'show_shop_more_button'		=> 0
			,'shop_more_button_link'		=> array( 'url' => '', 'is_external' => true, 'nofollow' => true )
			,'shop_more_button_text' 		=> 'See all'
			,'is_slider'					=> 0
			,'only_slider_mobile'			=> 0
			,'rows' 						=> 1
			,'show_nav'						=> 1
			,'auto_play'					=> 0
			,'disable_slider_responsive'	=> 0
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		if( $only_slider_mobile && !wp_is_mobile() ){
			$is_slider = false;
		}
		
		$options = array(
				'show_image'			=> $show_image
				,'show_label'			=> $show_label
				,'show_title'			=> $show_title
				,'show_sku'				=> $show_sku
				,'show_price'			=> $show_price
				,'show_short_desc'		=> $show_short_desc
				,'show_categories'		=> $show_categories
				,'show_brands'			=> $show_brands
				,'show_rating'			=> $show_rating
				,'show_add_to_cart'		=> $show_add_to_cart
				,'show_color_swatch'	=> $show_color_swatch
				,'number_color_swatch'	=> $number_color_swatch
			);
		ts_remove_product_hooks( $options );
		
		$args = array(
			'post_type'				=> 'product'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> $limit
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
			,'meta_query' 			=> WC()->query->get_meta_query()
			,'tax_query'           	=> WC()->query->get_tax_query()
		);
		
		ts_filter_product_by_product_type($args, $product_type);

		if( is_array($product_cats) && count($product_cats) > 0 ){
			$args['tax_query'][] = array(
										'taxonomy' 	=> 'product_cat'
										,'terms' 	=> $product_cats
										,'field' 	=> 'term_id'
									);
		}
		
		if( is_array($ids) && count($ids) > 0 ){
			$args['post__in'] = $ids;
			$args['orderby'] = 'post__in';
		}

		$link_attr = $this->generate_link_attributes( $shop_more_button_link );
		
		global $post;
		if( (int)$columns <= 0 ){
			$columns = 5;
		}
		
		$old_woocommerce_loop_columns = wc_get_loop_prop('columns');
		wc_set_loop_prop('columns', $columns);

		$products = new WP_Query( $args );
		
		$heading_html = '';
		if( $title ){
			$heading_html .= '<h2 class="shortcode-title">'. esc_html( $title ) .'</h2>';
		}
		if( $show_shop_more_button ){
			$heading_html .= '<div class="shop-more hidden-phone"><a class="shop-more-button" '. implode( ' ', $link_attr ) .'>'. esc_html($shop_more_button_text). '</a></div>';
		}
		if( $heading_html ){
			$heading_html = '<header class="shortcode-heading-wrapper">' . $heading_html . '</header>';
		}
		else{
			$style = 'default';
		}
		
		$classes = array();
		$classes[] = 'ts-product-wrapper ts-shortcode ts-product woocommerce';
		$classes[] = 'columns-' . $columns;
		$classes[] = $product_type;
		$classes[] = 'style-' . $style;
		
		if( $show_color_swatch ){
			$classes[] = 'show-color-swatch';
		}
		
		if( $is_slider ){
			$classes[] = 'ts-slider';
			$classes[] = 'rows-' . $rows;
			if( $show_nav ){
				$classes[] = 'show-nav';
			}
		}
		
		$data_attr = array();
		if( $is_slider ){
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-autoplay="'.$auto_play.'"';
			$data_attr[] = 'data-columns="'.$columns.'"';
			$data_attr[] = 'data-disable_responsive="'.$disable_slider_responsive.'"';
		}

		if( $products->have_posts() ): 
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr) ?>>
		
			<?php 
			if( $style != 'title-inside-content' || $is_slider ){
				echo $heading_html;
			}
			?>
			<div class="content-wrapper <?php echo ($is_slider)?'loading':'' ?>">
			
				<?php
				$count = 0;
				woocommerce_product_loop_start();
					if( !$is_slider && $style == 'title-inside-content' ){
						echo $heading_html;
					}
					while( $products->have_posts() ){
						$products->the_post();
						
						if( $is_slider && $rows > 1 && $count % $rows == 0 ){
							echo '<div class="product-group">';
						}
						
						wc_get_template_part( 'content', 'product' );
						
						if( $is_slider && $rows > 1 && ($count % $rows == $rows - 1 || $count == $products->post_count - 1) ){
							echo '</div>';
						}
					
						$count++;
					}
				woocommerce_product_loop_end();
				?>
				
			</div>
			
			<?php if( $show_shop_more_button ): ?>
			<div class="shop-more visible-phone">
				<a class="shop-more-button" <?php echo implode( ' ', $link_attr ) ?>><?php echo esc_html($shop_more_button_text); ?></a>
			</div>
			<?php endif; ?>
			
		</div>
		<?php
		endif;
		
		wp_reset_postdata();

		/* restore hooks */
		ts_restore_product_hooks();

		wc_set_loop_prop('columns', $old_woocommerce_loop_columns);
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Products() );