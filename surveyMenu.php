<?php 
session_start();
include "menu.php";

 $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mydb";



            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            //wehre Id = $selectedId
            //$sql= "SELECT * FROM logs WHERE Id = 1";
            $receiverId = $_SESSION['user']['Id'];
            $sql = "SELECT survey.survey_name ,survey.survey_id
            FROM survey_sent_to 
            JOIN survey 
            ON survey.survey_id = survey_sent_to.survey_id
            WHERE survey_sent_to.user_id = $receiverId AND survey_sent_to.has_answered = 0
            ";
            //$result = mysqli_query($conn,$sql); 
            $result = $conn->query($sql);
            $allRecords = $result->fetch_all(MYSQLI_ASSOC);








 ?>


<!DOCTYPE html>
<html>
<head>
	  <link href="CSS/simple-sidebar.css" rel="stylesheet">

	<title>Survey menu</title>
</head>
<body>
<div class="bg-dark border-right" id="sidebar-wrapper" >

      <div class="list-group list-group-flush bg-dark  " style= "width:40%;">
      	<?php foreach($allRecords as $record){
              
          		$surveyId = $record['survey_id'];
            
            printf('<a href="Customer_surveyAnswer.php?Id=%s" class="list-group-item list-group-item-action bg-secondary text-light show"><span class="text-nowrap"><i class="fa fa-plus-square"></i> %s </a></span>',$record['survey_id'],$record['survey_name']);
          
        }


        	


        ?>
        
      </div>
    </div>
</body>
</html>