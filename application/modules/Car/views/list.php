<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">CAR MANAGEMENT SYSTEM</a>
        </div>
    </div>
    <div class="container mt-5">
        <h2>Car Model List:</h2>
        <!-- <a href="<?php echo base_url().'index.php/admin/create'?>" class="btn btn-info" style="margin-top:-80px; margin-left:900px;">Create</a> -->
        <div class="text-center">
        <a href="javascript:void(0);" onClick="showModal();" class="btn btn-warning" style="margin-top:-80px; margin-left:1000px;">Create</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12" id="user-list">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Transmission</th>
                        <th>Price</th>
                        <th>Created Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php if(!empty($employee)) { foreach($employee as $employ) {?>
                    <tr>
                        <td><?php echo $employ['id']?></td>
                        <td><?php echo $employ['name']?></td>
                        <td><?php echo $employ['email']?></td>
                        <td><?php echo $employ['dob']?></td>
                        <td><?php echo $employ['address']?></td>
                        <td>
                            <a href="#" class="btn btn-success edit-btn" 
                            data-toggle="modal" 
                            data-target="#modalEditForm">
                            Edit
                            </a>
                        </td>
                        <td>
                            <a href="" class="btn btn-danger delete-btn" data-userid="<?php echo $employ['id']; ?>" data-toggle="modal" data-target="#modalDeleteForm">Delete</a>
                        </td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="5">No Records Available</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Create Modal -->
<div class="modal fade" id="createCar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create New Car Model</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="response">

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    function showModal() {
        $('#createCar').modal('show');
    
        $.ajax({
            url: '<?php echo base_url().'index.php/car/showCreateForm'?>',
            type: 'POST',
            data: {},
            dataType: 'json',
            success : function(response)
            {
                $('#response').html(response["html"]);
            }
        })
    }

    $("body").on("submit", "#createCarModel", function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url().'index.php/car/saveModel'?>',
            type: 'POST',
            data: $(this).serializeArray(),
            dataType: 'json',
            success : function(response)
            {
                if(response['status'] == 0)
                {
                    if(response["name"] != "")
                    {
                        $(".nameError").html(response["name"]).addClass('invalid-feedback d-block');
                        $("#name").addClass('is-invalid');
                    }
                    else{
                        $(".nameError").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');
                    }
                    if(response["color"] != "")
                    {
                        $(".colorError").html(response["color"]).addClass('invalid-feedback d-block');
                        $("#color").addClass('is-invalid');
                    }
                    else{
                        $(".colorError").html("").removeClass('invalid-feedback d-block');
                        $("#color").removeClass('is-invalid');
                    }
                    if(response["price"] != "")
                    {
                        $(".priceError").html(response["price"]).addClass('invalid-feedback d-block');
                        $("#price").addClass('is-invalid');
                    }
                    else{
                        $(".priceError").html("").removeClass('invalid-feedback d-block');
                        $("#price").removeClass('is-invalid');
                    }
                }
                else
                {
                    $(".nameError").html("").removeClass('invalid-feedback d-block');
                    $("#name").removeClass('is-invalid');

                    $(".colorError").html("").removeClass('invalid-feedback d-block');
                    $("#color").removeClass('is-invalid');

                    $(".priceError").html("").removeClass('invalid-feedback d-block');
                    $("#price").removeClass('is-invalid');                    
                }
            }
        });
    });
</script>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
