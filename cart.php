<?php
session_start();
  include 'menu.php';

  $totalPrice = 0;
  $totalWithTax = 0;
//$_SESSION['cartItems']= array();
  //echo count($_SESSION['cartItems']);
 
  $Ids = array();
  $quantities = array();
if(isset($_SESSION['cartItems'])){
  foreach($_SESSION['cartItems'] as $cartItem){
  		try {
		    array_push(  $Ids,(int)$cartItem['Id']);//echo $cartItem['Id'] . "  hehe " .$cartItem['quantity'];
    		array_push($quantities,(int)$cartItem['quantity']);
		} 
		catch (Exception $e) 
		{
		   // echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  	//echo $cartItem['Id'] . "  hehe " .$cartItem['quantity'];
      
  }
}

  $noOfItems = count($Ids);

  //  echo "heeeeeeeeeeeee". $_SESSION['cartItems']['Id'][0];

   
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "myDB";

      
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
       if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

	          	if(isset($_POST['checkout']))
	          	{
	              $idStr = implode( ",", $Ids);
	              $quantityStr = implode("," , $quantities);
	              //echo "testingg ". $quantityStr;
	              //customer id will be a session
	              //echo $_POST['checkout'];
	              $sqlInsert = "INSERT INTO `invoice` (`productIds`, `customerId`, `ProductQuantities`) 
	              VALUES ('$idStr', 0, '$quantityStr')";
	              if($conn->query($sqlInsert))
	              {
	                  unset($_SESSION['cartItems']);
	                  unset($_SESSION['inSession']);
	                  header("Location:home.php");

	              }
	              else
	              {
	                echo "error inserting " . $conn->error;
	              }

	          	}
	          	
	          	
          }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>in webmarketplace</title>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="CSS/cart.css" type="text/css">      

    <script src = "JS/cart.js"></script>
    <script>
    	function refresh(Id)
		{
			btnId = Id;
			//alert(btnId);
			 jQuery.ajax({
			 	//
            url:"DeleteFromCartSession.php",
            data:'removeItem='+$("#"+Id).val(),
            type:"POST",

            success:function(data)
            {
            	//alert(data);
            	//alert($(btnId).val());
            	//$( "#" + Id).remove();
             	
             
            }
          });
			
			//location.reload();
		}

    </script>
   
</head>
<body>
<section>
  

<?php 
  
      //select the closest query that would match
      $sql="select * from products where Id IN (".implode(",",$Ids).")";
    
      $result = $conn->query($sql);
      if($result)
      {
        $allRecords = $result->fetch_all(MYSQLI_ASSOC);
      }
      else
      {
        echo "<h1> your cart is empty :( </h1>";
        echo "<img src = './images/products/catsearch.gif' >";
        exit;
      }
      
      


?>

 <!--Grid row-->
  <div class="row">

    <!--Grid column-->
    <div class="col-lg-6">

<!-- panel on the left -->
      <!-- start of the item -->
      <?php $qCounter = 0; ?>
      <?php foreach($allRecords as $record){ 
        //change to new image file paths 
        $noImage = "./pics/no-image.png";
          $path = "./pics/".$record['Id'];
        $files = glob($path."*.{jpg,jpeg,png,gif}", GLOB_BRACE);

       // echo implode(',', $files);
          $validatedPath = empty($files)? $noImage : $files[0];
        ?>
  <div id = <?php echo $record['Id'] ?> class="card flex-row flex-wrap">
        <div class="card-header border-0">

            <img src = <?php echo "'".$validatedPath."'" ;?> alt = "" >
        </div>
        <div class="card-block px-2">
            <h4 class="card-title"><?php echo $record['Name']?></h4>
            <p class="card-text"><?php echo $record['Details']?></p>
            <br>
            <p class="card-text">Price : <?php echo $record['Price']?></p>
            <br>
            <p class = "card -text">quantity: <?php echo $quantities[$qCounter]; $qCounter++;?></p>
            <form action = "" method = "POST">
            	<button class = "btn btn-danger" onclick='refresh(this.id)' 
            		id = <?php echo 'removeItem'.$record['Id'];?>name = <?php echo 'removeItem'.$record['Id'];?> value = <?php echo $record['Id'] ?>><i class="fa fa-trash"></i></button>


            	<input type = 'text' name = 'removeItem' id =  'removeItem' value = <?='removeItem'.$record['Id'];?>>
        	</form>
        </div>
        <div class="w-100"></div>
        
  </div>

<?php 
//your still in the loop :)
  $totalPrice += $record['Price'];

  //tax rate is 0.101
  $totalWithTax += $record['Price'] * (1 + 0.101);
//ending for each loop
} ?>



  </div>
    <!--Grid column-->

  
    <div class = "col-lg-5">
<!-- reciept on the right -->
     <!-- Card -->
      <div class="mb-3">
        <div class="pt-4">

          <h5 class="mb-3">The total amount of</h5>



          <ul class="list-group list-group-flush">
            <?php foreach($allRecords as $record){?>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              <?php echo $record['Name'] ?>
              <span><?php echo $record['Price'].'EGP' ?></span>
            </li>
            <!--closing for each loop -->
            <?php }?>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
              </li>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              Temporary amount
              <span><?php echo $totalPrice.'EGP' ?></span>
            </li>
            
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
              <div>
                <strong>The total amount of</strong>
                <strong>
                  <p class="mb-0">(taxes)</p>
                </strong>
              </div>
              <span><strong><?php echo $totalWithTax.'EGP' ?></strong></span>
            </li>
          </ul>
            <form action = "" method = "POST">
                 <input type="submit" name = "checkout" class="btn btn-primary btn-block" value = "checkout">
            </form>
        </div>
      </div>
      <!-- Card -->

      
    </div>
        

</section>
</body>
</html>