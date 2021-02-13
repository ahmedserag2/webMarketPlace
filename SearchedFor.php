<!DOCTYPE html>
<html>
<head>
	<title>search results</title>
	<link rel="stylesheet" href="CSS/SearchedFor.css" type="text/css"> 



	</head>
<body>

	
	<?php 
		$noOfPages = 0;
	function add_items($currentPage){
		//set the limit of items per page 
			$allowedItems = 8;
			//0 times 8 , 1 times 8, 2 times 8 the pattern goes on
			$startingIndex = $currentPage * $allowedItems;
			//path for products with no images
			$noImagePath = "./pics/no-image.png";
			//end of the loop is the strt plus 8 items 
			$end =  $startingIndex + 8;
			$noOfItems = count($_SESSION['allRecords']);
			//subtract the starting index be it 0,8,16 whatever from the total number of items
			$itemsLeft = $noOfItems - $startingIndex;
			//unless a fraction of the items is remaining in this case
			//the end is the start plus the itemsleft
			if($itemsLeft < 8)
				$end = $startingIndex + $itemsLeft;
			//devide 8 items per page
			$noOfPages = ceil($noOfItems / 8.0);

			$GLOBALS['noOfPages'] = $noOfPages;
			for($i = $startingIndex;$i < $end; $i++)
			{
				$path = "./pics/".$_SESSION['allRecords'][$i]['Id'];
				$files = glob($path."*.{jpg,jpeg,png,gif}", GLOB_BRACE);

				//$imagePath = ("./pics/%d.%s",$row['Id']);
				print '<div class="col-sm-3">';
				print '<div class="card">';
				print '<div class="card-body">';
					if(empty($files))
					{
						printf('<a href="ProductPage.php?q=%d">',$i);
						printf('<img class="card-img-top" src="%s" alt="Card image cap">',$noImagePath);
						print'</a>';
					}
					else
					{
						printf('<a href="ProductPage.php?q=%d">',$i);
					    printf('<img class="card-img-top" src="%s" alt="Card image cap">',$files[0]);
						print'</a>';

					}
					printf('<a href="ProductPage.php?q=%d">',$i);
			        printf('<h5 class="card-title">%s</h5>', $_SESSION['allRecords'][$i]['Name']);
			        print'</a>';
			      print'</div>';
			    print '</div>';
			  print '</div>';
				
				

			}
			
		  	print '</div>';}
		$query = "";
		session_start();
		include "menu.php";
		//$currentPage = 0;
		//$_SERVER['REQUEST_METHOD'] == 'POST' && 
		if(!empty($_GET['ProductName'])){

			
			$query = $_GET['ProductName'];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "myDB";

			
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			//select the closest query that would match
			$sql="select * from products where Name like '%$query%' OR Name like '%$query' OR Name like '$query%'";


			print"<div class = row>";
	
			printf("<div class = col><h3>search results for: %s</h3></div>",$query);
			print'</div>';
			print'<div class="row">';


			
			
			$currentPage = 0;
			$result = $conn->query($sql);

			$allRecords = $result->fetch_all(MYSQLI_ASSOC);
			$_SESSION['allRecords'] = $allRecords;
			add_items($currentPage);
			
		}
		if(!empty($_GET['pn'])){
			//get product name
			//pn stands for product name
			echo "ahmmmm" .$_SERVER['HTTP_REFERER'];
			$query = $_GET['pn'];
			$currentPage = (int)$_GET['no'];

			print"<div class = row>";
	
			printf("<div class = col><h3>search results for: %s</h3></div>",$query);
			print'</div>';
			print'<div class="row">';


			
			$noImagePath = "./pics/no-image.png";
			

			add_items($currentPage);

		
		
		}

	 ?>



<?php //pagiation bar
print'<nav aria-label="">';
  print'<ul class="pagination">';

    
    //make a condition so u dont go into index out of bounds
    if($currentPage != 0){
    	print'<li class="page-item">';
      printf('<a class="page-link" href="SearchedFor.php?no=%d & pn = %s" tabindex="-1">Previous</a>'
      	, $currentPage - 1,$query);
    print'</li>';}
    for($i = 0;$i < $noOfPages; $i++){
    	if($currentPage != $i){
   	    	printf('<li class="page-item"><a class="page-link" href="SearchedFor.php?no=%d & pn=%s">%d</a></li>'
   	    		,$i, $query, $i);
   	    	
   		}
   		else{
   			print'<li class="page-item active">';
      		printf('<a class="page-link" href="SearchedFor.php?no=%d & pn=%s">%d <span class="sr-only">(current)</span></a>', $i,$query , $i);
    		print'</li>';
   		}


    }

  if($currentPage < $noOfPages-1)
  {
    print'<li class="page-item">';
    //make condition so u dont go index out of bounds
      printf('<a class="page-link" href="SearchedFor.php?no=%d & pn=%s">Next </a>',$currentPage + 1,$query );
    print'</li>';
	}
  print'</ul>';
print'</nav>';
?>



</body>
</html>