<?php  
 include 'conn.php';   

 $record_per_page = 5;  
 $page = '';  
 $output = '';  
 if($_POST["page"])  
 {  
      $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }  
 $start_from = ($page - 1)*$record_per_page;  
 $query = "SELECT name FROM emp_data ORDER BY id DESC LIMIT $start_from, $record_per_page";  
 $result = mysqli_query($connect, $query);  
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
 $output .= '</table><br /><div align="center">';  
 $page_query = "SELECT * FROM emp_data ORDER BY id DESC";  
 $page_result = mysqli_query($connect, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  
 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
 }  
 $output .= '</div><br /><br />';  
 echo $output;  
 ?>  