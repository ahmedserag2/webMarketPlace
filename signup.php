<html>



<head>

<link rel="stylesheet" href="CSS/style.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<!------ Include the above in your HEAD tag ---------->
<style>
    
    
h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}


/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset]  {
  background-color: #56baed;   
  border: none;
  color: white;
  padding: 15px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type=text]:placeholder {
  color: #cccccc;
}


/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
  width:60%;
}

    

    
    
    body {
    background: url('img/main_banner.jpg') fixed;
    background-size: cover;
        
}

*[role="form"] {
    
    max-width: 530px;
    padding: 15;
    padding-bottom:50;
    margin: 10 auto;
    border-radius: 0.3em;
    background-color: white;
}

*[role="form"] h2 { 
    
    font-family: 'Open Sans' , sans-serif;
    font-size: 40px;
    font-weight: 600;
    color: #000000;
    margin-top: 5%;
    
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 4px;
}
    
    .img
    {
        height: 200px;
        width: 75%;
        align-self: auto;
        padding: 50;
        padding-left: 15;
        margin-left: 100;
        
        
    }
    </style>



</head>


<body>
  
<?php
    
        
    //session_start();
    include "menu.php";
    
     
        if(isset($_POST["submit"])) { 
             
             
            $servername = "localhost";
            $username = "root";
            $passwordDB = "";
            $dbname = "mydb";

            // Create connection
            $conn = new mysqli($servername, $username, $passwordDB, $dbname);

            $firstname = $_POST['fname'];
            $lastname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['Password'];
            $phonenumber = $_POST['phone'];
            $gender = $_POST['gender'];
            $DOB=$_POST["date"];
            
            $sqlInsert = "INSERT INTO 
            `user`(`firstName`, `lastName`, `password`, `Role`,`phoneNumber`,`gender`,`Email`,`date_of_birth`)
             VALUES ('$firstname', '$lastname','$password',1,'$phonenumber','$gender','$email','$DOB')";
            $sqlmail = "SELECT Id FROM user WHERE Email = '$email'";
            $mailExists = mysqli_query($conn,$sqlmail);

            echo mysqli_num_rows($conn->query($sqlmail));

          
          //if email not found 
              if(mysqli_num_rows($conn->query($sqlmail)) == 0)
              {
                $result = mysqli_query($conn,$sqlInsert);
                  if($result)	
          		    {
          			     echo "<script>
                        alert('Submitted successfully');
                         window.location.href='signin.php';
                        </script>";  
                       
          		    }
                  else{
                    echo $conn->error;
                  }
  		        }
              else
              {
                echo "<script>alert('email already taken please try again')</script>";
              }
                //return $result;
            } 
   // }


        ?>
    
    
<div class="container">
            <form class="form-horizontal" method="post" action="" role="form">
                <img src="img/logo.png" class="img"><h3 style="font-weight: bold;  padding-bottom: 25;
    padding-left: 60;
align-content: center; margin-left:150;">Sign up</h3>
                <div class="form-group">
                    <label for="firstName" class="col-sm-6 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" name="fname" placeholder="First Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName" class="col-sm-6 control-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="lastName" name="lname" placeholder="Last Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-6 control-label">Email* </label>
                    <div class="col-sm-9">
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control" name= "email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-6 control-label">Password*</label>
                    <div class="col-sm-9">
                    <input type="password" id="psw" name="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-6 control-label">Confirm Password*</label>
                    <div class="col-sm-9">
                    <input type="password" id="psw2" name="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" class="form-control" required>
                       
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthDate" class="col-sm-6 control-label">Date of Birth*</label>
                    <div class="col-sm-9">
                        <input type="date" name="date" id="birthDate" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-6 control-label">Phone number </label>
                    <div class="col-sm-9">
                        <input type="phoneNumber" name="phone" id="phoneNumber" placeholder="Phone number" class="form-control">
                        <span class="help-block"></span>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="control-label col-sm-5">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" id="femaleRadio" name="gender" value="Female">Female
                                </label>
                            </div>

                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" id="maleRadio" name="gender" value="Male" checked>Male
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <span class="help-block"></span>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                <button type="reset" class="btn btn-primary btn-block">Reset</button>
                
                </form>		
</div>
    
<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the userstype something inside the password field
myInput.onkeyup = function() {
  // da validate l lower case
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validat cap letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate num
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

        
    </body>
    </html>
    
    