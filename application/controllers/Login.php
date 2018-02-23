<?php

class Login extends CI_Controller {
               
	function __construct()
	{
 		 parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
       $this->load->library('session');
          $this->load->helper('html');
          $this->load->model('Login_model');
		 // $this->load->model('Order_model');
	}	
	function index()
	{			
		$this->form_validation->set_rules('username', 'Username', 'required');			
		$this->form_validation->set_rules('password', 'Password', 'required');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
		$data["title"]='login';;
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/login");	
		  $this->load->view("template/footer");		
		
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'username' => set_value('username'),
					       	'password' => set_value('password')
						);
					
			// run insert model to write data to db
		
			//check if username and password is correct
			$username = $this->input->post("username");
          $password = $this->input->post("password");
			
		//	$this->load->model('Login_model'); # Load Model
			$usr_result = $this->Login_model->get_user($username, $password);
                  //  $usr_result = $this->login_user->get_user($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
						//$data['records'] = $this->testmodel->getAllRecords();
						$result['records'] = $this->Login_model->get_contents($username, $password);
					// echo $data['records']['fullname']; 
                         //set the session variables
                         $sessiondata = array(
                              'username' => $username,
							  'membername'=> $result['records'][0]['fullname'],
							  'email'=> $result['records'][0]['email'],
							  'pass'=> $password,
							   'group'=> $result['records'][0]['mygroup'],
							    'startd'=> date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days')),
								 'endd'=> date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')),
                              'loginuser' => TRUE
                         );
						
					 $this->session->set_userdata($sessiondata);	 
                        
						 
						  $page="HOME";
						  
						 $data = array('title' => $page);
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/home');	
		  $this->load->view("template/footer");
                    }
                    else
                    {
                    //     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                          $data["title"]="Login";
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/login');	
		  $this->load->view("template/footer");
                    }
			
		}
	}
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
}
?>