<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Model {

    function MysqliRealeScapeString($val){

        $new = mysqli_real_escape_string($this->db->conn_id, $val);
        return $new;
    }

    function get_all_students(){
        return $this->db->query("SELECT * FROM students")->result_array();
    }
    function get_student_by_id($student_id){
        return $this->db->query("SELECT * FROM students WHERE id = ?", array($student_id))->row_array();
    }

    function  get_student_by_email($email){
        return $this->db->query("SELECT * FROM students WHERE email = ?", array($this->MysqliRealeScapeString($email)))->row_array();
    }

    function add_student($student){
        $query = "INSERT INTO students (first_name,last_name,email,password,salt, created_at) VALUES (?,?,?,?,?,?)";
        $values = array($this->MysqliRealeScapeString($student['first_name']),$this->MysqliRealeScapeString($student['last_name']),$this->MysqliRealeScapeString($student['email']),$student['password'],$student['salt'], date("Y-m-d, H:i:s")); 
        return $this->db->query($query, $values);
    }

}

?>