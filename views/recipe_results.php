<?


?>


<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="Flat-UI-master/css/flat-ui.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Leckerli+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Signika+Negative' rel='stylesheet' type='text/css'>
        <script src="bootstrap/js/bootstrap.js"></script>
<script>
  $('#myAffix').affix({
    offset: {
      top: 100
    , bottom: function () {
        return (this.bottom = $('.bs-footer').outerHeight(true))
      }
    }
  })
</script>
    
</head>


<body style="background-color:white;">

<section id="section1">

	<div class="row-fluid">


		<div class="span6" id="recipe">

			<?

				$array = explode(",",$_SESSION['items']);



				for($i = 0; $i < sizeof($array); $i = $i + 1){

					$array[$i] = strip_tags($array[$i]);
					echo $array[$i]."<br>";
				}


			?>
		</div>


		<div class="span6" id="directions"data-spy="affix" data-offset-top="60" data-offset-bottom="200" >


			<?

				$array_d = explode(",",$_SESSION['directions']);
				
				for($i = 0; $i < sizeof($array_d); $i = $i + 1){
				
					$array_d[$i] = strip_tags($array_d[$i]);

					echo $i.": ".$array_d[$i]."<br><br><br>";

				}


			?>

		</div>





	</div>









</section>
	









</body>
</html>