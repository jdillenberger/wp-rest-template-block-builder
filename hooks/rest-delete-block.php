<?php

add_filter('rest-template-block-builder-delete-block', function ($atts) {

    global $wpdb;

    $rb_table = $wpdb->prefix . 'rest-blocks';

    $wpdb->query($wpdb->prepare("DELETE FROM `$rb_table` WHERE `id` = %d", $atts['id']));

    return $wpdb->affected_rows > 0;

});
