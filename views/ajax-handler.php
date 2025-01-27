<?php

$param = isset($_REQUEST['param']) ? sanitize_text_field($_REQUEST['param']) : '';

if(!empty($param)){
    if($param == "get_message"){
        echo json_encode(['message' => 'Successfull']);
        wp_die();
    }

    if($param == "post_data"){
        error_log(print_r($_REQUEST,true));
        wp_die();
    }

    echo json_encode(['status' => 'successfull', 'data'=>$_REQUEST]);
    wp_die();
    
}

?>