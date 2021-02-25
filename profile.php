<?php
session_start();
include 'menu.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="CSS/profile.css" type="text/css"> 

</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$DB = "mydb";
$conn = mysqli_connect($servername, $username, $password, $DB);
if ($_SESSION["user"]["Role"] != 1) {
    echo "<script> location.href='home.php'; </script>";    
}
?>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-12 col-md-12" style="margin-left: 250px;">
                <div class="card user-card-full h-100" >
                    <div class="row m-l-0 m-r-0 h-100" >
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img style="width: 250px; height: 250px; border-radius: 50%;" src=<?php echo "images/users/".$_SESSION['user']['Id'] ?> class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600"><?php echo $_SESSION["user"]["firstName"]." ".$_SESSION["user"]["lastName"] ?></h6>
                                <p>      	<?php 
						      		if ($_SESSION['user']['gender'] == "Male") {
						      			echo "Male";
						      		} else {
						      			echo "Female";
						      		}
      							?>
							</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['email'])) {
                            $id = $_SESSION["user"]["Id"];
                            $email = $_POST['email'];
                            $number = $_POST['number'];
                            $_SESSION["user"]["Email"] = $email;
                            $_SESSION["user"]["phoneNumber"] = $number;
                            $res = $conn->query("UPDATE user SET Email = '$email', phoneNumber = '$number' WHERE Id = '$id'");
                        }

                        ?>
                        <div class="col-sm-8">
                            <form action="profile.php" method="POST" onsubmit="return validate();">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400" id="emailID"><?php echo $_SESSION["user"]["Email"] ?></h6>
                                        <input type="hidden" name="email" id="email">
                                    </div>
                                    <div class="col-sm-5">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400" id="phoneID"><?php echo $_SESSION["user"]["phoneNumber"] ?></h6>
                                        <input type="hidden" name="number" id="number">
                                    </div>
                                    <div class="col-sm-2">
                                       <button class="btn btn-dark" id="editinfo" onclick="return changeForm()">edit info</button>
                                       <input hidden class="btn btn-dark"type="submit" id="submit" value="Submit">
                                    </div>
                                </div>

                                <script>
                                    function changeForm() {
                                        var hiddenEmail = document.getElementById("email");
                                        var emailLabel = document.getElementById("emailID");
                                        var hiddenPhone = document.getElementById("number");
                                        var phoneLabel = document.getElementById("phoneID");
                                        var editButton = document.getElementById("editinfo");
                                        var submitButton = document.getElementById("submit");
                                        if (hiddenEmail.type == "hidden") {
                                            hiddenEmail.type = "text";
                                            emailLabel.style.display = "none";
                                            hiddenEmail.value = emailLabel.innerHTML;
                                            hiddenPhone.type = "text";
                                            phoneLabel.style.display = "none";
                                            hiddenPhone.value = phoneLabel.innerHTML;
                                            editButton.style.display = "none";
                                            submitButton.removeAttribute("hidden");
                                        }
                                        return false;
                                    }
                                    function validate() {
                                        var hiddenEmail = document.getElementById("email");
                                        var hiddenPhone = document.getElementById("number");
                                        if (hiddenEmail.value == "" || hiddenPhone.value == "") {
                                            alert("Email and phone number cant be empty");
                                            return false;
                                        }
                                    }
                                    var option = 1;
                                </script>
                            </form>
                        </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Previous orders</h6>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="m-b-10 f-w-600">Orders</p>
                                        <select class="form-select" size="10" style="width: 200px;" aria-label="size 3 select example">
                                        	<?php
                                        		$prod = array();
										  		$res = $conn->query("SELECT * FROM invoice WHERE customerId=".$_SESSION["user"]["Id"]."");

                                                // $rowData;

                                                while ($row = $res->fetch_assoc()) {
                                                    //echo $l;
                                                    $l = $row["Id"];
                                                    if (isset($_GET['order'])) {
                                                        $l = $_GET['order'];
                                                    }
                                                
                                                    if ($l == $row["Id"]) {
                                                        $rowData = $row;
                                                      //  echo $rowData;
                                                        echo "<option selected onclick='chng(".$row['Id'].")'>Order #".$row['Id']."</option>";
                                                    } else {
                                                        //$rowData = $row;
                                                        echo "<option onclick='chng(".$row['Id'].")'>Order #".
                                                        $row['Id']."</option>";
                                                    }

                                                }
										  		$productIDS = explode (",", $rowData['productIds']);
										  		$prq = explode (",", $rowData['ProductQuantities']);
                                                $am = 0;
                                                $tProducts = substr_count($rowData['productIds'], ",");
										  		for ($i = 0; $i < count($productIDS); $i++) {
                                                    $am += $prq[$i];
										  			$query2 = $conn->query("SELECT Name, Price FROM Products WHERE Id=".$productIDS[$i]."");
										  			$productName = $query2->fetch_assoc();
										  			$pushthis = array($productIDS[$i], $productName['Name'], $productName['Price'], $prq[$i]);
										  			array_push($prod, $pushthis);
										  		}

     										  		/*for ($i = 0; $i < count($prod); $i++) {
										  			if ($i == 0) {
										  				echo "<option onclick='change()' selected value=".$prod[0][0].",".$prod[0][2].",".$prod[0][3].">".$prod[0][1]."</option>";
 										  			} else {
										  				echo "<option onclick='change()' value=".$prod[$i][0].",".$prod[$i][2].",".$prod[$i][3].">".$prod[$i][1]."</option>";
										  		}
										  	}*/

                                        	?>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600" style="text-align: center;">Amount of products</p>
                                        <h6 id="amount" class="text-muted f-w-400" style="text-align: center;"><?php echo $am ?></h6>
                                        <p class="m-b-10 f-w-600" style="text-align: center;">Quanitity</p>
                                        <h6 id="quantity" class="text-muted f-w-400" style="text-align: center;"><?php echo $prod[0][3] ?></h6>
                                        <p class="m-b-10 f-w-600" style="text-align: center;">Price</p>
                                        <h6 id="price" class="text-muted f-w-400" style="text-align: center;"><?php echo $prod[0][2] ?></h6>
                                        <p class="m-b-10 f-w-600" style="text-align: center;">Address</p>
                                        <h6 id="price" class="text-muted f-w-400" style="text-align: center;"><?php echo $rowData['Address'] ?></h6>


                                    </div>
                                    <div class="col-sm-4">
                                        <img style="width: 200px; height: 200px;" src='https://placehold.it/300' id="imgShow" class="img-thumbnail">
                                        <button class="btn btn-dark" onclick="decreaseOne();"><</button>
                                        <label id="labelID">&nbsp&nbsp <?php echo "1 of ".$tProducts+1 ?> &nbsp</label>
                                        <button class="btn btn-dark"onclick="increaseOne();">></button>

                                    </div>
                                </div>
                                   
                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <script type="text/javascript">
                                        function updateLabel() {
                                            var labelID = document.getElementById("labelID");
                                            var maxProducts = <?php echo $tProducts;?>;
                                            labelID.innerHTML = "&nbsp&nbsp Product "+option+" of "+(maxProducts+1)+"&nbsp";
                                            var imgShow = document.getElementById("imgShow");
                                            var data = <?php echo json_encode($prod);?>;
                                            imgShow.src = "images/products/"+data[0][0];
                                        }
                                        updateLabel();
                                        function increaseOne() {
                                            var maxProducts = <?php echo $tProducts;?>;
                                            var data = <?php echo json_encode($prod);?>;
                                            var imgShow = document.getElementById("imgShow");
                                            if (option == (maxProducts+1)) {
                                                return;
                                            }
                                            option++;
                                            var quantity = document.getElementById("quantity");
                                            var price = document.getElementById("price");
                                            quantity.innerHTML = data[option-1][3];
                                            price.innerHTML = data[option-1][2];
                                            updateLabel();
                                            imgShow.src = "images/products/"+data[option-1][0];
                                        }
                                        function decreaseOne() {
                                            var data = <?php echo json_encode($prod);?>;
                                            var imgShow = document.getElementById("imgShow");
                                            if (option == 1) {
                                                return;
                                            }
                                            option--;
                                            var quantity = document.getElementById("quantity");
                                            var price = document.getElementById("price");
                                            quantity.innerHTML = data[option-1][3];
                                            price.innerHTML = data[option-1][2];
                                            updateLabel();
                                            imgShow.src = "images/products/"+data[option-1][0];
                                        }
                                        function chng(id) {
                                            window.location = "profile.php?order="+id;
                                        }
                                    </script>
  <?php 
        
        include 'footer.php'
    ?>

</body>
</html>
