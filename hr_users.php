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

</style>
</head>
<?php
session_start();
if (!$_SESSION['loggedIn'] || $_SESSION['user']['Role'] != 3) {
    echo "<script> location.href='home.php'; </script>";
}
include "menu.php";

?>
<body>

  <div class="d-flex" id="wrapper">


    <div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="hr_users.php" class="list-group-item list-group-item-action bg-secondary text-light"><span class="text-nowrap"><i class="fa fa-user"></i> Admins</a></span>
        <a href="messagesMenu.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-envelope"></i> Reports</a></span>
        
        
        
        
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      </nav>
      <div class="container-fluid">
        <?php

        if(isset($_GET['Id']))
          $_SESSION['$selectedSurvey'] = $_GET['Id'];

        $servername = "localhost";
$username = "root";
$password = "";
$DB = "mydb";
$conn = mysqli_connect($servername, $username, $password, $DB);
if (!$conn) {
  die("Connection failed: " .mysqli_connect_error());
}


if (isset($_GET['send'])) {

  $valuesToSend = explode (",", $_GET['send']);
  for ($i = 0; $i < count($valuesToSend); $i++) {
    $v = $valuesToSend[$i];
    //echo "<script>alert('".$v."');</script>";
    $valuesToSend = explode (",", $_GET['send']);
    
    //$surveyId = $_SESSION['$selectedSurvey'];
    
    for ($i = 0; $i < count($valuesToSend); $i++) {
    $v = $valuesToSend[$i];
    
    //echo $v;

     if(mysqli_num_rows($conn->query("SELECT * FROM salaries
     WHERE userId ='$v'")) == 0)
    {
        $conn->query("INSERT INTO `salaries` (`userId`,`penalty`,`salary`) VALUES ('$v',1,2000)");
        //$salary = mysqli_fetch($conn->query("SELECT salary FROM salaries WHERE userId = $v"));
        //$conn->query("UPDATE `salaries` (`userId`,`penalty`,`salary`) VALUES ('$v',1,200)");
               
    }
    else
    {
      $salary = mysqli_fetch_row($conn->query("SELECT salary FROM salaries WHERE userId = $v"));
      //echo $salary[0];
      $newSalary = $salary[0] * 0.75;
      $conn->query("UPDATE `salaries` SET `salary` = $newSalary,`penalty` = 1 WHERE userId = $v AND penalty = 0");

    }  
  }
  //unset($_SESSION['$selectedSurvey']);
  echo "<script> location.href='hr_users.php'; </script>";
  }
}

//depenalty
if (isset($_GET['depenalty'])) {

  $valuesToSend = explode (",", $_GET['depenalty']);
  for ($i = 0; $i < count($valuesToSend); $i++) {
    $v = $valuesToSend[$i];
    //echo "<script>alert('".$v."');</script>";
    $valuesToSend = explode (",", $_GET['depenalty']);
    
    //$surveyId = $_SESSION['$selectedSurvey'];
    
    for ($i = 0; $i < count($valuesToSend); $i++) {
    $v = $valuesToSend[$i];
    
    //echo $v;

     if(mysqli_num_rows($conn->query("SELECT * FROM salaries
     WHERE userId ='$v'")) == 0)
    {
        
               
    }
    else
    {
      $salary = mysqli_fetch_row($conn->query("SELECT salary FROM salaries WHERE userId = $v"));
      //echo $salary[0];
      $newSalary = $salary[0] / .75;
      $conn->query("UPDATE `salaries` SET `salary` = $newSalary,`penalty` = 0 WHERE userId = $v AND penalty = 1");

    }  
  }
  //unset($_SESSION['$selectedSurvey']);
  echo "<script> location.href='hr_users.php'; </script>";
  }
}



$res = $conn->query("SELECT * FROM user u LEFT JOIN salaries s ON s.userId = u.Id WHERE u.Role = 2");
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
      }
      else if($colname == "userId")
      {
      } 
      else if($colname == "Role")
      {

      }
      else
      {
         echo "<th>$colname</th>";

      }
    }
    
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
       // echo $colval;
        echo "<td>&nbsp;<input type='checkbox' id='check".$id."' onclick='checkBoxes(".$id.")' name='select' value='".$id."'></td>";
      } else if ($where == 4) {

      }
      else if($where == 7)
      {

      }
      else if($where == 9)
      {

      } 
      else if ($where == 8) {
          
      }
      else {
        echo "<td>$colval</td>";
      }
    }
    $where++;
  }
  
   
    $rownumber ++;

  echo "</tr>\n";
}
echo "</table>\n";
$res->close(); 
?>

<?php echo '<a class="btn btn-dark" href="hr_users.php?page='.($page-1).'"><</a>' ?>
<?php echo"<a>\t".$page."\t</a>"?>
<?php echo '<a class="btn btn-dark" href="hr_users.php?page='.($page+1).'">></a>' ?>
<?php echo '  <a class="btn bg-danger text-light" id = "send" href = "">Add penalty</a>' ?>
<?php echo '  <a class="btn bg-success text-light" id = "depenalty" href = "">remove penalty</a>' ?>


      </div>
    </div>

  </div>


  <script>
  var selected = [];
  //adding and removing penaltyies
  var addLink = document.getElementById("send");
  var removeLink = document.getElementById("depenalty");

  var searchBy = "Name";
  addLink.setAttribute("href", "hr_users.php");
  removeLink.setAttribute("href", "hr_users.php");
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
      addLink.setAttribute("href", "hr_users.php?send="+selected.join(",")+"");
      removeLink.setAttribute("href", "hr_users.php?depenalty="+selected.join(",")+"");
    } else {
      addLink.setAttribute("href", "hr_users.php");
     removeLink.setAttribute("href", "hr_users.php");
       
    }
  }
</script>
<?php 
        
        include 'footer.php'
    ?>
</body>

</html>