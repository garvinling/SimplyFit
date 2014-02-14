<?


?>


<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="Flat-UI-master/css/flat-ui.css">
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Leckerli+One' rel='stylesheet' type='text/css'>
    
</head>


<body style="background-color:#e74c3c;">

<div id="main_div">

	

	<h1 style="font-family: 'Leckerli One', cursive;">Now, we're cookin'.</h1>
	<br>

  	<?echo form_open('cookme/getRecipe');?>	
	<input type="text" name="pastelink" id="pastelink"  placeholder="Paste Recipe Link" class="form-control" style="width:300px; text-align:center;"/>
	<br><br>
	<input type="submit" class="btn btn-primary" value="Let's Cook!" style="width:300px;"/>
  	<? echo form_close(); ?>
  	<br><br>



</div>





</body>
</html>