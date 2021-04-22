<?php

register_activation_hook(RB_PLUGIN_INDEX, function () {

    global $wpdb;

    $rb_table = $wpdb->prefix . 'rest-blocks';
    
    $wpdb->query("CREATE TABLE IF NOT EXISTS `$rb_table` (
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `apis` TEXT,
        `content` TEXT
    )");

});

register_deactivation_hook(RB_PLUGIN_INDEX, function () {
    include plugin_dir_path(RB_PLUGIN_INDEX) . 'uninstall.php';
});
