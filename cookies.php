<?php            
                       $cookie_name=$_SESSION["username"];
                       $cookie_value=$_SESSION["Password"];
               setcookie("Username",$cookie_name,time()+(86400*30),"/");
               setcookie("Password",$cookie_value,time()+(86400*30),"/");

 
?>