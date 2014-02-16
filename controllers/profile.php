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
			
			$_SESSION['exercise_num'] = $num_exercises;
			echo "<form class=\"form-inline\" id=\"new_exercise_form\">";
				
				echo "<div class=\"form-group\">";
				echo "<label for=\"exercise\">Name your exercise:</label>";
				echo "<input type=\"text\" name=\"routine_name\" placeholder=\"(Ex. Tricep Thursday)\" class=\"form-control\" id=\"routine_name\"/>";
				echo "</div>  <br><br>";

				echo "<div class=\"form-group\">";
				echo "<label for=\"exercise\">Tags:</label>";
				echo "<input type=\"text\" name=\"routine_tags\" data-role=\"tagsinput\" placeholder=\"#LegDay\" class=\"form-control\" id=\"routine_tags\"/>";
				echo "</div>  <br><br>";

			for($i = 0 ; $i < $num_exercises; $i++)
			{
				echo "<div class=\"form-group\">";
				echo "<label for=\"exercise\">Exercise:</label>";
				echo "<input type=\"text\" name=\"exercise_".$i."\" placeholder=\"(Ex. Bench Press)\" class=\"form-control\" id=\"exercise_".$i."\"/>";
				echo "</div>  &nbsp; &nbsp;";

				echo "<div class=\"form-group\">";
				echo "<label for=\"repetitions\">Repetitions:</label>";
				echo "<input type=\"text\" name=\"repetitions_".$i."\" placeholder=\"(Ex. 12)\" class=\"form-control\" id=\"repetitions_".$i."\">";
				echo "</div> &nbsp; &nbsp;";


				echo "<div class=\"form-group\">";
				echo "<label for=\"exercise\">Weights:</label>";
				echo "<input type=\"text\" name=\"weights_".$i."\" placeholder=\"(Ex. 180)\" class=\"form-control\" id=\"weights_".$i."\">";
				echo "</div><br><br>";

			}
			echo "<input type=\"submit\" id=\"create_workout_button\" class=\"btn btn-primary\" value=\"register\"/>";

		}//end if
	}//end generateExerciseInputForm



	public function gatherExerciseFormData(){
				
			$tags = $this->input->post('routine_tags');

			$username = $_SESSION['user_name'];
			$num_exercises = $_SESSION['exercise_num'];
			$exercises = array();
			$repetitions = array();
			$weights = array();
		    $routine_name = $this->input->post('routine_name');

			for($i = 0 ; $i < $num_exercises; $i = $i + 1)
			{

				$exercises[$i] = $this ->input -> post('exercise_'.$i);
				$repetitions[$i] = $this ->input->post('repetitions_'.$i);
				$weights[$i] = $this ->input->post('weights_'.$i);

			}

			//Create the workout routine first, then create the log.  the log inherits from routine db object. 
			$this->load->model('workout_routine_model');
			$this->workout_routine_model->createNewRoutine($username,$routine_name,$exercises);


			$date_month = date('F');
			$date_day = date('d');
			$date_month = substr($date_month,0,3);

			echo $tags;
			$this ->load->model('workout_log_model');
			$this->workout_log_model->createNewLog($username,$date_month,$date_day,$routine_name,$weights,$repetitions);
			echo "200";
	}






}//end

