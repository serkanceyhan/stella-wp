<?php
define( 'WP_CACHE', true ); // Added by WP Rocket



 // Added by WP Rocket

/**
 * WordPress için balangıç ayar dosyası.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. sterseniz bu dosyayı kopyalayp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * Bu dosya şu ayarları içerir:
 * 
 * * Veritabanı ayarları
 * * Gizli anahtarlar
 * * Veritabanı tablo n eki
 * * ABSPATH
 * 
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Veritabanı ayarları - Bu bilgileri servis sağlayıcınızdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının ad */
define( 'DB_NAME', 'stel_dbase' );
/** Veritabanı kullanıcsı */
define( 'DB_USER', 'stel_serkanc' );
/** Veritaban parolası */
define( 'DB_PASSWORD', '1g6+Ek*cBmy15FEK' );
/** Veritabanı sunucusu */
define( 'DB_HOST', 'localhost' );
/** Yaratılacak tablolar için veritabanı karakter seti. */
define( 'DB_CHARSET', 'utf8mb4' );
/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define( 'DB_COLLATE', '' );
/**#@+
 * Eşsiz doğrulama anahtarlar ve tuzlar.
 *
 * Her anahtar farklı bir karakter kmesi olmal!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * 
 * Çerezleri geçersiz kılmak için istediiniz zaman bu değerleri değitirebilirsiniz.
 * Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'F2BP_Ed/cjJLhVUz Tgwyt3?~Id_XR=ZU1_~dy:D>SC$ufNP[X=lOOi%l4|#It>]' );
define( 'SECURE_AUTH_KEY',  'D0W&>er1[)s(am{E1KV+=i]! `=N}!e}w(O@:nSJ6<RhYg,#O_r1*<Z>fb <Xe`Z' );
define( 'LOGGED_IN_KEY',    'r{}lY5XcGMQ12}{fcK5[(hB%,4]:o7>62YJ0:~T^<L_/Qr&f> 4z36gCQEpY5$-P' );
define( 'NONCE_KEY',        'C`~~xG,xW=RK^=6AU>#_Yb?zTIhbOJNLf;N;9i?9W0@Qx)f?HOvLGJo0@Ru;X6?k' );
define( 'AUTH_SALT',        ']`=F{} PMi ;Pk)d]=hh<;RUv&ahwf7o2+oc|^-I6o,O@BHQK!Mz%5Gk,,wb QVh' );
define( 'SECURE_AUTH_SALT', '4l[ZsGc<$~oU)<&_,3c4ArR8y>2uyXj(MS`~tB=;E9Q(wZZ]Aau$Bk!4TDf1k~&6' );
define( 'LOGGED_IN_SALT',   'Bn/EvH:HiDYqbX?T+)v!6z>5d@Cy{j;Xah;MxsB)yuI !kxtjZo b4G6x)Kew)>Q' );
define( 'NONCE_SALT',       'QP!^<%3L*3vEOZ)*dfm,sKI}(MicM}Jmnf66}8z72L}i,4*_?!9mX]eo?3~C&J_X' );
/**#@-*/
/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix = 'wps_';
/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri true olarak ayarlayıp gelitirme sırasında hatalarn ekrana
 * basılmasını salayabilirsiniz. Tema ve eklenti gelitiricilerinin geliştirme
 * aamasında WP_DEBUG kullanmalarnı önemle tavsiye ederiz.
 * 
 * Hata ayıklama için kullanabilecek diğer sabitler ile ilgili daha fazla bilgiyi
 * belgelerden edinebilirsiniz.
 * 
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* Her türlü özel deeri bu satı ile "Hepsi bu kadar" yazan satır arasına ekleyebilirsiniz. */
/* Hepsi bu kadar. Mutlu bloglamalar! */
/** WordPress dizini için mutlak yol. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}
/** WordPress değişkenlerini ve yollarını kurar. */
require_once ABSPATH . 'wp-settings.php';

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
