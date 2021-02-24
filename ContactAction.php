<?php

$target_dir = "Uploads/";
$target_file = $target_dir.basename($_FILES["filename"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["filename"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["filename"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$email = $_POST['email'];
$phonenumber = $_POST['phone'];
$imageurl = $target_file;

$sql = "INSERT INTO ContactUs (FirstName, LastName, Email,Phone,ImageUrl)
VALUES ('$firstname', '$lastname', '$email','$phonenumber','$imageurl')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Submitted successfully');
     window.location.href='contactus.php';
    </script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>