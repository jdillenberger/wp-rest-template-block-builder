<?php

register_activation_hook(RB_PLUGIN_INDEX, function () {

});

register_deactivation_hook(RB_PLUGIN_INDEX, function () {
    include plugin_dir_path(RB_PLUGIN_INDEX) . 'uninstall.php';
});
