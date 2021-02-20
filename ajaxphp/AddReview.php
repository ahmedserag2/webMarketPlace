<?php   //add data validation
      $rating = 0;
      $text = "";
     // echo "got into file ";
      $productIndex = $_POST['productIndex'];
      $noOfReviews = $_POST['noOfReviews'];
      $totalRating = $_POST['totalRating'];
      $msg = "";
      
      echo $_POST['review'];
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['rating'] !== 'undefined' && isset($_POST['review']))
        {


          $serverName = "localHost";
          $userName = "root";
          $password = "";
          $DB = "mydb";
          $conn = mysqli_connect($serverName, $userName, $password, $DB);

          if(!$conn)
          {
            die("connect failed : " . mysqli_connect_error());
          }
            $rating = $_POST['rating']; 
            $text = $_POST['review'];
            
          
            //$userId = $_SESSION['user']['Id'];
            //review should carry the productid, userid, reviewid
            $sqlreview = "INSERT INTO `reviews`(`productId`, `customerId`, `Rating`, `Details`) VALUES ('$productIndex',26,$rating
            ,'$text')";

           
            $avgRating = ($totalRating + $rating) / ($noOfReviews + 1);
            //echo "rated: ".$rating . "<br>" . "current rating ".$currentRating . 
            //"<br>" . "total reviews: ". $noOfReviews."<br>";
            $sqlUpdate = "UPDATE `products` SET `rating`=$avgRating WHERE Id = $productIndex";

            if($conn->query($sqlreview) && $conn->query($sqlUpdate))
            {
              $msg = "your review has been posted";
            }
            else
            {
              echo "Error: ".$sqlreview . "<br>". $conn->error;
              //echo $sqlUpdate;

            }
             $conn ->close();

        }
        else
        {
          echo "please submit a rating and review first";
        }
      
      

      echo $msg;


 ?>