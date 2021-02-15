<html>
<head>
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
$res = $conn->query("SELECT * FROM user");
if (!$res) {
    //die "Query failed: (" . $res->errno . ") " . $res->error;
}
$rownumber = 1;
$page = 1;
$where = 0;
$firstrow = 0;
echo "<table style='width:100%'>\n";
if (isset($_GET['page'])) {
    $do = $_GET['page'];
    if ($do <= 0) {
      $page = 1;
    } else if ($do > (ceil(($res->num_rows) / 10))) {
        $page = ceil(($res->num_rows) / 10);
    } else {
    $page = $do;
  }
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
        echo "<td>&nbsp;<input type='checkbox' id='select'></td>";
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
    echo "<td><a href='Admin_edituser.php?id=".$id."' class='btn btn-dark'>edit</a><td>";
  }
    $rownumber ++;

  echo "</tr>\n";
}
echo "</table>\n";
$res->close(); 
?>

<?php echo '<a class="btn btn-dark" href="Admin_users.php?page='.($page-1).'"><</a>' ?>
<?php echo"<a>\t".$page."\t</a>"?>
<?php echo '<a class="btn btn-dark" href="Admin_users.php?page='.($page+1).'">></a>' ?>
<button class='btn float-right bg-warning text-light'>Delete</button>
<?php echo '<a class="btn bg-success text-light" href="Admin_edituser.php?action=add">add user</a>' ?>

      </div>
    </div>

  </div>
</body>

</html>