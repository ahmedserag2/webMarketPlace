<?php
	

	if($_SERVER['REQUEST_METHOD'] == 'POST')
  	{

      $msg = "";
    	$productId = $_POST['productId'];
    	$quantity = $_POST['quantity'];
    	session_start();

    	$_SESSION['inSession'] = false;
      //condition to avoid excessive iterations 
    
      foreach($_SESSION['cartItems'] as $cartItem)
      {
        if($cartItem['Id'] == $productId)
          $_SESSION['inSession'] = true;
      }
    //check if the user is logged in 
    if(isset($_SESSION['user']))
    {

      if(!$_SESSION['inSession'])
      {
    	   array_push($_SESSION['cartItems'], array("Id"=>$productId , "quantity"=>$quantity));
         //after adding it to the cartItems session set the boolean to true
         $_SESSION['inSession'] = true;
         $msg = "product added to your cart";
      }
      else
      {
        $msg = "product already in cart ";
      }
    }
    else
    {
      $msg = 'please create an account first or log in';
    }

      echo $msg;
    	//$_SESSION['cartItems'] = array_merge(array($productId , $quantity));
    	/*
	    	iterate over the carItems session 
	    	cartItem, quantity 
	    	foreach($_SESSION['cartItems'] as $cartItem)
	    		for($i =0; $i < 2 ; $i++)
	    			echo $cartItem[$i];
		*/
   
  	}

?>