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
		$workout_item = array( );

		$_SESSION['workout_items_num'] = sizeof($result);  //Number of workout items to list

		for($i = 0 ; $i < sizeof($result); $i = $i + 1)
		{

				$tags[$i]["tags"] = explode(',',$result[$i]["tags"]);	//Each index is an 
				$repetitions[$i]["repetitions"] = explode(',',$result[$i]["repetitions"]);
				$weight[$i]["weight"] = explode(',',$result[$i]["weight"]);
				// Structure: 
				// Tags --> item[i] --> array_of_tags[j];
				// Access: $weight[i]["repetitions"][j];

		}




		/*
		var_dump($tags);
		echo "<br>";
		var_dump($repetitions);
		echo "<br>";
		var_dump($weight);
		*/

for($i = 0; $i < sizeof($result) ; $i = $i + 1)
{



			  				$workout_item[$i][0] =  "<div id=\"workout_item_".$i."\">";
					
							$workout_item[$i][1] =  "<div class=\"row\">";
						
							$workout_item[$i][2] =  "<div class=\"col-md-2\"id=\"item_date\">";
							$workout_item[$i][3] =  "<h2 id=\"date_month\">".$result[$i]["date_month"]."</h2>";
							$workout_item[$i][4] =  "<h1 id=\"date_day\">".$result[$i]["date_day"]."</h1>";
							$workout_item[$i][5] =  "</div>";

							$workout_item[$i][6] =  "<div class=\"col-md-4\"id=\"item_time_highlights\">";

							$workout_item[$i][7] =  "<h4 id=\"workout_time\">Elapsed time: --:--</h4>";
													

							$max_reps = max($repetitions[$i]["repetitions"]);
							$max_weight = max($weight[$i]["weight"]);

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

			$_SESSION['workout_items'] = $workout_item;
	}//end function



}//end of class

