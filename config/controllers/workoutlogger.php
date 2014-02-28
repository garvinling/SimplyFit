<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workoutlogger extends CI_Controller {

	
	function __construct(){
			
		session_start();
		date_default_timezone_set('America/Los_Angeles');
		parent::__construct();

	}



	public function index()
	{		

		//$this->load->model('user_model');


		$this->load->view('workout/workout_view_landing');

	}






	public function validateUserName(){

		$username =  $this->input->post('user_name');
		$pw = sha1($this ->input->post('pw_input'));

		$this->load->model('user_model');

		$exists = $this->user_model->check_for_existing($username);

		if($exists == true)
		{
			echo "404";  //User already exists
		}
		else
		{
			echo "/profile/";  //Username already exists.
			$this->user_model->addUser($username,$pw);
			//Set user to session. 
			$_SESSION['user_name'] = $username;
		}


	}


	public function login(){


		$username = $this->input->post('existing_user_name');
		$pw = $this->input->post('existing_pw');

		$this->load->model('user_model');

		$exists = $this->user_model->check_for_existing($username);



		if($exists == true)
		{
				$result = $this->user_model->get($username,$pw);


				if($result != false)
				{
					$_SESSION['user_name'] = $result->id_username;
					echo "/profile/";
					return;
				}
		}


 		echo "404";

	}


	public function logout(){

		session_destroy();
		redirect('workoutlogger');



	}







}//end

