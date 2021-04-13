<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Model {

    function mysqli_real_escape_string($val){

        $escape_string = mysqli_real_escape_string($this->db->conn_id, $val);
        return $escape_string;
    }

    // https://www.formget.com/php-checkbox/

    function get_all_students(){
        return $this->db->query("SELECT * FROM students")->result_array();
    }
    function get_student_by_id($student_id){
        return $this->db->query("SELECT * FROM students WHERE id = ?", array($student_id))->row_array();
    }

    function  get_student_by_email($email){
        return $this->db->query("SELECT * FROM students WHERE email = ?", array($this->mysqli_real_escape_string($email)))->row_array();
    }

    function add_student($student){
        $query = "INSERT INTO students (first_name,last_name,email,password,salt, created_at) VALUES (?,?,?,?,?,?)";
        $values = array($this->MysqliRealeScapeString($student['first_name']),$this->mysqli_real_escape_string($student['last_name']),$this->mysqli_real_escape_string($student['email']),$student['password'],$student['salt'], date("Y-m-d, H:i:s")); 
        return $this->db->query($query, $values);
    }

}

?>