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


	public function generateExerciseInputForm(){


		$num_exercises = $this->input->post('number_of_exercises');

		if($num_exercises > 0)
		{
			echo "<form class=\"form-inline\" id=\"register_form\">";

			for($i = 0 ; $i < $num_exercises; $i++)
			{
				echo "<div class=\"form-group\">";
				echo "<label for=\"exercise\">Exercise:</label>";
				echo "<input type=\"text\" name=\"exercise\" placeholder=\"(Ex. Bench Press)\" class=\"form-control\" id=\"exercise_".$i."\">";
				echo "</div>";

				echo "<div class=\"form-group\">";
				echo "<label for=\"repetitions\">Repetitions:</label>";
				echo "<input type=\"text\" name=\"repetitions\" placeholder=\"(Ex. 12)\" class=\"form-control\" id=\"repetitions_".$i."\">";
				echo "</div>";


				echo "<div class=\"form-group\">";
				echo "<label for=\"exercise\">Weights:</label>";
				echo "<input type=\"text\" name=\"weights\" placeholder=\"(Ex. 180)\" class=\"form-control\" id=\"weights_".$i."\">";
				echo "</div><br><br>";


			}

			echo "</form>";
		}//end if

	               
	  



	}



}//end

