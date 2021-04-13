<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CI_Model {

    function mysqli_real_escape_string($val){

        $escape_string = mysqli_real_escape_string($this->db->conn_id, $val);
        return $escape_string;
    }

    // https://www.formget.com/php-checkbox/

    function get_all_players($search_detail){
        $query = "SELECT * FROM users WHERE name LIKE ? ";
        if(!(is_null($search_detail['gender']))){
            $gender1 = (isset( $search_detail['gender'][0]) ? $search_detail['gender'][0] : NULL);
            $gender2 = (isset($search_detail['gender'][1]) ? $search_detail['gender'][1] : NULL);
            $query .= "AND (";
            $query .= "gender = ? OR gender = ?";
            $query .=")";
        }

        if(!(is_null($search_detail['sports']))){
            $sport1 = (isset($search_detail['sports'][0]) ? $search_detail['sports'][0] : NULL);
            $sport2 = (isset($search_detail['sports'][1]) ? $search_detail['sports'][1] : NULL);
            $sport3 = (isset($search_detail['sports'][2]) ? $search_detail['sports'][2] : NULL);
            $sport4 = (isset($search_detail['sports'][3]) ? $search_detail['sports'][3] : NULL);
            $sport5 = (isset($search_detail['sports'][4]) ? $search_detail['sports'][4] : NULL);
            $sport6 = (isset($search_detail['sports'][5]) ? $search_detail['sports'][5] : NULL);
            // $sport7 = (isset($search_detail['sports'][6]) ? $search_detail['sports'][6] : NULL);
            $query .= " AND (";
            // $query .= "sports_id = ? OR sports_id = ? OR sports_id = ? OR sports_id = ? OR sports_id = ? OR sports_id = ?";
            $query .= "sports_id = ? OR sports_id = ? OR sports_id = ? OR sports_id = ? OR sports_id = ? OR sports_id = ? OR sports_id = ?";
            $query .=")";
        }
        if(!(is_null($search_detail['sports'])) AND !(is_null($search_detail['gender']))){

            $values = array($this->mysqli_real_escape_string("%{$search_detail['name']}%"),(isset($gender1) ? $gender1 : ""),(isset($gender2) ? $gender2 : ""),(isset($sport1) ? $sport1 : ""),(isset($sport2) ? $sport2 : ""),(isset($sport3) ? $sport3 : ""),(isset($sport4) ? $sport4 : ""),(isset($sport5) ? $sport5 : ""),(isset($sport6) ? $sport6 : ""));

        }else if(!(is_null($search_detail['gender']))){

            $values = array($this->mysqli_real_escape_string("%{$search_detail['name']}%"),(isset($gender1) ? $gender1 : ""),(isset($gender2) ? $gender2 : ""));

        }else if(!(is_null($search_detail['sports']))){

            // $values = array($this->mysqli_real_escape_string("%{$search_detail['name']}%"),(isset($sport1) ? $sport1 : ""),(isset($sport2) ? $sport2 : ""),(isset($sport3) ? $sport3 : ""),(isset($sport4) ? $sport4 : ""),(isset($sport5) ? $sport5 : ""),(isset($sport6) ? $sport6 : ""),(isset($sport7) ? $sport7 : ""));

            $values = array($this->mysqli_real_escape_string("%{$search_detail['name']}%"),(isset($sport1) ? $sport1 : ""),(isset($sport2) ? $sport2 : ""),(isset($sport3) ? $sport3 : ""),(isset($sport4) ? $sport4 : ""),(isset($sport5) ? $sport5 : ""),(isset($sport5) ? $sport5 : ""),(isset($sport6) ? $sport6 : ""));

        }else{
            $values = array($this->mysqli_real_escape_string("%{$search_detail['name']}%"));
        }

       
       
        return $this->db->query($query, $values)->result_array();
        // return $this->db->query("SELECT * FROM users")->result_array();
       
    }
  



}




// if(!(is_null($search_detail['gender']))){
//     $query .= "AND (";
//     foreach($search_detail['gender'] as $gender){
//         $query .="gender = ?";
       
//     }

//     if(count($search_detail['gender']) > 1){
//         $query .=" OR ";
//     }
    
//     $query .=")";
// }

?>