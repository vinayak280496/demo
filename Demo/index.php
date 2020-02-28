<?php  
 include 'conn.php'; 
 $query = "SELECT * FROM emp_data ORDER BY id DESC";  
 $result = mysqli_query($connect, $query);  
 ?>
   <!DOCTYPE html>  
 <html>  
      <head>  
      <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       </head>  
      <body>  
     <br /><br />  
     <div class="container">  
     <h3 align="center"></h3>
     <br />  
          <div class="table-responsive">  
               <div align="center">  
                    <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add New Employee</button>  
               </div>  
               <br />
          <h4 align="center">Employee List</h4>
               <div id="employee_table">  
               <table class="table table-striped">
                <div id="pagination_data"> 
                         <tr>  
                         <th width="70%">Employee Name</th>
                         <th width="10%" class="text-center">Edit</th>
                         <th width="20%" class="text-center">View Employee Details</th>
                         <th width="10%" class="text-center">Delete</th>
                         </tr>  
                         <?php  
                         while($row = mysqli_fetch_array($result))  
                         {  
                         ?>  
                         <tr>  
                              <td><?php echo $row["name"]; ?></td>  
                              <td class="text-center"><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info edit_data" /></td>  
                              <td class="text-center"><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-success view_data" /></td> 
                              <td class="text-center"><input type="button" name="delete" value="delete" id="<?php echo $row["id"]; ?>" class="btn btn-danger delete_data" /></td> 
                         </tr>  
                         <?php  
                         }  
                         ?>  
                    </table>  
               </div>  
          </div>  
     </div> 
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                <h4 class="modal-title">Employee Details</h4>  
              <button type="button" class="close" data-dismiss="modal">&times;</button>  
                 </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                       <h4 class="modal-title"></h4>  
                       <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Enter Employee Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Enter Employee Address</label>  
                          <textarea name="address" id="address" class="form-control"></textarea>  
                          <br />  
                          <br />  
                          <label>Enter Department</label>  
                          <input type="text" name="dept" id="dept" class="form-control" />  
                          <br />  
                          <label>Enter Salary</label>  
                          <input type="text" name="salary" id="salary" class="form-control" />  
                          <br />  
                          <input type="hidden" name="employee_id" id="employee_id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>     
<script>  
 $(document).ready(function() {
    $('#add').click(function() {
        $('#insert').val("Insert");
        $('#insert_form')[0].reset();
    });
    $(document).on('click', '.edit_data', function() {
        var employee_id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
                employee_id: employee_id
            },
            dataType: "json",
            success: function(data) {
                $('#name').val(data.name);
                $('#address').val(data.address);
                $('#dept').val(data.dept);
                $('#salary').val(data.salary);
                $('#employee_id').val(data.id);
                $('#insert').val("Update");
                $('#add_data_Modal').modal('show');
            }
        });
    });
    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#name').val() == "") {
            alert("Employee Name Required");
        } else if ($('#address').val() == '') {
            alert("Employee Address Required");
        } else if ($('#designation').val() == '') {
            alert("Employee Designation Required");
        } else if ($('#salary').val() == '') {
            alert("Employee Salary Required");
        } else {
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                beforeSend: function() {
                    $('#insert').val("Inserting");
                },
                success: function(data) {
                    $('#insert_form')[0].reset();
                    $('#add_data_Modal').modal('hide');
                    $('#employee_table').html(data);
                }
            });
        }
    });
    $(document).on('click', '.view_data', function() {
        var employee_id = $(this).attr("id");
        if (employee_id != '') {
            $.ajax({
                url: "select.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                success: function(data) {
                    $('#employee_detail').html(data);
                    $('#dataModal').modal('show');
                }
            });
        }
    });
    $(document).on('click', '.delete_data', function() {
        var id = $(this).attr("id");
        if(confirm("Are you sure you want to remove this?"))
   {
            $.ajax({
                url: "delete.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#employee_table').html(data);
                }
            });
        }
    });
});

 $(document).ready(function(){  
      load_data();  
      function load_data(page)  
      {  
           $.ajax({  
                url:"pagination.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                     $('#employee_table').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });  
 });  

 </script> 
</body>  
 </html>  