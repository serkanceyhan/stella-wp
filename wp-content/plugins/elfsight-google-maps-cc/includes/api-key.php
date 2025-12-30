<?php

if (!defined('ABSPATH')) exit;


function elfsight_google_maps_get_api_key(){
    return get_option('elfsight_google_maps_api_key', '');
}

$elfsight_google_maps_api_key = elfsight_google_maps_get_api_key();

if (is_array($elfsight_google_maps_config['settings']) && is_array($elfsight_google_maps_config['preferences'])) {
    array_push($elfsight_google_maps_config['settings']['properties'], array(
        'id' => 'apiKey',
        'name' => esc_html__('API key'),
        'type' => 'hidden',
        'defaultValue' => $elfsight_google_maps_api_key
    ));
}

function elfsight_google_maps_shortcode_options_filter($options) {
    $apiKey = get_option('elfsight_google_maps_api_key', '');

    if (is_array($options)) {
        $options['apiKey'] = $apiKey;
    }

    return $options;
}
add_filter('elfsight_google_maps_shortcode_options', 'elfsight_google_maps_shortcode_options_filter');

function elfsight_google_maps_widget_options_filter($options_json) {
    $options = json_decode($options_json, true);

    if (is_array($options)) {
        unset($options['apiKey']);
    }

    return json_encode($options);
}
add_filter('elfsight_google_maps_widget_options', 'elfsight_google_maps_widget_options_filter');
