<html>
<head>
  <title> Admin - Add/edit user</title>
  <link rel="icon" href="images/admin.jfif" type="image/x-icon"> 
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
if (!$_SESSION['loggedIn'] || $_SESSION['user']['Role'] != 2) {
    echo "<script> location.href='home.php'; </script>";
}
include "menu.php";
?>
<body>

  <div class="d-flex" id="wrapper">


    <div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="Admin_products.php" class="list-group-item list-group-item-action bg-dark text-light show"><span class="text-nowrap"><i class="fa fa-plus-square"></i> Products</a></span>
        <a href="Admin_users.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-user"></i> Users</a></span>
        <a href="Admin_orders.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> Orders</a></span>
        
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
  if (isset($_POST['fname'])) {
    $id = $_POST['Id'];
    $name = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $action  = $_POST['action'];
    $file_name = $_FILES['image']['name'];
    if ($action == "old") {
      $file_name = $id;
    }
    
    if ($name == "" || $lname < 0 || $email == "" || $number == "" || $file_name == "") {
      if ($action == "old") {
        echo "<script> location.href='Admin_edituser.php?Id=".$id."&error=1'; </script>";
      } else {
        echo "<script> location.href='Admin_edituser.php?action=add&error=1'; </script>";
      }
      $_SESSION["err"] = 1;
      return;
    }
    if ($action == "old") {
        $res = $conn->query("UPDATE user SET firstName = '$name', lastName = '$lname', Email = '$email', phoneNumber = '$number', gender = '$gender', Role = '$role' WHERE Id = $id");
    } else {
      $res = $conn->query("INSERT INTO user (firstName, lastName, Email, phoneNumber, gender, Role) VALUES ('$name', '$lname', '$email', '$number', '$gender', '$role')");
    }
    if ($id == "new") {
      $id = $conn->insert_id;
    }
    move_uploaded_file($_FILES['image']['tmp_name'],"images/users/".$id);
   echo "<script> location.href='Admin_users.php'; </script>";
  } else {
    $res = $conn->query("SELECT * FROM user WHERE Id=".$_GET['Id']."");
    $row = $res->fetch_assoc();
    $row['action'] = "old";
    $row['img'] = "images/users/".$row['Id'];
  }

} else if (isset($_GET['action'])){
  if ($_GET['action'] == "add") {
      $row = array();
      $row['Id'] = "new";
      $row['firstName'] = 'first name';
      $row['lastName'] = "last name";
      $row['Email'] = "";
      $row['phoneNumber'] = "";
      $row['gender'] = "Male";
      $row['Role'] = "1";
      $row['img'] = 'https://placehold.it/300';
      $row['action'] = "new";
     
  } else {
    echo "<script> location.href='Admin_users.php'; </script>";
  }
} else {
  echo "<script> location.href='Admin_users.php'; </script>";
}


?>

<div class="container">
  <?php 
  if (isset($_GET["error"])) {
    echo "<h5 style='color: red;'>Please enter first name, last name, email, phone number and upload an image before proceeding. </h5>";
  }
  ?>
  <form action="Admin_edituser.php" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-25">
        <label>First name</label>
      </div>
      <input type="hidden" name="action" id="action" value='<?php echo $row['action'] ?>'>
      <input type="hidden" name="Id" id="Id" value='<?php echo $row['Id'] ?>'>
      <div class="col-75">
        <input type="text" id="fname" name="fname" value='<?php echo $row['firstName'] ?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Last name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lname" value='<?php echo $row['lastName'] ?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Email</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email" value='<?php echo $row['Email'] ?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Phone number</label>
      </div>
      <div class="col-75">
        <input type="text" id="number" name="number" value='<?php echo $row['phoneNumber'] ?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Gender</label>
      </div>
      <div class="col-75">
        <select id="gender" name="gender">
          <option <?php if ($row['gender'] == "Male") {echo "selected='selected'"; }?> value="Male">Male</option>
          <option <?php if ($row['gender'] == "Female") {echo "selected='selected'"; }?> value="Female">Female</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Role</label>
      </div>
      <div class="col-75">
        <select id="role" name="role">
          <option <?php if ($row['Role'] == 1) {echo "selected='selected'"; }?> value="1">User</option>
          <option <?php if ($row['Role'] == 2) {echo "selected='selected'"; }?> value="2">Admin</option>
          <option <?php if ($row['Role'] == 3) {echo "selected='selected'"; }?> value="3">HR</option>
          <option <?php if ($row['Role'] == 4) {echo "selected='selected'"; }?> value="4">Auditor</option>

        </select>
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