

<?php
session_start();
/*this is where messages get inserted
note that i didnt want anything to break so is sticked with the same name :D

*/	

if(isset($_POST['text']))
{
	$text = $_POST['text'];
    $receiver = $_POST['receiver'];
    /*$text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";*/

    //file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);


            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mydb";



            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            //wehre Id = $selectedId
            //$sql= "SELECT * FROM logs WHERE Id = 1";
            echo $text;
            //sender will be $_SESSION['user']['Id']
            $sender = $_SESSION['user']['Id'];
            $sql = "INSERT INTO `logs`(`content`, `receiverId`, `senderId`) VALUES ('$text','$receiver','$sender')";
            $result = mysqli_query($conn,$sql); 
           // echo 'heloooooooo';
            
            if($result)
            {
            	//echo 'inserted ';
            }
            else
            {

            }
            
}
            

            $conn->close();
if(isset($_SESSION['name'])){
    
}
?>