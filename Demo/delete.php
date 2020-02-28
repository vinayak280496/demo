<?php  
 include 'conn.php'; 
 include 'pagination.php';
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $name = mysqli_real_escape_string($connect, $_POST["name"]);  
      $address = mysqli_real_escape_string($connect, $_POST["address"]);  
      $dept = mysqli_real_escape_string($connect, $_POST["dept"]);   
      $salary = mysqli_real_escape_string($connect, $_POST["salary"]);  
	if(isset($_POST["id"]))
		{
		 $query = "
		 DELETE FROM emp_data 
		 WHERE id = '".$_POST["id"]."'";
		 $message = 'Data Deleted'; 
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM emp_data ORDER BY id DESC";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="70%">Employee Name</th>  
                          <th width="15%">Edit</th>  
                          <th width="15%">View</th>
                          <th width="15%">Delete</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["name"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-success btn-xs view_data" /></td> 
                           <td><input type="button" name="delete" value="delete" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete_data" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>