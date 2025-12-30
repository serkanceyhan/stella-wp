<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Banner extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-banner';
    }
	
	public function get_title(){
        return esc_html__( 'TS Banner', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-image';
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
            'img_bg'
            ,array(
                'label' 		=> esc_html__( 'Background Image', 'themesky' )
                ,'type' 		=> Controls_Manager::MEDIA
                ,'default' 		=> array( 'id' => '', 'url' => '' )		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'img_bg_sm'
            ,array(
                'label' 		=> esc_html__( 'Mobile Background Image', 'themesky' )
                ,'type' 		=> Controls_Manager::MEDIA
                ,'default' 		=> array( 'id' => '', 'url' => '' )		
                ,'description' 	=> esc_html__( 'Leave it empty to use only Background Image above for all screen', 'themesky' )
            )
        );
		
		$this->add_control(
            'heading_title'
            ,array(
                'label' 		=> esc_html__( 'Heading', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXTAREA
                ,'default' 		=> ''		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'description'
            ,array(
                'label' 		=> esc_html__( 'Description', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> ''		
                ,'description' 	=> ''
            )
        );
		
		$this->add_responsive_control(
            'text_position'
            ,array(
                'label' 		=> esc_html__( 'Content Position', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'description' 	=> ''
                ,'default' 		=> 'left-top'
				,'options'		=> array(
									'left-top'			=> esc_html__( 'Left Top', 'themesky' )
									,'left-bottom'		=> esc_html__( 'Left Bottom', 'themesky' )
									,'left-center'		=> esc_html__( 'Left Center', 'themesky' )
									,'right-top'		=> esc_html__( 'Right Top', 'themesky' )
									,'right-bottom'		=> esc_html__( 'Right Bottom', 'themesky' )
									,'right-center'		=> esc_html__( 'Right Center', 'themesky' )
									,'center-top'		=> esc_html__( 'Center Top', 'themesky' )
									,'center-bottom'	=> esc_html__( 'Center Bottom', 'themesky' )
									,'center-center'	=> esc_html__( 'Center Center', 'themesky' )
								)
                ,'prefix_class'   => 'text%s-'
            )
        );
		
		$this->add_control(
            'description_position'
            ,array(
                'label' 		=> esc_html__( 'Description Position', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'bottom'
				,'options'		=> array(
									'top'			=> esc_html__( 'Above', 'themesky' )
									,'bottom'		=> esc_html__( 'Under', 'themesky' )
								)			
                ,'description' 	=> esc_html__( 'Choose the description is above or under the heading', 'themesky' )
            )
        );
		
		$this->add_control(
            'link'
            ,array(
                'label'     	=> esc_html__( 'Link', 'themesky' )
                ,'type'     	=> Controls_Manager::URL
				,'default'  	=> array( 'url' => '', 'is_external' => true, 'nofollow' => true )
				,'show_external'=> true
            )
        );
		
		$this->add_control(
            'button_text'
            ,array(
                'label' 		=> esc_html__( 'Button Text', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> ''		
                ,'description' 	=> esc_html__( 'Only working if the "Link" field is not empty', 'themesky' )
            )
        );
		
		$this->add_control(
            'style_effect'
            ,array(
                'label' 		=> esc_html__( 'Style Effect', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'eff-zoom-in'
				,'options'		=> array(									
									'eff-zoom-in'				=> esc_html__('Zoom In', 'themesky')
									,'eff-zoom-out' 			=> esc_html__('Zoom Out', 'themesky')
									,'eff-flash' 				=> esc_html__('Flash', 'themesky')
									,'eff-line' 				=> esc_html__('Line', 'themesky')
									,'eff-overlay' 				=> esc_html__('Overlay', 'themesky')
									,'no-effect' 				=> esc_html__('None', 'themesky')
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'line_color'
            ,array(
                'label'     	=> esc_html__( 'Line Border Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#ffffff'
				,'condition'	=> array( 'style_effect' => 'eff-line' )
				,'selectors'	=> array(
					'{{WRAPPER}} .eff-line .bg-content:before,{{WRAPPER}} .eff-line .bg-content:after,{{WRAPPER}} .eff-line .image-link:before,{{WRAPPER}} .eff-line .image-link:after' => 'border-color: {{VALUE}}'
				)
            )
        );
		
		$this->add_control(
            'overlay_color'
            ,array(
                'label'     	=> esc_html__( 'Overlay Background Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#ffffff'
				,'condition'	=> array( 'style_effect' => 'eff-overlay' )
				,'selectors'	=> array(
					'{{WRAPPER}} .eff-overlay .bg-content:before,{{WRAPPER}} .eff-overlay .image-link:before,{{WRAPPER}} .eff-overlay .bg-content:after,{{WRAPPER}} .eff-overlay .image-link:after' => 'background: {{VALUE}}'
				)
            )
        );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_style'
            ,array(
                'label' 	=> esc_html__( 'Style', 'themesky' )
                ,'tab'   	=> Controls_Manager::TAB_STYLE
            )
        );
		
		$this->add_responsive_control(
			'banner_min_height'
			,array(
				'label' => esc_html__( 'Banner Min Height(px)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'range' => array(
					'px' => array(
						'min' => 0
						,'max' => 1000
					)
				)
				,'selectors' => array(
					'{{WRAPPER}} .banner-bg img' => 'min-height: {{SIZE}}px;'
				)
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type()
			,array(
				'label' 	=> esc_html__( 'Heading Typography', 'themesky' )
				,'name' 	=> 'heading_size'
				,'selector'	=> '{{WRAPPER}} .box-content h2'
				,'fields_options'	=> array(
					'font_size'	=> array(
						'default'	=> array(
							'size' 	=> '48'
							,'unit' => 'px'
						)
						,'size_units' => array( 'px', 'em', 'rem', 'vw' )
					)
					,'font_weight'  => array(
						'default' 	=> '700'
					)
					,'letter_spacing'	=> array(
						'default' 		=> array(
							'size' 		=> '0.075'
							,'unit' 	=> 'em'
						)
					)
				)
				,'exclude'	=> array('text_transform', 'font_style', 'text_decoration', 'word_spacing')
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type()
			,array(
				'label' 	=> esc_html__( 'Description Typography', 'themesky' )
				,'name' 	=> 'description_size'
				,'selector'	=> '{{WRAPPER}} .box-content .description'
				,'fields_options'	=> array(
					'font_size'	=> array(
						'default'	=> array(
							'size' 	=> '14'
							,'unit' => 'px'
						)
						,'size_units' => array( 'px', 'em', 'rem', 'vw' )
					)
					,'font_weight'  => array(
						'default' 	=> '400'
					)
					,'letter_spacing'	=> array(
						'default' 		=> array(
							'size' 		=> '0.075'
							,'unit' 	=> 'em'
						)
					)
				)
				,'exclude'	=> array('text_transform', 'font_style', 'text_decoration', 'word_spacing')
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type()
			,array(
				'label' 	=> esc_html__( 'Button Typography', 'themesky' )
				,'name' 	=> 'btn_size'
				,'selector'	=> '{{WRAPPER}} .ts-banner-button a.button-text'
				,'fields_options'	=> array(
					'font_size'	=> array(
						'default'	=> array(
							'size' 	=> '14'
							,'unit' => 'px'
						)
						,'size_units' => array( 'px', 'em', 'rem', 'vw' )
					)
					,'font_weight'  => array(
						'default' 	=> '700'
					)
				)
				,'exclude'	=> array('text_transform', 'font_style', 'text_decoration', 'letter_spacing', 'line_height', 'word_spacing')
			)
		);
		
		$this->add_control(
            'text_color'
            ,array(
                'label'     	=> esc_html__( 'Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#000000'
				,'selectors'	=> array(
					'{{WRAPPER}} .box-content' => 'color: {{VALUE}}'
				)
            )
        );
		
		$this->add_responsive_control(
            'text_alignment'
            ,array(
                'label' 		=> esc_html__( 'Text Alignment', 'themesky' )
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
				,'prefix_class' => 'ts-align%s'
				,'description' 	=> ''
            )
        );
		
		$this->add_responsive_control(
			'content_padding'
			,array(
				'type' => Controls_Manager::DIMENSIONS
				,'label' => esc_html__( 'Content Padding(px)', 'themesky' )
				,'size_units' => array( 'px' )
				,'selectors' => array(
					'{{WRAPPER}} .box-content' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
				)
			)
		);
		
		$this->add_responsive_control(
			'title_mgbottom'
			,array(
				'label' => esc_html__( 'Title Margin Bottom(px)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'range' => array(
					'px' => array(
						'min' => 0
						,'max' => 100
					)
				)
				,'selectors' => array(
					'{{WRAPPER}} .box-content h2' => 'margin-bottom: {{SIZE}}px;'
				)
			)
		);
		
		$this->add_responsive_control(
			'description_mgbottom'
			,array(
				'label' => esc_html__( 'Description Margin Bottom(px)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'range' => array(
					'px' => array(
						'min' => 0
						,'max' => 100
					)
				)
				,'selectors' => array(
					'{{WRAPPER}} .box-content .description' => 'margin-bottom: {{SIZE}}px;'
				)
			)
		);
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'img_bg'							=> array( 'id' => '', 'url' => '' )
			,'img_bg_sm'						=> array( 'id' => '', 'url' => '' )
			,'banner_min_height'				=> '0'
			,'heading_title'					=> ''
			,'heading_size'						=> '30'
			,'description'						=> ''
			,'description_size'					=> '14'
			,'btn_size'							=> '14'
			,'text_color'						=> '#000000'
			,'description_position'				=> 'bottom'
			,'text_position'					=> 'left-top'
			,'button_text'						=> ''
			,'content_padding'					=> ''
			,'link' 							=> array( 'url' => '', 'is_external' => true, 'nofollow' => true )
			,'style_effect'						=> 'eff-zoom-in'
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		$link_attr = $this->generate_link_attributes( $link );
		
		$classes = array();
		$classes[] = $style_effect;
		$classes[] = 'description-'.$description_position;
		
		?>
		<div class="ts-banner <?php echo esc_attr( implode(' ', $classes) ); ?>">
			<div class="banner-wrapper">
			
				<?php if( $link_attr ): ?>
				<a class="banner-link" <?php echo implode(' ', $link_attr); ?>></a>
				<?php endif;?>
					
				<div class="banner-bg">
					<div class="bg-content">
						<?php echo wp_get_attachment_image($img_bg_sm['id'], 'full', 0, array('class'=>'img-sm')); ?>
						<?php echo wp_get_attachment_image($img_bg['id'], 'full', 0, array('class'=>'img')); ?>
					</div>
				</div>
							
				<div class="box-content">
					<?php if( $heading_title ): ?>				
						<h2><?php echo wp_kses( $heading_title, array('br' => array()) ); ?></h2>
					<?php endif; ?>
					
					<?php if( $description ): ?>				
						<div class="description"><?php echo esc_html($description) ?></div>
					<?php endif; ?>
					
					<?php if( $button_text && $link_attr ):?>
						<div class="ts-banner-button">
							<a class="button button-text" <?php echo implode(' ', $link_attr); ?>><?php echo esc_html($button_text) ?></a>
						</div>
					<?php endif; ?>
				</div>
				
			</div>
		</div>
		<?php
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Banner() );