<html>
<head>
  <link href="CSS/simple-sidebar.css" rel="stylesheet">
  <title> Customer Survey</title>
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

if (!$_SESSION['loggedIn'] || $_SESSION['user']['Role'] != 4) {
    echo "<script> location.href='home.php'; </script>";
}
include "menu.php";
//include "surveyMenu.php";

?>

<body>


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
        $surveyId = $_SESSION['$selectedSurvey'];
      $sqlQuestions = "SELECT s.survey_name ,sq.question_text,sq.question_order,
        sq.is_required,sq.question_id,sa.answer_value,u.firstName,u.lastName,u.Id
            FROM question sq
            JOIN survey s
            ON s.survey_id = sq.survey_id
            JOIN survey_answer sa
            ON sa.question_id = sq.question_id
            JOIN user u
            ON u.Id = sa.user_id
            WHERE sq.survey_id = $surveyId
            ";
            //$result = mysqli_query($conn,$sql); 
            $result = $conn->query($sqlQuestions);
            $allRecords = $result->fetch_all(MYSQLI_ASSOC);




          

   ?>

   <div class="d-flex" id="wrapper">
<div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="Auditor_surveys.php" class="list-group-item list-group-item-action bg-dark text-light"><span class="text-nowrap"><i class="fa fa-plus-square"></i> surveys</a></span>
        
        
      </div>
    </div>
  <div class="container">
    

    <div class ="row">


        <h3><?php echo $allRecords[0]['survey_name']; ?></h3>

    </div>
<form id = "survey" action="" method="POST" enctype="multipart/form-data">
    
    
    
  <?php

  
      $sameUser = $allRecords[0]['Id'];
      
        printf('<h6>%s %s</h6>',$allRecords[0]['firstName'] , $allRecords[1]['lastName']); 
        foreach($allRecords as $record){ 
            if($sameUser != $record['Id'])
          {
            echo "<br>";
            printf('<h6>%s %s  <h6><br>',$record['firstName'] , $record['lastName']); 
            $sameUser = $record['Id'];
          }
          echo '<div class = "row">';
        
           printf('<br><h6>%s</h6>',$record['question_text']);
           
            printf('<textarea style = "height:150px;" disabled >%s</textarea>',$record['answer_value']);

          echo '</div>';
        }
    
   ?>

 

     
    
  </form>
</div>  


      </div>
    </div>

  </div>
</div>
</body>

</html>