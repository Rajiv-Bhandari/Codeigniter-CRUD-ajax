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
            <a href="#" class="navbar-brand">EMPLOYEE MANAGEMENT SYSTEM</a>
        </div>
    </div>
    <div class="container mt-5">
        <h2>Employee List:</h2>
        <!-- <a href="<?php echo base_url().'index.php/admin/create'?>" class="btn btn-info" style="margin-top:-80px; margin-left:900px;">Create</a> -->
        <div class="text-center">
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalRegisterForm" style="margin-top:-80px; margin-left:1000px;">Create</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12" id="user-list">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Address</th>
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

<!--create modal -->
<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title w-100 font-weight-bold text-center">Create Employee</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Employee Creation Form -->
                <form id="create-form" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Load user list using AJAX
        $('#user-list').load('<?php echo base_url(); ?>index.php/admin/index #user-list');
    });
</script>

<script>
    $(document).ready(function() {
        // Submit form using AJAX
        $('#create-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/admin/create',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    // Reset form
                    $('#create-form')[0].reset();
                    // Check if response status is success
                    if (response.status === 'success') {
                        // Close the modal
                        $('#modalRegisterForm').modal('hide');
                        $('#user-list').load('<?php echo base_url(); ?>index.php/admin/index #user-list');
                    } else {
                        // Handle error case
                        console.error(response.message);
                        $('#user-list').load('<?php echo base_url(); ?>index.php/admin/index #user-list');
                    }
                },
                error: function(xhr, status, error) {
                    // Log error and close modal
                    console.error(xhr.responseText);
                    $('#create-form')[0].reset();
                    $('#modalRegisterForm').modal('hide');
                    $('#user-list').load('<?php echo base_url(); ?>index.php/admin/index #user-list');
                }
            });
        });
    });
</script>

<!-- Edit modal -->
<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title w-100 font-weight-bold text-center">Edit Employee</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Employee Edit Form -->
                <form id="edit-form" method="post" action="<?php echo base_url(); ?>index.php/admin/update">
                    <input type="hidden" id="edit-user-id" name="user_id">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="modalDeleteForm" tabindex="-1" role="dialog" aria-labelledby="modalDeleteFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeleteFormLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this item?
      </div>
      <div class="modal-footer">
        <form id="delete-form" method="post">
            <input type="hidden" id="delete-user-id" name="user_id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var userId = $(this).data('userid');
            $('#delete-user-id').val(userId);
        });

        // Submit form using AJAX
        $('#delete-form').submit(function(e) {
            e.preventDefault();
            var userId = $('#delete-user-id').val(); // Retrieve user ID from input field
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/admin/delete/' + userId, // Correct AJAX URL
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    // Check if response status is success
                    if (response.status === 'success') {
                        // Close the modal
                        $('#modalDeleteForm').modal('hide');
                        $('#user-list').load('<?php echo base_url(); ?>index.php/admin/index #user-list');
                    } else {
                        // Handle error case
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Log error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<button class="btn btn-dark" style="margin-left:600px;" id="jButton">One</button>
<button class="btn btn-secondary" id="jButtontwo">Two</button>

<script>
    // Using jQuery's document ready function to ensure the DOM is fully loaded
    $(document).ready(function() {
        // Using jQuery to attach event handler using on() method
        $("#jButton").on("click", function() {
            alert("This is using jQuery's on() method.");
        });

        // Using jQuery to attach event handler using click() method
        $("#jButtontwo").click(function() {
            alert("This is using jQuery's click() method.");
        });
    });
</script>

<!-- Search input field -->
<input type="text" id="searchInput" placeholder="Search">

<!-- Div to display search results -->
<div id="searchResults"></div>

<script>
    // Predefined set of values
    var defaultValues = ["Apple", "Banana", "Orange", "Mango", "Grapes", "Pineapple", "Kiwi", "Strawberry", "Peach", "Watermelon","Pomogranate"];

    // Display default values when the page loads
    displaySearchResults(defaultValues);

    // Using jQuery's document ready function to ensure the DOM is fully loaded
    $(document).ready(function() {
        // Attach keyup event handler to the search input field
        $("#searchInput").on("keyup", function() {
            // Get the value entered in the search input field
            var searchTerm = $(this).val().toLowerCase();

            // Filter default values based on the search term
            var filteredValues = defaultValues.filter(function(value) {
                return value.toLowerCase().includes(searchTerm);
            });

            // Display filtered results
            displaySearchResults(filteredValues);
        });
    });

    // Function to display search results
    function displaySearchResults(results) {
        // Clear previous results
        $("#searchResults").empty();

        // If there are no results, display a message
        if (results.length === 0) {
            $("#searchResults").text("No results found.");
            return;
        }

        // Display each result in a list
        var listItems = results.map(function(result) {
            return "<li>" + result + "</li>";
        });

        // Append the list items to the search results div
        $("#searchResults").append("<ul>" + listItems.join("") + "</ul>");
    }
</script>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
