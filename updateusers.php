<?php

include_once("DBHelper.php");

$db=new DBHelper();
$conn=$db->connect();

$sql="UPDATE users 
SET status = 'Approved'
Where ID= '4'";
/*$sql="UPDATE users 
SET status = Approved
Where ID= '$_GET[ID]'";
*/
//var_dump($sql);
if( mysqli_query($conn,$sql))
header("refresh:1; url=SeeUpdateRequests.php");

?>