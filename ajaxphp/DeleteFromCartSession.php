<?php 

session_start();


if(isset($_POST['removeItem']))
{
	//echo $_POST['removeItem'];	

	 for($i = 0; $i < count($_SESSION['cartItems']); $i++){
	 	try
	 	{
		 	//echo " selected ". $_POST['removeItem'] ;  
	 		//echo "session : ". $_SESSION['cartItems'][$i]['Id'];
		 	if($_SESSION['cartItems'][$i]['Id'] == $_POST['removeItem']){
		 		unset($_SESSION['cartItems'][$i]);
		 		array_splice($_SESSION['cartItems'], $i, 0);
		 	}
		 }
		 catch (Exception $e)
		 {}
  
  
}

}


?>