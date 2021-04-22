<?php

add_filter('rest-template-block-builder-put-block', function ($atts) {

    $data = $atts->get_params();
    $title = $data['title'];
    $apis = $data['apis'];
    $content = $data['content'];

    global $wpdb;
    $rb_table = $wpdb->prefix . 'rest-blocks';

    $stmt = $wpdb->prepare("UPDATE `$rb_table` SET `title` = %s, `apis` = %s, `content` = %s WHERE `id`= %d;", $title, json_encode($apis), $content, $atts['id']);

    $wpdb->query($stmt);

    return $atts['id'];
});
