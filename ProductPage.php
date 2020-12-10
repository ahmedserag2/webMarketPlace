<!DOCTYPE html>
<html>
<head>
	<title>products page</title>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="CSS/bootstrap.min.css" type="text/css"> 
 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
  /* Make the image fully responsive */
  
  
  </style>

</head>
<body>

	<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
  <div class="col-12 col-md-8"><h5>{Product Title}</h5></div>
  
</div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<div class="row">
  <div class="col-6 col-md-3">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	    <ol class="carousel-indicators">
	        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    </ol>
	    <div class="caousel-inner">
	        <div class="carousel-item active">
	            <img class="d-block w-100" src="//placehold.it/200" alt="First slide">
	            <div class="carousel-caption d-none d-md-block">
	                <h5>My Caption Title (1st Image)</h5>
	                <p>The whole caption will only show up if the screen is at least medium size.</p>
	            </div>
	        </div>
	        
	        <div class="carousel-item">
	            <img class="d-block w-100" src="//placehold.it/200" alt="Third slide">
	        </div>
	    </div>
	    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	        <span class="sr-only">Previous</span>
	    </a>
	    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	        <span class="carousel-control-next-icon" aria-hidden="true"></span>
	        <span class="sr-only">Next</span>
	    </a>
	</div></div>
  <div class="col-6 col-md-3">Description: <br> {detailsPlaceHolder}</div>
  <div class= "col-6 col-md-3"><button type="button" class="btn btn-success btn-lg">Add to cart</button></div>
  <div class="col-6 col-md-3">.col-6 .col-md-4</div>
</div>

<!-- Columns are always 50% wide, on mobile and desktop -->
<div class="row">
  <div class="col-6">.col-6</div>
  <div class="col-6">.col-6</div>
</div>


	
</body>
</html>