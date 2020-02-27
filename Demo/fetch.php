<?php
include 'conn.php'; 
if (isset($_POST["employee_id"])) {
    $query  = "SELECT * FROM emp_data WHERE id = '" . $_POST["employee_id"] . "'";
    $result = mysqli_query($connect, $query);
    $row    = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>