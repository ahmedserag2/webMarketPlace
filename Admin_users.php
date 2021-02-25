<html>
<head>
  <title> Admin - users </title>
  <link rel="icon" href="images/admin.jfif" type="image/x-icon"> 
  <link href="CSS/simple-sidebar.css" rel="stylesheet">
<style>
table {
  border-collapse: collapse;
  margin-top: 15px;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px 0px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #292b2c;
  color: white;
}
.button {
  background-color: #292b2c;
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  cursor: pointer;
}
.button:hover {
  background-color: black;
}
.button.delete {
  background-color: #b30000;
}
.button.delete:hover {
    background-color: #660000;

}
</style>
</head>
<?php
session_start();
include "menu.php";

?>
<body>

  <div class="d-flex" id="wrapper">


    <div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="Admin_products.php" class="list-group-item list-group-item-action bg-dark text-light show"><span class="text-nowrap"><i class="fa fa-plus-square"></i> Products</a></span>
        <a href="Admin_users.php" class="list-group-item list-group-item-action bg-secondary text-light"><span class="text-nowrap"><i class="fa fa-user"></i> Users</a></span>
        <a href="Admin_orders.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> Orders</a></span>

        <a href="Admin_contactus.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> contact us</a></span>

        
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
<div class="row d-flex justify-content-center">
  <!--Grid column-->
  <div class="col-md-6" style="margin-top: 15px; display:inline-block;">
<div class="input-group rounded">
  <input type="search" id="searchBar" class="form-control rounded" placeholder="Search" aria-label="Search"
    aria-describedby="search-addon" />
  <span onclick="search()" style="margin-left: 10px;" class="input-group-text border-0" id="search-addon">
 <i class="fa fa-search"></i>
  </span>
  <span onclick="show()" style="margin-left: 10px;" class="btn input-group-text border-0" id="searchoptions">
    Show search options
  </span>

</div>
  </div>
</div>
<div class="row d-flex justify-content-center" >

  <div class="col-md-3 fade-in" style="display: none;" id="options">
Search by: 
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" checked>
  <label class="form-check-label" for="exampleRadios1">
    First name
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" id="radioLN">
  <label class="form-check-label" for="exampleRadios2">
    Last name
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" id="radioEmail">
  <label class="form-check-label" for="exampleRadios2">
    Email 
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" id="radioNumber">
  <label class="form-check-label" for="exampleRadios2">
    Phone number 
  </label>
</div>

</div>
</div>

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
if (isset($_GET['delete'])) {
  $valuesToDelete = explode (",", $_GET['delete']);
  for ($i = 0; $i < count($valuesToDelete); $i++) {
    $v = $valuesToDelete[$i];
    //echo "<script>alert('".$v."');</script>";
    $conn->query("DELETE FROM invoice WHERE customerId=$v");
    $conn->query("DELETE FROM user WHERE Id=$v");
    if (file_exists("images/products/".$v)) {
      unlink("images/users/".$v);
    }
  }
}
if (isset($_GET['search'])) {
  $val = $_GET['search'];
  $val2 = $_GET['searchBy'];
  if ($val2 == "lastname") {
    $res = $conn->query("select * from user where lastName like '%$val%' OR lastName like '%$val' OR lastName like '$val%'");
  } else if ($val2 == "email") {
    $res = $conn->query("SELECT * FROM user WHERE Email='$val'");
  } else if ($val2 == "number"){
    $res = $conn->query("SELECT * FROM user WHERE phoneNumber='$val'");
  } else {
    $res = $conn->query("select * from user where firstName like '%$val%' OR firstName like '%$val' OR firstName like '$val%'");
  }
} else {
  $res = $conn->query("SELECT * FROM user");

}

if (!$res) {
    //die "Query failed: (" . $res->errno . ") " . $res->error;
}$rownumber = 1;
$page = 1;
$where = 0;
$firstrow = 0;
echo "<table style='width:100%'>\n";
if (isset($_GET['page'])) {
  $do = $_GET['page'];
  $page = $do;
}

while ($row = $res->fetch_assoc()) {

  if (0 == $firstrow) {
    /* first result set row? look at the keys=column nanes */
    echo "<tr>";
    foreach (array_keys($row) as $colname) {

      if ($colname == "firstName") {
        echo "<th>First name</th>";
      } else if ($colname == "Id") {
        echo "<th>&nbsp;&nbsp;#</th>";
      } else if ($colname == "lastName") {
        echo "<th>Last name</th>";
      } else if ($colname == "password") {
      } else if ($colname == "phoneNumber") {
        echo "<th>Phone number</th>";

      }else if ($colname == "date_of_birth") {
        echo "<th>Date of birth</th>";
        
      }  else {
         echo "<th>$colname</th>";

      }
    }
    echo "<th>Action</th>";
    echo "</tr>\n";
  }
  $firstrow = 1;

  echo "<tr>";
  $where = 0;
  $id = 0;
  foreach (array_values($row) as $colval) {
    if (($rownumber <= $page*10 && abs($page*10 - $rownumber < 10)))  {
      if ($where == 0) {
        $id = $colval;
        echo "<td>&nbsp;<input type='checkbox' id='check".$id."' onclick='checkBoxes(".$id.")' name='select' value='".$id."'></td>";
      } else if ($where == 4) {

      } else if ($where == 8) {
          if ($colval == 1) {
            echo "<td>user</td>";
          } else if ($colval == 2){
            echo "<td>admin</td>";
          } else if ($colval == 3){
            echo "<td>HR</td>";
          } else if ($colval == 4){
            echo "<td>auditor</td>";
          }
      }
      else {
        echo "<td>$colval</td>";
      }
    }
    $where++;
  }
    if (($rownumber <= $page*10 && abs($page*10 - $rownumber < 10)))  {
    echo "<td><a href='Admin_edituser.php?Id=".$id."' class='btn btn-dark'>edit</a><td>";
  }
    $rownumber ++;

  echo "</tr>\n";
}
echo "</table>\n";
$amountOfRows = $res->num_rows;
if ($amountOfRows == 0) {
  echo "No results found";
}
$res->close(); 
?>

<?php 
if (isset($_GET['search'])) { 
  $s = $_GET['search']; 
  $s2 = $_GET['searchBy']; 
  $do = $page - 1;
  $change = true;
  if ($do <= 0) {
   $change = false;
  } else if ($do > (ceil(($amountOfRows) / 10))) {
    $change = false;
  }
  if ($change) {
    echo '<a class="btn btn-dark" href="Admin_users.php?search='.$s.'&page='.($page-1).'&searchBy='.$s2.'"><</a>'; 
  }
} else { 
  $do = $page - 1;
  $change = true;
  if ($do <= 0) {
   $change = false;
  } else if ($do > (ceil(($amountOfRows) / 10))) {
    $change = false;
  }
  if ($change) {
    echo '<a class="btn btn-dark" href="Admin_users.php?page='.($page-1).'"><</a>'; 
  }
} 
?>
<?php if ($amountOfRows > 0) { echo"<a>\t".$page." of ".(ceil(($amountOfRows) / 10))."\t</a>"; }?>
<?php echo '<a id="delete" class="btn float-right bg-warning text-light" href="">delete</a>' ?>
<?php echo '<a class="btn bg-success text-light" href="Admin_edituser.php?action=add">add user</a>' ?>
<?php 
if (isset($_GET['search'])) { 
  $s = $_GET['search']; 
  $s2 = $_GET['searchBy']; 
  $do = $page + 1;
  $change = true;
  if ($do <= 0) {
   $change = false;
  } else if ($do > (ceil(($amountOfRows) / 10))) {
    $change = false;
  }
  if ($change) {
    echo '<a class="btn btn-dark" href="Admin_users.php?search='.$s.'&page='.($page+1).'&searchBy='.$s2.'">></a>'; 
  }
} else { 
  $do = $page + 1;

  $change = true;
  if ($do <= 0) {
   $change = false;
  } else if ($do > (ceil(($amountOfRows) / 10))) {
    $change = false;
  }
  if ($change) {
    echo '<a class="btn btn-dark" href="Admin_users.php?page='.($page+1).'">></a>'; 
  }
} 
?>
      </div>
    </div>
<script>
  var selected = [];
  var link = document.getElementById("delete");
  var searchBy = "FN";
  link.setAttribute("href", "Admin_users.php");
  function checkBoxes(id) {
    var check = document.getElementById("check"+id);
    if (check.checked) {
      selected.push(id);
    } else {
      var ind = selected.indexOf(id);
      if (ind > -1) {
        selected.splice(ind, 1);
      }
    }
    
    if (selected.length > 0) {
      link.setAttribute("href", "Admin_users.php?delete="+selected.join(",")+"");
    } else {
      link.setAttribute("href", "Admin_users.php");
    }
  }
  var searchBar = document.getElementById("searchBar");
  searchBar.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) { 
        search();
    }
  });
  function search() {
    var searchBar = document.getElementById("searchBar");
    if (searchBar.value != "") {
      if (document.getElementById('radioLN').checked) {
        searchBy = "lastname";
      } else if (document.getElementById('radioEmail').checked) {
        searchBy = "email";
      } else if (document.getElementById('radioNumber').checked){
        searchBy = "number";
      }
      window.location = "Admin_users.php?search="+searchBar.value+"&searchBy="+searchBy;
    }
  }
  function show() {
    var options = document.getElementById("options");
    var text = document.getElementById("searchoptions");
    searchoptions
    if (options.style.display == "none") {
      options.style.display = "block";
      text.innerHTML = "Hide search options";
    } else {
      options.style.display = "none";
      text.innerHTML = "Show search options";
    }
  }

</script>

  </div>
  <?php 
        
        include 'footer.php'
    ?>
</body>

</html>