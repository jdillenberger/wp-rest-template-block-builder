<?php

add_action('rest-blocks-new-block-admin-page', function(){

    wp_enqueue_script('rest-blocks-new-block-js', plugin_dir_url(RB_PLUGIN_INDEX) . 'jsdist/admin.js', [], false, true);
    
    wp_localize_script('rest-blocks-new-block-js', 'localURLs', [
        'home' => home_url(),
        'rest' => rest_url(),
        'restBlocksURL' => plugin_dir_url(RB_PLUGIN_INDEX),
    ]);

    wp_localize_script('rest-blocks-new-block-js', 'section', 'newBlock');

    wp_localize_script('rest-blocks-new-block-js', 'nonce', [wp_create_nonce('wp_rest')]);

    echo '<div class="rest-blocks-admin"></div>';

});