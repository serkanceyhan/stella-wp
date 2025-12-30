<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
// Slider görsellerini ekle
$slider_images = get_term_meta(get_queried_object()->term_id, 'slider_images', true);
$images = $slider_images ? explode(',', $slider_images) : [];
$image_count = count($images);

if ($image_count > 0) {
    echo '<div id="category-slider-wrapper" class="category-slider-wrapper">';
    echo '<div class="swiper-container">';
    echo '<div class="swiper-wrapper">';
    
    // Kategori başlığı almak için
    $category_title = single_term_title('', false);
    
    foreach ($images as $index => $image) {
        echo '<div class="swiper-slide">';
        echo '<img src="' . esc_url($image) . '" class="d-block w-100" alt="' . esc_attr($category_title) . '">'; // Alt metin olarak kategori başlığı
        echo '</div>';
    }
    
    echo '</div>';
    
    if ($image_count > 1) {
        echo '<div class="swiper-button-next"></div>';
        echo '<div class="swiper-button-prev"></div>';
        echo '<div class="swiper-pagination"></div>';
    }
    
    echo '</div>'; // Swiper container bitiş
    echo '<div class="category-slider-overlay">';
    echo '<div class="category-breadcrumb">' . woocommerce_breadcrumb() . '</div>';
    echo '<div class="category-title">' . esc_html($category_title) . '</div>'; // Kategori başlığı gösterimi
    echo '</div>';
    echo '</div>';
}

woocommerce_output_all_notices();
do_action('woocommerce_before_main_content');

if (woocommerce_product_loop()) {
    do_action('woocommerce_before_shop_loop');
    woocommerce_product_loop_start();

    // Liste görünümü için başlangıç
    echo '<div class="collection-list page-container show_breadcrumb_v2 no-sidebar">';
    do_action('woocommerce_archive_description');
    if (wc_get_loop_prop('total')) {
        while (have_posts()) {
            the_post();
            do_action('woocommerce_shop_loop');

            // Ürün şablonunu liste görünümü için özelleştirin
            ?>
            <div <?php wc_product_class('product-list-item', get_the_ID()); ?>>
                <div class="product-list-thumbnail">
                    <?php woocommerce_template_loop_product_link_open(); ?>
                    <?php woocommerce_template_loop_product_thumbnail(); ?>
                    <?php woocommerce_template_loop_product_link_close(); ?>
                </div>
                <div class="product-list-details">
                    <h2 class="woocommerce-loop-product__title"><?php woocommerce_template_loop_product_link_open(); ?><?php the_title(); ?><?php woocommerce_template_loop_product_link_close(); ?></h2>
                    <?php woocommerce_template_loop_price(); ?>
                    <?php woocommerce_template_loop_rating(); ?>
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
            </div>
            <?php
        }
    }

    echo '</div>';
    // Liste görünümü için bitiş

    woocommerce_product_loop_end();
    do_action('woocommerce_after_shop_loop');
} else {
    do_action('woocommerce_no_products_found');
}

get_footer();
?>

<style>
    .breadcrumb-title-wrapper {
        display: none;
    }

    .collection-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .product-list-item {
        display: flex;
        flex-direction: row;
        padding: 10px;
        border: 1px solid #eaeaea;
    }

    .product-list-thumbnail {
        flex: 0 0 75%;
        margin-right: 20px;
    }

    .product-list-thumbnail img {
        max-width: 100%;
        height: auto;
    }

    .product-list-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .product-list-details h2 {
        font-size: 1.5em;
        margin: 0 0 10px;
    }

    .product-list-details .price {
        font-size: 1.2em;
        color: #333;
        margin: 0 0 10px;
    }

    .product-list-details .woocommerce-product-rating {
        margin: 0 0 10px;
    }

    .product-list-details .woocommerce-product-details__short-description {
        margin: 0 0 10px;
        line-height: 1.6;
    }

    .product-list-details .add_to_cart_button {
        margin-top: 10px;
    }

    @media screen and (max-width: 768px) {
        .product-list-item {
            flex-direction: column;
        }
        .product-list-thumbnail {
            margin-right: 0;
            margin-bottom: 10px;
            flex: 1;
        }
        .product-list-details {
            flex: 1;
        }
    }

    /* WooCommerce koleksiyon sayfası için özel stiller */
    .category-slider-wrapper {
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
        margin-top: -133px;
        z-index: 2;
    }

    .swiper-container {
        width: 100%;
        height: 100%;
    }

    .swiper-slide img {
        max-height: 100vh;
        object-fit: cover;
        filter: brightness(1.1);
    }

 .category-slider-overlay {
    position: absolute;
    bottom: 150px;
    left: 20px;
    right: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
    z-index: 2;
    padding: 20px;
    background: rgba(0, 0, 0, 0.3);
}

    .category-title {
        font-size: 2em;
        text-align: left;
    }

    .category-breadcrumb {
        color: #fff;
        text-align: left;
        margin-right: auto;
    }

    @media (max-width: 768px) {
        .category-slider-wrapper {
            margin-top: 0;
        }
        .category-slider-overlay {
            flex-direction: row;
            align-items: flex-start;
            text-align: left;
            padding: 7px;
        }

        .category-slider-overlay {
            position: absolute;
            bottom: 0px;
        }

        .woocommerce .woocommerce-breadcrumb {
            margin: 0;
            padding: 0;
        }
    }

    .ts-header .header-container {
        position: relative;
        z-index: 9;
    }

   .header-middle {
    background: linear-gradient(to bottom, rgba(255, 255, 255, 1), rgb(255 255 255 / 92%), rgb(255 255 255 / 1%));
    color: black;
    border-bottom: 0;
}

    .woocommerce:where(body:not(.woocommerce-uses-block-theme)) .woocommerce-breadcrumb a {
        color: #ffffff;
    }

    .woocommerce:where(body:not(.woocommerce-uses-block-theme)) .woocommerce-breadcrumb {
        font-size: .92em;
        color: #ffffff;
    }

    .products {
        margin-right: 0px !important;
        margin-left: 0px !important;
    }
/* Swiper Container ve Görseller */
.swiper-container {
    width: 100%; /* Genişliği tam yap */
    height:900px; /* Sabit bir yükseklik ayarla */
    position: relative;
    margin: 0 auto; /* Ortalamak için */
}

.swiper-slide img {
    width: 100%; /* Genişliği tam ekran yap */
    height: 100%; /* Yüksekliği tam olarak doldur */
    object-fit: cover; /* Görsellerin taşmasını önlemek için kırp */
}

/* Oklar (Prev ve Next) */
.swiper-button-prev, .swiper-button-next {
    width: 40px;
    height: 40px;
    background-color: rgba(0, 0, 0, 0.5); /* Arka plan yarı şeffaf */
    border-radius: 50%; /* Yuvarlak oklar */
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff; /* Ok rengi beyaz */
    position: absolute;
    top: 50%; /* Yükseklik ortasında */
    transform: translateY(-50%);
    z-index: 10; /* Okların üstte kalmasını sağla */
    transition: background-color 0.3s ease; /* Hover efekti için */
}

/* Oklar Hover Efekti */
.swiper-button-prev:hover, .swiper-button-next:hover {
    background-color: rgb(255 255 255 / 80%) /* Hover durumunda daha koyu */
}

/* Sol ok pozisyonu */
.swiper-button-prev {
    left: 10px; /* Sol kenara yaklaştır */
}

/* Sağ ok pozisyonu */
.swiper-button-next {
    right: 10px; /* Sağ kenara yaklaştır */
}

/* Paginasyon (Çizgisel) */
.swiper-pagination {
    bottom: 15px; /* Paginasyonu aşağıya yerleştir */
    left: 0;
    right: 0;
    text-align: center;
}

.swiper-pagination-bullet {
    width: 30px; /* Daha geniş çizgisel görünüm */
    height: 4px; /* Çizgi şeklinde */
    background: rgba(0, 0, 0, 0.3); /* Gri ton */
    border-radius: 0; /* Yuvarlak yerine düz çizgi */
    margin: 0 5px; /* Aralarında biraz boşluk */
    display: inline-block;
}

.swiper-pagination-bullet-active {
    background: rgba(0, 0, 0, 0.7); /* Aktif olan daha koyu */
}

/* Mobil Cihazlar için Ayarlar */
@media (max-width: 768px) {
    .swiper-container {
        height: 350px; /* Mobil cihazlar için daha küçük yükseklik */
    }

    .swiper-button-prev, .swiper-button-next {
        width: 30px;
        height: 30px;
    }

    .swiper-pagination-bullet {
        width: 20px;
        height: 3px; /* Daha küçük çizgiler */
    }
}

/* Slider container için relative konumlandırma */
.swiper-container {
    position: relative; /* Overlay için referans noktası */
}

/* Overlay'i sliderın altına sabitle */
.category-slider-overlay {
    position: absolute; /* Mutlak konumlandırma */
    bottom: 0; /* Alt kısmına sabitlenir */
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
    z-index: 2;
    padding: 20px;
    background: rgba(0, 0, 0, 0.3); /* Yarı saydam arka plan */
}

/* Breadcrumb stilini güncellemek için */
.woocommerce-breadcrumb {
    color: #fff; /* Breadcrumb metni beyaz */
    text-decoration: none; /* Alt çizgi kaldır */
}

.woocommerce-breadcrumb a {
    color: #fff; /* Link rengi beyaz */
    text-decoration: underline; /* İstendiği takdirde link altı çizgili */
}

/* Kategori başlığı için stil */
.category-title {
    font-size: 24px; /* Başlık için font büyüklüğü */
    font-weight: bold;
    color: #fff;
}

  
@media only screen and (min-width: 1279px) {
    body .swiper-button-next, body .swiper-button-prev {
        width: 50px;
        height: 50px;
        opacity: 7;
        visibility: visible;
    }
}

</style>

<script>
window.addEventListener('scroll', function() {
    var header = document.querySelector('.header-middle');
    var stickyWrapper = document.querySelector('.sticky-wrapper');
    if (stickyWrapper.classList.contains('is-sticky')) {
        header.style.backgroundColor = 'white';
    } else {
        header.style.backgroundColor = 'transparent';
    }
});


	// Swiper'ı başlat
const swiper = new Swiper('.swiper-container', {
    // Swiper ayarları
    loop: true, // Dönüşümlü döngü
    autoplay: {
        delay: 3000, // 3 saniye aralıklarla geçiş
        disableOnInteraction: false, // Kullanıcı etkileşimlerinde durdurma
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

// Mouse olaylarını dinle
const swiperContainer = document.querySelector('.swiper-container');

swiperContainer.addEventListener('mouseenter', () => {
    swiper.autoplay.stop(); // Mouse geldiğinde autoplay'i durdur
});

swiperContainer.addEventListener('mouseleave', () => {
    swiper.autoplay.start(); // Mouse ayrıldığında autoplay'i başlat
});

</script>
