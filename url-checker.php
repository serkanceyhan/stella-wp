<?php
function check_urls($urls) {
    $multi_handle = curl_multi_init();
    $curl_handles = [];
    $results = [];

    foreach ($urls as $i => $url) {
        $curl_handles[$i] = curl_init($url);
        curl_setopt($curl_handles[$i], CURLOPT_NOBODY, true);
        curl_setopt($curl_handles[$i], CURLOPT_FOLLOWLOCATION, false); // Yönlendirmeleri takip etme
        curl_setopt($curl_handles[$i], CURLOPT_TIMEOUT, 10);
        curl_setopt($curl_handles[$i], CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handles[$i], CURLOPT_SSL_VERIFYPEER, false);
        curl_multi_add_handle($multi_handle, $curl_handles[$i]);
    }

    do {
        curl_multi_exec($multi_handle, $running);
        curl_multi_select($multi_handle);
    } while ($running > 0);

    foreach ($curl_handles as $i => $ch) {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $redirect_url = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
        
        // Eğer yönlendirme varsa
        if ($http_code == 301 || $http_code == 302) {
            $results[$urls[$i]] = ["status" => $http_code, "redirect" => $redirect_url];
        } else {
            $results[$urls[$i]] = ["status" => $http_code, "redirect" => null];
        }
        
        curl_multi_remove_handle($multi_handle, $ch);
        curl_close($ch);
    }

    curl_multi_close($multi_handle);
    return $results;
}

// URL'leri yükle
$file = "urls.txt";
$urls = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$batch_size = 20; // Aynı anda kaç URL kontrol edilecek
$chunks = array_chunk($urls, $batch_size);

foreach ($chunks as $index => $chunk) {
    echo "İşlenen grup: " . ($index + 1) . "/" . count($chunks) . "\n";
    $results = check_urls($chunk);

    foreach ($results as $url => $data) {
        $status = $data['status'];
        $redirect = $data['redirect'];

        if ($status == 404) {
            echo "404 - $url\n";
            file_put_contents("404_urls.txt", "$url\n", FILE_APPEND);
        } elseif ($status == 301 || $status == 302) {
            echo "$status (Redirect) - $url -> $redirect\n";
            file_put_contents("redirects.txt", "$url -> $redirect\n", FILE_APPEND);
        } elseif ($status >= 500 || $status == 0) {
            echo "500+ veya erişilemeyen - $url\n";
            file_put_contents("500_urls.txt", "$url\n", FILE_APPEND);
        }
    }

    sleep(2); // Cloudflare'e yakalanmamak için bekleme süresi
}

echo "İşlem tamamlandı.\n";
?>
