<?php 

	class Workout_log_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}


		public function createNewLog($username,$date,$routine_name,$weight,$reps){

					$data_logs = array(

							'id_username' => $username,
							'date'        => $date,
							'name_of_routine' => $routine_name,
							'weight'      => $weight,
							'repetitions' => $reps
								

							);

							$this-> db -> insert('user_workouts_logs', $workout_log);

		}



	}
?>