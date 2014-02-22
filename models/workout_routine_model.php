<?php 

	class Workout_routine_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}


		public function createNewRoutine($username,$routine_name,$exercises){



					$comma_separated_exercises = implode(",", $exercises);

					$routine = array(

							'id_username' => $username,
							'name_of_routine' => $routine_name,
							'exercises' => $comma_separated_exercises

							);

							$this-> db -> insert('user_workouts_routines', $routine);

		}


		public function getRoutines($username){




			$query = $this -> db -> where('id_username',$username)->get('user_workouts_routines');	//Should we set a limit here?



			if($query -> num_rows > 0)
			{

				return $query -> result_array(); 

			}


			return false;


		}


		public function getRoutineWorkouts($id){


			


			
		}







	}
?>