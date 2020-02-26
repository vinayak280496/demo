<?php
    include('fetch.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
    .bs-example{
      margin: 10px;
    }
</style>

</head>
<body>

<h2>Employee Details</h2>
<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <a href="#myModal" role="button" class="btn btn-sg btn-primary" data-toggle="modal">Add New</a>

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="field name">
            <label class="label" for="name"><span>Name</span></label>
            <div class="control">
                <input name="name" id="name" title="name" value="" class="input-text" type="text">
            </div>
        </div>
        <div class="field address">
            <label class="label" for="address"><span>Address</span></label>
            <div class="control">
                <input name="address" id="address" title="address" value="" class="input-text" type="text">
            </div>
        </div>
        <div class="field dept">
            <label class="label" for="dept"><span>Department</span></label>
            <div class="control">
                <input name="dept" id="dept" title="dept" value="" class="input-text" type="text">
            </div>
        </div>
        <div class="field salary">
            <label class="label" for="salary"><span>Salary</span></label>
            <div class="control">
                <input name="salary" id="salary" title="salary" value="" class="input-text" type="text">
            </div>
        </div>
                </div>
                <div class="modal-footer">
                    <input type="button" name="save" class="btn btn-primary" value="ADD" id="butsave">
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Address</th>
    <th>Department</th>
    <th>Salary</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  <?php                                                         
        $query=mysqli_query($conn,"select * from new");                                                        
        while($row=mysqli_fetch_array($query))
        {
    ?>
    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['address'] ?></td>        
        <td><?php echo $row['dept'] ?></td>        
        <td><?php echo $row['salary'] ?></td>  
        <td>
          <a href="#myMoal" role="button" class="btn btn-sg btn-success" id="btn_edi" data-toggle="modal">Edit</a>        
        </td>      
        <td>
        <input type="button" name="Delete" class="btn btn-danger" value="Delete" id="btn_delete">
        </td>
    </tr>    

    <?php
        }
    ?>
</table>

<script>
  $(document).on('click', '#butsave', function(e){  
     e.preventDefault();
    var name = $('#name').text();
    var address = $('#address').text();
    var dept = $('#dept').text();
    var salary = $('#salary').text();
    if(name!="" && address!="" && dept!="" && salary!=""){
      $.ajax({
        url: "save.php",
        type: "POST",
        data: {
          name: name,
          address: address,
          dept: dept,
          salary: salary        
        },
        dataType:"text",
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            $("#butsave").removeAttr("disabled");
            $('#fupForm').find('input:text').val('');
            $("#success").show();
            $('#success').html('Data added successfully !');            
          }
          else if(dataResult.statusCode==201){
             alert("Error occured !");
          }
          
        }
      });
    }
    else{
      alert('error');
    }
  });
  $(document).on('click', '#btn_edit', function(){  
           function edit_data(name, address, dept, salary)  
      {  
           $.ajax({  
                url:"edit.php",  
                method:"POST",  
                data:{name:name, address:address, dept:dept, salary:salary},  
                dataType:"text",  
                success:function(data){  
                     alert(data);  
                }  
           });  
      }  
      });  

  $(document).on('click', '#btn_delete', function(){  
           var id=$(this).data("id3");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:{id:id},    
                     success:function(data){ 
                         if(data=="YES"){
                        $ele.fadeOut().remove();
                        }else{
                            alert("can't delete the row")
                            }
                     }  
                });  
           }else{
            alert("error");
           }  
      });  
</script>
</body>
</html>