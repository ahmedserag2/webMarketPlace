<html>
<head>
  <link href="CSS/simple-sidebar.css" rel="stylesheet">
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
$_SESSION["err"] = 0;
include "menu.php";
?>
<body>

  <div class="d-flex" id="wrapper">


    <div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="Admin_products.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-plus-square"></i> Products</a></span>
        <a href="Admin_users.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-user"></i> Users</a></span>
        <a href="#" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> Settings</a></span>
        
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
  die("Connection failed: " .mysqli_connect_error());
}

if (isset($_GET['Id']) || isset($_POST['Id'])) {
  if (isset($_POST['name'])) {
    $id = $_POST['Id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $details = $_POST['details'];
    $action  = $_POST['action'];
    $file_name = $_FILES['image']['name'];
    if ($action == "old") {
      $file_name = $id;
    }
    
    if ($name == "" || $price < 0 || $price == "" || $details == "" || $file_name == "") {
      if ($action == "old") {
        echo "<script> location.href='editproduct.php?Id=".$id."'; </script>";
      } else {
        echo "<script> location.href='editproduct.php?action=add'; </script>";
      }
      $_SESSION["err"] = 1;
      return;
    }
    if ($action == "old") {
        $res = $conn->query("UPDATE products SET Name = '$name', Price = '$price', Details = '$details' WHERE Id = $id");
    } else {
      $res = $conn->query("INSERT INTO products (Name, Price, rating, Details) VALUES ('$name', '$price', '$rating', '$details')");
      
    }
    if ($id == "new") {
      $id = $conn->insert_id;
    }
    move_uploaded_file($_FILES['image']['tmp_name'],"images/products/".$id);
    echo "<script> location.href='products.php'; </script>";
  } else {
    $res = $conn->query("SELECT * FROM products WHERE Id=".$_GET['Id']."");
    $row = $res->fetch_assoc();
    $row['action'] = "old";
    $row['img'] = "images/products/".$row['Id'];
  }

} else if (isset($_GET['action'])){
  if ($_GET['action'] == "add") {
      $row = array();
      $row['Id'] = "new";
      $row['Name'] = 'name';
      $row['rating'] = "0";
      $row['Price'] = "0";
      $row['Details'] = "Description";
      $row['img'] = 'https://placehold.it/300';
      $row['action'] = "new";
     
  } else {
    echo "<script> location.href='products.php'; </script>";
  }
} else {
  echo "<script> location.href='products.php'; </script>";
}


?>

<div class="container">
  <?php 
  if ($_SESSION["err"] == 1) {
    echo "<h5 style='color: red;'>Please enter product name, price, description and upload an image before proceeding. </h5>";
    $_SESSION["err"] = 0;
    }
  ?>
  <form action="editproduct.php" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-25">
        <label>Product name</label>
      </div>
      <input type="hidden" name="action" id="action" value='<?php echo $row['action'] ?>'>
      <input type="hidden" name="Id" id="Id" value='<?php echo $row['Id'] ?>'>
      <div class="col-75">
        <input type="text" id="pname" name="name" value='<?php echo $row['Name'] ?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Price</label>
      </div>
      <div class="col-75">
        <input type="text" id="price" name="price" value='<?php echo $row['Price'] ?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Rating</label>
      </div>
      <div class="col-75">
        <label id="rate"><?php echo $row['rating'] ?></label>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Description</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="details" style="height:200px"><?php echo $row['Details'] ?></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Upload image</label>
      </div>
      <div class="col-75">
        <input type="file" id="image" name="image" class="file" onchange="putImage()" accept="image/*">
          <img style="max-width: 300px; max-height: 300px;" src=<?php echo $row['img'] ?> id="target" id="preview" class="img-thumbnail">
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
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
</script>

      </div>
    </div>

  </div>
</body>

</html>