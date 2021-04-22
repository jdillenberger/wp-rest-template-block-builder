<?php

add_filter('rest-template-block-builder-get-blocks', function ($atts) {

    global $wpdb;

    $rb_table = $wpdb->prefix . 'rest-blocks';
    
    return array_map(function($row){
        $apis = json_decode($row['apis']);
        return [
            'id' => $row['id'],
            'title' => $row['title'],
            'apis' => $apis,
            'num_apis' => count($apis),
            'content' => $row['title']
        ];
    }, $wpdb->get_results("SELECT * FROM `$rb_table`", ARRAY_A));

});
