<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class MY_Form_validation extends CI_Form_validation
{

    public function __construct()
    {
        parent::__construct();
    }

    public function test_vali($p1,$p2){
        $p2 = explode('.', $p2);
        var_dump($p2);
        die;
    }

    public function unique_except($str,$param){
        $CI =& get_instance();
        $this->set_message('unique_except','{field} had be used');
        $param = explode('||', $param);
        //param[0] is table, [1] is column, [2] except value
        $CI->db->where($param[1],$str)
            ->where("{$param[1]} !=",$param[2]);
        $count = $CI->db->count_all_results($param[0]);
        if($count > 0)
            return false;
        else
            return true;
    }

  

}