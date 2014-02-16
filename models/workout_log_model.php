<?php 

	class Workout_log_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}


		public function createNewLog($username,$date_month,$date_day,$routine_name,$weight,$reps,$tags){

					$comma_separated_repetitions = implode(",", $reps);
					$comma_separated_weight = implode(",", $weight);
					
	

					//Account fo ryear! 
					$data_logs = array(

							'id_username' => $username,
							'date_month'        => $date_month,
							'date_day'        =>   $date_day,
							'name_of_routine' => $routine_name,
							'weight'      => $comma_separated_weight,
							'repetitions' => $comma_separated_repetitions,
							'tags'        => $tags
								

							);

							$this-> db -> insert('user_workouts_logs', $data_logs);

		}



	}
?>