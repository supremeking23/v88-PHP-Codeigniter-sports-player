<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Sports extends CI_Controller {

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

        
		$name = ($this->session->has_userdata("name") ? $this->session->userdata("name") : "");
		$gender = ($this->session->has_userdata("gender") ? $this->session->userdata("gender") : NULL);
		$sports = ($this->session->has_userdata("sports") ? $this->session->userdata("sports") : NULL);
		// if(is_null($gender)){
		// 	echo "wala laman boss";
		// }else {
		// 	echo $gender[0];
		// 	foreach($gender as $g){
		// 		echo $g;
		// 	}
		// }
		// if(is_null($sports)){
		// 	echo "wala laman sa sports boss";
		// }else {
			
		// 	foreach($sports as $s){
		// 		echo $s;
		// 	}
		// }
		$search_detail = array(
			"name" => $name,
			"gender" => $gender,
			"sports" => $sports
		);
		
       	$data['users'] = $this->player->get_all_players($search_detail);
		$data['sports'] = $this->sport->get_all_sports();
		// var_dump($this->player->get_all_players($search_detail));
		$this->load->view('sports/index',$data);
        // 

        
	}

    public function search_process(){
        $gender = $this->input->post("gender");
		$sports = $this->input->post("sports");
		if(is_null($gender)){
			echo "wala sya laman boss";
		}
		var_dump($gender);
		$players_detail = array(
			"name" => $this->input->post("name"), 
			"gender" => $gender,
			"sports" => $sports
		);

		$this->session->set_userdata($players_detail);
		redirect(base_url());
        // var_dump($check);
    }

   
   

}
