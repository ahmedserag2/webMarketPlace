

<?php
session_start();
/*this is where messages get inserted
note that i didnt want anything to break so is sticked with the same name :D

*/	
function sendMessage()
{
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

                //incase its an auditor get the id of the previous sender
               /* if($_SESSION['user']['Role'] == 4)
               		$sender = $_POST['sender'];*/
                $sql = "";
                if($_SESSION['user']['Role'] == 4)
                	$sql = "INSERT INTO `logs`(`content`, `receiverId`, `senderId`,`seen`,`comment`) VALUES ('$text','$receiver','$sender',0,1)";
                else
                	$sql = "INSERT INTO `logs`(`content`, `receiverId`, `senderId`,`seen`,`comment`) VALUES ('$text','$receiver','$sender',0,0)";

                $result = mysqli_query($conn,$sql); 
               // echo 'heloooooooo';
                
                if($result)
                {
                    error_log($text,3,"../errors/chat-errors.log");
                	//echo 'inserted ';
                }
                else
                {
                    error_log($conn->error(),3,"../errors/chat-errors.log");
                	//echo $conn->error();
                }
                
    }
                

                $conn->close();
}

            if(isset($_GET['action']) && function_exists($_GET['action'])) {
    $action = $_POST['action'];
    
    error_log("\ndetected get into function",3,"../errors/chat-errors.log");
    sendMessage();

}

?>