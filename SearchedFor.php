<!DOCTYPE html>
<html>
<head>
	<title>search results</title>
	<link rel="stylesheet" href="CSS/bootstrap.min.css" type="text/css"> 
	<style>
		.card{
			border:none !important;	
		}


	</style>
</head>
<body>
	<?php include "menu.html" ?>

<div class = row>
	<div class = col><h3>search results</h3></div>
</div>

<?php
	print'<div class="row">';

for($i =0;$i<6;$i++){ 
  print '<div class="col-sm-3">';
    print '<div class="card">';
      print '<div class="card-body">';
      	  print'<img class="card-img-top" src="//placehold.it/200" alt="Card image cap">';

        print '<h5 class="card-title">Special title treatment</h5>';
      print'</div>';
    print '</div>';
  print '</div>';
}
  print '</div>';

?>


 

</body>
</html>