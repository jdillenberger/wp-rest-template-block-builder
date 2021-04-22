<?php

add_action('admin_menu', function () {

    // REST Blocks - main menu
    add_menu_page(
        __('REST-Blocks', 'rest-blocks'),
        __('REST-Blocks', 'rest-blocks'),
        'manage_options',
        'rest-blocks',
        function () { },
        'dashicons-text-page',
        17
    );


    add_submenu_page(
        'rest-blocks',
        __('All Blocks', 'rest-blocks'),
        __('All Blocks', 'rest-blocks'),
        'manage_options',
        'rest-blocks',
        function () {
            do_action('rest-blocks-all-blocks-admin-page');
        },
        11
    );

    add_submenu_page(
        'rest-blocks',
        __('New Block', 'rest-blocks'),
        __('New Block', 'rest-blocks'),
        'manage_options',
        'rest-blocks-new',
        function () {
            do_action('rest-blocks-new-block-admin-page');
        },
        11
    );



});
