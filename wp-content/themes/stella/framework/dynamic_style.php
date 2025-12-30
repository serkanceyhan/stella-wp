<?php
if( !isset($data) ){
	$data = stella_get_theme_options();
}

$default_options = array(
				'ts_layout_fullwidth'			=> 0
				,'ts_logo_width'				=> "160"
				,'ts_device_logo_width'			=> "120"
				,'ts_header_slide_notice_timing' => "15"
				,'ts_custom_font_ttf'			=> array( 'url' => '' )
		);
		
foreach( $default_options as $option_name => $value ){
	if( isset($data[$option_name]) ){
		$default_options[$option_name] = $data[$option_name];
	}
}

extract($default_options);
		
$default_colors = array(
				'ts_main_content_background_color'				=>	'#ffffff'
				,'ts_primary_color'								=>	'#d10202'
				,'ts_text_color_in_bg_primary'					=>	'#ffffff'
				,'ts_text_color'								=>	'#000000'
				,'ts_heading_color'								=>	'#000000'
				,'ts_gray_text_color'							=>	'#848484'
				,'ts_gray_bg_color'								=>	'#efefef'
				,'ts_text_in_gray_bg_color'						=>	'#000000'
				,'ts_dropdown_bg_color'							=>	'#ffffff'
				,'ts_dropdown_color'							=>	'#000000'
				,'ts_link_color'								=>	'#d10202'
				,'ts_link_color_hover'							=>	'#848484'
				,'ts_icon_hover_color'							=>	'#d10202'
				,'ts_tags_color'								=>	'#848484'
				,'ts_tags_background_color'						=>	'#ffffff'
				,'ts_tags_border_color'							=>	'#ebebeb'
				,'ts_blockquote_icon_color'						=>	'#959595'
				,'ts_blockquote_text_color'						=>	'#000000'
				,'ts_border_color'								=>	'#ebebeb'
				,'ts_input_text_color'							=>	'#000000'
				,'ts_input_background_color'					=>	'#ffffff'
				,'ts_input_border_color'						=>	'#ebebeb'
				,'ts_button_text_color'							=>	'#ffffff'
				,'ts_button_background_color'					=>	'#000000'
				,'ts_button_border_color'						=>	'#000000'
				,'ts_button_text_hover_color'					=>	'#ffffff'
				,'ts_button_background_hover_color'				=>	'#d10202'
				,'ts_button_border_hover_color'					=>	'#d10202'
				,'ts_button_thumbnail_text_color'				=>	'#000000'
				,'ts_button_thumbnail_bg_color'					=>	'#ffffff'
				,'ts_button_thumbnail_hover_text_color'			=>	'#ffffff'
				,'ts_button_thumbnail_hover_bg_color'			=>	'#d10202'
				,'ts_breadcrumb_background_color'				=>	'#ffffff'
				,'ts_breadcrumb_text_color'						=>	'#000000'
				,'ts_breadcrumb_link_color'						=>	'#848484'
				,'ts_header_top_background_color'				=>	'#000000'
				,'ts_header_top_text_color'						=>	'#ffffff'
				,'ts_header_top_border_color'					=>	'#000000'
				,'ts_header_top_link_hover_color'				=>	'#848484'
				,'ts_header_top_icon_count_background_color'	=>	'#ffffff'
				,'ts_header_top_icon_count_text_color'			=>	'#000000'
				,'ts_header_middle_background_color'			=>	'#ffffff'
				,'ts_header_middle_text_color'					=>	'#000000'
				,'ts_header_middle_border_color'				=>	'#d6d6d6'
				,'ts_header_middle_link_hover_color'			=>	'#848484'
				,'ts_header_icon_count_background_color'		=>	'#000000'
				,'ts_header_icon_count_text_color'				=>	'#ffffff'
				,'ts_header_bottom_background_color'			=>	'#ffffff'
				,'ts_header_bottom_text_color'					=>	'#000000'
				,'ts_header_bottom_border_color'				=>	'#d6d6d6'
				,'ts_header_bottom_link_hover_color'			=>	'#848484'
				,'ts_footer_background_color'					=>	'#ffffff'
				,'ts_footer_text_color'							=>	'#848484'
				,'ts_footer_link_hover_color'					=>	'#d10202'
				,'ts_footer_border_color'						=>	'#d6d6d6'
				,'ts_rating_color'								=>	'#000000'
				,'ts_product_price_color'						=>	'#000000'
				,'ts_product_sale_price_color'					=>	'#848484'
				,'ts_product_sale_label_text_color'				=>	'#ffffff'
				,'ts_product_sale_label_background_color'		=>	'#000000'
				,'ts_product_new_label_text_color'				=>	'#ffffff'
				,'ts_product_new_label_background_color'		=>	'#ffa632'
				,'ts_product_feature_label_text_color'			=>	'#ffffff'
				,'ts_product_feature_label_background_color'	=>	'#d10202'
				,'ts_product_outstock_label_text_color'			=>	'#ffffff'
				,'ts_product_outstock_label_background_color'	=>	'#919191'
				,'ts_product_meta_label_text_color'				=>	'#d10202'
);

$data = apply_filters('stella_custom_style_data', $data);

foreach( $default_colors as $option_name => $default_color ){
	if( isset($data[$option_name]['rgba']) ){
		$default_colors[$option_name] = $data[$option_name]['rgba'];
	}
	else if( isset($data[$option_name]['color']) ){
		$default_colors[$option_name] = $data[$option_name]['color'];
	}
}

extract( $default_colors );

/* Parse font option. Ex: if option name is ts_body_font, we will have variables below:
* ts_body_font (font-family)
* ts_body_font_weight
* ts_body_font_style
* ts_body_font_size
* ts_body_font_line_height
* ts_body_font_letter_spacing
*/
$font_option_names = array(
							'ts_body_font',
							'ts_body_font_medium',
							'ts_body_font_bold',
							'ts_heading_font',
							'ts_menu_font',
							'ts_sidebar_menu_font',
							'ts_mobile_menu_font',
							'ts_button_font',
							);
$font_size_option_names = array( 
							'ts_h1_font', 
							'ts_h2_font', 
							'ts_h3_font', 
							'ts_h4_font', 
							'ts_h5_font', 
							'ts_h6_font',
							'ts_sub_menu_font',
							'ts_sidebar_submenu_font',
							'ts_blockquote_font',
							'ts_single_product_price_font',
							'ts_single_product_sale_price_font',
							'ts_h1_ipad_font', 
							'ts_h2_ipad_font', 
							'ts_h3_ipad_font', 
							'ts_h4_ipad_font',
							'ts_h5_ipad_font',
							'ts_h6_ipad_font',
							'ts_sidebar_menu_ipad_font',
							'ts_sidebar_submenu_ipad_font',
							'ts_single_product_price_ipad_font',
							'ts_single_product_sale_price_ipad_font',
							'ts_h1_mobile_font',
							'ts_h2_mobile_font',
							'ts_h3_mobile_font',
							'ts_h4_mobile_font',
							'ts_h5_mobile_font',
							'ts_h6_mobile_font',
							);
$font_option_names = array_merge($font_option_names, $font_size_option_names);
foreach( $font_option_names as $option_name ){
	$default = array(
		$option_name 						=> 'inherit'
		,$option_name . '_weight' 			=> 'normal'
		,$option_name . '_style' 			=> 'normal'
		,$option_name . '_size' 			=> 'inherit'
		,$option_name . '_line_height' 		=> 'inherit'
		,$option_name . '_letter_spacing' 	=> 'inherit'
		,$option_name . '_transform' 		=> 'inherit'
	);
	if( is_array($data[$option_name]) ){
		if( !empty($data[$option_name]['font-family']) ){
			$default[$option_name] = $data[$option_name]['font-family'];
		}
		if( !empty($data[$option_name]['font-weight']) ){
			$default[$option_name . '_weight'] = $data[$option_name]['font-weight'];
		}
		if( !empty($data[$option_name]['font-style']) ){
			$default[$option_name . '_style'] = $data[$option_name]['font-style'];
		}
		if( !empty($data[$option_name]['font-size']) ){
			$default[$option_name . '_size'] = $data[$option_name]['font-size'];
		}
		if( !empty($data[$option_name]['line-height']) ){
			$default[$option_name . '_line_height'] = $data[$option_name]['line-height'];
		}
		if( !empty($data[$option_name]['letter-spacing']) ){
			$default[$option_name . '_letter_spacing'] = $data[$option_name]['letter-spacing'];
		}
		if( !empty($data[$option_name]['text-transform']) ){
			$default[$option_name . '_transform'] = $data[$option_name]['text-transform'];
		}
	}
	extract( $default );
}

/* Custom Font */
if( isset($ts_custom_font_ttf) && $ts_custom_font_ttf['url'] ):
?>
@font-face {
	font-family: 'CustomFont';
	src:url('<?php echo esc_url($ts_custom_font_ttf['url']); ?>') format('truetype');
	font-weight: normal;
	font-style: normal;
}
<?php endif; ?>	
	
:root{
	--stella-logo-width: <?php echo absint($ts_logo_width); ?>px;
	--stella-logo-device-width: <?php echo absint($ts_device_logo_width); ?>px;
	
	<?php if( $ts_header_slide_notice_timing ): ?>
	--stella-marquee-timing: <?php echo esc_html($ts_header_slide_notice_timing); ?>s;
	<?php endif; ?>
	
	--stella-main-font-family: <?php echo esc_html($ts_body_font); ?>;
	--stella-main-font-style: <?php echo esc_html($ts_body_font_style); ?>;
	--stella-main-font-weight: <?php echo esc_html($ts_body_font_weight); ?>;
	--stella-main-font-medium-family: <?php echo esc_html($ts_body_font_medium); ?>;
	--stella-main-font-medium-style: <?php echo esc_html($ts_body_font_medium_style); ?>;
	--stella-main-font-medium-weight: <?php echo esc_html($ts_body_font_medium_weight); ?>;
	--stella-main-font-bold-family: <?php echo esc_html($ts_body_font_bold); ?>;
	--stella-main-font-bold-style: <?php echo esc_html($ts_body_font_bold_style); ?>;
	--stella-main-font-bold-weight: <?php echo esc_html($ts_body_font_bold_weight); ?>;
	--stella-body-font-size: <?php echo esc_html($ts_body_font_size); ?>;
	--stella-body-line-height: <?php echo esc_html($ts_body_font_line_height); ?>;
	--stella-body-letter-spacing: <?php echo esc_html($ts_body_font_letter_spacing); ?>;
	
	--stella-button-font-family: <?php echo esc_html($ts_button_font); ?>;
	--stella-button-font-style: <?php echo esc_html($ts_button_font_style); ?>;
	--stella-button-font-weight: <?php echo esc_html($ts_button_font_weight); ?>;
	--stella-button-transform: <?php echo esc_html($ts_button_font_transform); ?>;
	--stella-button-font-size: <?php echo esc_html($ts_button_font_size); ?>;
	--stella-button-letter-spacing: <?php echo esc_html($ts_button_font_letter_spacing); ?>;
	
	--stella-menu-font-family: <?php echo esc_html($ts_menu_font); ?>;
	--stella-menu-font-style: <?php echo esc_html($ts_menu_font_style); ?>;
	--stella-menu-font-weight: <?php echo esc_html($ts_menu_font_weight); ?>;
	--stella-menu-font-size: <?php echo esc_html($ts_menu_font_size); ?>;
	--stella-menu-line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
	--stella-submenu-font-size: <?php echo esc_html($ts_sub_menu_font_size); ?>;
	--stella-submenu-line-height: <?php echo esc_html($ts_sub_menu_font_line_height); ?>;
	
	--stella-sidebar-menu-font-family: <?php echo esc_html($ts_sidebar_menu_font); ?>;
	--stella-sidebar-menu-font-style: <?php echo esc_html($ts_sidebar_menu_font_style); ?>;
	--stella-sidebar-menu-font-weight: <?php echo esc_html($ts_sidebar_menu_font_weight); ?>;
	--stella-sidebar-menu-font-size: <?php echo esc_html($ts_sidebar_menu_font_size); ?>;
	--stella-sidebar-menu-line-height: <?php echo esc_html($ts_sidebar_menu_font_line_height); ?>;
	--stella-sidebar-submenu-font-size: <?php echo esc_html($ts_sidebar_submenu_font_size); ?>;
	--stella-sidebar-submenu-line-height: <?php echo esc_html($ts_sidebar_submenu_font_line_height); ?>;
	--stella-sidebar-menu-ipad-font-size: <?php echo esc_html($ts_sidebar_menu_ipad_font_size); ?>;
	--stella-sidebar-menu-ipad-line-height: <?php echo esc_html($ts_sidebar_menu_ipad_font_line_height); ?>;
	--stella-sidebar-submenu-ipad-font-size: <?php echo esc_html($ts_sidebar_submenu_ipad_font_size); ?>;
	--stella-sidebar-submenu-ipad-line-height: <?php echo esc_html($ts_sidebar_submenu_ipad_font_line_height); ?>;
	
	--stella-mobile-menu-font-family: <?php echo esc_html($ts_sidebar_menu_font); ?>;
	--stella-mobile-menu-font-style: <?php echo esc_html($ts_sidebar_menu_font_style); ?>;
	--stella-mobile-menu-font-weight: <?php echo esc_html($ts_sidebar_menu_font_weight); ?>;
	--stella-mobile-menu-font-size: <?php echo esc_html($ts_mobile_menu_font_size); ?>;
	--stella-mobile-menu-line-height: <?php echo esc_html($ts_mobile_menu_font_line_height); ?>;
	
	--stella-blockquote-font-size: <?php echo esc_html($ts_blockquote_font_size); ?>;
	--stella-single-product-price-font-size: <?php echo esc_html($ts_single_product_price_font_size); ?>;
	--stella-single-product-sale-price-font-size: <?php echo esc_html($ts_single_product_sale_price_font_size); ?>;
	--stella-single-product-price-ipad-font-size: <?php echo esc_html($ts_single_product_price_ipad_font_size); ?>;
	--stella-single-product-sale-price-ipad-font-size: <?php echo esc_html($ts_single_product_sale_price_ipad_font_size); ?>;
	
	--stella-heading-font-family: <?php echo esc_html($ts_heading_font); ?>;
	--stella-heading-font-style: <?php echo esc_html($ts_heading_font_style); ?>;
	--stella-heading-font-weight: <?php echo esc_html($ts_heading_font_weight); ?>;
	--stella-h1-font-size: <?php echo esc_html($ts_h1_font_size); ?>;
	--stella-h1-line-height: <?php echo esc_html($ts_h1_font_line_height); ?>;
	--stella-h1-letter-spacing: <?php echo esc_html($ts_h1_font_letter_spacing); ?>;
	--stella-h2-font-size: <?php echo esc_html($ts_h2_font_size); ?>;
	--stella-h2-line-height: <?php echo esc_html($ts_h2_font_line_height); ?>;
	--stella-h2-letter-spacing: <?php echo esc_html($ts_h2_font_letter_spacing); ?>;
	--stella-h3-font-size: <?php echo esc_html($ts_h3_font_size); ?>;
	--stella-h3-line-height: <?php echo esc_html($ts_h3_font_line_height); ?>;
	--stella-h3-letter-spacing: <?php echo esc_html($ts_h3_font_letter_spacing); ?>;
	--stella-h4-font-size: <?php echo esc_html($ts_h4_font_size); ?>;
	--stella-h4-line-height: <?php echo esc_html($ts_h4_font_line_height); ?>;
	--stella-h4-letter-spacing: <?php echo esc_html($ts_h4_font_letter_spacing); ?>;
	--stella-h5-font-size: <?php echo esc_html($ts_h5_font_size); ?>;
	--stella-h5-line-height: <?php echo esc_html($ts_h5_font_line_height); ?>;
	--stella-h5-letter-spacing: <?php echo esc_html($ts_h5_font_letter_spacing); ?>;
	--stella-h6-font-size: <?php echo esc_html($ts_h6_font_size); ?>;
	--stella-h6-line-height: <?php echo esc_html($ts_h6_font_line_height); ?>;
	--stella-h6-letter-spacing: <?php echo esc_html($ts_h6_font_letter_spacing); ?>;
	--stella-h1-ipad-font-size: <?php echo esc_html($ts_h1_ipad_font_size); ?>;
	--stella-h1-ipad-line-height: <?php echo esc_html($ts_h1_ipad_font_line_height); ?>;
	--stella-h1-ipad-letter-spacing: <?php echo esc_html($ts_h1_ipad_font_letter_spacing); ?>;
	--stella-h2-ipad-font-size: <?php echo esc_html($ts_h2_ipad_font_size); ?>;
	--stella-h2-ipad-line-height: <?php echo esc_html($ts_h2_ipad_font_line_height); ?>;
	--stella-h2-ipad-letter-spacing: <?php echo esc_html($ts_h2_ipad_font_letter_spacing); ?>;
	--stella-h3-ipad-font-size: <?php echo esc_html($ts_h3_ipad_font_size); ?>;
	--stella-h3-ipad-line-height: <?php echo esc_html($ts_h3_ipad_font_line_height); ?>;
	--stella-h3-ipad-letter-spacing: <?php echo esc_html($ts_h3_ipad_font_letter_spacing); ?>;
	--stella-h4-ipad-font-size: <?php echo esc_html($ts_h4_ipad_font_size); ?>;
	--stella-h4-ipad-line-height: <?php echo esc_html($ts_h4_ipad_font_line_height); ?>;
	--stella-h4-ipad-letter-spacing: <?php echo esc_html($ts_h4_ipad_font_letter_spacing); ?>;
	--stella-h5-ipad-font-size: <?php echo esc_html($ts_h5_ipad_font_size); ?>;
	--stella-h5-ipad-line-height: <?php echo esc_html($ts_h5_ipad_font_line_height); ?>;
	--stella-h5-ipad-letter-spacing: <?php echo esc_html($ts_h5_ipad_font_letter_spacing); ?>;
	--stella-h6-ipad-font-size: <?php echo esc_html($ts_h6_ipad_font_size); ?>;
	--stella-h6-ipad-line-height: <?php echo esc_html($ts_h6_ipad_font_line_height); ?>;
	--stella-h6-ipad-letter-spacing: <?php echo esc_html($ts_h6_ipad_font_letter_spacing); ?>;
	--stella-h1-mobile-font-size: <?php echo esc_html($ts_h1_mobile_font_size); ?>;
	--stella-h1-mobile-line-height: <?php echo esc_html($ts_h1_mobile_font_line_height); ?>;
	--stella-h1-mobile-letter-spacing: <?php echo esc_html($ts_h1_mobile_font_letter_spacing); ?>;
	--stella-h2-mobile-font-size: <?php echo esc_html($ts_h2_mobile_font_size); ?>;
	--stella-h2-mobile-line-height: <?php echo esc_html($ts_h2_mobile_font_line_height); ?>;
	--stella-h2-mobile-letter-spacing: <?php echo esc_html($ts_h2_mobile_font_letter_spacing); ?>;
	--stella-h3-mobile-font-size: <?php echo esc_html($ts_h3_mobile_font_size); ?>;
	--stella-h3-mobile-line-height: <?php echo esc_html($ts_h3_mobile_font_line_height); ?>;
	--stella-h3-mobile-letter-spacing: <?php echo esc_html($ts_h3_mobile_font_letter_spacing); ?>;
	--stella-h4-mobile-font-size: <?php echo esc_html($ts_h4_mobile_font_size); ?>;
	--stella-h4-mobile-line-height: <?php echo esc_html($ts_h4_mobile_font_line_height); ?>;
	--stella-h4-mobile-letter-spacing: <?php echo esc_html($ts_h4_mobile_font_letter_spacing); ?>;
	--stella-h5-mobile-font-size: <?php echo esc_html($ts_h5_mobile_font_size); ?>;
	--stella-h5-mobile-line-height: <?php echo esc_html($ts_h5_mobile_font_line_height); ?>;
	--stella-h5-mobile-letter-spacing: <?php echo esc_html($ts_h5_mobile_font_letter_spacing); ?>;
	--stella-h6-mobile-font-size: <?php echo esc_html($ts_h6_mobile_font_size); ?>;
	--stella-h6-mobile-line-height: <?php echo esc_html($ts_h6_mobile_font_line_height); ?>;
	--stella-h6-mobile-letter-spacing: <?php echo esc_html($ts_h6_mobile_font_letter_spacing); ?>;
	
	--stella-primary-color: <?php echo esc_html($ts_primary_color); ?>;
	--stella-text-in-primary-color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	<?php if( strpos($ts_primary_color, 'rgba') !== false ): ?>
	--stella-primary-loading-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_primary_color))); ?>;
	<?php endif; ?>
	--stella-main-bg: <?php echo esc_html($ts_main_content_background_color); ?>;
	--stella-text-color: <?php echo esc_html($ts_text_color); ?>;
	--stella-heading-color: <?php echo esc_html($ts_heading_color); ?>;
	--stella-gray-color: <?php echo esc_html($ts_gray_text_color); ?>;
	--stella-gray-bg: <?php echo esc_html($ts_gray_bg_color); ?>;
	--stella-text-in-gray-bg: <?php echo esc_html($ts_text_in_gray_bg_color); ?>;
	--stella-dropdown-bg: <?php echo esc_html($ts_dropdown_bg_color); ?>;
	--stella-dropdown-color: <?php echo esc_html($ts_dropdown_color); ?>;
	--stella-link-color: <?php echo esc_html($ts_link_color); ?>;
	--stella-link-hover-color: <?php echo esc_html($ts_link_color_hover); ?>;
	--stella-icon-hover-color: <?php echo esc_html($ts_icon_hover_color); ?>;
	--stella-tag-color: <?php echo esc_html($ts_tags_color); ?>;
	--stella-tag-bg: <?php echo esc_html($ts_tags_background_color); ?>;
	--stella-tag-border: <?php echo esc_html($ts_tags_border_color); ?>;
	--stella-blockquote-icon-color: <?php echo esc_html($ts_blockquote_icon_color); ?>;
	--stella-blockquote-text-color: <?php echo esc_html($ts_blockquote_text_color); ?>;
	--stella-border: <?php echo esc_html($ts_border_color); ?>;
	
	--stella-input-color: <?php echo esc_html($ts_input_text_color); ?>;
	--stella-input-background-color: <?php echo esc_html($ts_input_background_color); ?>;
	--stella-input-border: <?php echo esc_html($ts_input_border_color); ?>;
	
	--stella-button-color: <?php echo esc_html($ts_button_text_color); ?>;
	--stella-button-bg: <?php echo esc_html($ts_button_background_color); ?>;
	--stella-button-border: <?php echo esc_html($ts_button_border_color); ?>;
	--stella-button-hover-color: <?php echo esc_html($ts_button_text_hover_color); ?>;
	--stella-button-hover-bg: <?php echo esc_html($ts_button_background_hover_color); ?>;
	--stella-button-hover-border: <?php echo esc_html($ts_button_border_hover_color); ?>;
	<?php if( strpos($ts_button_text_color, 'rgba') !== false ): ?>
	--stella-button-loading-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_button_text_color))); ?>;
	<?php endif; ?>
	<?php if( strpos($ts_button_text_hover_color, 'rgba') !== false ): ?>
	--stella-button-loading-hover-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_button_text_hover_color))); ?>;
	<?php endif; ?>
	--stella-button-thumbnail-color: <?php echo esc_html($ts_button_thumbnail_text_color); ?>;
	--stella-button-thumbnail-bg: <?php echo esc_html($ts_button_thumbnail_bg_color); ?>;
	--stella-button-thumbnail-hover-color: <?php echo esc_html($ts_button_thumbnail_hover_text_color); ?>;
	--stella-button-thumbnail-hover-bg: <?php echo esc_html($ts_button_thumbnail_hover_bg_color); ?>;
	<?php if( strpos($ts_button_thumbnail_text_color, 'rgba') !== false ): ?>
	--stella-button-thumbnail-loading-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_button_thumbnail_text_color))); ?>;
	<?php endif; ?>
	<?php if( strpos($ts_button_thumbnail_hover_text_color, 'rgba') !== false ): ?>
	--stella-button-thumbnail-loading-hover-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_button_thumbnail_hover_text_color))); ?>;
	<?php endif; ?>
	
	--stella-breadcrumb-bg: <?php echo esc_html($ts_breadcrumb_background_color); ?>;
	--stella-breadcrumb-color: <?php echo esc_html($ts_breadcrumb_text_color); ?>;
	--stella-breadcrumb-link-color: <?php echo esc_html($ts_breadcrumb_link_color); ?>;
	
	--stella-top-bg: <?php echo esc_html($ts_header_top_background_color); ?>;
	--stella-top-color: <?php echo esc_html($ts_header_top_text_color); ?>;
	--stella-top-border: <?php echo esc_html($ts_header_top_border_color); ?>;
	--stella-top-link-hover-color: <?php echo esc_html($ts_header_top_link_hover_color); ?>;
	--stella-top-cart-number-bg: <?php echo esc_html($ts_header_top_icon_count_background_color); ?>;
	--stella-top-cart-number-color: <?php echo esc_html($ts_header_top_icon_count_text_color); ?>;
	--stella-middle-bg: <?php echo esc_html($ts_header_middle_background_color); ?>;
	--stella-middle-color: <?php echo esc_html($ts_header_middle_text_color); ?>;
	--stella-middle-border: <?php echo esc_html($ts_header_middle_border_color); ?>;
	--stella-middle-link-hover-color: <?php echo esc_html($ts_header_middle_link_hover_color); ?>;
	--stella-middle-cart-number-bg: <?php echo esc_html($ts_header_icon_count_background_color); ?>;
	--stella-middle-cart-number-color: <?php echo esc_html($ts_header_icon_count_text_color); ?>;
	--stella-bottom-bg: <?php echo esc_html($ts_header_bottom_background_color); ?>;
	--stella-bottom-color: <?php echo esc_html($ts_header_bottom_text_color); ?>;
	--stella-bottom-border: <?php echo esc_html($ts_header_bottom_border_color); ?>;
	--stella-bottom-link-hover-color: <?php echo esc_html($ts_header_bottom_link_hover_color); ?>;
	
	--stella-footer-bg: <?php echo esc_html($ts_footer_background_color); ?>;
	--stella-footer-color: <?php echo esc_html($ts_footer_text_color); ?>;
	--stella-footer-link-color: <?php echo esc_html($ts_footer_link_hover_color); ?>;
	--stella-footer-border: <?php echo esc_html($ts_footer_border_color); ?>;
	
	--stella-star-color: <?php echo esc_html($ts_rating_color); ?>;
	--stella-product-price-color: <?php echo esc_html($ts_product_price_color); ?>;
	--stella-product-sale-price-color: <?php echo esc_html($ts_product_sale_price_color); ?>;
	--stella-sale-label-color: <?php echo esc_html($ts_product_sale_label_text_color); ?>;
	--stella-sale-label-bg: <?php echo esc_html($ts_product_sale_label_background_color); ?>;
	--stella-new-label-color: <?php echo esc_html($ts_product_new_label_text_color); ?>;
	--stella-new-label-bg: <?php echo esc_html($ts_product_new_label_background_color); ?>;
	--stella-hot-label-color: <?php echo esc_html($ts_product_feature_label_text_color); ?>;
	--stella-hot-label-bg: <?php echo esc_html($ts_product_feature_label_background_color); ?>;
	--stella-soldout-label-color: <?php echo esc_html($ts_product_outstock_label_text_color); ?>;
	--stella-soldout-label-bg: <?php echo esc_html($ts_product_outstock_label_background_color); ?>;
	--stella-meta-label-color: <?php echo esc_html($ts_product_meta_label_text_color); ?>;
}