<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Product_Categories extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-product-categories';
    }
	
	public function get_title(){
        return esc_html__( 'TS Product Categories', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'woocommerce-elements' );
    }
	
	public function get_icon(){
		return 'eicon-product-categories';
	}
	
	protected function register_controls(){
		$this->start_controls_section(
            'section_general'
            ,array(
                'label' 	=> esc_html__( 'General', 'themesky' )
                ,'tab'   	=> Controls_Manager::TAB_CONTENT
            )
        );
		
		$this->add_control(
            'tabs_layout'
            ,array(
                'label' 		=> esc_html__( 'Tabs Layout', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> esc_html__( 'No', 'themesky' )			
                ,'description' 	=> esc_html__( 'Add parent categories below. Each tab contains their children. If enabled, block title and slider will be disabled', 'themesky' )
            )
        );
		
		$this->add_control(
            'parents'
            ,array(
                'label' 		=> esc_html__( 'Parents', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'product_cat'
				)
				,'multiple' 	=> true
				,'sortable' 	=> true
				,'label_block' 	=> true
				,'description' 	=> ''
				,'condition'	=> array( 'tabs_layout' => '1' )
            )
        );
		
		$this->add_title_and_style_controls( array( 'tabs_layout!' => '1' ) );
		
		$this->add_title_alignment_controls( false, array( 'tabs_layout!' => '1' ) );

		$this->add_control(
            'style'
            ,array(
                'label' 		=> esc_html__( 'Style', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'default'
				,'options'		=> array(
									'default'			=> esc_html__( 'Style Default', 'themesky' )
									,'icon'				=> esc_html__( 'Style Icon', 'themesky' )
									,'img-large'		=> esc_html__( 'Style Image Large', 'themesky' )
								)			
                ,'description' 	=> ''
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
            )
        );

		$this->add_control(
            'first_level'
            ,array(
                'label' 		=> esc_html__( 'Only display the first level', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'			
                ,'description' 	=> ''
				,'condition'	=> array( 'tabs_layout!' => '1' )
            )
        );
		
		$this->add_control(
            'parent'
            ,array(
                'label' 		=> esc_html__( 'Parent', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'product_cat'
				)
				,'multiple' 	=> false
				,'sortable' 	=> false
				,'label_block' 	=> true
				,'description' 	=> esc_html__( 'Get direct children of this category', 'themesky' )
				,'condition'	=> array( 'first_level!' => '1', 'tabs_layout!' => '1' )
            )
        );
		
		$this->add_control(
            'child_of'
            ,array(
                'label' 		=> esc_html__( 'Child of', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'product_cat'
				)
				,'multiple' 	=> false
				,'sortable' 	=> false
				,'label_block' 	=> true
				,'description' 	=> esc_html__( 'Get all descendents of this category', 'themesky' )
				,'condition'	=> array( 'first_level!' => '1', 'tabs_layout!' => '1' )
            )
        );
		
		$this->add_control(
            'ids'
            ,array(
                'label' 		=> esc_html__( 'Specific categories', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'product_cat'
				)
				,'multiple' 	=> true
				,'label_block' 	=> true
				,'condition'	=> array( 'tabs_layout!' => '1' )
            )
        );
		
		$this->add_control(
            'hide_empty'
            ,array(
                'label' 		=> esc_html__( 'Hide empty product categories', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_title'
            ,array(
                'label' 		=> esc_html__( 'Product category title', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_responsive_control(
			'title_max_width'
			,array(
				'label' => esc_html__( 'Title Max Width(%)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'description' 	=> esc_html__( 'Default is 100%', 'themesky' )
				,'condition'	=> array( 'style' => 'img-large' )
				,'range' => array(
					'%' => array(
						'min' => 0
						,'max' => 100
					)
				)
				,'selectors' => array(
					'{{WRAPPER}} .style-img-large .product-wrapper > .meta-wrapper' => 'max-width: {{SIZE}}%;'
				)
			)
		);
		
		$this->add_control(
            'meta_color'
            ,array(
                'label'     	=> esc_html__( 'Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#000000'
				,'condition'	=> array( 'style' => 'img-large' )
				,'selectors'	=> array(
					'{{WRAPPER}} .style-img-large .product-wrapper > .meta-wrapper *' => 'color: {{VALUE}};'
				)
            )
        );
		
		$this->add_control(
            'meta_bg'
            ,array(
                'label'     	=> esc_html__( 'Background Color On Hover', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#e3e3e3'
				,'condition'	=> array( 'style' => 'img-large' )
				,'selectors'	=> array(
					'{{WRAPPER}} .style-img-large .product-wrapper' => 'background: {{VALUE}};'
					
				)
            )
        );
		
		$this->add_control(
            'show_product_count'
            ,array(
                'label' 		=> esc_html__( 'Product count', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'view_shop_button_text'
            ,array(
                'label'         => esc_html__( 'Shop Now Button Text', 'themesky' )
                ,'type'         => Controls_Manager::TEXT
                ,'default'      => ''
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

		$this->add_product_slider_controls(false);
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'title'							=> ''
			,'title_alignment' 				=> ''
			,'tabs_layout' 					=> 0
			,'parents' 						=> ''
			,'style' 						=> 'default'
			,'is_slider'					=> 0
			,'only_slider_mobile'			=> 0
			,'per_page' 					=> 4
			,'columns' 						=> 4
			,'first_level' 					=> 0
			,'parent' 						=> ''
			,'child_of' 					=> 0
			,'ids'	 						=> ''
			,'hide_empty'					=> 1
			,'show_title'					=> 1
			,'show_product_count'			=> 1
			,'view_shop_button_text'		=> ''
			,'show_nav' 					=> 1
			,'auto_play' 					=> 1
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		if( !class_exists('WooCommerce') ){
			return;
		}

		if( $only_slider_mobile && !wp_is_mobile() ){
			$is_slider = false;
		}
		
		if( $tabs_layout ){
			$is_slider = false;
		}
		
		if( is_admin() && !wp_doing_ajax() ){ /* WooCommerce does not include hook below in Elementor editor */
			add_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
		}
		
		if( $style == 'icon' ){
			remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
			add_action( 'woocommerce_before_subcategory_title', array($this, 'category_icon'), 10 );
		}
		
		if( $style == 'img-large' ){
			add_filter( 'subcategory_archive_thumbnail_size', array( $this, 'image_size' ), 9999 );
		}
		
		if( !$tabs_layout ){
			if( $first_level ){
				$parent = $child_of = 0;
			}
		
			$parent = is_array($parent) ? implode('', $parent) : $parent;
			$child_of = is_array($child_of) ? implode('', $child_of) : $child_of;

			$args = array(
				'taxonomy'	  => 'product_cat'
				,'orderby'    => 'name'
				,'order'      => 'ASC'
				,'hide_empty' => $hide_empty
				,'pad_counts' => true
				,'parent'     => $parent
				,'child_of'   => $child_of
				,'number'     => $limit
			);
			
			if( $ids ){
				$args['include'] = $ids;
				$args['orderby'] = 'include';
			}
			
			$product_categories = get_terms( $args );
		}
		
		$old_woocommerce_loop_columns = wc_get_loop_prop('columns');
		wc_set_loop_prop('columns', $columns);
		
		wc_set_loop_prop( 'is_shortcode', true );
		
		if( !empty($product_categories) || ( $tabs_layout && $parents ) ):
			$classes = array();
			$classes[] = 'ts-product-category-wrapper ts-product ts-shortcode woocommerce';
			$classes[] = 'columns-' . $columns;
			$classes[] = 'style-' . $style;
			$classes[] = $is_slider?'ts-slider':'grid';
			
			if( $tabs_layout ){
				$classes[] = 'tabs-layout';
			}
			
			if( $is_slider ){
				if( $show_nav ){
					$classes[] = 'show-nav';
				}
			}
		
			$data_attr = array();
			if( $is_slider ){
				$data_attr[] = 'data-nav="'.$show_nav.'"';
				$data_attr[] = 'data-autoplay="'.$auto_play.'"';
				$data_attr[] = 'data-columns="'.$columns.'"';
			}
		?>
			<div class="<?php echo esc_attr(implode(' ', $classes)) ?>" <?php echo implode(' ', $data_attr); ?>>
				<?php
				if( $tabs_layout ){
					$suffix = '-' . mt_rand(0, 10000);
					$parent_slugs = array();
				?>
				<ul class="tabs">
					<?php 
					foreach( $parents as $k => $p ){
						$parent_obj = get_term_by('term_id', $p, 'product_cat');
						if( isset($parent_obj->term_id) ){
							$parent_slugs[$p] = $parent_obj->slug;
						?>
						<li class="tab-item <?php echo $k == 0 ? 'active' : '' ?>" data-tab_key="<?php echo esc_attr($parent_obj->slug) . $suffix; ?>"><?php echo esc_html($parent_obj->name); ?></li>
						<?php
						}
					}
					?>
				</ul>
				<?php
				}
				elseif( $title ){
				?>
				<header class="shortcode-heading-wrapper">
					<h2 class="shortcode-title"><?php echo esc_html($title); ?></h2>
				</header>
				<?php
				}
				?>
				
				<div class="content-wrapper <?php echo $is_slider?'loading':''; ?>">
					<?php 
					woocommerce_product_loop_start();
					
					if( $tabs_layout ){
						foreach( $parents as $k => $p ){
							$parent_slug = isset($parent_slugs[$p]) ? $parent_slugs[$p] : '';
							if( $parent_slug ){
								$extra_class = $parent_slug . $suffix;
								if( $k == 0 ){
									$extra_class .= ' active';
								}
								add_filter('product_cat_class', function($classes) use ($extra_class){
									$classes[] = $extra_class;
									return $classes;
								}, 9999);
							}
							
							$args = array(
								'taxonomy'	  => 'product_cat'
								,'orderby'    => 'name'
								,'order'      => 'ASC'
								,'hide_empty' => $hide_empty
								,'pad_counts' => true
								,'parent'     => $p
								,'child_of'   => $p
								,'number'     => $limit
							);
							
							$child_categories = get_terms( $args );
							if( !empty($child_categories) ){
								foreach ( $child_categories as $category ) {
									wc_get_template( 'content-product-cat.php', array(
										'category' 						=> $category
										,'style' 						=> $style
										,'show_title' 					=> $show_title
										,'show_product_count' 			=> $show_product_count
										,'view_shop_button_text' 		=> $view_shop_button_text
									) );
								}
							}
							
							remove_all_filters('product_cat_class', 9999);
						}
					}
					else{
						foreach ( $product_categories as $category ) {
							wc_get_template( 'content-product-cat.php', array(
								'category' 						=> $category
								,'style' 						=> $style
								,'show_title' 					=> $show_title
								,'show_product_count' 			=> $show_product_count
								,'view_shop_button_text' 		=> $view_shop_button_text
							) );
						}
					}
					
					woocommerce_product_loop_end();
					?>
				</div>
			</div>
		<?php
		endif;
		
		if( $style == 'icon' ){
			add_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
			remove_action( 'woocommerce_before_subcategory_title', array($this, 'category_icon'), 10 );
		}
		
		if( $style == 'img-large' ){
			remove_filter( 'subcategory_archive_thumbnail_size', array( $this, 'image_size' ), 9999 );
		}
		
		wc_set_loop_prop('columns', $old_woocommerce_loop_columns);
		
		wc_set_loop_prop( 'is_shortcode', false );
	}

	function image_size() {
		return 'full';
	}
	
	function category_icon( $category ){
		$icon_id = get_term_meta($category->term_id, 'icon_id', true);
		if( $icon_id ){
			echo wp_get_attachment_image( $icon_id, 'full' );
		}
		else{
			echo wc_placeholder_img();
		}
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Product_Categories() );