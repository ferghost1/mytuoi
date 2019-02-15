<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function refresh_error($type,$mes,$url=''){
    $CI =& get_instance();
    if($type == 'error')
        $CI->session->set_flashdata('error',$mes);
    if($type == 'success')
        $CI->session->set_flashdata('noti_success',$mes);
    if(empty($url))
        redirect(current_url());
    else
        redirect($url);
}

function ctrler_redirect($type,$mes){
    $CI =& get_instance();
    if($type == 'error')
        $CI->session->set_flashdata('error',$mes);
    if($type == 'success')
        $CI->session->set_flashdata('noti_success',$mes);
    redirect($CI->controller);
}

function redirect_with($type,$mes,$url = '/'){
    $CI =& get_instance();
    if($type == 'error')
        $CI->session->set_flashdata('error',$mes);
    if($type == 'success')
        $CI->session->set_flashdata('noti_success',$mes);
    redirect($url);
}


?>