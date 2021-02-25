<?php 

function deleteCartSession(){

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
}
    //error_log($_GET['action']." empty action?\n",3,"../errors/ajax-errors.log");
if(isset($_GET['action']) && function_exists($_GET['action'])) {
    $action = $_POST['action'];
    //$var = isset($_POST['name']) ? $_POST['name'] : null;
    //$getData = $action($var);
    // do whatever with the result
    error_log("\ndetected get into function",3,"../errors/ajax-errors.log");
    deleteCartSession();

}



?>