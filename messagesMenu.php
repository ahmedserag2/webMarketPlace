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

            if($_SESSION['user']['Role'] == 4)
            {
                $sql = "SELECT l.content, u.firstName,l.reg_date,l.senderId,l.receiverId,l.seen
                         FROM `logs` l 
                         JOIN `user` u
                          ON l.senderId = u.Id
                          WHERE u.Role !=2
                          GROUP BY l.senderId,l.receiverId
                          ORDER BY reg_date";
            }
            else if ($_SESSION['user']['Role'] == 3)
            {
                $sql = "SELECT l.content, u.firstName,l.reg_date,l.senderId,l.receiverId,l.seen
                         FROM `logs` l 
                         JOIN `user` u
                          ON l.senderId = u.Id
                          WHERE u.Role !=2 AND l.report = 1
                          GROUP BY l.senderId,l.receiverId
                          ORDER BY reg_date";
            }
            else
            {

                $sql = "SELECT l2.*, u.firstName, u.lastName 
                FROM logs l2
                JOIN user u
                ON l2.senderId = u.Id
                WHERE l2.Id IN (SELECT  max(l.Id) FROM logs l
                                      WHERE l.receiverId = $receiverId
                                      GROUP BY l.receiverId,l.senderId
                                      ORDER BY reg_date)";

   
            }
            //$result = mysqli_query($conn,$sql); 
            $result = $conn->query($sql);
            $allRecords = $result->fetch_all(MYSQLI_ASSOC);








 ?>


<!DOCTYPE html>
<html>
<head>
	  <link href="CSS/simple-sidebar.css" rel="stylesheet">

	<title></title>
</head>
<body>

    
<div class = row>
    <?php if($_SESSION['user']['Role'] == 4){

        echo '<div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="Auditor_surveys.php" class="list-group-item list-group-item-action bg-secondary text-light show"><span class="text-nowrap"><i class="fa fa-plus-square"></i> surveys</a></span>
        <a href="messagesMenu.php" class="list-group-item list-group-item-action bg-dark text-light show"><span class="text-nowrap"><i class="fa fa-profile"></i>Messages</a></span>
        
      </div>
    </div>';
    }
    if($_SESSION['user']['Role'] == 3){

        echo '<div class="bg-dark border-right" id="sidebar-wrapper">

      <div class="list-group list-group-flush bg-dark">
        <a href="Auditor_surveys.php" class="list-group-item list-group-item-action bg-secondary text-light show"><span class="text-nowrap"><i class="fa fa-plus-square"></i> users</a></span>
        <a href="messagesMenu.php" class="list-group-item list-group-item-action bg-dark text-light show"><span class="text-nowrap"><i class="fa fa-profile"></i>Reports</a></span>
        
      </div>
    </div>';
    }



     ?>
<div class="bg-dark border-right" id="sidebar-wrapper" >

      <div class="list-group list-group-flush bg-dark  " style= "width:40%;">
      	<?php 


        foreach($allRecords as $record){
      		$senderId = $record['senderId'];
            if($_SESSION['user']['Role'] == 3 || $_SESSION['user']['Role'] == 4)
                $getRequest = "sender=". $record['receiverId']. "&receiver=".$record['senderId'];
            else 
                $getRequest = "receiver=".$record['senderId'];

	        if($record['seen'])
	        {
	        	printf('<a href="chat.php?%s" class="list-group-item list-group-item-action bg-secondary text-light show" style = "font-style:italic;"><span class="text-nowrap"><i class="fa fa-user"></i> %s </a></span>',$getRequest,$record['firstName']);	
	        }
	        else
	        {
	        	printf('<a href="chat.php?%s" class="list-group-item list-group-item-action bg-secondary text-light show" style = "font-weight:bold;"><span class="text-nowrap"><i class="fa fa-user"></i> %s </a></span>',$getRequest,$record['firstName']);		
	        }
	        
        }


        	if(count($allRecords) == 0 && $_SESSION['user']['Role'] == 1)
            {


            	$sqlAdmins = "SELECT * FROM user WHERE Role = 2";
            	$result = $conn->query($sqlAdmins);
            	$admins = $result->fetch_all(MYSQLI_ASSOC);
            	echo "<h3>you didnt send any message here are some of our available workers</h3> ";
            	foreach($admins as $admin)
            	{
            		//echo $admin['firstName'];
            		printf('<a href="chat.php?receiver=%s" class="list-group-item list-group-item-action bg-secondary text-light show"><span class="text-nowrap"><i class="fa fa-plus-square"></i> %s </a></span>',$admin['Id'],$admin['firstName']);
            	}
            	
            }

			if(isset($_POST['message']))
			{
	            $sender = $_SESSION['user']['Id'];
	            $message = $_POST['message'];


	        }

        ?>
        
      </div>
    </div>
</div>
<?php 
include 'footer.php'
?>

</body>
</html>