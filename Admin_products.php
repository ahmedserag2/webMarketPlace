<html>
<head>
  <title> Admin - Products</title>
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
        <a href="Admin_products.php" class="list-group-item list-group-item-action bg-secondary text-light show"><span class="text-nowrap"><i class="fa fa-plus-square"></i> Products</a></span>
        <a href="Admin_users.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-user"></i> Users</a></span>
        <a href="Admin_orders.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-cog"></i> Orders</a></span>
        
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
  <label class="form-check-label" for="exampleRadios1">
    Name
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" id="radioRating">
  <label class="form-check-label" for="exampleRadios2">
    rating
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="filter" id="radioPrice">
  <label class="form-check-label" for="exampleRadios2">
    price 
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
    $conn->query("DELETE FROM reviews WHERE productId=$v");
    $conn->query("DELETE FROM products WHERE Id=$v");
    if (file_exists("images/products/".$v)) {
      unlink("images/products/".$v);
    }
  }
}
if (isset($_GET['search'])) {
  $val = $_GET['search'];
  $val2 = $_GET['searchBy'];
  if ($val2 == "rating") {
    $res = $conn->query("SELECT * FROM products WHERE rating='$val'");
  } else if ($val2 == "price") {
    $res = $conn->query("SELECT * FROM products WHERE Price='$val'");
  } else {
    $res = $conn->query("select * from products where Name like '%$val%' OR Name like '%$val' OR Name like '$val%'");
  }
} else {
  $res = $conn->query("SELECT * FROM products");

}
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
      } else {
        echo "<td>$colval</td>";
      }
    }
    $where++;
  }
    if (($rownumber <= $page*10 && abs($page*10 - $rownumber < 10)))  {
    echo "<td><a href='Admin_editproduct.php?Id=".$id."' class='btn btn-dark'>edit</a><td>";
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
    echo '<a class="btn btn-dark" href="Admin_products.php?search='.$s.'&page='.($page-1).'&searchBy='.$s2.'"><</a>'; 
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
    echo '<a class="btn btn-dark" href="Admin_products.php?page='.($page-1).'"><</a>'; 
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
    echo '<a class="btn btn-dark" href="Admin_products.php?search='.$s.'&page='.($page+1).'&searchBy='.$s2.'">></a>'; 
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
    echo '<a class="btn btn-dark" href="Admin_products.php?page='.($page+1).'">></a>'; 
  }
} 
?>

<?php echo '<a id="delete" class="btn float-right bg-warning text-light" href="">delete</a>' ?>
<?php echo '  <a class="btn bg-success text-light" href="Admin_editproduct.php?action=add">add product</a>' ?>

      </div>
    </div>
<script>
  var selected = [];
  var link = document.getElementById("delete");
  var searchBy = "Name";
  link.setAttribute("href", "Admin_products.php");
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
      link.setAttribute("href", "Admin_products.php?delete="+selected.join(",")+"");
    } else {
      link.setAttribute("href", "Admin_products.php");
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
      if (document.getElementById('radioRating').checked) {
        searchBy = "rating";
      } else if (document.getElementById('radioPrice').checked) {
        searchBy = "price";
      }
      if (searchBy != "Name") {
        if (isNaN(searchBar.value)) {
          alert("Must be a number");
          return;
        }
      }
      window.location = "Admin_products.php?search="+searchBar.value+"&searchBy="+searchBy;
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