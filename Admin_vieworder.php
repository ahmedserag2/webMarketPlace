<html>
<head>
  <link href="CSS/simple-sidebar.css" rel="stylesheet">
  <title> Admin - View order</title>
  <link rel="icon" href="images/admin.jfif" type="image/x-icon"> 
<style>

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #292b2c;
  color: white;
  padding: 10px;
  border: none;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: black;
}


.container {
  margin-top: 40px;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<?php
session_start();
if (!$_SESSION['loggedIn'] || $_SESSION['user']['Role'] != 2) {
    echo "<script> location.href='home.php'; </script>";
}
include "menu.php";
?>
<body>

  <div class="d-flex" id="wrapper">


    <div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="Admin_products.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-plus-square"></i> Products</a></span>
        <a href="Admin_users.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-user"></i> Users</a></span>
        <a href="Admin_orders.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> Orders</a></span>

        <a href="Admin_contactus.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> contact us</a></span>

        
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      </nav>
      <div class="container-fluid">
        <?php
        $servername = "localhost";
$username = "root";
$password = "";
$DB = "mydb";
$conn = mysqli_connect($servername, $username, $password, $DB);
if (!$conn) {
  error_log(mysqli_connect_error(),3,"../errors/db-errors.log");
  die("Connection failed: " .mysqli_connect_error());
}
$prod = array();
if (isset($_GET['Id'])) {
  $res = $conn->query("SELECT * FROM invoice WHERE Id=".$_GET['Id']."");
  $row = $res->fetch_assoc();
  $query = $conn->query("SELECT firstName FROM user WHERE Id=".$row['customerId']."");
  $accName = $query->fetch_assoc();
  $productIDS = explode (",", $row['productIds']);
  $prq = explode (",", $row['ProductQuantities']);
  for ($i = 0; $i < count($productIDS); $i++) {
    $query2 = $conn->query("SELECT Name, Price FROM Products WHERE Id=".$productIDS[$i]."");
    $productName = $query2->fetch_assoc();
    $pushthis = array($productIDS[$i], $productName['Name'], $productName['Price'], $prq[$i]);
    array_push($prod, $pushthis);
  }
    $row['name'] = $accName['firstName'];
    //$row['img'] = "images/products/".$row['Id'];

}else {
  echo "<script> location.href='Admin_products.php'; </script>";
}


?>

<div class="container">
    <div class="row">
      <div class="col-25">
        <label>Customer name</label>
      </div>
      <div class="col-75">
        <label><?php echo "<a href='Admin_edituser.php?Id=".$row["customerId"]."'>".$row['name']."</a>" ?></label>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Date ordered</label>
      </div>
      <div class="col-75">
        <label><?php echo $row["reg_date"] ?></label>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Total price</label>
      </div>
      <div class="col-75">
        <label><?php echo $row["TotalPrice"] ?></label>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Address</label>
      </div>
      <div class="col-75">
        <label><?php echo $row["Address"] ?></label>
      </div>
    </div>
    <div class="row" style="margin-top: 15px;">
      <div class="col-25">
        <label>Products</label>
      </div>
      <div class="col-75 p-2">
        <select class="form-select" id="productShow" size="10" style="width: 250px;" aria-label="size 3 select example">
          <?php
            for ($i = 0; $i < count($prod); $i++) {
              if ($i == 0) {
                echo "<option onclick='change()' selected value=".$prod[0][0].",".$prod[0][2].",".$prod[0][3].">".$prod[0][1]."</option>";
              } else {
                echo "<option onclick='change()' value=".$prod[$i][0].",".$prod[$i][2].",".$prod[$i][3].">".$prod[$i][1]."</option>";
              }
            }

          ?>
      </select>
      <label class="control-label col-sm-2 d-block p-1" id="quan"> <?php echo "Quantity: ".$prod[0][3]?></label>
      <label class="control-label col-sm-2 d-block p-1" id="price"> <?php echo "Price: ".$prod[0][2]?></label>
      <img style="max-width: 200px; max-height: 200px;" id="pic" src=<?php echo "images/products/".$prod[0][0] ?> id="target" id="preview" class="img-thumbnail">

      </div>
    </div>
</div>  
<script>
  function showImage(src, target) {
    var fr = new FileReader();
    fr.onload = function(){
        target.src = fr.result;
    }
    fr.readAsDataURL(src.files[0]);
}

function putImage() {
    var src = document.getElementById("image");
    var target = document.getElementById("target");
    showImage(src, target);
}
function change() {
  var e = document.getElementById("productShow");
  var value = e.options[e.selectedIndex].value;
  var valueArr = value.split(',');
  var quan = document.getElementById("quan");
  var price = document.getElementById("price");
  var pic = document.getElementById("pic");
  quan.innerHTML = "Quantity: "+valueArr[2];
  price.innerHTML = "Price: "+valueArr[1];
  pic.src = "images/products/"+valueArr[0];

}
</script>

      </div>
    </div>

  </div>
  <?php 
        
        include 'footer.php'
    ?>

</body>

</html>