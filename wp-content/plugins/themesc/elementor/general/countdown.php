<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Countdown extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-countdown';
    }
	
	public function get_title(){
        return esc_html__( 'TS Countdown', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-countdown';
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
            'date'
            ,array(
                'label' 			=> esc_html__( 'Date', 'themesky' )
                ,'type' 			=> Controls_Manager::DATE_TIME
                ,'default' 			=> date( 'Y-m-d', strtotime('+1 day') )
            )
        );
		
		$this->add_control(
            'style'
            ,array(
                'label' 		=> esc_html__( 'Style', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'style-default'
				,'options'		=> array(
									'style-default'	=> esc_html__( 'Default', 'themesky' )
									,'style-2'		=> esc_html__( 'Style 2', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_responsive_control(
			'circle_size'
			,array(
				'label' => esc_html__( 'Custom Circle Size(px)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'range' => array(
					'px' => array(
						'min' => 0
						,'max' => 500
					)
				)
				,'selectors' => array(
					'{{WRAPPER}} .ts-countdown.style-2 .counter-wrapper > div' => 'min-width: {{SIZE}}px; min-height: {{SIZE}}px;'
				)
				,'condition'	=> array( 'style' => 'style-2' )
			)
		);
		
		$this->add_responsive_control(
            'alignment'
            ,array(
                'label' 		=> esc_html__( 'Alignment', 'themesky' )
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
				,'devices' => array( 'desktop', 'tablet', 'mobile' )
				,'prefix_class' => 'ts-align%s'
				,'description' 	=> ''
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

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type()
			,array(
				'label' 	=> esc_html__( 'Number Typography', 'themesky' )
				,'name' 	=> 'counter_typography'
				,'selector'	=> '{{WRAPPER}} .counter-wrapper'
				,'fields_options'	=> array(
					'font_size'	=> array(
						'default'	=> array(
							'size' 	=> '20'
							,'unit' => 'px'
						)
						,'size_units' => array( 'px', 'em', 'rem', 'vw' )
					)
				)
				,'exclude'	=> array('font_family', 'font_weight', 'text_transform', 'font_style', 'text_decoration', 'line_height', 'letter_spacing', 'word_spacing')
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type()
			,array(
				'label' 	=> esc_html__( 'Text Typography', 'themesky' )
				,'name' 	=> 'text_typography'
				,'selector'	=> '{{WRAPPER}} .counter-wrapper .ref-wrapper'
				,'fields_options'	=> array(
					'font_size'	=> array(
						'default'	=> array(
							'size' 	=> '12'
							,'unit' => 'px'
						)
						,'size_units' => array( 'px', 'em', 'rem', 'vw' )
					)
				)
				,'exclude'	=> array('font_family', 'font_weight', 'text_transform', 'font_style', 'text_decoration', 'line_height', 'letter_spacing', 'word_spacing')
			)
		);
		
		$this->add_control(
            'text_color'
            ,array(
                'label'     	=> esc_html__( 'Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .style-default .counter-wrapper, {{WRAPPER}} .style-2 .counter-wrapper > div' => 'color: {{VALUE}}'
				)
            )
        );
		
		$this->add_control(
            'background_color'
            ,array(
                'label'     	=> esc_html__( 'Background Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .style-default .counter-wrapper, {{WRAPPER}} .style-2 .counter-wrapper > div' => 'background: {{VALUE}}'
				)
            )
        );
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		if( empty($settings['date']) ){
			return;
		}
		
		$time = strtotime($settings['date']);
		
		if( $time === false ){
			return;
		}
		
		$current_time = current_time('timestamp');
		
		if( $time < $current_time ){
			return;
		}
		
		$settings['seconds'] = $time - $current_time;
		$settings['title']	= 0;
		
		ts_countdown( $settings );
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Countdown() );