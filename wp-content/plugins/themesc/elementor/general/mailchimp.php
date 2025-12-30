<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Mailchimp extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-mailchimp';
    }
	
	public function get_title(){
        return esc_html__( 'TS Mailchimp', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-email-field';
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
            'form'
            ,array(
                'label' 		=> esc_html__( 'Form', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> ''
				,'options'		=> $this->get_custom_post_options( 'mc4wp-form' )			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'title'
            ,array(
                'label' 		=> esc_html__( 'Title', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXTAREA
                ,'default' 		=> ''		
                ,'description' 	=> ''
            )
        );

		$this->add_control(
            'intro_text'
            ,array(
                'label' 		=> esc_html__( 'Intro text', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXTAREA
                ,'default' 		=> ''		
                ,'description' 	=> ''
            )
        );
		
		$this->add_responsive_control(
            'ts_alignment'
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
				'label' 	=> esc_html__( 'Title Typography', 'themesky' )
				,'name' 	=> 'title_typography'
				,'selector'	=> '{{WRAPPER}} .mailchimp-subscription .widget-title'
				,'fields_options'	=> array(
					'font_size'	=> array(
						'default'	=> array(
							'size' 	=> '30'
							,'unit' => 'px'
						)
						,'size_units' => array( 'px', 'em', 'rem', 'vw' )
					)
				)
				,'exclude'	=> array('font_family', 'text_transform', 'font_style', 'text_decoration', 'line_height', 'letter_spacing', 'word_spacing')
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type()
			,array(
				'label' 	=> esc_html__( 'Intro Text Typography', 'themesky' )
				,'name' 	=> 'intro_typography'
				,'selector'	=> '{{WRAPPER}} .mailchimp-subscription .newsletter'
				,'fields_options'	=> array(
					'font_size'	=> array(
						'default'	=> array(
							'size' 	=> '15'
							,'unit' => 'px'
						)
						,'size_units' => array( 'px', 'em', 'rem', 'vw' )
					)
				)
				,'exclude'	=> array('font_family', 'font_weight', 'text_transform', 'font_style', 'text_decoration', 'line_height', 'letter_spacing', 'word_spacing')
			)
		);
		
		$this->add_control(
            'title_color'
            ,array(
                'label'     	=> esc_html__( 'Title Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .mailchimp-subscription .widget-title' => 'color: {{VALUE}}'
				)
				,'separator'	=> 'before'
            )
        );
		
		$this->add_control(
            'intro_color'
            ,array(
                'label'     	=> esc_html__( 'Intro Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .mailchimp-subscription .newsletter' => 'color: {{VALUE}}'
				)
            )
        );
		
		$this->add_control(
            'input_background'
            ,array(
                'label'     	=> esc_html__( 'Input Background Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .mc4wp-form .subscribe-email input[type="email"]' => 'background: {{VALUE}}; border-color: {{VALUE}}'
				)
				,'separator'	=> 'before'
            )
        );
		
		$this->add_control(
            'input_color'
            ,array(
                'label'     	=> esc_html__( 'Input Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .mc4wp-form .subscribe-email input[type="email"]' => 'color: {{VALUE}}'
				)
            )
        );
		
		$this->add_control(
            'button_background'
            ,array(
                'label'     	=> esc_html__( 'Button Background Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .mc4wp-form .subscribe-email .button' => 'background: {{VALUE}}; border-color: {{VALUE}}'
				)
				,'separator'	=> 'before'
            )
        );
		
		$this->add_control(
            'button_color'
            ,array(
                'label'     	=> esc_html__( 'Button Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .mc4wp-form .subscribe-email .button' => 'color: {{VALUE}}'
				)
            )
        );
		
		$this->add_control(
            'button_hover_background'
            ,array(
                'label'     	=> esc_html__( 'Button Hover Background Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .mc4wp-form .subscribe-email .button:hover' => 'background: {{VALUE}}; border-color: {{VALUE}}'
				)
            )
        );
		
		$this->add_control(
            'button_hover_color'
            ,array(
                'label'     	=> esc_html__( 'Button Hover Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> ''
				,'selectors'	=> array(
					'{{WRAPPER}} .mc4wp-form .subscribe-email .button:hover' => 'color: {{VALUE}}'
				)
            )
        );
		
		$this->add_control(
            'custom_spacing'
            ,array(
                'label' 		=> esc_html__( 'Custom Spacing', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )			
                ,'description' 	=> ''
                ,'separator' 	=> 'before'
            )
        );
		
		$this->add_responsive_control(
			'title_spacing'
			,array(
				'label' => esc_html__( 'Title Spacing (px)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'range' => array(
					'px' => array(
						'min' => 0
						,'max' => 100
					)
				)
				,'condition'	=> array( 'custom_spacing' => '1' )
				,'selectors' => array(
					'{{WRAPPER}} .mailchimp-subscription .widget-title-wrapper' => 'margin-bottom: {{SIZE}}px;'
				)
			)
		);
		
		$this->add_responsive_control(
			'intro_spacing'
			,array(
				'label' => esc_html__( 'Intro Text Spacing (px)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'range' => array(
					'px' => array(
						'min' => 0
						,'max' => 100
					)
				)
				,'condition'	=> array( 'custom_spacing' => '1' )
				,'selectors' => array(
					'{{WRAPPER}} .mailchimp-subscription .newsletter' => 'margin-bottom: {{SIZE}}px;'
				)
			)
		);

		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'title'				=> ''
			,'intro_text'		=> ''
			,'form'				=> ''
			,'ts_alignment'		=> ''
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		if( !class_exists('TS_Mailchimp_Subscription_Widget') ){
			return;
		}
		
		$args = array(
			'before_widget' => '<section class="widget-container %s">'
			,'after_widget' => '</section>'
			,'before_title' => '<div class="widget-title-wrapper"><h3 class="widget-title heading-title">'
			,'after_title'  => '</h3></div>'
		);

		$title = wp_kses($title, array('br' => array()));
		$instance = compact('title', 'intro_text', 'form');
		
		$classes = array();
		
		echo '<div class="ts-mailchimp-subscription-shortcode '.implode(' ', $classes).'" >';
		
		the_widget('TS_Mailchimp_Subscription_Widget', $instance, $args);
		
		echo '</div>';
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Mailchimp() );