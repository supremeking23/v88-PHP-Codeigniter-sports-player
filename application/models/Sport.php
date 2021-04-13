<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sport extends CI_Model {

    function mysqli_real_escape_string($val){

        $escape_string = mysqli_real_escape_string($this->db->conn_id, $val);
        return $escape_string;
    }

    // https://www.formget.com/php-checkbox/

    function get_all_sports(){
        return $this->db->query("SELECT * FROM sports")->result_array();
    }
  



}

?>