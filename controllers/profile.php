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


	public function gatherExistingExerciseFormData(){
				
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
			//$this->load->model('workout_routine_model');
			//$this->workout_routine_model->createNewRoutine($username,$routine_name,$exercises);
			$type = $this->getType($exercises);


			$date_month = date('F');
			$date_day = date('d');
			$date_month = substr($date_month,0,3);

			echo $tags;
			$this ->load->model('workout_log_model');
			$this->workout_log_model->createNewLog($username,$date_month,$date_day,$routine_name,$weights,$repetitions,$tags,$type);
			echo "200";
	}

	public function gatherExerciseFormData(){
				
			$tags = $this->input->post('routine_tags');
			$username = $_SESSION['user_name'];
			$num_exercises = $_SESSION['exercise_num'];
			$exercises = array();
			$repetitions = array();
			$weights = array();
		    $routine_name = $this->input->post('routine_name');



		    $routine_name = ucfirst($routine_name);

			for($i = 0 ; $i < $num_exercises; $i = $i + 1)
			{

				$exercises[$i] = $this ->input -> post('exercise_'.$i);
				$repetitions[$i] = $this ->input->post('repetitions_'.$i);
				$weights[$i] = $this ->input->post('weights_'.$i);

			}

			$type = $this->getType($exercises);

			//Create the workout routine first, then create the log.  the log inherits from routine db object. 
			$this->load->model('workout_routine_model');
			$this->workout_routine_model->createNewRoutine($username,$routine_name,$exercises);


			$date_month = date('F');
			$date_day = date('d');
			$date_month = substr($date_month,0,3);

			echo $tags;
			$this ->load->model('workout_log_model');
			$this->workout_log_model->createNewLog($username,$date_month,$date_day,$routine_name,$weights,$repetitions,$tags,$type);
			echo "200";
	}




	public function buildLogList(){


		$username = $_SESSION['user_name'];
		$this->load->model('workout_log_model');

		$result = $this->workout_log_model->gatherLogs($username); //LIMIT ?
		
		$this->createWorkoutItem($result);	

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
		$types = array();

		$_SESSION['workout_items_num'] = sizeof($result);  //Number of workout items to list
		for($i = 0 ; $i < sizeof($result); $i = $i + 1)
		{
				$log_ids[$i] = $result[$i]["id_log"];

				$id = $log_ids[$i];

				$tags[$id]["tags"] = explode(',',$result[$i]["tags"]);	//Each index is an 
				$repetitions[$id]["repetitions"] = explode(',',$result[$i]["repetitions"]);
				$weight[$id]["weight"] = explode(',',$result[$i]["weight"]);
				$routines[$id]["routines"] = $result[$i]["name_of_routine"];
				$types[$id]["types"] = $result[$i]["type"];

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

							$workout_item[$i][10] =  "<div class=\"col-md-4\" id=\"item_workout_tags\">";

								
								for($k = 0 ; $k < sizeof($tags[$log_id]["tags"]); $k = $k + 1)
								{
									$workout_item[$i][$k+11] =  "<a href=\"#\"><code>".$tags[$log_id]["tags"][$k]."</code></a>";
									$j = $k+12;
								}

							$workout_item[$i][$j] =  "</div>";
						
							$workout_item[$i][$j+1] =  "<div class=\"col-md-2\" id=\"item_workout_tags\">";

							//$workout_item[$i][$j+2] =  "<div class=\"circle-text-strength\" style=\"width:70px; margin-top:-13px; margin-left:12px;\"><div><h3 id=\"code_indicator\">".$types[$log_id]["types"]."</h3></div></div>";
							$workout_item[$i][$j+2] = $this->getIndicatorLine($types[$log_id]["types"],$log_id);

							$workout_item[$i][$j+3] =  "</div>
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

				$result = $this -> getRoutineWorkouts($id,$username);

				$routine_name = $result -> name_of_routine;
				//Output workout to the details section.
				$exercises_string = $result -> exercises;
				$exercises = explode(',',$exercises_string);

				for($i = 0; $i < sizeof($exercises) ; $i = $i + 1)
				{

					echo "<div id=\"exercise_graph_".$i."\" style=\"padding-top:20px;\">";
					echo "<a href=\"#\">";
					echo "<h3 style=\"font-weight:300;\">".$exercises[$i]."</h3>";
					echo "<h5>Reps:".$_SESSION['reps'][$id]["repetitions"][$i]."</h5>";
					echo "<h5>Weight:".$_SESSION['weight'][$id]["weight"][$i]."</h5>";
					echo "<br><br>";
					echo "</a>";
					echo "</div>";

				}
	}



	public function getRoutineWorkouts($id,$username){
		
		$this->load->model('workout_routine_model');
		$result = $this->workout_routine_model->getRoutineWorkouts($id,$username);

		if($result == false)
		{
			return false;
		}

		return $result;



	}

	public function getRoutineComparison(){
		
		$prev_log_id = null;
		$found = false;
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

				//PREVIOUS ID data handling is broken
				//Find the last workout that isnt the current one.  Get that log_id and use it as the key in the SESSION arrays that hold reps/weights

				for($i = 0; $i < sizeof($result_workout_previous) ; $i = $i + 1)
				{
							//need to fix this algorithm. broken for 1st item. after clicking 1st item it always returns null.

						if($id == $result_workout_previous[$i]["id_log"])	//Check if the id log of the row is our current selected ID.  Exit loop.
						{
						
							break;
						}


						$prev_log_id = $result_workout_previous[$i]["id_log"];

				}

				if($prev_log_id!=null)
				{	
					$_SESSION['curr_workout_id'] = $id;
					$_SESSION['prev_workout_id'] = $prev_log_id;
					$this -> compareData($exercises,$prev_log_id,$id);
				}
				else
				{
					//$_SESSION['prev_workout_id'] = null;
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

				$percentage = $this->calculatePercentage($prev_rep,$curr_rep);

				$analysis[$i] = "<h1> Your <strong>".$exercises[$i]."</strong> repetitions increased by <span style=\"font-weight:bold; color:#e74c3c;\">".$percentage."%</span></h1>";
				echo $analysis[$i];

			}

			if($curr_weight > $prev_weight)
			{
				$percentage = $this->calculatePercentage($prev_weight,$curr_weight);
				$analysis[$i] = "<h1> Your <strong>".$exercises[$i]."</strong> weight increased by <span style=\"font-weight:bold; color:#e74c3c;\">".$percentage."%</span></h1>";
				echo $analysis[$i];

			}
		}
	

		$_SESSION['analysis'] = $analysis;

	}


	public function getGraphData(){



			/*
					
				@param: log_id

				Use log_id to get routine_name from selected log. [x]
					Get exercisees based on routine_name.  [x]
						For initial state, grab the first indexed exercise.
							Grab data_weight for all previous log_ids @ exercise_offset ( in this case 0)
								Grab data_reps for all preivious log_ids @ exercise offset (in this case 0)
								   Build JSON array and echo to client

			*/

		$weight_string = "";
		$new_reps_string = "";
		$old_weight_string = "";
		$reps_string = "";
		$prev_id = "";
		$previous_ids = array();					//Array to store all the previous IDs matching the current routine.

		$username = $_SESSION['user_name'];
		$id = $this->input->post('id_log');

		$result = $this->getRoutineWorkouts($id,$username);									//Get routine workouts that match the clicked id of the workout item.  
		
		$exercises_string    = $result-> exercises;		
		$exercises = explode(',',$exercises_string);	

		$routine_name = $result-> name_of_routine;	

		$previous_ids = $this -> getAllPreviousRoutineData($routine_name,$username,$id);	//Grab all previous workout log items based on the routine name and username

		if($previous_ids == null)
		{

			echo "404";								//Echo 404 and hide graph and show message.
			return;

		}

		$size = sizeof($_SESSION['reps'][$_SESSION['prev_workout_id']]["repetitions"]);

		$exercise_name = $exercises[0];			//Set the exercise name for the graph title


		for($i = 0 ; $i < sizeof($previous_ids); $i = $i + 1)
		{	
			$prev_id = $previous_ids[$i];
			$weight_string = $weight_string.$_SESSION['weight'][$prev_id]["weight"][0].",";	    //get at workout id at exercise offset $i
			$reps_string    = $reps_string.$_SESSION['reps'][$prev_id]["repetitions"][0].",";
		}
		
		$weight_string = substr($weight_string,0,-1);		//Get rid of trailing comma
		$reps_string   = substr($reps_string,0,-1);

		$data_weight = explode(',',$weight_string);			//Explode the strings into corresponding arrays
		$data_reps   = explode(',',$reps_string);

		array_walk($data_reps,'intval');
		array_walk($data_weight,'intval');


		foreach ($data_reps as $key => $var) {				//Convert to int array
		    
		    $data_reps[$key] = (int)$var;
		   	

		}

		foreach ($data_weight as $key => $var) {
		 
		   	
		   	$data_weight[$key] = (int)$var;


		}

		/*
			for($i = 0; $i < sizeof($exercises); $i = $i + 1)
			{
				for($j = 0 ; $j < sizeof($previous_ids); $j = $j + 1)
				{
						$prev_id     = $previous_ids[$j];
						echo "Adding data for id: ".$prev_id;
						$prev_weight = $_SESSION['weight'][$prev_id]["weight"][$i];	    //get at workout id at exercise offset $i
						$prev_rep    = $_SESSION['reps'][$prev_id]["repetitions"][$i];

						$data_weight[$i] = $prev_weight.",";
						$data_reps[$i]   = $prev_rep.",";								//Save the weight/rep data for all ids of an exercise.

				}
					$data_reps[$i] = substr($data_reps[$i],0,-1);						//Parse out the last comma
					$data_weight[$i] = substr($data_weight[$i],0,-1);

			}



			for($i = 0; $i < sizeof($exercises); $i = $i + 1)
			{

					$response["ExerciseName_".$i] = $exercises[$i];
					$response["DataWeight_".$i] = explode(',',$data_weight[$i]);  
					$response["DataReps_".$i] = explode(',',$data_reps[$i]);

			}
			var_dump($response);


	*/


/*
		array_walk($data_reps,'intval');
		array_walk($data_weight,'intval');

	

	*/
		$response = array( 'exerciseName'=>$exercise_name,'repetitions' => $data_reps,'weight'=>$data_weight);

		echo json_encode($response);
	}






	public function getAllPreviousRoutineData($routine_name,$username,$id){

				$this->load->model('workout_log_model');
				$this->load->model('workout_routine_model');



		
				$result_workout_previous = $this->workout_log_model->getLastMatchingWorkoutObject($username,$routine_name);

				if($result_workout_previous == false)
				{
					echo "404: previous routine not found";
					return;
				}



				if(sizeof($result_workout_previous) == 1)
				{
					return false;		//Return if there is only one entry 
				}



				for($i = 0; $i < sizeof($result_workout_previous) ; $i = $i + 1)
				{	

					if($id == $result_workout_previous[$i]["id_log"])
					{
						$previous_ids[$i] = $result_workout_previous[$i]["id_log"];
						return $previous_ids;
					}

					$previous_ids[$i] = $result_workout_previous[$i]["id_log"];

				}

				return $previous_ids;


	}






	public function calculatePercentage($starting,$current){

			$total = $current - $starting; 

			$total = $total / $starting; 

			$total = $total * 100; 

			return round($total);	//return rounded total




	}



	private function getType($exercises){


		//This function is the algorithm for auto-detecting workouttype 
		//Need to come up with some sort of a language processor or table lookup.  


		//For now we will look at basic cases such as searching for body part names/lift/etc. 


		for($i = 0; $i < sizeof($exercises); $i = $i + 1)
		{

			$ex = $exercises[$i];

			if(strpos($ex,'bicep') !== FALSE  || strpos($ex,'skull crushers') || strpos($ex,'dips'))
			{
				return "S";
			}
			else
			{
				return "H";
			}


		}



	}

	private function getIndicatorLine($indicator,$id_log){


			if($indicator == 'S')
			{
				return "<div class=\"circle-text-strength\" style=\"color:white;width:70px; margin-top:-13px; margin-left:12px;\"><div><h3 id=\"code_indicator_".$id_log."\" style=\"color:white;\">S</h3></div></div>";

			}
			else if($indicator == 'X')
			{
				return "<div class=\"circle-text-cross\" style=\"color:white;width:70px; margin-top:-13px; margin-left:12px;\"><div><h3 id=\"code_indicator_".$id_log."\" style=\"color:white;\">X</h3></div></div>";

			}
			else if($indicator == 'C')
			{				

				return "<div class=\"circle-text\" style=\"color:white;width:70px; margin-top:-13px; margin-left:12px;\"><div><h3 id=\"code_indicator_".$id_log."\" style=\"color:white;\">C</h3></div></div>";

			}
			else if($indicator == 'H')
			{
				return "<div class=\"circle-text-HIIT\" style=\" color:white;width:70px; margin-top:-13px; margin-left:12px;\"><div><h3 id=\"code_indicator_".$id_log."\" style=\"color:white;\">H</h3></div></div>";

			}


	}



	public function getWorkoutPercentage(){

		$s = 0;
		$x = 0;
		$h = 0;
		$c = 0;

		$username = $_SESSION['user_name'];
		$this ->load->model('workout_log_model');
		$result = $this->workout_log_model->getTypes($username);

		if($result == false)
		{
			echo "404";
			return;
		}

		for($i = 0 ; $i < sizeof($result); $i = $i + 1)
		{

			$type = $result[$i]["type"];

			if($type == 'C')
			{
				$c++;
			}
			else if($type == 'X')
			{	
				$x++;

			}
			else if($type == 'H')
			{
				$h++;

			}
			else if($type == 'S')
			{
				$s++;
			}


		}

		$total = $c + $x + $h + $s; 

		$c_percentage = ($c / $total)*100;
		$x_percentage = ($x / $total)*100;
		$h_percentage = ($h / $total)*100;
		$s_percentage = ($s / $total)*100;

		$response = array('Cpercentage'=>$c_percentage,'Xpercentage'=>$x_percentage,'Hpercentage'=>$h_percentage,'Spercentage'=>$s_percentage);

		echo json_encode($response);

	}








}//end of class

