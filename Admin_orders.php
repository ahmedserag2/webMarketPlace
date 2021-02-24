<html>
<head>
  <title> Admin - Orders</title>
  <link rel="icon" href="images/admin.jfif" type="image/x-icon"> 
  <link href="CSS/simple-sidebar.css" rel="stylesheet">
<style>
table {
  border-collapse: collapse;
  margin-top: 15px;
  width: 100%;
  text-align: center;
}

th, td {
  text-align: left;
  padding: 8px 0px;
  text-align: center;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #292b2c;
  color: white;
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
        <a href="Admin_orders.php" class="list-group-item list-group-item-action bg-secondary text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> Orders</a></span>

        <a href="Admin_contactus.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> contact us</a></span>

        
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
<div class="row d-flex justify-content-center">
  <!--Grid column-->
  <div class="col-md-6" style="margin-top: 15px;">
<div class="input-group rounded">
  <input type="search" id="searchBar" class="form-control rounded" placeholder="Search" aria-label="Search"
    aria-describedby="search-addon" />
  <span onclick="search()" style="margin-left: 10px;" class="btn input-group-text border-0" id="search-addon">
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
  <label class="form-check-label" for="customernameRadio">
    Customer name
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" id="amountofproductsRadio">
  <label class="form-check-label" for="amountofproductsRadio">
    Amount of products
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" id="tpriceRadio">
  <label class="form-check-label" for="tpriceRadio">
    Total price 
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" id="addressRadio">
  <label class="form-check-label" for="addressRadio">
    Address 
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
  die("Connection failed: " .mysqli_connect_error());
}
if (isset($_GET['delete'])) {
  $valuesToDelete = explode (",", $_GET['delete']);
  for ($i = 0; $i < count($valuesToDelete); $i++) {
    $v = $valuesToDelete[$i];
    //echo "<script>alert('".$v."');</script>";
    $conn->query("DELETE FROM invoice WHERE Id=$v");
  }
}

if (isset($_GET['search'])) {
  $val = $_GET['search'];
  $val2 = $_GET['searchBy'];
  if ($val2 == "amount") {
    $query1 = $conn->query("SELECT Id,ProductQuantities FROM invoice");
    $amountIDS = array();
    while ($row = $query1->fetch_assoc()) {
      $values = array_map("intval", explode(",", $row["ProductQuantities"]));
      $am = 0;
      for ($i = 0; $i < count($values); $i++) {
          $am += $values[$i];
      }
      if ($am == $val) {
        array_push($amountIDS, $row["Id"]);
      }
    }
    $res = $conn->query("SELECT * FROM invoice WHERE Id IN (".implode(",",$amountIDS).")");
  } else if ($val2 == "price") {
    $res = $conn->query("SELECT * FROM invoice WHERE TotalPrice='$val'");
  } else if ($val2 == "address") {
    $res =  $conn->query("select * from invoice  where Address like '%$val%' OR Address like '%$val' OR Address like '$val%'");
  } else {
    $query = $conn->query("select Id from user where firstName like '%$val%' OR firstName like '%$val' OR firstName like '$val%'");
    $custIds = "";
    while ($row = $query->fetch_assoc()) {
      $custIds = $custIds."".$row["Id"].",";
    }
    $res = $conn->query("SELECT * FROM invoice WHERE customerId IN ('".$custIds."')");
  }
} else {
  $res = $conn->query("SELECT * FROM invoice");

}
if (!$res) {
    //die "Query failed: (" . $res->errno . ") " . $res->error;
}
$rownumber = 1;
$page = 1;
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

      if ($colname == "reg_date") {
        echo "<th>date added</th>";
      } else if ($colname == "Id") {
        echo "<th>&nbsp;&nbsp;#</th>";
      } else if ($colname == "productIds") {
        echo "<th>Products</th>";
      } else if ($colname == "ProductQuantities") {
        echo "<th>Amount of products</th>";
      } else if ($colname == "customerId") {
        echo "<th>Customer name</th>";
      } else if ($colname == "TotalPrice") {
        echo "<th>Total price</th>";
      } else {
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
      } else if ($where == 1) {
        $proudctsByID = explode (",", $colval);
        echo "<td>";
        for ($i = 0; $i < count($proudctsByID); $i++) {
          //echo $proudctsByID[$i]." ";
          echo "<a href='Admin_editproduct.php?Id=".$proudctsByID[$i]."'>".$proudctsByID[$i]."</a>";
          if ((count($proudctsByID) - $i) > 1) {
            echo ", ";
          }
        }
        echo "</td>";
      } else if ($where == 2) {
        $query = $conn->query("SELECT firstName FROM user WHERE Id=".$colval."");
        $accName = $query->fetch_assoc();
        $n = $accName['firstName'];
        echo "<td><a href='Admin_edituser.php?Id=$colval'>$n</a></td>";
      } else if ($where == 4) {
        $values = array_map("intval", explode(",", $colval));
        $am = 0;
        for ($i = 0; $i < count($values); $i++) {
          $am += $values[$i];
        }
        echo "<td>$am</td>";
      } else {
        echo "<td>$colval</td>";
      }
    }
    $where++;
  }
    if (($rownumber <= $page*10 && abs($page*10 - $rownumber < 10)))  {
    echo "<td><a href='Admin_vieworder.php?Id=".$id."' class='btn btn-dark'>View order</a><td>";
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
    echo '<a class="btn btn-dark" href="Admin_orders.php?search='.$s.'&page='.($page-1).'&searchBy='.$s2.'"><</a>'; 
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
    echo '<a class="btn btn-dark" href="Admin_orders.php?page='.($page-1).'"><</a>'; 
  }
} 
?>
<?php if ($amountOfRows > 0) { echo"<a>\t".$page." of ".(ceil(($amountOfRows) / 10))."\t</a>"; }?>
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
    echo '<a class="btn btn-dark" href="Admin_orders.php?search='.$s.'&page='.($page+1).'&searchBy='.$s2.'">></a>'; 
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
    echo '<a class="btn btn-dark" href="Admin_orders.php?page='.($page+1).'">></a>'; 
  }
} 
?>

<?php echo '<a id="delete" class="btn float-right bg-warning text-light" href="">delete</a>' ?>

      </div>
    </div>
<script>
  var selected = [];
  var link = document.getElementById("delete");
  var searchBy = "Name";
  link.setAttribute("href", "Admin_orders.php");
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
      link.setAttribute("href", "Admin_orders.php?delete="+selected.join(",")+"");
    } else {
      link.setAttribute("href", "Admin_orders.php");
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
      if (document.getElementById('amountofproductsRadio').checked) {
        searchBy = "amount";
      } else if (document.getElementById('tpriceRadio').checked) {
        searchBy = "price";
      } else if (document.getElementById('addressRadio').checked){
        searchBy = "address";
      }
      if (searchBy == "amount" || searchBy == "price") {
        if (isNaN(searchBar.value)) {
          alert("Must be a number");
          return;
        }
      }
      window.location = "Admin_orders.php?search="+searchBar.value+"&searchBy="+searchBy;
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