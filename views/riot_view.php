<?
	if(isset($_SESSION['summoner_level'])){

		$summoner_level = $_SESSION['summoner_level'];




	}
	else{
		$summoner_level = false;


	}

if(isset($_SESSION['summoner_name'])){

	$summoner_name = $_SESSION['summoner_name'];

	if(isset($_SESSION['lastchamp'])){

		$lastchampused = $_SESSION['lastchamp'];
		
	}
	else{
		$lastchampused = false;
	}

}
else{
	$summoner_name = false;
}





?>


<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css"/>
    <!--link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>-->
    <link rel="stylesheet" type="text/css" href="Flat-UI-master/css/flat-ui.css">
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
    
    
</head>


<body style="background-color:#e74c3c;">

<div id="main_div">

	

	<h1 style="font-family:'Friz',sans-serif;">Lgnds</h1>
	<br>

  	<?echo form_open('thatsariot/getinfo');?>	
	<input type="text" name="summoner" id="summoner"  placeholder="Who goes there, summoner?" class="form-control" style="width:300px; text-align:center;"/>
	<br><br>
	<input type="submit" class="btn btn-primary" value="Find out" style="width:300px;"/>
  	<? echo form_close(); ?>
  	<br><br>
		<?

	

		if($summoner_level !== false){

			echo "You are level: ".$summoner_level; echo "<br><br>";
			if($lastchampused !== false){
			echo "You last played with: ".$lastchampused;

			}

		}
		else{

			if($summoner_name !== false){
			
				echo $summoner_name, "WHO the FUCK are you? ";
			
			}
		}


		?>


</div>





</body>
</html>