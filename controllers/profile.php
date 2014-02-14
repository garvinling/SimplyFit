<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	
	function __construct(){
			
		session_start();
		date_default_timezone_set('America/Los_Angeles');
		parent::__construct();

	}



	public function index()
	{		

		//$this->load->model('user_model');
		if(isset($_SESSION['user_name']))
		{
			$this->load->view('workout/profile_view');  //Send in data through the second argument

		}
		else
		{
			redirect('workoutlogger');
		}


	}






}//end

