<?php
add_action('enqueue_block_assets', function(){

    wp_enqueue_script('rest-blocks-gutenberg-blocks-js', plugin_dir_url(RB_PLUGIN_INDEX) . 'jsdist/blocks-backend.js', ['wp-blocks', 'wp-element'], false, true);

    wp_localize_script('rest-blocks-gutenberg-blocks-js', 'localURLs', [
        'home' => home_url(),
        'rest' => rest_url(),
        'restBlocksURL' => plugin_dir_url(RB_PLUGIN_INDEX),
    ]);

    wp_localize_script('rest-blocks-gutenberg-blocks-js', 'nonce', [wp_create_nonce('wp_rest')]);


    global $wpdb;
    $rb_table = $wpdb->prefix . 'rest-blocks';
    $blocks = array_map(function($row){
        $apis = json_decode($row['apis']);
        return [
            'id' => $row['id'],
            'title' => $row['title']
        ];
    }, $wpdb->get_results("SELECT * FROM `$rb_table`", ARRAY_A));

    wp_localize_script('rest-blocks-gutenberg-blocks-js', 'blocks', $blocks);

    register_block_type('rest-template-block-builder/rest-template-block', [
        'editor_script' => 'rest-blocks-gutenberg-blocks-js',
    ]);

    
});