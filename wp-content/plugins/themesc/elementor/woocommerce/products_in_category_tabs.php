<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Products_In_Category_Tabs extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-products-in-category-tabs';
    }
	
	public function get_title(){
        return esc_html__( 'TS Products In Category Tabs', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'woocommerce-elements' );
    }
	
	public function get_icon(){
		return 'eicon-product-tabs';
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
				,'label_block' 	=> true
            )
        );
		
		$this->add_control(
            'parent_cat'
            ,array(
                'label' 		=> esc_html__( 'Parent category', 'themesky' )
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
				,'description' 	=> esc_html__( 'Each tab will be a sub category of this category. This option is available when the Product categories option is empty', 'themesky' )
            )
        );
		
		$this->add_control(
            'include_children'
            ,array(
                'label' 		=> esc_html__( 'Include children', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )				
                ,'description' 	=> esc_html__( 'Load the products of sub categories in each tab', 'themesky' )
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
				,'separator'	=> 'before'
            )
        );

		$this->add_control(
            'shop_more_button_text'
            ,array(
                'label' 		=> esc_html__( 'Shop more button label', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> 'See All'		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_general_tab'
            ,array(
                'label' 		=> esc_html__( 'Show general tab', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )			
                ,'description' 	=> esc_html__( 'Get products from all categories or sub categories', 'themesky' )
				,'separator'	=> 'before'
            )
        );
		
		$this->add_control(
            'general_tab_heading'
            ,array(
                'label' 		=> esc_html__( 'General tab heading', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> ''		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'product_type_general_tab'
            ,array(
                'label' 		=> esc_html__( 'Product type of general tab', 'themesky' )
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
            'show_shop_more_general_tab'
            ,array(
                'label' 		=> esc_html__( 'Show shop more button in general tab', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'
				,'label_on'		=> 	esc_html__( 'Yes', 'themesky' )
				,'label_off'	=> 	esc_html__( 'No', 'themesky' )			
                ,'description' 	=> ''
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
		
		$this->add_product_slider_controls();
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
        $default = array(
			'title'							=> ''
			,'title_alignment' 				=> ''
			,'product_type'					=> 'recent'
			,'columns' 						=> 4
			,'limit' 						=> 4
			,'product_cats'					=> array()
			,'parent_cat' 					=> array()
			,'include_children' 			=> 0
			,'show_general_tab' 			=> 0
			,'general_tab_heading' 			=> ''
			,'product_type_general_tab' 	=> 'recent'
			,'show_image' 					=> 1
			,'show_title' 					=> 1
			,'show_sku' 					=> 0
			,'show_price' 					=> 1
			,'show_short_desc'  			=> 0
			,'show_rating' 					=> 0
			,'show_label' 					=> 1
			,'show_categories'				=> 0
			,'show_brands'					=> 1			
			,'show_add_to_cart' 			=> 1
			,'show_color_swatch' 			=> 0
			,'number_color_swatch' 			=> 3
			,'show_shop_more_button' 		=> 0
			,'show_shop_more_general_tab' 	=> 0
			,'shop_more_button_text' 		=> 'See all'
			,'is_slider' 					=> 0
			,'only_slider_mobile'			=> 0
			,'rows' 						=> 1
			,'show_nav' 					=> 1
			,'auto_play' 					=> 1
		);
		
		$settings = wp_parse_args( $settings, $default );
		extract( $settings );
		
		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		$is_elementor_editor = ( isset($_GET['action']) && $_GET['action'] == 'elementor' ) || wp_doing_ajax();
		
		$product_cats = implode(',', $product_cats);
		$parent_cat = is_array($parent_cat) ? implode('', $parent_cat) : $parent_cat;
		
		if( !$product_cats && !$parent_cat ){
			if( $is_elementor_editor ){
				esc_html_e( 'Please select at least one product category', 'themesky' );
			}
			return;
		}
		
		if( !$product_cats ){
			$args = array(
				'taxonomy'	=> 'product_cat'
				,'parent'	=> $parent_cat
				,'fields'	=> 'ids'
				,'orderby'	=> 'none'
			);

			$sub_cats = get_terms($args);

			if( is_array($sub_cats) && !empty($sub_cats) ){
				$product_cats = implode(',', $sub_cats);
			}
			else{
				if( $is_elementor_editor ){
					esc_html_e( 'The selected parent category does not have children', 'themesky' );
				}
				return;
			}
		}
		else{
			$parent_cat = '';
		}
		
		if( $only_slider_mobile && !wp_is_mobile() ){
			$is_slider = 0;
		}
		if ( wp_is_mobile() ) {
    		$columns = 1;   // WooCommerce grid ve data-columns için
    		$rows    = 2;   // Slider'da her slaytta 1 ürün
}
		
		$atts = compact('product_type', 'columns', 'rows', 'limit' ,'product_cats', 'include_children'
						,'show_image', 'show_title', 'show_sku', 'show_price', 'show_short_desc', 'show_rating', 'show_label' ,'show_categories', 'show_brands', 'show_add_to_cart', 'show_color_swatch', 'number_color_swatch'
						,'show_shop_more_button', 'show_shop_more_general_tab', 'show_general_tab', 'product_type_general_tab', 'is_slider', 'show_nav', 'auto_play');
		
		$classes = array();
		$classes[] = 'ts-product-in-category-tab-wrapper ts-shortcode ts-product';
		$classes[] = $product_type;
		
		if( $show_color_swatch ){
			$classes[] = 'show-color-swatch';
		}
		
		if( $is_slider ){
			$classes[] = 'ts-slider';
			$classes[] = 'rows-'.$rows;
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
		
		$current_cat = '';
		$is_general_tab = false;
		$shop_more_link = '#';
		
		$rand_id = 'ts-product-in-category-tab-' . mt_rand(0, 1000);
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="<?php echo esc_attr($rand_id) ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>" <?php echo implode(' ', $data_attr); ?>>
			
			<div class="column-tabs">
				<div class="list-categories">
					<?php if( $title ): ?>
					<header class="heading-tab">
						<h2 class="heading-title">
							<?php echo esc_html($title); ?>
						</h2>
					</header>
					<?php endif; ?>
					
					<ul class="tabs mobile-scroll-tabs">
					<?php
					if( $show_general_tab ){
						if( $parent_cat ){
							$current_cat = $parent_cat;
							$shop_more_link = get_term_link((int)$parent_cat, 'product_cat');
							if( is_wp_error($shop_more_link) ){
								$shop_more_link = wc_get_page_permalink('shop');
							}
						}
						else{
							$current_cat = $product_cats;
							$shop_more_link = wc_get_page_permalink('shop');
						}
						$is_general_tab = true;
					?>
						<li class="tab-item general-tab current" data-product_cat="<?php echo esc_attr( $current_cat ); ?>" data-link="<?php echo esc_url($shop_more_link) ?>">
							<span><?php echo esc_html($general_tab_heading) ?></span>
						</li>
					<?php
					}

					$product_cats = array_map('trim', explode(',', $product_cats));
					foreach( $product_cats as $k => $product_cat ):
						$term = get_term_by( 'term_id', $product_cat, 'product_cat');
						if( !isset($term->name) ){
							continue;
						}
						
						$current_tab = false;
						if( $current_cat == '' ){
							$current_tab = true;
							$current_cat = $product_cat;
							$shop_more_link = get_term_link($term, 'product_cat');
						}
					?>
						<li class="tab-item <?php echo ($current_tab)?'current':''; ?>" data-product_cat="<?php echo esc_attr($product_cat) ?>" data-link="<?php echo esc_url(get_term_link($term, 'product_cat')) ?>">
							<span><?php echo esc_html($term->name) ?></span>
						</li>
					<?php
					endforeach;
					?>
					</ul>
				</div>
			</div>

			<div class="column-content">
				<div class="column-products woocommerce columns-<?php echo esc_attr($columns) ?> <?php echo $is_slider?'loading':''; ?>">
					<?php 
						ts_get_product_content_in_category_tab($atts, $current_cat, $is_general_tab);
					?>
				</div>
				
				<?php if( $show_shop_more_button ): ?>
				<div class="shop-more">
					<a class="shop-more-button" href="<?php echo esc_url($shop_more_link) ?>"><?php echo esc_html($shop_more_button_text) ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<style>
		/* === Tek satır + yatay scroll'u ZORLA (mobil) === */
@media (max-width: 768px) {
  /* UL mutlaka flex-row ve nowrap olsun */
  .column-tabs .list-categories ul.tabs,
  .column-tabs .list-categories ul.tabs.mobile-scroll-tabs {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    gap: 12px !important;

    overflow-x: auto !important;
    overflow-y: hidden !important;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: smooth;
    scroll-snap-type: x proximity;
  }

  /* LI’lar satır içi eleman gibi davransın, 100% genişlik alma */
  .column-tabs .list-categories ul.tabs > li.tab-item {
    flex: 0 0 auto !important;
    width: auto !important;
    display: inline-flex !important;
    list-style: none;
    scroll-snap-align: start;
  }

  /* Etiketler tek satır kalsın */
  .column-tabs .list-categories ul.tabs > li.tab-item > span {
    display: inline-block !important;
    white-space: nowrap !important;
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    line-height: 1;
  }

  /* İsteğe bağlı aktif görünüm */
  .column-tabs .list-categories ul.tabs > li.tab-item.current > span {
    background: #111827; color: #fff; border-color: #111827;
  }

  /* Scrollbar gizle (opsiyonel) */
  .column-tabs .list-categories ul.tabs::-webkit-scrollbar { display: none; }
  .column-tabs .list-categories ul.tabs { scrollbar-width: none; }
}
			
			/* Mobilde ilk öğenin yarım kalmasını kesin çözer */
@media (max-width: 768px) {
  /* Soldaki/sağdaki fade'i kapat */
  .column-tabs .list-categories::before,
  .column-tabs .list-categories::after {
    display: none !important;
  }

  /* UL: tek satır + yatay scroll + güvenli iç boşluk */
  .column-tabs .list-categories ul.tabs {
    display: flex !important;
    flex-wrap: nowrap !important;
    gap: 12px !important;

    margin-left: 0 !important;
    margin-right: 0 !important;

    padding-left: 16px !important;   /* ilk chip kesilmesin */
    padding-right: 16px !important;  /* son chip kesilmesin */
    scroll-padding-left: 16px !important;
    scroll-padding-right: 16px !important;

    overflow-x: auto !important;
    overflow-y: hidden !important;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: smooth;
    position: relative; z-index: 2;  /* olası overlay'lere karşı */
  }

  /* LI'lar genişlemesin, tek satırda kalsın */
  .column-tabs .list-categories ul.tabs > li.tab-item {
    flex: 0 0 auto !important;
    width: auto !important;
    display: inline-flex !important;
    list-style: none;
  }

  /* Aktif: içi dolu (zaten tamam ama garanti altına alalım) */
  .column-tabs .list-categories ul.tabs > li.tab-item.current > span {
        background: #111827 !important;
        color: #fff !important;
        border-color: #111827 !important;
  }
}
			
}
			
			/* === Mobilde her satırda 1 ürün === */
@media (max-width: 768px) {

  /* Slayt: ekranda 1 slayt (Swiper inline width'ünü ezer) */
  .ts-product-in-category-tab-wrapper .swiper-slide {
    width: 100% !important;
    flex: 0 0 100% !important;
  }

  /* Slayt içindeki ürün grubu: 2 sütun yerine tek sütun */
  .ts-product-in-category-tab-wrapper .product-group {
    display: block !important;
  }

  /* Her ürün kartı tam genişlik olsun, yan yana gelmesin */
  .ts-product-in-category-tab-wrapper .product-group .product {
    width: 100% !important;
    max-width: none !important;
    float: none !important;
    display: block !important;
  }

  /* Ürünler arası dikey boşluk */
  .ts-product-in-category-tab-wrapper .product-group .product + .product {
    margin-top: 16px;
  }

  /* WooCommerce columns-* sınıfları varsa hepsini tek sütuna indir */
  .ts-product-in-category-tab-wrapper .woocommerce.columns-2 .product,
  .ts-product-in-category-tab-wrapper .woocommerce.columns-3 .product,
  .ts-product-in-category-tab-wrapper .woocommerce.columns-4 .product,
  .ts-product-in-category-tab-wrapper .woocommerce.columns-5 .product {
    width: 100% !important;
  }
}
			
/* === Mobil: slaytta alt alta 2 ürün, her satırda 1 ürün === */
@media (max-width: 768px) {
  /* Slayt tam genişlik */
  .ts-product-in-category-tab-wrapper .swiper-slide {
    width: 100% !important;
    flex: 0 0 100% !important;
  }

  /* İki ürünü dikey istifle */
  .ts-product-in-category-tab-wrapper .product-group {
    display: grid !important;
    grid-template-columns: 1fr !important; /* tek sütun */
    gap: 16px !important;                  /* ürünler arası boşluk */
  }

  /* Ürün kartı tek satır kaplasın */
  .ts-product-in-category-tab-wrapper .product-group .product {
    width: 100% !important;
    max-width: none !important;
    float: none !important;
    display: block !important;
  }

  /* Woo columns-* kalıntıları varsa etkisizleştir */
  .ts-product-in-category-tab-wrapper .woocommerce[class*="columns-"] .product {
    width: 100% !important;
  }
}
			



		</style>

		
<script>
(function(){
  var root = document.getElementById(<?php echo wp_json_encode($rand_id); ?>);
  if (!root) return;
  var ul = root.querySelector('.list-categories .mobile-scroll-tabs');
  if (!ul) return;

  // SADECE MOBİLDE aktif et -> masaüstünde tema/sekme tıklamaları aynen kalsın
  var isMobile = window.matchMedia('(max-width: 768px)').matches;
  if (!isMobile) return;

  // Erişilebilirlik
  ul.tabIndex = 0;

  // Sürükleyerek kaydırma (click iptali YOK)
  var isDown = false, startX = 0, startLeft = 0, pid = null;

  ul.addEventListener('pointerdown', function(e){
    isDown = true; pid = e.pointerId;
    ul.setPointerCapture(pid);
    startX = e.clientX;
    startLeft = ul.scrollLeft;
    ul.style.scrollSnapType = 'none';
  });

  ul.addEventListener('pointermove', function(e){
    if (!isDown || e.pointerId !== pid) return;
    ul.scrollLeft = startLeft - (e.clientX - startX);
  });

  function endDrag(){
    if (!isDown) return;
    isDown = false; pid = null;
    setTimeout(function(){ ul.style.scrollSnapType = ''; }, 80);
  }
  ul.addEventListener('pointerup', endDrag);
  ul.addEventListener('pointercancel', endDrag);
  ul.addEventListener('mouseleave', endDrag);

  // Dikey tekeri yataya çevir (sadece mobil trackpad’de işe yarar)
  ul.addEventListener('wheel', function(e){
    if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
      ul.scrollLeft += e.deltaY;
      e.preventDefault();
    }
  }, { passive:false });

  // Yüklenince current chip’i ortaya al
  var current = ul.querySelector('.tab-item.current');
  if (current){
    requestAnimationFrame(function(){
      var ulRect = ul.getBoundingClientRect();
      var liRect = current.getBoundingClientRect();
      var offset = (liRect.left - ulRect.left) - (ulRect.width/2 - liRect.width/2);
      ul.scrollLeft += offset;
    });
  }
})();
</script>


		<?php
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Products_In_Category_Tabs() );
