<?php //header("Location: home.php"); ?>
<html>
<head>
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="CSS/style.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="CSS/ProductPage.css" type="text/css"> 
  <link rel="stylesheet" href="CSS/bootstrap.min.css" type="text/css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/bootstrap.css" type="text/css">      




</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #333333;">
  <a class="navbar-brand" href="home.php">Emart</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <?php
         echo '<li class="nav-item active">
         <a class="nav-link" href="home.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
        </li>';

         


          if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
          {
            //find a better place for this line 
           // echo '<a class="navbar-brand" href="home.php">Welcome '.$_SESSION["user"]["firstName"].'</a>';
            if ($_SESSION["user"]["Role"] == 1) {
              echo '<li class="nav-item active">
              <a class="nav-link" href="profile.php"><i class="fa fa-user"></i> My Profile <span class="sr-only">(current)</span></a>
              </li>';

                echo '<li class="nav-item active">
           <a class="nav-link" href="messagesMenu.php"><i class="fa fa-envelope	"></i>messages <span class="sr-only">(current)</span></a>
          </li>';
          echo '<li class="nav-item active">
           <a class="nav-link" href="surveyMenu.php"><i class="fa fa-envelope"></i>surveys <span class="sr-only">(current)</span></a>
          </li>';
          echo '
              <li class="nav-item active">
              <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i>Cart<span class="sr-only">(current)</span></a>
              </li>';
              echo '<li class="nav-item active">
        <a class="nav-link" href="contactus.php"><i class="fa fa-info-circle"></i> Contact us</a>
      </li>';
      
      

            } else if ($_SESSION["user"]["Role"] == 2){
               echo '<li class="nav-item active">
              <a class="nav-link" href="Admin_products.php"><i class="fa fa-user"></i> Admin <span class="sr-only">(current)</span></a>
              </li>';

                echo '<li class="nav-item active">
           <a class="nav-link" href="messagesMenu.php"><i class="fa fa-home"></i>messages <span class="sr-only">(current)</span></a>
          </li>';

            }
            else if($_SESSION["user"]["Role"] == 3)
            {
               echo '<li class="nav-item active">
              <a class="nav-link" href="hr_users.php"><i class="fa fa-user"></i> HR <span class="sr-only">(current)</span></a>
              </li>';
            }
            else if($_SESSION["user"]["Role"] == 4)
            {
                echo '<li class="nav-item active">
              <a class="nav-link" href="Auditor_surveys.php"><i class="fa fa-user"></i> Auditor <span class="sr-only">(current)</span></a>
              </li>';
            }

             echo ' <li class="nav-item active">
                <a class="nav-link" href="signout.php"><i class="fa fa-sign-out"></i> SignOut <span class="sr-only">(current)</span></a>
              </li>';

              //make condition for hr,admin andd auditor mostly a menu will be added

          }
          else
          {
            echo '<li class="nav-item active">
              <a class="nav-link" href="signin.php"><i class="fa fa-sign-in"></i> Signin <span class="sr-only">(current)</span></a>
              </li>';

             echo ' <li class="nav-item active">
                <a class="nav-link" href="signup.php"><i class="fa fa-user-plus"></i> Signup <span class="sr-only">(current)</span></a>
              </li>';
               echo '<li class="nav-item active">
        <a class="nav-link" href="contactus.php"><i class="fa fa-info-circle"></i> Contact us</a>
      </li>';
          }
      ?>

      
      <li class="nav-item active">
              <a class="nav-link" href="SearchedFor.php?ProductName="><i class="fa fa-shopping-basket"></i> All Products <span class="sr-only">(current)</span></a>
              </li>
      

      

    
    
      
      

        
    </ul>

    <form class="form-inline my-2 my-lg-0" action = "SearchedFor.php" method = "get">
      <input class="form-control mr-sm-2" name = "ProductName" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-dark my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

</body>
</html>