<?php
	include('fetch.php');

	if($_REQUEST['name']){
	$name = $_REQUEST['name'];
	$address = $_REQUEST['address'];
	$dept= $_REQUEST['dept'];
	$salary = $_REQUEST['salary'];
	$sql = "INSERT INTO new VALUES('','$name', '$address', '$dept', '$salary')";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Inserted';  
 }  
 ?> 


