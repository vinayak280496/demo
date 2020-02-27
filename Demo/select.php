<?php
if (isset($_POST["employee_id"])) {
    $output = '';
    include 'conn.php';
    $query  = "SELECT * FROM emp_data WHERE id = '" . $_POST["employee_id"] . "'";
    $result = mysqli_query($connect, $query);
    $output .= '  
      <div class="table-responsive">  
           <table class="table table-striped">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">' . $row["name"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%">' . $row["address"] . '</td>  
                </tr>  
                     <td width="30%"><label>Department</label></td>  
                     <td width="70%">' . $row["dept"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Salary</label></td>  
                     <td width="70%">' . $row["salary"] . '</td>  
                </tr>  
           ';
    }
    $output .= '  
           </table>  
      </div>  
      ';
    echo $output;
}
?>