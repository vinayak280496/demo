<?php  
include('fetch.php');
 
 $abc = $_POST['id'];
 $sql = "DELETE FROM new WHERE id = '$abc'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>