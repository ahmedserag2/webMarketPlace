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

if (!$_SESSION['loggedIn'] || $_SESSION['user']['Role'] != 1) {
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
      $sqlQuestions = "SELECT survey.survey_name ,question.question_text,question.question_order,
        question.is_required,question.question_id
            FROM question 
            JOIN survey 
            ON survey.survey_id = question.survey_id
            WHERE question.survey_id = $surveyId
            ";
            //$result = mysqli_query($conn,$sql); 
            $result = $conn->query($sqlQuestions);
            $allQuestions = $result->fetch_all(MYSQLI_ASSOC);



          if($_SERVER['REQUEST_METHOD'] == 'POST')
          {
            $userId = $_SESSION['user']['Id'];
            foreach($allQuestions as $question)
            {
              $qId = $question['question_id'];
              $answer = $_POST[$qId];
              //echo $answer . " for ". $question['question_order'];
              $conn->query("INSERT INTO `survey_answer` (`question_id`,`survey_id`,`answer_value`,`user_id`)
               VALUES ('$qId','$surveyId','$answer','$userId')");

              $conn->query("UPDATE `survey_sent_to` SET `has_answered`=1 
                WHERE survey_id = $surveyId AND user_id = $userId");
              echo "<script> location.href='surveyMenu.php'; </script>";
            }
          }

   ?>
  <div class="container">


    <div class ="row">
        <h3><?php echo $allQuestions[0]['survey_name']; ?></h3>

    </div>
<form id = "survey" action="" method="POST" enctype="multipart/form-data">
    
    
    
  <?php foreach($allQuestions as $question){ 
    echo '<div class = "row">';
     printf('<h6>%s</h6>',$question['question_text']);
      printf('<textarea name = "%s" id = "%s" style = "height:100px;"></textarea>',$question['question_id'],$question['question_id']);

    echo '</div>';
  }
   ?>

    <div class = "row">
         <input type="submit" value="Submit" >
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