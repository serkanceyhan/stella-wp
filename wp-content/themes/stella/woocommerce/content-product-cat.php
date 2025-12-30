<?php

/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$show_cat_title = isset($show_title) ? $show_title : true;
$cat_style = isset($style) ? $style : 'default';
$show_cat_product_count = isset($show_product_count) ? $show_product_count : true;
$cat_view_shop_button_text = isset($view_shop_button_text) ? $view_shop_button_text : '';

$term_link = get_term_link( $category, 'product_cat' );

// Kategori meta verilerini alın
$is_collection = get_term_meta($category->term_id, 'is_collection', true);
$slider_images = get_term_meta($category->term_id, 'slider_images', true);
$slider_images = !empty($slider_images) ? explode(',', $slider_images) : array();

?>
<section <?php wc_product_cat_class('product-category product', $category); ?>>
    
    <div class="product-wrapper">
        <?php do_action('woocommerce_before_subcategory', $category); ?>
        
        <a href="<?php echo esc_url($term_link) ?>">
            <?php
            do_action('woocommerce_before_subcategory_title', $category);
            ?>
        </a>

        <?php if ($is_collection && !empty($slider_images)) : ?>
            <div id="category-slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($slider_images as $index => $image_url) : ?>
                        <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
                            <img src="<?php echo esc_url(trim($image_url)); ?>" class="d-block w-100" alt="...">
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#category-slider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only"><?php _e('Previous', 'your-textdomain'); ?></span>
                </a>
                <a class="carousel-control-next" href="#category-slider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only"><?php _e('Next', 'your-textdomain'); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <div class="meta-wrapper">
            <div class="category-name">
                <?php if ($show_cat_title) { ?>
                    <h3 class="heading-title">
                        <a href="<?php echo esc_url($term_link) ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </h3>
                <?php } ?>
            </div>
            
            <?php if ($show_cat_product_count) {
                echo apply_filters('woocommerce_subcategory_count_html', '<span class="count">' . sprintf(_n("%s product", "%s products", $category->count, 'stella'), $category->count) . '</span>', $category);
            } ?>
            
            <?php if ($cat_view_shop_button_text) { ?>
                <div class="shop-now-button">
                    <a href="<?php echo esc_url($term_link) ?>" class="button button-text">
                        <?php echo esc_html($cat_view_shop_button_text); ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        
        <?php
            do_action('woocommerce_after_subcategory_title', $category);
        ?>

        <?php do_action('woocommerce_after_subcategory', $category); ?>
        
        <?php if ($cat_style == 'img-large') { ?>
            <a href="<?php echo esc_url($term_link) ?>" class="term-link"></a>
        <?php } ?>
    </div>
</section>
