<?php  
 include('fetch.php');


 $name = $_POST["name"];  
 $address = $_POST["address"];  
 $dept = $_POST["dept"];
 $salary = $_POST["salary"];
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE tbl_sample SET ".$column_name."='".$text."' WHERE id='".$id."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Updated';  
 }  
 ?>
