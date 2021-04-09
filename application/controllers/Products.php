<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Products extends CI_Controller {

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
       $data["products"] = $this->product->get_all_products();
		$this->load->view('products/index',$data);
         
	}

    public function edit($id){	
        $data["product"] = $this->product->get_product_by_id($id);
        if(empty($data["product"])){
            redirect(base_url());
        }
        
		$this->load->view('products/edit',$data);
         
	}

    public function show($id){	
       
		$data["product"] = $this->product->get_product_by_id($id);
        if(empty($data["product"])){
            redirect(base_url());
        }
		$this->load->view('products/show',$data);
         
	}

	public function new(){
		$this->load->view('products/new');

	}

    public function create(){	
		$this->load->library("form_validation");
        $this->form_validation->set_rules("product", "Product Name", "trim|required");
		$this->form_validation->set_rules("price", "Product Price", "trim|required|numeric");
        if($this->form_validation->run() === FALSE){
            $errors = validation_errors('<div class="alert alert-danger">', '</div>');
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url() ."new");

        }else{
            //codes to run on success validation here
            $product_details = array(
                "product_name" => $this->input->post("product"),
				"price" => $this->input->post("price"),
                "description" => $this->input->post("product-description")
            ); 
            $add_product = $this->product->add_product($product_details);
            if($add_product === TRUE) {
                // echo "Course is added!";
				$this->session->set_flashdata('add-product-success', "<div class=\"alert alert-success\">New product has been added successfully.</div>");
                redirect(base_url()."products");
            }
            
        }
		
         
	}

    public function update(){	
		$this->load->library("form_validation");
		$id = $this->input->post("product-id");
        $this->form_validation->set_rules("product", "Product Name", "trim|required");
		$this->form_validation->set_rules("price", "Product Price", "trim|required|numeric");
        if($this->form_validation->run() === FALSE){
            $errors = validation_errors('<div class="alert alert-danger">', '</div>');
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url() ."edit/".$id);

        }else{
            // codes to run on success validation here
            $product_details = array(
                "product_name" => $this->input->post("product"),
				"price" => $this->input->post("price"),
                "description" => $this->input->post("product-description"),
				"product_id" => $this->input->post("product-id"),
            ); 
            $update_product = $this->product->update_product($product_details);
            if($update_product === TRUE) {
                // echo "Course is added!";
				$this->session->set_flashdata('update-product-success', "<div class=\"alert alert-success\">Product has been updated successfully.</div>");
                redirect(base_url()."edit/".$id);
            }
            
        }
         
	}


	public function destroy(){
		$delete_product = $this->product->delete_product($this->input->post("product-id"));
        // var_dump($delete_course);
        if($delete_product){
            $this->session->set_flashdata('delete-product-success','<div class="alert alert-success">Product has been deleted successfully</div>');
            redirect(base_url()."products");
        }
	}

   


    

}
