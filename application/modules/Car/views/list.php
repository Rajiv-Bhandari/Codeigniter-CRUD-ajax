<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Model List</title>
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
        <div class="text-center">
        <a href="javascript:void(0);" onClick="showModal();" class="btn btn-warning" style="margin-top:-80px; margin-left:1000px;">Create</a>
        </div>
        <hr>
        <div class="col-md-12 pt-3">
            <table class="table table-striped" id="carModelList">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Transmission</th>
                    <th>Price (Rs.)</th>
                    <th>Created Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php if(!empty($rows)) {?>
                    <?php foreach($rows as $row) {
                    $data['row'] = $row;
                    $this->load->view('car/car_row',$data);
                }
                ?>
                <?php } else { ?>
                <tr>
                    <td colspan="5">No Records Available</td>
                </tr>
                <?php } ?>
            </table>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteNow();" id="confirmDeleteBtn">Delete</button>
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
    // createCarModel
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
                    
                    $('#createCar').modal('hide');

                    $('#carModelList').append(response["row"]);
                }
            }
        });
    });

    function showEditForm(id)
    {
        $("#createCar .modal-title").html('Edit');
        $.ajax({
            url: '<?php echo base_url().'index.php/car/getCarModel/'?>' + id,
            type: 'POST',
            dataType: 'json',
            success : function(response)
            {
                $("#createCar #response").html(response["html"]);
                $("#createCar").modal("show");
            }
        });
    }

    // editCarModel
    $("body").on("submit", "#editCarModel", function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url().'index.php/car/updateModel'?>',
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

                    var id = response['row']['id'];
                    $("#row-"+id+" .modelName").html(response['row']['name']);
                    $("#row-"+id+" .modelColor").html(response['row']['color']);
                    $("#row-"+id+" .modelTransmission").html(response['row']['transmission']);
                    $("#row-"+id+" .modelPrice").html(response['row']['price']);

                    $('#createCar').modal('hide');                   
                }
            }
        });
    });

    function confirmDeleteModel(id)
    {
        $("#deleteModal").modal('show');
        $("#deleteModal .modal-body").html("Are you sure you want to delete #"+id+" ?");
        $("#deleteModal").data("id",id);
    }

    function deleteNow()
    {
        var id = $("#deleteModal").data('id');
        $.ajax({
            url: '<?php echo base_url().'index.php/car/deleteModel/'?>'+id,
            type: 'POST',
            dataType: 'json',
            success : function(response)
            {
                if(response['status'] == 1)
                {
                    $("#deleteModal").modal('hide');
                    reloadCarModelList(); 
                }   
                else{
                    $("#deleteModal").modal('hide');
                    alert(response['msg']);
                }
            }
        });     
    }

    function reloadCarModelList() {
        $('#carModelList').load('<?php echo base_url().'index.php/car/index #carModelList'?>');
    }

</script>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
