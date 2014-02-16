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



	}
?>