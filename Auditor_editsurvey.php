<html>
<head>
  <link href="CSS/simple-sidebar.css" rel="stylesheet">
  <title> Auditor - Add survey</title>
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



<script>
var limit = 10; // Max questions
var count = 4; // There are 4 questions already

function addQuestion()
{
    // Get the survey form element
    var survey = document.getElementById('survey');

    // Good to do error checking, make sure we managed to get something
    if (survey)
    {
        if (count < limit)
        {
            // Create a new <p> element
            var newP = document.createElement('p');
            newP.innerHTML = 'Question ' + (count + 1);

            // Create the new text box
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'questions[]';

            // Good practice to do error checking
            if (newInput && newP)   
            {
                // Add the new elements to the form
                survey.appendChild(newP);
                survey.appendChild(newInput);
                // Increment the count
                count++;
            }

        }
        else   
        {
            alert('Question limit reached');
        }
    }
}
</script>

</head>
<?php
session_start();
$_SESSION["err"] = 1;
if (!$_SESSION['loggedIn'] || $_SESSION['user']['Role'] != 4) {
    echo "<script> location.href='home.php'; </script>";
}
include "menu.php";
?>
<body>

  <div class="d-flex" id="wrapper">


    <div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="Auditor_surveys.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-plus-square"></i> surveys</a></span>
        
        
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
    $questions = $_POST['questions'];
  
    $action  = $_POST['action'];
    if ($action == "old") {
      $file_name = $id;
    }
    
    if ($name == "") {
      if ($action == "old") {
        echo "<script> location.href='Auditor_editsurvey.php?Id=".$id."'; </script>";
      } else {
        echo "<script> location.href='Auditor_editsurvey.php?action=add'; </script>";
      }
      $_SESSION["err"] = 1;
      return;
    }
    foreach($questions as $question)
    {
      if(empty($question))
      {

        if ($action == "old") {
        echo "<script> location.href='Auditor_editsurvey.php?Id=".$id."'; </script>";
        } else {
          echo "<script> location.href='Auditor_editsurvey.php?action=add'; </script>";
        }
        $_SESSION["err"] = 1;
        return;   
      }
    }
    
  
    if ($action == "old") {
        $res = $conn->query("UPDATE survey SET survey_name = '$name' WHERE survey_id = $id");
    } else {
      $res = $conn->query("INSERT INTO survey (survey_name) VALUES ('$name')");
      $res = $conn->query("SELECT LAST_INSERT_ID()");
      $row = $res->fetch_assoc();
      $surveyId = $row['LAST_INSERT_ID()'];
      for($i = 0;$i<count($questions); $i++)
      {

        $res = $conn->query("INSERT INTO question ( `survey_id`, `question_text`, `is_required`, `question_order`)
       VALUES ('$surveyId','$questions[$i]',1,'$i')");
  
      }
      

     
      
    }
    if ($id == "new") {
      $id = $conn->insert_id;
    }
    echo "<script> location.href='Auditor_surveys.php'; </script>";
  } else {
    $res = $conn->query("SELECT * FROM survey WHERE survey_id=".$_GET['Id']."");
    $row = $res->fetch_assoc();
    $row['action'] = "old";
  }

} else if (isset($_GET['action'])){
  if ($_GET['action'] == "add") {

    $row = array();
    $row['Id'] = "new";
    $row['survey_name'] = 'name';
    $row['Details'] = "Description";
    $row['action'] = "new";
     
  } else {
    echo "<script> location.href='Auditor_surveys.php'; </script>";
  }
} else {
  echo "<script> location.href='Auditor_surveys.php'; </script>";
}


?>

<div class="container">
  <?php 
  //echo $_SESSION["err"];
  if ($_SESSION["err"] == 1) {
    echo "<h5 style='color: red;'>Please enter survey name and fill all the  questions before proceeding. </h5>";
   // $_SESSION["err"] = 0;
    }
  ?>
  <form id = "survey" action="Auditor_editsurvey.php" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-25">
        <label>survey name</label>
      </div>
      <input type="hidden" name="action" id="action" value='<?php echo $row['action'] ?>'>
      <input type="hidden" name="Id" id="Id" value='<?php echo $row['survey_id'] ?>'>
      <div class="col-75">
        <input type="text" id="pname" name="name" value='<?php echo $row['survey_name'] ?>'>
      </div>
    </div>
    
    

   

    <div class = "row">
         <input type="submit" value="Submit" >
     

    </div>

     <div class = "row">
        <input type="button" value="Add question" onclick="javascript: addQuestion();"/>
    </div>
    <div class = "row">
       <p >Question 1</p>
          <input type="text" name="questions[]"  />
            <p>Question 2</p>
    <input type="text" name="questions[]"/>
    <p>Question 3</p>
    <input type="text" name="questions[]"/>
    <p>Question 4</p>
    <input type="text" name="questions[]"/>
      <p></p>
      

    </div>

    
    <div class="row">
      
    </div>
  </form>
</div>  


      </div>
    </div>

  </div>
  <?php 
        
        include 'footer.php'
    ?>
</body>

</html>