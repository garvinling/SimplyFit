<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	
	function __construct(){
			
		session_start();
		date_default_timezone_set('America/Los_Angeles');
		parent::__construct();

	}



	public function index()
	{		

	

		if(isset($_SESSION['user_name']))
		{
			
			$this->getExistingRoutines();
			$this->buildLogList();
			$this->load->view('workout/profile_view');  //Send in data through the second argument




		}
		else
		{
			redirect('workoutlogger');
		}
	}





	public function generateFormFromExistingRoutine(){

			$exercises = array();
			$routine_name = $this->input->post('name_of_routine');
			$this->load->model('workout_routine_model');

			//Get Routine from db and get number of get number of exercises in the routine. 
			$results = $this->workout_routine_model->getNumOfExercises($routine_name);

			if($results == false)
			{
				echo "404";
				return;
			}

			$exercise_string = $results-> exercises;
			$exercises = explode(',', $exercise_string);
			$num_of_exercises = sizeof($exercises);
			$this->generateExistingWorkoutInputForm($exercises);	//Generate the input form and send to client.
	}



	public function generateExerciseInputForm(){


		$num_exercises = $this->input->post('number_of_exercises');
		if($num_exercises > 0)
		{
			
			$_SESSION['exercise_num'] = $num_exercises;
			echo "<form class=\"form-inline\" id=\"new_exercise_form\">";
				

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
			echo "<input type=\"submit\" id=\"create_workout_button\" class=\"btn btn-primary\" value=\"Submit\"/>";

		}//end if

	}//end generateExerciseInputForm


	private function generateExistingWorkoutInputForm($exercises){

		$num_of_exercises = sizeof($exercises);


		if($num_of_exercises > 0)
		{
			
			$_SESSION['exercise_num'] = $num_of_exercises;

			echo "<form class=\"form-inline\" id=\"existing_exercise_form\">";
				

			for($i = 0 ; $i < $num_of_exercises; $i++)
			{
				echo "<div class=\"form-group\">";
				echo "<label for=\"exercise\">Exercise:</label>";
				echo "<input type=\"text\" name=\"exercise_".$i."\" placeholder=\"(Ex. Bench Press)\" class=\"form-control\" id=\"exercise_".$i."\"  value=\"".$exercises[$i]."\" readonly/>";
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
			echo "<input type=\"submit\" id=\"create_existing_workout_button\" class=\"btn btn-primary\" value=\"Submit\"/>";

		}//end if
	}


	public function gatherExerciseFormData(){
				
			$tags = $this->input->post('existing_routine_tags');

			$username = $_SESSION['user_name'];
			$num_exercises = $_SESSION['exercise_num'];
			$exercises = array();
			$repetitions = array();
			$weights = array();
		    $routine_name = $this->input->post('existing_routine_name');

		    $routine_name = ucfirst($routine_name);

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
			$this->workout_log_model->createNewLog($username,$date_month,$date_day,$routine_name,$weights,$repetitions,$tags);
			echo "200";
	}



	public function buildLogList(){


		$username = $_SESSION['user_name'];
		$this->load->model('workout_log_model');

		$result = $this->workout_log_model->gatherLogs($username); //LIMIT ?
		
		$this->createWorkoutItem($result);	





/*
			  echo "<div id=\"workout_item\">":
					
					echo "<div class=\"row\">";
						
							echo "<div class=\"col-md-2\"id=\"item_date\">";

								echo "<h2 id=\"date_month\">".$result["date_month"]."</h2>";
								echo "<h1 id=\"date_day\">".$result["date_day"]."</h1>";
							echo "</div>";

							echo "<div class=\"col-md-4\"id=\"item_time_highlights\">";

								echo "<h4 id=\"workout_time\">Elapsed time: --:--</h4>";
								echo "<h4 id=\"workout_highlights_reps\">Best reps: <span id=\"highlight_text\">".$result["repetitions"]."</span></h4>";
								echo "<h4 id=\"workout_highlights_weight\">Best weight: <span id=\"highlight_text\">".$result["weight"]." lbs.</span></h4>
							</div>";

							echo "<div class=\"col-md-4\"id=\"item_workout_tags\">";


								for($i = 0 ; $i < sizeof($tags); $i = $i + 1)
								{

									echo "<a href=\"#\"><code>".$tags[$i]."</code></a>";


								}

								

							echo "</div>";

						
							echo "<div class=\"col-md-2\" id=\"item_workout_tags\">";

								echo "<div class=\"circle-text-strength\" style=\"width:70px; margin-top:-13px; margin-left:12px;\"><div><h3 id=\"code_indicator\">S</h3></div></div>";


						echo "</div>
					</div>
				</div><!-- End workout item -->";

*/

	}



	public function getExistingRoutines(){

		$username = $_SESSION['user_name'];
		$this->load->model('workout_routine_model');
		$query = $this->workout_routine_model->getRoutines($username);


		$routine_names = array();
		$routine_exercises = array();	

		if($query !== false)
		{		
			

				for($i=0;$i<sizeof($query);$i=$i+1){

						$routine_names[$i] = $query[$i]["name_of_routine"];
       		
						$routine_exercises[$i] = $query[$i]["exercises"];
					

				}

			$_SESSION['routine_names'] = $routine_names;
			$_SESSION['exercises'] = $routine_exercises;


			return 200;
		}
		else
		{
			return 404;
		}
	}



	public function createWorkoutItem($result){

		$weight = array();
		$repetitions = array();
		$tags = array();
		$workout_item = array();
		$log_ids = array();
		$routines = array();

		$_SESSION['workout_items_num'] = sizeof($result);  //Number of workout items to list
		for($i = 0 ; $i < sizeof($result); $i = $i + 1)
		{
				$log_ids[$i] = $result[$i]["id_log"];

				$id = $log_ids[$i];

				$tags[$id]["tags"] = explode(',',$result[$i]["tags"]);	//Each index is an 
				$repetitions[$id]["repetitions"] = explode(',',$result[$i]["repetitions"]);
				$weight[$id]["weight"] = explode(',',$result[$i]["weight"]);
				$routines[$id]["routines"] = $result[$i]["name_of_routine"];

				// Structure: 
				// Tags --> item[i] --> array_of_tags[j];
				// Access: $weight[i]["repetitions"][j];
		}






for($i = 0; $i < sizeof($result) ; $i = $i + 1)
{		

				// Store {Routine Name(Or unique id) : Workouts/reps/weights data}
				// Onclick: send id as key for lookup in array. 

							$log_id = $log_ids[$i];
			  				$workout_item[$i][0] =  "<div id=\"workout_item_".$log_id."\">";
					
							$workout_item[$i][1] =  "<div class=\"row\">";
						
							$workout_item[$i][2] =  "<div class=\"col-md-2\"id=\"item_date\">";
							$workout_item[$i][3] =  "<h2 id=\"date_month\">".$result[$i]["date_month"]."</h2>";
							$workout_item[$i][4] =  "<h1 id=\"date_day\">".$result[$i]["date_day"]."</h1>";
							$workout_item[$i][5] =  "</div>";

							$workout_item[$i][6] =  "<div class=\"col-md-4\"id=\"item_time_highlights\">";

							$workout_item[$i][7] =  "<h4 id=\"workout_routine\">Routine Name: ".$routines[$log_id]["routines"]."</h4>";
													
							$max_reps = max($repetitions[$log_id]["repetitions"]);
							$max_weight = max($weight[$log_id]["weight"]);

							$workout_item[$i][8] =  "<h4 id=\"workout_highlights_reps\">Best reps: <span id=\"highlight_text\">".$max_reps."</span></h4>";
												
							$workout_item[$i][9] =  "<h4 id=\"workout_highlights_weight\">Best weight: <span id=\"highlight_text\">".$max_weight." lbs.</span></h4></div>";

							$workout_item[$i][10] =  "<div class=\"col-md-4\"id=\"item_workout_tags\">";

								/*
								for($k = 0 ; $k < sizeof($tags); $k = $k + 1)
								{

									$workout_item[$i][$k] =  "<a href=\"#\"><code>".$tags[$i]."</code></a>";


								}*/


							$workout_item[$i][11] =  "</div>";
						
							$workout_item[$i][12] =  "<div class=\"col-md-2\" id=\"item_workout_tags\">";

							$workout_item[$i][13] =  "<div class=\"circle-text-strength\" style=\"width:70px; margin-top:-13px; margin-left:12px;\"><div><h3 id=\"code_indicator\">S</h3></div></div>";


							$workout_item[$i][14] =  "</div>
					</div>
				</div><!-- End workout item -->";
	
			}//end for loop

					//Cache arrays into session

			$_SESSION['workout_items'] = $workout_item;
			$_SESSION['tags']  = $tags;
			$_SESSION['reps'] = $repetitions;
			$_SESSION['weight'] = $weight;
			$_SESSION['log_id'] = $log_ids;


	}//end function




	/*
		getWorkoutAnalysis()
		
		Analyze user's workout data. 

		-Compare to previous x amount of same workout routines.


	*/

	public function getWorkoutAnalysis(){
		
		$exercises = array();
		$username = $_SESSION['user_name'];
		$this->load->model('workout_routine_model');
		$this->load->model('workout_log_model');
		$id = $this->input->post('id_log');

		//Get Routine exercises	by name of routine and username  
		/*
		$result = $this->workout_routine_model->getRoutineWorkouts($id,$username);

		if($result == false)
		{
			echo "404: Data not found.";
			return;
		}
		*/

				$result = $this -> getRoutineWorkouts($id,$username);

				$routine_name = $result -> name_of_routine;
				//Output workout to the details section.
				$exercises_string = $result -> exercises;
				$exercises = explode(',',$exercises_string);

				for($i = 0; $i < sizeof($exercises) ; $i = $i + 1)
				{

					echo "<h5>Workout: ".$exercises[$i]."</h5>";
					echo "<h5>Reps:".$_SESSION['reps'][$id]["repetitions"][$i]."</h5>";
					echo "<h5>Weight:".$_SESSION['weight'][$id]["weight"][$i]."</h5>";
					echo "<br><br>";

				}
	}



	public function getRoutineWorkouts($id,$username){
		
		$result = $this->workout_routine_model->getRoutineWorkouts($id,$username);

		if($result == false)
		{
			return false;
		}

		return $result;



	}

	public function getRoutineComparison(){
		
		$prev_log_id = null;
		$username = $_SESSION['user_name'];
		$this->load->model('workout_routine_model');
		$this->load->model('workout_log_model');
		$id = $this->input->post('id_log');


				$result = $this->getRoutineWorkouts($id,$username);		
				$routine_name = $result-> name_of_routine;	
				$exercises_string = $result -> exercises;
				$exercises = explode(',',$exercises_string);

				//Get last workout log with the same routine name for comparison
				$result_workout_previous = $this->workout_log_model->getLastMatchingWorkoutObject($username,$routine_name);

				if($result_workout_previous == false)
				{
					echo "404: previous routine not found";
					return;
				}


				//Find the last workout that isnt the current one.  Get that log_id and use it as the key in the SESSION arrays that hold reps/weights


				for($i = 0; $i < sizeof($result_workout_previous) ; $i = $i + 1)
				{
						

						if($id == $result_workout_previous[$i]["id_log"])	//Check if the id log of the row is our current selected ID.  Exit loop.
						{
							break;
						}

						$prev_log_id = $result_workout_previous[$i]["id_log"];

				}

				if($prev_log_id != null)
				{
					$this -> compareData($exercises,$prev_log_id,$id);

				}

	}




	public function compareData($exercises,$prev_id,$current_id){

		//Comparing $_SESSION['reps'][$prev_log_id][$index] to $_SESSION['reps']['$id'][$index];
		//Set results in $_SESSION['analysis']
		$size = sizeof($exercises);


		$analysis = array();    //array to store all analysis messages

		for($i=0;$i<$size;$i=$i+1)
		{
			$prev_rep = $_SESSION['reps'][$prev_id]["repetitions"][$i];
			$curr_rep = $_SESSION['reps'][$current_id]["repetitions"][$i];
			$prev_weight = $_SESSION['weight'][$prev_id]["weight"][$i];
			$curr_weight = $_SESSION['weight'][$current_id]["weight"][$i];
			

			if($curr_rep > $prev_rep)
			{

				$analysis[$i] = "<h1> Your <strong>".$exercises[$i]."</strong> repetitions increased by <span style=\"font-weight:bold; color:#e74c3c;\">3 %</span></h1>";
							echo $analysis[$i];

			}

			if($curr_weight > $prev_weight)
			{

				$analysis[$i] = "<h1> Your <strong>".$exercises[$i]."</strong> weight increased by <span style=\"font-weight:bold; color:#e74c3c;\">3 %</span></h1>";
				echo $analysis[$i];

			}
		}
		$_SESSION['analysis'] = $analysis;



	}





	public function compareWeight(){



	}


	public function compareTime(){
		//Add support for cardio/running/mile times.

	}













}//end of class

