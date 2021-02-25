<!DOCTYPE html>
<html>
<head>
	<title>products page</title>



	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
<!-- Bootstrap CSS -->
     <link rel="stylesheet" href="CSS/ProductPage.css" type="text/css"> 


<?php 
  session_start();
  include 'menu.php';
?>
<!-- ajax method to add to cart -->
<script>
  //more error handeling could be added to check if the cart item has been added or not 
  //you could check it from the sessions incase the ajax method somehow fails to add the item to the cart 
  //handle the bug if the user exists the page and then gets back in to add the product 
  addedToCart = false;
  <?php 
    
   // if(!isset($_SESSION['inSession']))
      $_SESSION['inSession'] = false;
  ?>
  inSession = <?php echo json_encode($_SESSION['inSession']); ?>;
  console.log(inSession);
  function setData()
  {
    if(!addedToCart && !inSession)
    {
      jQuery.ajax({

            url:"./ajaxphp/SaveCartSession.php",
            data:'productId='+$("#productId").val()+'&quantity='+$("#quantity").val(),
            type:"POST",

            success:function(data)
            {
              showmsg(data);
              addedToCart = true;
            }
          });
    }
    else
    {
        //show message saying item already added 
        showmsg("item already added");

    }

  }

  function addReview()
  {

   rating = $(".ratingStar:checked").val();
   productIndex = $("#productId").val();
   totalRating = $("#totalRating").val();
   noOfReviews = $("#noOfReviews").val();

   //alert(rating);
    jQuery.ajax({
       
            url:"./ajaxphp/AddReview.php",
            data:'review='+$("#review").val()+'&rating='+rating
            +'&productIndex='+productIndex
            +'&totalRating='+totalRating
            +'&noOfReviews='+noOfReviews,
            type:"POST",

            success:function(data)
            {
              // alert('inajax');
              alert(data);
              //showmsg(data);
              
            }
          });
  }


    function showmsg(message) {
        var x = document.getElementById("msg");
        document.getElementById("msg").innerHTML = message;
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

    }

</script>


<!-- stars rating -->
<script>
  
  $(document).ready(function(){
        $('.rating input').change(function () {
      var $radio = $(this);
      $('.rating .selected').removeClass('selected');
      $radio.closest('label').addClass('selected');
    })
      });
</script>


</head>

<body>

<?php 
	//care because kareem might not neccisarily work with sessions 2aslan
//getting the index from the session
	
	




  //if there are no items added to the cart make an array
  if(!isset($_SESSION['cartItems']))
    $_SESSION['cartItems'] = array();

  // pulling the ratings from DB
   $serverName = "localHost";
    $userName = "root";
    $password = "";
    $DB = "mydb";
    //NOTE THAT THIS IS THE PRODUCTiD 
    $productIndex = $_GET['q']; 




    //$productId = $_SESSION["allRecords"][$productIndex]["Id"];
    $conn = mysqli_connect($serverName, $userName, $password, $DB);

    if(!$conn)
    {
      error_log(mysqli_connect_error(),3,"../errors/db-errors.log");
      die("connect failed : " . mysqli_connect_error());
    }
    //join on customerid later

    $sqlsearch = "SELECT R.Details,R.Rating ,U.firstName,U.lastName,U.Id
    FROM reviews R
    JOIN user U
    ON R.customerId = U.Id
     WHERE productId = $productIndex";

    //get product by Id
    $sqlGetProduct = "SELECT * FROM products WHERE Id = $productIndex";
    $productResult = $conn->query($sqlGetProduct);
    $product = mysqli_fetch_array($productResult);
   // echo $product['Name'];

    
    $result = $conn->query($sqlsearch);
    //change to all reviews later
    $allRecords = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    
    
    $currentRating = $product["rating"];

    $ratingPerc =  $currentRating * 20;


 ?>
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">

  <div class="col-12 col-md-8"><h5><?php echo $product["Name"]; ?></h5></div>
  
</div>

<!-- slider and product details -->
<div class="row">
  <div class="col-6 col-md-3">
	
            <!-- add a loop here to read each pic -->
            <?php

                $path = "./images/products/".$product['Id'];
                $files = glob($path, GLOB_BRACE);
                $noImagePath = "./images/products/no-image.png";
                 $validatedPath = empty($files)? $noImagePath : $files[0];
                printf('<img class="d-block w-100" src="%s" alt="First slide">', $validatedPath);
             ?>
	          
	      
</div>
  <div class="col-6 col-md-3">Description: <br><?php echo $product['Details'];?><br>
      Price: <?php echo $product['Price'] ;?>
      <br>
      
      <span class="score">
      <div class="score-wrap">
        <!--60:30stars -->
          <!--
            20 percent for 1 star
            40 percent for 2 stars
           60 percent is 3 stars etc etc 
            85 for 4 stars
            100 is 5 stars-->
          <span class="stars-active" style="width: <?php echo $ratingPerc."%"; ?>">
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
          </span>
          <span class="stars-inactive">
              <i class="fa fa-star-o" aria-hidden="true"></i>
              <i class="fa fa-star-o" aria-hidden="true"></i>
              <i class="fa fa-star-o" aria-hidden="true"></i>
              <i class="fa fa-star-o" aria-hidden="true"></i>
              <i class="fa fa-star-o" aria-hidden="true"></i>
          </span>
        </div>
      </span>


  </div>
  <div class="col-6 col-md-3">

  <div class="number-input md-number-input">
  <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
  <!-- form for the add to cart button -->


  <input class="quantity" id = "quantity" min="1" max = "9" name="quantity" value="1" type="number">
  <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
  </div>


  </div>
</div>
<!-- cart button -->
<div class = "row">
    <div class= "col-6 col-md-3" id = "cartBtn">
      <?php 

          $noOfReviews = count($allRecords);
          $totalRating = 0;
          foreach($allRecords as $record)
          {
            $totalRating += $record['Rating'];
          }

      ?>
         <input type="hidden" name = 'productId' id = "productId"  value = <?php echo $product['Id'];?>>
         <input type="hidden" name = 'totalRating' id = "totalRating"  value = <?php echo $totalRating;?>>
         <input type="hidden" name = 'noOfReviews' id = "noOfReviews"  value = <?php echo $noOfReviews;?>>
      <?php
       if(isset($_SESSION['user']) ){
          //if he is a user
          if($_SESSION['user']['Role'] == 1)
            echo '<input type="submit" value = "Add to Cart" onclick="setData()" class="btn btn-primary btn-lg">';
          else 
            echo '<input type="hidden" value = "Add to Cart" onclick="setData()" class="btn btn-primary btn-lg">';   
        }
        else
        {
          echo '<input type="submit" value = "Add to Cart" onclick="setData()" class="btn btn-primary btn-lg">';
        }

        ?>
    </div>

    <div id = "msg"> </div>

</div>



<!-- Columns are always 50% wide, on mobile and desktop -->
<div class="row">
  <div class="col-6"><h3>Reviews</h3></div>
    

</div>
<!-- dynamically reading the ratings -->
<?php
     
    $totalRating = 0;
    $starsMap = array(1=>20,
                           2 =>40,
                            3=>60,
                            4=>80,
                            5=>100);
    foreach ($allRecords as $record) {
    //  echo $record['Details'] . "<br>";
    
        $recordRating = $record['Rating'];
        $totalRating += $record['Rating'];

 ?>
<div class = "row">
  <?php
   $path = "./images/users/".$record['Id'];
                $files = glob($path, GLOB_BRACE);
                $noImagePath = "./images/products/no-image.png";
                 $validatedPath = empty($files)? $noImagePath : $files[0];
                //printf('<img class="d-block w-100" src="%s" alt="First slide">', $validatedPath);
                printf('<div class = "col-2"><img class="rounded-circle w-100" src="%s" alt="First slide"></div>',$validatedPath);
   ?>
  
  <div class = "col-7">
    <h5><?php echo $record['firstName'] . " ". $record['lastName']; ?></h5>
    <?php echo  $record['Details']; ?>
  </div>
  <div class = "col-3">
      <span class="score">
      <div class="score-wrap">
        <!--60:30stars -->
          <!--
            20 percent for 1 star
            40 percent for 2 stars
           60 percent is 3 stars etc etc 
            85 for 4 stars
            100 is 5 stars-->
          <span class="stars-active" style="width: <?php echo $starsMap[$recordRating]."%"; ?>">
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
          </span>
          <span class="stars-inactive">
              <i class="fa fa-star-o" aria-hidden="true"></i>
              <i class="fa fa-star-o" aria-hidden="true"></i>
              <i class="fa fa-star-o" aria-hidden="true"></i>
              <i class="fa fa-star-o" aria-hidden="true"></i>
              <i class="fa fa-star-o" aria-hidden="true"></i>
          </span>
        </div>
      </span>
  </div>

   
</div>

<?php  } ?>

<!-- rating rows -->
<div class = "row">

<div class = "col">
<h3>so what did you think ?</h3>
</div>
</div>
<form action =  ""  method = "post">
<div class = row>


  <div class = "col">
  
    <?php 

        if(isset($_SESSION['user']) ){
          //if he is a user
          if($_SESSION['user']['Role'] == 1)
            echo '<textarea id="review" name="review" style="height:200px"></textarea>';
          else 
            echo '<textarea id="review" name="review" style="height:200px" disabled></textarea>';
        }
        else
        {
          echo '<textarea id="review" name="review" style="height:200px"></textarea>';
        }


      

   ?>
</div>

<div class = "col-3">
  <!--get the rating from here  -->
<div class="rating">
  <label>
    <input type="radio" class = 'ratingStar' name="rating" value="5" title="5 stars"> 5
  </label>
  <label>
    <input type="radio" class = 'ratingStar' name="rating" value="4" title="4 stars"> 4
  </label>
  <label>
    <input type="radio" class = 'ratingStar' name="rating" value="3" title="3 stars"> 3
  </label>
  <label>
    <input type="radio" class = 'ratingStar' name="rating" value="2" title="2 stars"> 2
  </label>
  <label>
    <input type="radio" class = 'ratingStar' name="rating" value="1" title="1 star"> 1
  </label>
</div>
</div>
  <div class = "col">
    <?php

    if(isset($_SESSION['user']) ){
          //if he is a user
          if($_SESSION['user']['Role'] == 1)
            echo '<input type = "submit" onclick="addReview()" class="btn btn-primary btn-lg" style = "padding: 4px;">';
          else 
            echo '<input type = "hidden" class="btn btn-primary btn-lg" style = "padding: 4px;">';
        }
        else
        {
          echo '<input type = "submit" onclick="addReview()" class="btn btn-primary btn-lg" style = "padding: 4px;">';
        }


        
    ?>
  </div>




</div>
</form>

<!-- script to add to the average rating -->
<?php

      
   
 ?>

<?php 
        
        include 'footer.php'
    ?>

	
</body>
</html>