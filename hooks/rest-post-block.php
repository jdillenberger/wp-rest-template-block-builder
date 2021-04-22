<?php

add_filter('rest-template-block-builder-post-block', function ($atts) {

    $data = $atts->get_params();
    
    $title = $data['title'];
    $apis = $data['apis'];
    $content = $data['content'];

    global $wpdb;
    $rb_table = $wpdb->prefix . 'rest-blocks';
    $stmt = $wpdb->prepare("INSERT INTO `$rb_table` (title, apis, content) VALUES (%s, %s, %s);", $title, json_encode($apis), $content);
    $wpdb->query($stmt);

    return $wpdb->insert_id;
});
