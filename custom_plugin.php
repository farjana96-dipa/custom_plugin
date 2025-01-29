<?php
/*
Plugin Name: Custom Plugin
Plugin URI: https://customplugin.com
Description: This is a custom plugin for custom post type.
Version: 1.0.0
Author: Farjana Dipa
Author URI: https://farjana-dipa.com
License: GPLv2 or later

*/

define('PLUGIN_DIR_PATH',plugin_dir_path(__FILE__));
define('PLUGIN_URL',plugins_url());

function add_admin_menu(){
    add_menu_page('Custom Plugin', 'Custom Plugin', 'manage_options', 'custom_plugin', 'custom_plugin_func','dashicons-admin-plugins',9);

    add_submenu_page('custom_plugin', 'Add New', 'Add New ', 'manage_options', 'custom_plugin', 'custom_plugin_page_func');
    add_submenu_page('custom_plugin', 'Add New Page', 'Add New pages ', 'manage_options', 'custom_plugin', 'custom_plugin_all_page_func');
}

add_action('admin_menu','add_admin_menu');


// Plugin Callback Functions


function custom_plugin_func(){
    
}

function custom_plugin_page_func(){
    require_once PLUGIN_DIR_PATH.'/views/add_new.php';
}

function custom_plugin_all_page_func(){
    require_once PLUGIN_DIR_PATH.'/views/add_page.php';
}




// CSS JS file Enqueue


function css_js_file_calling(){
    wp_enqueue_style('style',PLUGIN_URL.'/custom_plugin/assets/css/style.css','','1.0','all');
    wp_enqueue_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css','','5.3.3');

    wp_enqueue_script('jquery');

    wp_enqueue_script('jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js', ['jquery'], '1.19.5', true);
    wp_enqueue_script('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js','','5.3.3');
    wp_enqueue_script('script',PLUGIN_URL.'/custom_plugin/assets/js/script.js',array('jquery'),'1.0',true);





    wp_localize_script('script', 'ajaxobj', ['ajax_url' => admin_url('admin-ajax.php'),]);
}

add_action('init','css_js_file_calling');

if(isset($_REQUEST['action'])){
    switch($_REQUEST['action']){
        case 'custom_plugin':
            add_action('admin_init','ajax_handler_file_add');
            function ajax_handler_file_add(){
                require_once PLUGIN_DIR_PATH.'/views/ajax-handler.php';
            }
            break;
        
    }
}


add_action('wp_ajax_custom_plugin', 'custom_plugin_handler'); // For logged-in users
add_action('wp_ajax_nopriv_custom_plugin', 'custom_plugin_handler'); // For logged-out users

function custom_plugin_handler() {
    $param = isset($_REQUEST['param']) ? sanitize_text_field($_REQUEST['param']) : '';

    if ($param === "post_data") {
        // Send a response
        wp_send_json_success(['message' => 'Data received', 'data' => $_REQUEST]);
    } else {
        wp_send_json_error(['message' => 'Invalid parameter']);
    }
    wp_die(); // Always terminate to avoid unexpected output
}


//Plugin Activation
function custom_plugin_activation(){
    global $wpdb;
    require_once(ABSPATH.'wp-admin/includes/upgrade.php');

    $sql = "CREATE TABLE `wp_cutom_plugin_table` (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `phone` varchar(11) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    dbDelta($sql);
}
register_activation_hook(__FILE__,'custom_plugin_activation');

//Plugin Deactivation hook
function custom_plugin_deactivation(){
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS `wp_cutom_plugin_table`");
}
register_deactivation_hook(__FILE__,'custom_plugin_deactivation');

//Plugin Uninstall hook
function custom_plugin_delete(){
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS 'wp_cutom_plugin_table'");
}
register_uninstall_hook(__FILE__,'custom_plugin_delete');


// Insert Posts

function custom_plugin_page(){
    $page = array();
    
    $page['post_type'] = 'page';
    $page['post_title'] = 'Custom Plugin Page';
    $page['post_content'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec purus ac nunc.';
    $page['post_status'] = 'publish';
    $page['post_author']= 1;

    wp_insert_post($page);
}

register_activation_hook(__FILE__,'custom_plugin_page');

?>