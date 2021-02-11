<html>
<head>
 
<link rel="stylesheet" href="CSS/style.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    </head>
    
<?php
    session_start();
     
   include_once("connection.php");
     
     if(!$conn)
     {
     die("Connection failed: ".mysqli_connect_error());
     }
     if(isset($_SESSION["Adminloggedin"]))
     {
    header("Location:Admin.html");
     }
     if(isset($_SESSION["Custmorlogin"]))
     {
    header("Location:Custmor.html");
     }
     if(isset($_SESSION["Odeterlogin"]))
     {
    header("Location:odeter.html");
     }
     if(isset($_SESSION["HRlogin"]))
     {
    header("Location:HR.html");
     }
    $Error="";
     

    
     /* bos ya negm aly hy edit yrag3 3la al navigation bta3t aly
      fo2 3shan ana 3amelha 3la files 3ndi ana wa htdrb 3nd omk wa shokrn */
    
    
    
    if(isset($_POST["Submit"]))
    {
        $username = $_POST['username'];
        $password = $_POST['upassword'];
        $_SESSION['username']=$username;
        $_SESSION['Password']=$password;
        
        if(isset($_POST["remember"]))
        {  
         include_once("cookies.php");
        }
       

        $sql="SELECT * FROM users WHERE Email = '$username' AND Password ='$password'";
        $sql2="SELECT TypeID FROM users WHERE Email ='$username'";
        $sql3="SELECT status FROM users WHERE Email ='$username'";
        
	    $result = mysqli_query($conn,$sql);
        $result2 = mysqli_query($conn,$sql2);
        $result3 = mysqli_query($conn,$sql3);
            
        /* user typee wa pending state */

        if($row3=mysqli_fetch_array($result3))
        {
            $_SESSION["userstatus"]=$row3[0];
        }
        if($row2=mysqli_fetch_array($result2))            
        {
              $_SESSION["usertype"]=$row2[0];
        }
        
        if($row=mysqli_fetch_array($result))	
	    {
            if($_SESSION["userstatus"]=="pending")
            {
                $Error= "You are not approved yet";       
            }
            else if($_SESSION["userstatus"]=="Declined")
            {
                
                $Error= "sorry you have been declined, please contact us for further information";
            }
            else 
            {
                
                 $_SESSION["ID"]=$row[7];
                  $_SESSION["Fname"]=$row[0];
                  $_SESSION["Lname"]=$row[1];
                  $_SESSION["Umail"]=$row[2];
                  
              
               
                if($_SESSION["usertype"] == 0)
                { 
                  $_SESSION['Adminloggedin'] = true;
                  header("Location:Admin.html");
                    
                }
                else if($_SESSION["usertype"] == 1)
                {
                   
                    $_SESSION["HRlogin"]=true;
                    header("Location:HR.html");
                }
                else if($_SESSION["usertype"] == 2)
                {
                    $_SESSION["Odeterlogin"]=true;
                    header("Location:odeter.html");
                } 
                else if($_SESSION["usertype"] == 2)
                {
                    $_SESSION["Cutmorlogin"]=true;
                    header("Location:Custmor.html");
                } 
            }  
	    }
	    else	
	    {
		 $Error= "Invalid username or Password";
        }
     
        
    }
    if(!isset($_COOKIE['Username']))
    {
        $_COOKIE['Username']=" ";
        
    }
   if(!isset($_COOKIE['Password']))
    {
        $_COOKIE['Password']=" ";
        
    }
    
    
    ?>
    
    <!-- jaison class front -->
    <script src="js/wow.min.js"></script>
    <script>
              new WOW().init();
        
    </script>
    
<body>
<?php include"header.php";?>

<form action="" method="post">
  <div class="imgcontainer wow fadeIn">
    
      <div class="line"></div>
  </div>
  <div class="container">
      <h2 class="title wow flipInX" data-wow-delay="0.5s">Sign In</h2>
      <?php echo "<h4 style='color: red'>".$Error."</h4>"; ?>
    <label for="uname"><b>Email</b></label><br>
    <input type="text" class="form-control" placeholder="Enter Username" value="<?php echo $_COOKIE['Username'] ?>" id="uname" name="username" required><br>

    <label for="psw"><b>Password</b></label><br>
    <input type="password" class="form-control" placeholder="Enter Password" value="<?php echo $_COOKIE['Password'] ?>" id="pass" name="upassword" required><br><br>
        
    <button class="btn mybtn" name="Submit" type="submit">Login</button><br>
    <label>
      <input type="checkbox" checked="checked" class="form-check-label" name="remember"> Remember me
    </label>
      
  </div>

</form>
    <script>
      document.getElementById("uname").focus();
        
    </script>
    

</body>
</html>