<?php
use Elementor\Controls_Manager;

abstract class TS_Elementor_Widget_Base extends Elementor\Widget_Base{
	public function get_name(){
        return 'ts-base';
    }
	
	public function get_title(){
        return esc_html__( 'ThemeSky Base', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements' );
    }
	
	/* key|value,key|value => return array */
	public function parse_link_custom_attributes( $custom_attributes ){
		if( !$custom_attributes ){
			return array();
		}
		
		$attributes = array();
		
		$custom_attributes = str_replace(' ', '', $custom_attributes);
		
		$custom_attributes = explode(',', $custom_attributes);
		foreach( $custom_attributes as $custom_attribute ){
			$attr = explode('|', $custom_attribute);
			if( count($attr) == 2 ){
				$attributes[] = $attr;
			}
		}
		
		return $attributes;
	}
	
	public function generate_link_attributes( $link ){
		if( !$link ){
			return array();
		}

		$link_attr = array();
		
		if( $link['url'] ){
			$link_attr[] = 'href="' . esc_url($link['url']) . '"';
			$link_attr[] = $link['is_external'] ? 'target="_blank"' : '';
			$link_attr[] = $link['nofollow'] ? 'rel="nofollow"' : '';
			
			if( !empty($link['custom_attributes']) ){
				$link_custom_attributes = $this->parse_link_custom_attributes( $link['custom_attributes'] );
				foreach( $link_custom_attributes as $attr ){
					$link_attr[] = $attr[0] . '="' . esc_attr($attr[1]) . '"';
				}
			}
		}
		
		return $link_attr;
	}
	
	public function get_custom_taxonomy_options( $tax = '' ){
		if( !$tax ){
			return;
		}
		
		$terms = get_terms( array(
				'taxonomy'		=> $tax
				,'hide_empty'	=> false
				,'fields'		=> 'id=>name'
			) );
			
		return is_array($terms) ? $terms : array();
	}
	
	public function get_custom_post_options( $post_type = 'post' ){
		$args = array(
				'post_type'				=> $post_type
				,'post_status'			=> 'publish'
				,'posts_per_page'		=> -1
			);
			
		$posts = array();
		
		$query_obj = new WP_Query($args);
		if( $query_obj->have_posts() ){
			foreach( $query_obj->posts as $p ){
				$posts[$p->ID] = $p->post_title;
			}
		}
		
		return $posts;
	}
	
	public function add_title_and_style_controls( $condition = array() ){
		$this->add_control(
            'title'
            ,array(
                'label' 		=> esc_html__( 'Title', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> ''		
                ,'description' 	=> ''
                ,'condition' 	=> $condition
            )
        );
	}
	
	public function add_title_alignment_controls( $has_desc = false, $condition = array() ){
		$this->add_responsive_control(
            'title_alignment'
            ,array(
                'label' 		=> esc_html__( 'Title Alignment', 'themesky' )
                ,'type' 		=> Controls_Manager::CHOOSE
				,'options' => array(
					'left' => array(
						'title' => esc_html__( 'Left', 'themesky' )
						,'icon' => 'eicon-text-align-left'
					)
					,'center' => array(
						'title' => esc_html__( 'Center', 'themesky' )
						,'icon' => 'eicon-text-align-center'
					)
					,'right' => array(
						'title' => esc_html__( 'Right', 'themesky' )
						,'icon' => 'eicon-text-align-right'
					)
				)
				,'default' 		=> 'left'
				,'prefix_class' => 'title-align-%s'
				,'description' 	=> $has_desc ? esc_html__( 'Not available if Title Style is Inside Content', 'themesky' ) : ''
				,'condition' 	=> $condition
            )
        );
	}
	
	public function add_product_meta_controls(){
		$this->add_control(
            'show_image'
            ,array(
                'label' 		=> esc_html__( 'Product image', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
				,'separator'	=> 'before'
            )
        );
		
		$this->add_control(
            'show_title'
            ,array(
                'label' 		=> esc_html__( 'Product name', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_sku'
            ,array(
                'label' 		=> esc_html__( 'Product SKU', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_price'
            ,array(
                'label' 		=> esc_html__( 'Product price', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_short_desc'
            ,array(
                'label' 		=> esc_html__( 'Product short description', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_rating'
            ,array(
                'label' 		=> esc_html__( 'Product rating', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_label'
            ,array(
                'label' 		=> esc_html__( 'Product label', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_categories'
            ,array(
                'label' 		=> esc_html__( 'Product categories', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_brands'
            ,array(
                'label' 		=> esc_html__( 'Product brands', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_add_to_cart'
            ,array(
                'label' 		=> esc_html__( 'Add to cart button', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
	}
	
	public function add_product_color_swatch_controls(){
		$this->add_control(
            'show_color_swatch'
            ,array(
                'label' 		=> esc_html__( 'Color swatches', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )
                ,'description' 	=> esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'themesky' )
            )
        );
		
		$this->add_control(
            'number_color_swatch'
            ,array(
                'label' 		=> esc_html__( 'Number of color swatches', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '3'
				,'options'		=> array(
									'2'		=> '2'
									,'3'	=> '3'
									,'4'	=> '4'
									,'5'	=> '5'
									,'6'	=> '6'
								)			
                ,'description' 	=> ''
                ,'condition' 	=> array( 'show_color_swatch' => '1' )
            )
        );
	}
	
	public function add_product_slider_controls( $has_rows = true, $has_rows_desc = false ){
		$this->add_control(
            'is_slider'
            ,array(
                'label' 		=> esc_html__( 'Enable Slider', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )				
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'only_slider_mobile'
            ,array(
                'label' 		=> esc_html__( 'Only enable slider on device', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )
                ,'description' 	=> esc_html__( 'Show Grid on desktop and only enable Slider on device', 'themesky' )
            )
        );
		
		if( $has_rows ){
			$this->add_control(
				'rows'
				,array(
					'label' 		=> esc_html__( 'Rows', 'themesky' )
					,'type' 		=> Controls_Manager::SELECT
					,'default' 		=> '1'
					,'options'		=> array(
										'1'		=> '1'
										,'2'	=> '2'
									)			
					,'description' 	=> $has_rows_desc ? esc_html__( 'Not available if Title Style is Inside Content', 'themesky' ) : ''
				)
			);
		}
		
		$this->add_control(
            'show_nav'
            ,array(
                'label' 		=> esc_html__( 'Show navigation', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'auto_play'
            ,array(
                'label' 		=> esc_html__( 'Auto play', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )
                ,'description' 	=> ''
            )
        );
	}
}