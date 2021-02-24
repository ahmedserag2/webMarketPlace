<?php
 
session_start();

if(isset($_GET['logout'])){    
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    //file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
     
    session_destroy();
    header("Location: chat.php"); //Redirect the user
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
 
function loginForm(){
    echo
    '<div id="loginform">
    <p>Please enter your name to continue!</p>
    <form action="chat.php" method="post">
      <label for="name">Name &mdash;</label>
      <input type="text" name="name" id="name" />
      <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
  </div>';
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<style>
		* {
    margin: 0;
    padding: 0;
  }
   
  body {
    
    font-family: "Lato";
    font-weight: 300;
  }
   
  form {
    padding: 15px 25px;
    display: flex;
    gap: 10px;
    justify-content: center;
  }
  img{
	  border:1pxsolid#ddd;
	  border-radius:4px;
	  padding:5px;
	  width:40%;
	  display:block;
	  margin-left:auto;
	  margin-right:auto;
	  
  }
   
  form label {
    font-size: 1.5rem;
    font-weight: bold;
  }
   
  input {
    font-family: "Lato";
  }
   
  a {
    color: #0000ff;
    text-decoration: none;
  }
   
  a:hover {
    text-decoration: underline;
  }
   
  #wrapper,
  #loginform {
    margin: 0 auto;
    padding-bottom: 25px;
    background: #eee;
    width: 600px;
    max-width: 100%;
    border: 2px solid #212121;
    border-radius: 4px;
  }
   
  #loginform {
    padding-top: 18px;
    text-align: center;
  }
   
  #loginform p {
    padding: 15px 25px;
    font-size: 1.4rem;
    font-weight: bold;
  }
   
  #chatbox {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 10px;
    background: #fff;
    height: 300px;
    width: 530px;
    border: 1px solid #a7a7a7;
    overflow: auto;
    border-radius: 4px;
    border-bottom: 4px solid #a7a7a7;
  }
   
  #usermsg {
    flex: 1;
    border-radius: 4px;
    border: 1px solid #ff9800;
  }
   
  #name {
    border-radius: 4px;
    border: 1px solid #ff9800;
    padding: 2px 5px;
  }
   
  #submitmsg,
  #enter{
    background: #ff9800;
    border: 2px solid #e65100;
    color: white;
    padding: 4px 10px;
    font-weight: bold;
    border-radius: 4px;
  }
   
  .error {
    color: #ff0000;
  }
   
  #menu {
	  
    padding: 15px 50px;
    display: flex;
  }
   
  #menu p.welcome {
    flex: 1;
  }
   
  a#exit {
    color: white;
    background: #c62828;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
  }
   
  .msgln {
    margin: 0 0 5px 0;
  }
   
  .msgln span.left-info {
    color: orangered;
  }
   
  .msgln span.chat-time {
    color: #666;
    font-size: 60%;
    vertical-align: super;
  }
   
  .msgln b.user-name, .msgln b.user-name-left {
    font-weight: bold;
    background: #546e7a;
    color: white;
    padding: 2px 4px;
    font-size: 90%;
    border-radius: 4px;
    margin: 0 5px 0 0;
  }
   
  .msgln b.user-name-left {
    background: orangered;
  }
		</style>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
        <script type="text/javascript">
          
          function insertMessage(sender)
          {
            //alert('function fired');
                jQuery.ajax({
            //
                url:"./ajaxphp/AjaxChatSend.php",
                data:'text='+$("#usermsg").val()+
                '&receiver='+<?php echo $_GET['receiver'];?>+
                '&sender='+sender,

                type:"POST",

                success:function(data)
                {

                  //alert(data);
                  //alert(data);
                  //alert($(btnId).val());
                  //$( "#" + Id).remove();
                 
                  
                 
                }
              });
          }
            // jQuery Document
            $(document).ready(function () {
               /* $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });*/
 
                /*function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }*/
 
                //setInterval (loadLog, 2500);
 
                $("#exit").click(function () {
                    var exit = confirm("Are you sure you want to end the session?");
                    if (exit == true) {
                    window.location = "chat.php?logout=true";
                    }
                });
            });
        </script>
    </head>
    <body>
    <?php
     include "menu.php"; 

    if(false){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION['user']['firstName']; ?></b></p>
				<br>
				<img src = 'Capture1.PNG'>
				
                <?php 
                if($_SESSION['user']['Role'] == 4)
                {
                echo '<form action = "" method = "POST">

                  <input class = "btn-danger" id="report" name = "report" type = submit value = "report">

                </form>';
              }
                ?>
            </div>
 
            <div id="chatbox">
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mydb";



            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            //wehre Id = $selectedId
            //$sql= "SELECT * FROM logs WHERE Id = 1";

            $sender = $_SESSION['user']['Id'];
            if($_SESSION['user']['Role'] == 4)
            {
              $sender = $_GET['sender'];
            }
            $receiver = $_GET['receiver'];



            $sql = "";
            if($_SESSION['user']['Role'] == 1)
            {
              
              $sql = "SELECT l.content, u.firstName sender,l.reg_date,l.senderId,l.comment
               FROM `logs` l 
               JOIN `user` u
                ON l.senderId = u.Id
                WHERE 
                (l.senderId = $sender) OR 
                (l.receiverId = $sender)
                ORDER BY l.Id";

                //echo $sender;
                $conn->query("UPDATE logs SET seen = 1 WHERE Id =  (SELECT  max(l.Id) FROM logs l
                              WHERE l.senderId = $receiver
                              GROUP BY l.senderId
                              ORDER BY reg_date)");
            }
            else if($_SESSION['user']['Role'] == 2)
            {
                $sql = "SELECT l.content, u.firstName sender,l.reg_date,l.senderId,l.comment
               FROM `logs` l 
               JOIN `user` u
                ON l.senderId = u.Id
                WHERE 
                (l.senderId = $receiver) OR 
                (l.receiverId = $receiver)
                ORDER BY reg_date"; 

                $conn->query("UPDATE logs SET seen = 1 WHERE Id =  (SELECT  max(l.Id) FROM logs l
                              WHERE l.senderId = $receiver
                              GROUP BY l.receiverId
                              ORDER BY reg_date)");
            }
            else
            {
              $sql = "SELECT l.content, u.firstName sender,l.reg_date,l.senderId,l.comment
               FROM `logs` l 
               JOIN `user` u
                ON l.senderId = u.Id
                WHERE 
                (l.senderId = $receiver) OR 
                (l.receiverId = $receiver)
                ORDER BY reg_date"; 
            }
            //$result = mysqli_query($conn,$sql); 
            $result = $conn->query($sql);
            //echo $receiver;
            if(isset($_POST['report']))
            {

              $conn->query("UPDATE logs SET report = 1 
                WHERE  (senderId = $receiver) OR 
                (receiverId = $receiver)");

              
            }


            $allRecords = $result->fetch_all(MYSQLI_ASSOC);
            $contents = "";
            //Select all where 
            foreach($allRecords as $record){

              if($record['comment'] == 1)
              {
                echo "<div class='msgln'><span class='chat-time'>".$record['reg_date']."</span> <b class='user-name'>super visor</b> ".stripslashes(htmlspecialchars($record['content']))."<br></div>";
              }
              else
              {
                if($_SESSION['user']['Id'] == $record['senderId'])
                {
                     echo "<div class='msgln'><span class='chat-time'>".$record['reg_date']."</span> <b class='user-name'>you</b> ".stripslashes(htmlspecialchars($record['content']))."<br></div>";
             
                }
                else
                {
                  echo "<div class='msgln'><span class='chat-time'>".$record['reg_date']."</span> <b class='user-name'>".$record['sender']."</b> ".stripslashes(htmlspecialchars($record['content']))."<br></div>";
                }
              }  
              
            
          }

            //echo $contents;
            $conn->close();
            ?>
            </div>
 <?php 
      if($_SESSION['user']['Role'] != 3)
      {
        //echo $sender;
        printf('<form name="message" action="" method="post">
                <input name="usermsg" type="text" id="usermsg" />
                <intput name = "receiver"  id = "receiver" type = "hidden" value = $receiver >
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" onclick = "insertMessage(%s)" />
            </form>',$sender);
      }
 ?>
            
        </div>
        <?php 
        
        include 'footer.php'
    ?>
    </body>
</html>
<?php
}
?>