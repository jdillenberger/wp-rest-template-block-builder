<?php

add_action('rest-blocks-all-blocks-admin-page', function(){

    wp_enqueue_script('rest-blocks-all-blocks-js', plugin_dir_url(RB_PLUGIN_INDEX) . 'jsdist/admin.js', [], false, true);
    
    wp_localize_script('rest-blocks-all-blocks-js', 'localURLs', [
        'home' => home_url(),
        'rest' => rest_url(),
        'restBlocksURL' => plugin_dir_url(RB_PLUGIN_INDEX),
    ]);

    wp_localize_script('rest-blocks-all-blocks-js', 'nonce', [wp_create_nonce('wp_rest')]);

    ?>
    <!-- ADD COMPONENT LOADER HERE -->
    <?php

});