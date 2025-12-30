<?php 
/** =========================================================
 *  BOOTSTRAP
 * ========================================================= */
require_once get_template_directory().'/admin/init.php';
require_once get_template_directory().'/framework/init.php';

/** =========================================================
 *  WOOCOMMERCE → FİYAT & SATIN ALMA GÖRÜNÜRLÜĞÜ
 *  - Fiyatları misafirlere gizle
 *  - Satın alma (Sepete Ekle) devre dışı
 * ========================================================= */
add_filter('woocommerce_get_price_html', 'hide_product_price');
function hide_product_price($price) {
    if ( current_user_can('manage_woocommerce') || current_user_can('administrator') ) {
        return $price;
    }
    return '';
}

add_filter('woocommerce_is_purchasable', 'disable_add_to_cart_button');
function disable_add_to_cart_button($is_purchasable) {
    // Gerekirse koşullu aç/kapat
    return false;
}

/** =========================================================
 *  WOOCOMMERCE → KATALOG SIRALAMA (BELİRLİ KATEGORİLER HARİÇ)
 * ========================================================= */
add_action('pre_get_posts', 'custom_order_products_except_some_categories');
function custom_order_products_except_some_categories($query) {
    if ( is_admin() || !$query->is_main_query() || !is_product_category() ) {
        return;
    }

    $excluded_categories = array(
        'alex-tr','cleo-tr','jasmine-tr','karen-tr','lupi-tr','minerva-tr',
        'pallas-tr','petra','soho-tr','valentino-tr','adel'
    );

    $current_category = get_queried_object();
    if ( isset($current_category->slug) && !in_array($current_category->slug, $excluded_categories, true) ) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
}

/** =========================================================
 *  WOOCOMMERCE → KATEGORİ META: "IS COLLECTION" CHECKBOX
 * ========================================================= */
add_action('product_cat_add_form_fields', 'add_collection_checkbox');
add_action('product_cat_edit_form_fields', 'edit_collection_checkbox', 10, 2);

function add_collection_checkbox() { ?>
    <div class="form-field">
        <label for="is_collection"><?php _e('Is Collection', 'woocommerce'); ?></label>
        <input type="checkbox" name="is_collection" id="is_collection" value="1">
        <p class="description"><?php _e('Check if this category is a collection.', 'woocommerce'); ?></p>
    </div>
<?php }

function edit_collection_checkbox($term, $taxonomy) {
    $is_collection = get_term_meta($term->term_id, 'is_collection', true); ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="is_collection"><?php _e('Is Collection', 'woocommerce'); ?></label></th>
        <td>
            <input type="checkbox" name="is_collection" id="is_collection" value="1" <?php checked($is_collection, 1); ?>>
            <p class="description"><?php _e('Check if this category is a collection.', 'woocommerce'); ?></p>
        </td>
    </tr>
<?php }

add_action('created_term', 'save_collection_checkbox', 10, 3);
add_action('edit_term', 'save_collection_checkbox', 10, 3);
function save_collection_checkbox($term_id, $tt_id, $taxonomy) {
    if ( isset($_POST['is_collection']) ) {
        update_term_meta($term_id, 'is_collection', 1);
    } else {
        delete_term_meta($term_id, 'is_collection');
    }
}

/** =========================================================
 *  WOOCOMMERCE → KATEGORİ SLIDER ALANI
 * ========================================================= */
add_action('product_cat_edit_form_fields', 'add_category_slider_fields');
function add_category_slider_fields($term) {
    $slider_images = get_term_meta($term->term_id, 'slider_images', true); ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="slider_images"><?php _e('Slider Images', 'your-textdomain'); ?></label></th>
        <td>
            <textarea name="slider_images" id="slider_images" rows="5" cols="50"><?php echo esc_textarea($slider_images); ?></textarea>
            <p class="description"><?php _e('Enter comma-separated URLs of images for the slider.', 'your-textdomain'); ?></p>
        </td>
    </tr>
<?php }

add_action('edited_product_cat', 'save_category_slider_fields');
function save_category_slider_fields($term_id) {
    if ( isset($_POST['slider_images']) ) {
        update_term_meta($term_id, 'slider_images', sanitize_textarea_field($_POST['slider_images']));
    }
}

/** =========================================================
 *  WOOCOMMERCE → WIDGET TEMİZLİĞİ
 * ========================================================= */
add_action('widgets_init', 'remove_woocommerce_widgets', 15);
function remove_woocommerce_widgets() {
    unregister_widget('WC_Widget_Archives');
    unregister_widget('WC_Widget_Categories');
    unregister_widget('WC_Widget_Pages'); // Not: Bu WooCommerce'ta yoksa etkisiz kalır.
}

/** =========================================================
 *  WOOCOMMERCE → ARAYÜZ DOKUNUŞLARI
 *  - "Ürün Detayı" metni
 *  - Katalog sıralama dropdown'unu kaldır
 *  - Ürün sekmeleri sırası ve varsayılan aktif sekme
 * ========================================================= */
add_filter('woocommerce_product_add_to_cart_text', 'custom_read_more_text');
function custom_read_more_text() {
    return __('Ürün Detayı', 'your-text-domain');
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_filter('woocommerce_product_tabs', 'custom_woocommerce_product_tabs', 98);
function custom_woocommerce_product_tabs($tabs) {
    if ( isset($tabs['ts_custom']) ) {
        $tabs['ts_custom']['priority'] = 5; // Boyut
    }
    if ( isset($tabs['additional_information']) ) {
        $tabs['additional_information']['priority'] = 10; // Materyal & Renk
    }
    foreach ($tabs as $key => $tab) {
        $tabs[$key]['class'] = array('inactive');
    }
    if ( isset($tabs['ts_custom']) ) {
        $tabs['ts_custom']['class'] = array('active');
    }
    return $tabs;
}

/** =========================================================
 *  SEO → RANK MATH OPENGRAPH/TWITTER ETİKETLERİNİ TEMİZLE
 * ========================================================= */
add_filter('rank_math/opengraph/facebook', function($metadata) {
    unset($metadata->tags['product:price:currency']);
    unset($metadata->tags['product:availability']);
    return $metadata;
});

add_filter('rank_math/opengraph/twitter', function($metadata) {
    unset($metadata->tags['twitter:label1']);
    unset($metadata->tags['twitter:data1']);
    unset($metadata->tags['twitter:label2']);
    unset($metadata->tags['twitter:data2']);
    return $metadata;
});

/** =========================================================
 *  ADMIN → POP-UP AYARLARI (WPML UYUMLU)
 * ========================================================= */
add_action('admin_menu', 'popup_settings_page');
function popup_settings_page() {
    add_menu_page(
        'Pop-up Ayarları',
        'Pop-up Ayarları',
        'manage_options',
        'popup-settings',
        'render_popup_settings',
        'dashicons-format-image',
        80
    );
}

function render_popup_settings() {
    if ( isset($_POST['popup_settings_save']) ) {
        update_option('popup_image_id', absint($_POST['popup_image_id']));
        update_option('popup_content', wp_kses_post($_POST['popup_content']));
        update_option('popup_shortcode', sanitize_text_field($_POST['popup_shortcode']));
        update_option('popup_enabled', isset($_POST['popup_enabled']) ? 1 : 0);
    }

    $popup_image_id  = get_option('popup_image_id');
    $popup_content   = get_option('popup_content', '');
    $popup_shortcode = get_option('popup_shortcode', '');
    $popup_enabled   = get_option('popup_enabled', 1);

    if ( function_exists('icl_register_string') ) {
        icl_register_string('popup', 'popup_content', $popup_content);
        icl_register_string('popup', 'popup_shortcode', $popup_shortcode);
    }

    wp_enqueue_media(); ?>
    <div class="wrap">
        <h1>Pop-up Ayarları</h1>
        <form method="post" action="">
            <h2>Pop-up Görseli</h2>
            <div>
                <img id="popup-image-preview" alt="pop up" src="<?php echo esc_url(wp_get_attachment_url($popup_image_id)); ?>" style="max-width: 100%; height: auto; border-radius: 2px;" />
                <input type="hidden" id="popup_image_id" name="popup_image_id" value="<?php echo esc_attr($popup_image_id); ?>" />
                <button type="button" class="button" id="upload-popup-image">Görsel Seç</button>
            </div>

            <h2>Pop-up İçeriği</h2>
            <?php
            wp_editor($popup_content, 'popup_content', array(
                'textarea_name' => 'popup_content',
                'media_buttons' => true,
                'textarea_rows' => 10,
                'tinymce'       => true,
                'quicktags'     => true,
            ));
            ?>

            <h2>Pop-up Shortcode</h2>
            <input type="text" name="popup_shortcode" value="<?php echo esc_attr($popup_shortcode); ?>" style="width:100%;" />

            <h2>Pop-up Etkinleştir</h2>
            <label>
                <input type="checkbox" name="popup_enabled" <?php checked($popup_enabled, 1); ?> />
                Pop-up Etkinleştir
            </label>

            <p class="submit">
                <input type="submit" name="popup_settings_save" class="button-primary" value="Ayarları Kaydet" />
            </p>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#upload-popup-image').on('click', function(e){
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({
                title: 'Pop-up Görselini Seç',
                button: { text: 'Görseli Kullan' },
                multiple: false
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                $('#popup_image_id').val(attachment.id);
                $('#popup-image-preview').attr('src', attachment.url);
            });
            frame.open();
        });
    });
    </script>
<?php }

/** =========================================================
 *  FRONTEND → POP-UP GÖSTERİMİ (WPML UYUMLU)
 * ========================================================= */
add_action('wp_footer', 'display_popup');
function display_popup() {
    $popup_enabled  = get_option('popup_enabled', 1);
    $popup_image_id = get_option('popup_image_id');
    $popup_content  = get_option('popup_content', '');
    $popup_shortcode= get_option('popup_shortcode', '');

    if ( function_exists('icl_t') ) {
        $popup_content  = icl_t('popup', 'popup_content', $popup_content);
        $popup_shortcode= icl_t('popup', 'popup_shortcode', $popup_shortcode);
    }

    if ( $popup_enabled && !isset($_COOKIE['popup_seen']) ) { ?>
        <div id="popup-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:9998;"></div>
        <div id="custom-popup" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); z-index:9999; width:480px; max-width:90%; background:#fff; border-radius:2px; overflow:hidden;">
            <button title="Close (Esc)" type="button" class="mfp-close">×</button>
            <div class="popup-content" style="padding:0;">
                <img src="<?php echo esc_url(wp_get_attachment_url($popup_image_id)); ?>" alt="pop up" style="width:100%; height:auto; border-radius:2px; margin:0; padding:0;" />
                <div><?php echo do_shortcode($popup_content); ?></div>
                <div><?php echo do_shortcode($popup_shortcode); ?></div>
            </div>
        </div>
        <script>
        jQuery(function($){
            if (!document.cookie.includes('popup_seen')) {
                setTimeout(function(){
                    $('#custom-popup').fadeIn();
                    $('#popup-overlay').fadeIn();
                }, 6000);
                document.cookie = "popup_seen=true; max-age=" + 24*60*60 + "; path=/";
            }
            $('.mfp-close, #popup-overlay').on('click', function(){
                $('#custom-popup').fadeOut();
                $('#popup-overlay').fadeOut();
            });
        });
        </script>
    <?php }
}

/** =========================================================
 *  ANALYTICS → GOOGLE TAG MANAGER
 * ========================================================= */
add_action('wp_head', 'add_google_tag_manager_head');
function add_google_tag_manager_head() { ?>
    <!-- Google Tag Manager -->
    <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
    var f=d.getElementsByTagName(s)[0], j=d.createElement(s), dl=l!='dataLayer'?'&l='+l:'';
    j.async=true; j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
    f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5DHHP76D');
    </script>
    <!-- End Google Tag Manager -->
<?php }

add_action('wp_body_open', 'add_google_tag_manager_body');
function add_google_tag_manager_body() { ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DHHP76D" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php }

/** =========================================================
 *  PERFORMANS → CF7 RECAPTCHA'YI SAYFALARDA GEREKSİZ YÜKLEME
 * ========================================================= */
add_action('wp_print_scripts', function () {
    global $post;
    if ( is_a($post, 'WP_Post') && !has_shortcode($post->post_content, 'contact-form-7') ) {
        wp_dequeue_script('google-recaptcha');
        wp_dequeue_script('wpcf7-recaptcha');
    }
});

/** =========================================================
 *  NOT: WhatsApp ile ilgili TÜM KODLAR talepleriniz doğrultusunda KALDIRILMIŞTIR.
 * ========================================================= */




?>