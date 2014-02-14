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
		$pw = $this ->input->post('pw_input');

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










}//end

