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

if (isset($_GET['id'])) {
  if (isset($_GET['fname'])) {
    $id = $_GET['id'];
    $name = $_GET['fname'];
    $lname = $_GET['lname'];
    $email = $_GET['email'];
    $number = $_GET['number'];
    $gender = $_GET['gender'];
    $role = $_GET['role'];
    $action  = $_GET['action'];
    if ($action == "old") {
        $res = $conn->query("UPDATE user SET firstName = '$name', lastName = '$lname', Email = '$email', phoneNumber = '$number', gender = '$gender', Role = '$role' WHERE Id = $id");
    } else {
      $res = $conn->query("INSERT INTO user (firstName, lastName, Email, phoneNumber, gender, Role) VALUES ('$name', '$lname', '$email', '$number', '$gender', '$role')");
    }
   echo "<script> location.href='users.php'; </script>";
  } else {
    $res = $conn->query("SELECT * FROM user WHERE Id=".$_GET['id']."");
    $row = $res->fetch_assoc();
    $row['action'] = "old";
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
      $row['action'] = "new";
     
  } else {
    echo "<script> location.href='Admin_users.php'; </script>";
  }
} else {
  echo "<script> location.href='Admin_users.php'; </script>";
}


?>

<div class="container">
  <form action="Admin_edituser.php">
    <div class="row">
      <div class="col-25">
        <label>First name</label>
      </div>
      <input type="hidden" name="action" id="action" value='<?php echo $row['action'] ?>'>
      <input type="hidden" name="id" id="id" value='<?php echo $row['Id'] ?>'>
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
      <input type="submit" value="Submit">
    </div>
  </form>
</div>  

      </div>
    </div>

  </div>
</body>

</html>