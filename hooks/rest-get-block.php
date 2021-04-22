<?php

add_filter('rest-template-block-builder-get-block', function ($atts) {

    global $wpdb;

    $rb_table = $wpdb->prefix . 'rest-blocks';

    return array_map(function($row){
        $apis = json_decode($row['apis']);
        return [
            'id' => $row['id'],
            'title' => $row['title'],
            'apis' =>  is_array($apis) ? $apis : [],
            'content' => $row['content']
        ];
    }, $wpdb->get_results($wpdb->prepare("SELECT * FROM `$rb_table` WHERE `id` = %d", $atts['id']), ARRAY_A ))[0];

});
