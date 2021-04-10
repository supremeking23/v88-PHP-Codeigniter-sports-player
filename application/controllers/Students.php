<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Students extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    

	public function index(){	

        // $this->load->model('course'); // already in the autoload
       
		$this->load->view('student/index');
        // 

        
	}

    public function register(){
        echo "dito kana";
        // var_dump($this->db);

        $this->load->library("form_validation");
        $this->form_validation->set_rules("first-name", "First Name", "trim|required");
        $this->form_validation->set_rules("last-name", "Last Name", "trim|required");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm-password", "Confirm password", "trim|required|matches[password]|min_length[8]");
        
        // form validation
        if($this->form_validation->run() === FALSE){
            $errors = validation_errors('<div class="alert alert-danger">', '</div>');
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url());
            die();

        }

        // check if email exist
       $check_email = $this->student->get_student_by_email($this->input->post("email"));
       if($check_email){
           $this->session->set_flashdata('errors', '<div class="alert alert-danger">Email alraedy exist</div>');
           redirect(base_url());
           die();
       }

       $salt = bin2hex(openssl_random_pseudo_bytes(22));
       $encrypted_password = md5($this->input->post("password") . '' . $salt);

       $student_details = array(
        "first_name" => $this->input->post("first-name"),
        "last_name" => $this->input->post("last-name"),
        "email" => $this->input->post("email"),
        "password" => $encrypted_password,
        "salt" => $salt
        ); 
        $add_student = $this->student->add_student($student_details);
        if($add_student === TRUE) {
            // echo "Course is added!";
            $this->session->set_flashdata('add-student-success', '<div class="alert alert-success">Student information has been added successfully</div>');
            redirect(base_url());
        }

    }

    public function login(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("password", "Password", "trim|required");

        if($this->form_validation->run() === FALSE){
            $errors = validation_errors('<div class="alert alert-danger">', '</div>');
            $this->session->set_flashdata('log_in_errors', $errors);
            redirect(base_url());
            die();
        }

        $student = $this->student->get_student_by_email($this->input->post("email"));
       if(!$student){
           $this->session->set_flashdata('log_in_errors', '<div class="alert alert-danger">Incorrect Email</div>');
           redirect(base_url());
           die();
       }else{
        $encrypted_password = md5($this->input->post("password"). '' . $student["salt"]);
        if($student["password"] == $encrypted_password){
            $user = array(
                'student_id' => $student['id'],
                'student_email' => $student['email'],
                'student_firstname' => $student['first_name'],
                'student_lastname' => $student['last_name'],
                'student_fullname' => $student['first_name'].' '.$student['last_name'],
                'is_logged_in' => true
             );
             $this->session->set_userdata($user);
             redirect("/students/profile");
        }
       }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect("/students/index");   
    }

    public function profile(){
        if($this->session->userdata('is_logged_in') === TRUE)
        {
            // load a view file to show them their information
            $this->load->view('student/profile');
        }
        else
        {
            redirect(base_url());
        }
        
    }

   

}
