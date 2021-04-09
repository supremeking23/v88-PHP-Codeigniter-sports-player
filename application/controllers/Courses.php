<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Courses extends CI_Controller {

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

    

	public function main()
	{	
        $sections = array(
            'config'  => TRUE,
            'queries' => TRUE
        );
    
        $this->output->set_profiler_sections($sections);
        $this->output->enable_profiler(FALSE);
        // $this->load->model('course'); // already in the autoload
        $data["courses"] = $this->course->get_all_courses();
		$this->load->view('course/index',$data);
        // 

        
	}

    public function add(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("course", "Course Name", "trim|required");
        if($this->form_validation->run() === FALSE)
        {
            $errors = validation_errors('<div class="alert alert-danger">', '</div>');
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url());

        }
        else
        {
            //codes to run on success validation here
            $course_details = array(
                "title" => $this->input->post("course"),
                "description" => $this->input->post("course-description")
            ); 
            $add_course = $this->course->add_course($course_details);
            if($add_course === TRUE) {
                // echo "Course is added!";
                redirect(base_url());
            }
            
        }
        
    }


    public function destroy($id){
        
        $this->output->enable_profiler(FALSE);
        $data["course"] = $this->course->get_course_by_id($id);
        if(empty($data["course"])){
            redirect(base_url());
        }
        
        $this->load->view('course/delete',$data);
    }

    public function delete_process(){
        $delete_course = $this->course->delete_course($this->input->post("course_id"));
        // var_dump($delete_course);
        if($delete_course){
            $this->session->set_flashdata('course-delete','<div class="alert alert-success">Course has been deleted successfully</div>');
            redirect(base_url());
        }
        // 
    }

}
