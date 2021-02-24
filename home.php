 <?php 
    session_start();
        include 'menu.php'
    ?>
<!DOCTYPE html>
<?php 
        session_start();
        include 'menu.php'
    ?>
<html>

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="slick-master/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="slick-master/slick/slick-theme.css">
    <style type="text/css">
        html, body {
        margin: 0;
        padding: 0;
        }

        * {
        box-sizing: border-box;
        }

        .slider {
            width: 50%;
            margin: 100px auto;
        }

        .slick-slide {
        margin: 0px 20px;
        }

        .slick-slide img {
        width: 100%;
        }

        .slick-prev:before,
        .slick-next:before {
        color: black;
        }


        .slick-slide {
        transition: all ease-in-out .3s;
        opacity: .2;
        }
        
        .slick-active {
        opacity: .5;
        }

        .slick-current {
        opacity: 1;
        }
    </style>
    <style>
        * {box-sizing: border-box;}
        body {font-family: Verdana, sans-serif;}
        .mySlides {display: none;}
        img {vertical-align: middle;}

        /* Slideshow container */
        .slideshow-container {
        position: relative;
        margin: auto;
        }
        .slider{
        margin: 50px auto;
        width: 600px;
      }

        .image1 {
                width: 660px;
            height: 500px;
        }
        /* Caption text */
        .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
        }


        /* Fading animation */
        .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
        }

        @keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
        .text {font-size: 11px}
        }
        .section-grey {
            background-color:#d3d3d352 !important;
        }
        .opacy_bg_02 {
            background: #f7f7f7;
        }
        .paddings-large {
            padding: 40px 0;
        }
        .boxes h1 {
            color: #fff;
            text-align: center;
        }
        .htitle:after {
                background: #1ACBF1;
                position: absolute;
                height: 4px;
                display: block;
                content: "";
                top: 90px;
                width: 208px;
                left: 20%;
                margin-left: -25px;
                border-radius: 35px;
            }
            .content_info {
            background-position: initial;
            background-size: initial;
            background-repeat-x: initial;
            background-repeat-y: initial;
            background-attachment: initial;
            background-origin: initial;
            background-clip: initial;
            background-color: initial;
            background-repeat: repeat;
        }
        .content_info {
            position: relative;
            width: 100%;
        }
        .opacy_bg_02 {
            bottom: 0;
            left: 0;
            width: 100%;
            position: relative;
            height: auto;
            z-index: 2;
        }
        .paddings-large {
            padding: 40px 0;
        }
        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .htitle {
            color: #808080 !important;
            text-align: center !important;
            font-weight: 700;
            font-family: "Century Gothic","sans-serif", "Helvetica Neue", "Helvetica", "Arial";
            font-size: 35px;
            padding-bottom: 35px;
        }
        .htitle1 {
            color: #808080 !important;
            text-align: center !important;
            font-weight: 700;
            font-family: "Century Gothic","sans-serif", "Helvetica Neue", "Helvetica", "Arial";
            font-size: 35px;
            padding-bottom: 35px;
            padding-left: 13%;
        }
        .boxes-info {
            background-color: #fff;
            text-align: left;
            padding: 20px;
            border: solid 1px #dedede;
            height: 332px;
        }
    </style>

</head>

<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM `products` limit 10";
$result = $conn->query($sql);
$path = array();
$RowsId = array();
$count = 0;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $path[$count] = "./images/products/".$row['Id'];
    $files = glob($path[$count], GLOB_BRACE);
    $noImagePath = "./images/products/no-image.png";
    $validatedPath = empty($files)? $noImagePath : $files[0];
    $path[$count] = $validatedPath;
    $RowsId[$count] = $row['Id'];
    $count++;
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<!--Start SlideShow -->
    <section>
        <div class="slideshow-container">

            <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="images/Slideshow/Slide1.jpg" style="width:100%">
            <div class="text">De7k keep on</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="images/Slideshow/Slide2.jpg" style="width:100%">
            <div class="text">Emart is de7k</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="images/Slideshow/Slide3.jpg" style="width:100%">
            <div class="text">de7k forever</div>
        </div>

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
        </div>
        <script>
            var slideIndex = 0;
            showSlides();

            function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
            }
        </script>
    </section>
<!-- end Slideshow -->
<!-- Start about us -->
    <section class="content_info section-white" >
        <div class="">
            <div class="container wow fadeInUp">
                <div class="row">               
                    <div class="col-lg-6 col-md-6 col-sm-12 " style="margin-top: 88px;">
                        
                        <h2 class="htitle2">Welcome to E-MART </h2>
                        <h4 class="htitle2">“We’re in Business to Improve Lives” </h4>

                        <br>
                        <p style="line-height: 27px;">

                        As much as customers want to hear the story of what makes your company unique, they also want to know how 
                        your company will help them. How will your products make their lives easier? Why should they choose your
                        product ahead of everything else on the market?
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img class="image1" src="images/Logo.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End about us -->
<!-- Start overview -->
    <section class="content_info section-grey">
        <section class="opacy_bg_02 paddings-large boxes">
            <div class="container wow fadeInUp">
            
                <div class="row">
                    <h1 class="htitle" style="color:#808080 !important" >Ecommerce Overview </h1>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="boxes-info">
                            <h3>All Products</h3>
                            <p style="height: 160px;">
                            A stroller might not sell well if the description tells of how it was thought up overnight and then handmade
                            . Similarly, a handmade leather playing card case might not sell well if all you show are the technical specs.</p>
                            <div style="text-align: center;">
                                <a class="btn btn-lg btn-primary delay4" href="SearchedFor.php">learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="boxes-info">
                            <h3>Contact us</h3>
                            <p style="height: 160px;">
                            Are easy to find so a visitor can quickly get in touch should they need it.
                            Explain why someone should contact them, and describe how they can help solve their visitors' problems.
                            Include an email and phone number so visitors can quickly find the right information.</p>
                            <div style="text-align: center;">
                                <a class="btn btn-lg btn-primary delay4" href="contactus.php">learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
<!-- End overview -->
<div class="row">
                    <h1 class="htitle1" style="color:#808080 !important" >Products Overview </h1>
                </div>
    <section class="regular slider">
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[0]);
                      printf('<img src="%s">',$path[0]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[1]);
                      printf('<img src="%s">',$path[1]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[2]);
                      printf('<img src="%s">',$path[2]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[3]);
                      printf('<img src="%s">',$path[3]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[4]);
                      printf('<img src="%s">',$path[4]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[5]);
                      printf('<img src="%s">',$path[5]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[6]);
                      printf('<img src="%s">',$path[6]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[7]);
                      printf('<img src="%s">',$path[7]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[8]);
                      printf('<img src="%s">',$path[8]);
                      print'</a>';
                ?>
                
            </div>
            <div>
                <?php 
                      printf('<a href="ProductPage.php?q=%s">',$RowsId[9]);
                      printf('<img src="%s">',$path[9]);
                      print'</a>';
                ?>
                
            </div>
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="slick-master/slick/slick.js" type="text/javascript" charset="utf-8"></script>
        
        <script type="text/javascript">
            $(document).on('ready', function() {
                $(".regular").slick({
                    dots: true,
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 3
                });
            });
        </script>
    </section>

    <?php 
        
        include 'footer.php'
    ?>
</body>


</html> 
