
<!doctype html>
<html lang="en">
  <head>
    <title>Contact Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
  <link rel="stylesheet" href="CSS/style.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <style>
          
        body{
          background-color: #F2F2F2;
        }
          h2.inactive {
            color: #cccccc;
 
        }

      </style>

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <?php 
  session_start();
    include 'menu.php'
  ?>
  
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-5 element-animate">
            <form name="ContactForm" action="ContactAction.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="fname">First Name</label>
                  <input type="text" name='fname' class="form-control form-control-lg" id="fname" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="lname">Last Name</label>
                  <span id="lname-info" class="info"></span><br/>
                  <input name='lname' type="text" class="form-control form-control-lg" id="lname" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="phone">Phone number</label>
                  <input name='phone' type="phone" id="phone" class="form-control form-control-lg" required>
                </div>
              </div>
                <br>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email">Email</label>
                  <input name='email' type="email" id="email" class="form-control form-control-lg" required>
                </div>
              </div>
                <br>
                              
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="message">Write Message</label>
                  <textarea name="message" id="message" class="form-control form-control-lg" cols="30" rows="8" required></textarea>
                </div>
              </div>

              <div class="row">             
                  <div class="col-md-12 form-group">
                    <label for="upload">Click on the "Choose File" button to upload a file:</label>
                    <input type="file" id="filename" name="filename">
                  </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-6 form-group">
                  <input Type='submit' name="submit" value="Send Comment" class="btn btn-primary btn-lg btn-block">
                </div>

              </div>
            </form>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-5 element-animate">
            
            <h5 class="text-uppercase mb-3">Address</h5>
            <p class="mb-5">ismailia road <br> 3rd c <br> 301 floor app no 7</p>
            
            <h5 class="text-uppercase mb-3">Email Us At</h5>
            <p class="mb-5"><a href="mailto:info@yourdomain.com">miu@students.com</a> <br> </p>
            
            <h5 class="text-uppercase mb-3">Call Us</h5>
            <p class="mb-5"> <br> Mobile: 01023078804 <br> Mobile 2: 01127222712</p>


          </div>
        </div>
      </div>
    </section>
    
    <?php 
        
        include 'footer.php'
    ?>
  </body>
</html>