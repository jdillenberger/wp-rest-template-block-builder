<?php

defined('ABSPATH') or die();

$permission_callback_nonce = function ($request) {
    $headers = getallheaders();
    return isset($headers['X-WP-Nonce']) && !empty($headers['X-WP-Nonce']);
};

add_action('rest_api_init', function () use ($permission_callback_nonce) {

    register_rest_route('rest-blocks/v1', '/blocks', array(
        'methods' => 'GET',
        'permission_callback' => '__return_true',
        'callback' => function ($atts) {
            return \apply_filters('rest-template-block-builder-get-blocks', $atts);
        }
    ));

    register_rest_route('rest-blocks/v1', '/block/(?P<id>\d+)', array(
        'methods' => 'GET',
        'permission_callback' => '__return_true',
        'callback' => function ($atts) {
            return \apply_filters('rest-template-block-builder-get-block', $atts);
        }
    ));

    register_rest_route('rest-blocks/v1', '/block', array(
        'methods' => 'POST',
        'permission_callback' => $permission_callback_nonce,
        'callback' => function ($atts) {
            return \apply_filters('rest-template-block-builder-post-block', $atts);
        }
    ));

    register_rest_route('rest-blocks/v1', '/block/(?P<id>\d+)', array(
        'methods' => 'PUT',
        'permission_callback' => $permission_callback_nonce,
        'callback' => function ($atts) {
            return \apply_filters('rest-template-block-builder-put-block', $atts);
        }
    ));

    register_rest_route('rest-blocks/v1', '/block/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'permission_callback' => $permission_callback_nonce,
        'callback' => function ($atts) {
            return \apply_filters('rest-template-block-builder-delete-block', $atts);
        }
    ));


});