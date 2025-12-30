<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Blogs extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-blogs';
    }
	
	public function get_title(){
        return esc_html__( 'TS Blogs', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-posts-grid';
	}
	
	public function get_script_depends(){
		if( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ){
			return array('isotope');
		}
		return array();
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
		
		$this->add_title_alignment_controls();
		
		$this->add_control(
            'layout'
            ,array(
                'label' 		=> esc_html__( 'Layout', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'masonry'
				,'options'		=> array(
									'grid'			=> esc_html__( 'Grid', 'themesky' )
									,'slider'		=> esc_html__( 'Slider', 'themesky' )
									,'masonry'		=> esc_html__( 'Masonry', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'item_layout'
            ,array(
                'label' 		=> esc_html__( 'Item Layout', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'grid'
				,'options'		=> array(
									'grid'		=> esc_html__( 'Grid', 'themesky' )
									,'list'		=> esc_html__( 'List', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
			'enable_partial_view'
			,array(
                'label' 		=> esc_html__( 'Enable Partial View', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )			
                ,'description' 	=> esc_html__( 'Not available if columns is 1', 'themesky' )
				,'condition'	=> array( 'layout' => 'slider' )
            )
		);
		
		$this->add_responsive_control(
			'partial_width'
			,array(
				'label' 		=> esc_html__( 'Partial View Width (%)', 'themesky' )
				,'type' 		=> Controls_Manager::SLIDER
				,'description' 	=> esc_html__( 'Set the visible width of the next item in Partial View mode. Default is 36%', 'themesky' )
				,'range' 		=> array(
					'%' => array(
						'min' => 0
						,'max' => 100
					)
				)
				,'mobile_default' => array(
					'size' => 100
					,'unit' => '%'
				)
				,'selectors' 	=> array(
					'{{WRAPPER}} .ts-blogs.partial-view .content-wrapper .items' => 'width: calc( 200% - {{SIZE}}% );'
				)
				,'condition'	=> array( 'enable_partial_view' => '1' )
			)
		);
		
		$this->add_control(
            'columns'
            ,array(
                'label' 		=> esc_html__( 'Columns', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '2'
				,'options'		=> array(
									'1'			=> '1'
									,'2'		=> '2'
									,'3'		=> '3'
									,'4'		=> '4'
								)			
                ,'description' 	=> esc_html__( 'Number of Columns', 'themesky' )
            )
        );
		
		$this->add_control(
            'limit'
            ,array(
                'label'     	=> esc_html__( 'Limit', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 9
				,'min'      	=> 1
				,'description' 	=> esc_html__( 'Number of Posts', 'themesky' )
            )
        );
		
		$this->add_control(
			'filter_posts'
			,array(
                'label' 		=> esc_html__( 'Filter blogs', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'					=> esc_html__( 'None', 'themesky' )
									,'specific_posts'	=> esc_html__( 'Specific blogs', 'themesky' )
									,'except_posts'		=> esc_html__( 'Except for blogs', 'themesky' )
								)			
                ,'description' 	=> ''
            )
		);

		$this->add_control(
			'specific_posts'
			,array(
				'label'			=> esc_html__( 'Specific Blogs', 'themesky' )
				,'type'			=> 'ts_autocomplete'
				,'default'		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'post'
					,'name'		=> 'post'
				)
				,'multiple' 	=> true
				,'sortable' 	=> false
				,'label_block' 	=> true
				,'condition'	=> array( 'filter_posts' => 'specific_posts' )
			)
		);

		$this->add_control(
			'except_posts'
			,array(
				'label'			=> esc_html__( 'Except for Blogs', 'themesky' )
				,'type'			=> 'ts_autocomplete'
				,'default'		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'post'
					,'name'		=> 'post'
				)
				,'multiple' 	=> true
				,'sortable' 	=> false
				,'label_block' 	=> true
				,'condition'	=> array( 'filter_posts' => 'except_posts' )
			)
		);
		
		$this->add_control(
            'orderby'
            ,array(
                'label' 		=> esc_html__( 'Order by', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'date'
				,'options'		=> array(
									'none'		=> esc_html__( 'None', 'themesky' )
									,'ID'		=> esc_html__( 'ID', 'themesky' )
									,'date'		=> esc_html__( 'Date', 'themesky' )
									,'name'		=> esc_html__( 'Name', 'themesky' )
									,'title'	=> esc_html__( 'Title', 'themesky' )
								)		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'order'
            ,array(
                'label' 		=> esc_html__( 'Order', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'DESC'
				,'options'		=> array(
									'DESC'		=> esc_html__( 'Descending', 'themesky' )
									,'ASC'		=> esc_html__( 'Ascending', 'themesky' )
								)		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'categories'
            ,array(
                'label' 		=> esc_html__( 'Categories', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'category'
				)
				,'multiple' 	=> true
				,'sortable' 	=> false
				,'label_block' 	=> true
            )
        );

		
		$this->add_control(
            'show_title'
            ,array(
                'label' 		=> esc_html__( 'Post title', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
                ,'separator' 	=> 'before'
            )
        );
		
		$this->add_control(
            'show_thumbnail'
            ,array(
                'label' 		=> esc_html__( 'Post thumbnail', 'themesky' )
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
                'label' 		=> esc_html__( 'Post categories', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_author'
            ,array(
                'label' 		=> esc_html__( 'Post author', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description'	=> ''
            )
        );
		
		$this->add_control(
            'show_comment'
            ,array(
                'label' 		=> esc_html__( 'Post comment', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_date'
            ,array(
                'label' 		=> esc_html__( 'Post date', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_excerpt'
            ,array(
                'label' 		=> esc_html__( 'Post excerpt', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'excerpt_words'
            ,array(
                'label'     => esc_html__( 'Number of words in excerpt', 'themesky' )
                ,'type'     => Controls_Manager::NUMBER
				,'default'  => 36
				,'min'      => 1
				,'condition'=> array( 'show_excerpt' => '1' )
            )
        );
		
		$this->add_control(
            'show_readmore'
            ,array(
                'label' 		=> esc_html__( 'Read more button', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '1'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )		
                ,'description' 	=> 	esc_html__( 'Show button read more in each post', 'themesky' )
            )
        );
		
		$this->add_control(
            'show_load_more'
            ,array(
                'label' 		=> esc_html__( 'Load more button', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Show', 'themesky' )
				,'label_off'	=> 	esc_html__( 'Hide', 'themesky' )			
                ,'description' 	=> 	esc_html__( 'Show button load more at the end of shortcode', 'themesky' )
				,'condition' 	=> array( 'layout' => array('grid', 'masonry') )
				,'separator' 	=> 'before'
            )
        );
		
		$this->add_control(
            'load_more_text'
            ,array(
                'label' 		=> esc_html__( 'Load more button text', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> 'Load more'		
                ,'description' 	=> ''
                ,'condition' 	=> array( 'show_load_more' => '1', 'layout' => array('grid', 'masonry') )
            )
        );
		
		$this->add_control(
            'show_nav'
            ,array(
                'label' 		=> esc_html__( 'Show slider navigation', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )			
                ,'description' 	=> ''
				,'condition' 	=> array( 'layout' => 'slider' )
				,'separator' 	=> 'before'
            )
        );
		
		$this->add_control(
            'auto_play'
            ,array(
                'label' 		=> esc_html__( 'Slider auto play', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )			
                ,'description' 	=> ''
				,'condition' 	=> array( 'layout' => 'slider' )
            )
        );
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'title'				=> ''
			,'title_alignment' 	=> ''
			,'layout'			=> 'masonry'
			,'item_layout'		=> 'grid'
			,'enable_partial_view'	=> '0'
			,'columns'			=> 2
			,'categories'		=> array()
			,'filter_posts'		=> 0
			,'specific_posts'	=> array()
			,'except_posts'		=> array()
			,'limit'			=> 9
			,'orderby'			=> 'date'
			,'order'			=> 'DESC'
			,'show_title'		=> 1
			,'show_thumbnail'	=> 1
			,'show_categories'	=> 1
			,'show_author'		=> 1
			,'show_date'		=> 1
			,'show_comment'		=> 0
			,'show_excerpt'		=> 1
			,'show_readmore'	=> 1
			,'excerpt_words'	=> 36
			,'show_nav'			=> 1
			,'auto_play'		=> 0
			,'show_load_more'	=> 0
			,'load_more_text'	=> 'View More'
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		if( !is_numeric($excerpt_words) ){
			$excerpt_words = 20;
		}
		
		$is_slider = 0;
		$is_masonry = 0;
		if( $layout == 'slider' ){
			$is_slider = 1;
		}
		if( $layout == 'masonry' ){
			wp_enqueue_script( 'isotope' );
			$is_masonry = 1;
		}
		
		$columns = absint($columns);
		if( !in_array($columns, array(1, 2, 3, 4)) ){
			$columns = 2;
		}
		
		$args = array(
			'post_type' 			=> 'post'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts' 	=> 1
			,'posts_per_page'		=> $limit
			,'orderby'				=> $orderby
			,'order'				=> $order
			,'tax_query'			=> array()
		);

		if( $specific_posts && $filter_posts ){
			$args['post__in'] = $specific_posts;
		}

		if( $except_posts && $filter_posts ){
			$args['post__not_in'] = $except_posts;
		}

		if( $categories ){
			$args['tax_query'][] = array(
										'taxonomy' 	=> 'category'
										,'terms' 	=> $categories
										,'field' 	=> 'term_id'
										,'include_children' => false
									);
		}
		
		global $post;
		$posts = new WP_Query($args);
		
		if( $posts->have_posts() ):
			if( $posts->post_count <= 1 ){
				$is_slider = 0;
			}
			if( $is_slider || $posts->max_num_pages == 1 ){
				$show_load_more = 0;
			}
			
			$classes = array();
			$classes[] = 'ts-blogs-wrapper ts-shortcode ts-blogs';
			$classes[] = 'columns-' . $columns;
			$classes[] = 'style-' . $layout;
			$classes[] = 'item-' . $item_layout;
			
			if( $is_slider ){
				
				$classes[] = 'ts-slider rows-1 loading';
				
				if( $show_nav ){
					$classes[] = 'show-nav';
				}
				
				if( $enable_partial_view ){
					$classes[] = 'partial-view';
				}
			}
			
			if( $is_masonry ){
				$classes[] = 'ts-masonry loading';
			}
			
			$data_attr = array();
			if( $is_slider ){
				$data_attr[] = 'data-nav="'.esc_attr($show_nav).'"';
				$data_attr[] = 'data-autoplay="'.esc_attr($auto_play).'"';
				$data_attr[] = 'data-columns="'.absint($columns).'"';
			}
			
			if( is_array($categories) ){
				$categories = implode(',', $categories);
			}
			
			$atts = compact('layout', 'columns', 'categories', 'limit', 'orderby', 'order'
							,'show_title', 'show_thumbnail', 'show_author', 'show_categories'
							,'show_date', 'show_comment', 'show_excerpt', 'show_readmore', 'excerpt_words'
							,'is_slider', 'show_nav', 'auto_play', 'is_masonry', 'show_load_more');
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>" <?php echo implode(' ', $data_attr); ?>>
				<?php if( $title ): ?>
				<header class="shortcode-heading-wrapper">
					<h2 class="shortcode-title">
						<?php echo esc_html($title); ?>
					</h2>
				</header>
				<?php endif; ?>
				
				<div class="content-wrapper">
					<div class="blogs items">
						<?php ts_get_blog_items_content($atts, $posts); ?>
					</div>
					<?php if( $show_load_more ): ?>
					<div class="load-more-wrapper">
						<a href="#" class="load-more button" data-posts_per_page="<?php echo esc_attr( $limit ); ?>" data-total_pages="<?php echo esc_attr( $posts->max_num_pages ); ?>" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Blogs() );