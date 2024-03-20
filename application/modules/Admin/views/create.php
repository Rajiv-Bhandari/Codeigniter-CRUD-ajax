<!-- create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-dark bg-dark">    
        <div class="container">
            <a href="#" class="navbar-brand">EMPLOYEE MANAGEMENT SYSTEM</a>
        </div>
    </div>
    <div class="container mt-5">
        <h2>Create Employee:</h2>
        <hr>
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
            <a href="<?php echo base_url().'index.php/admin/index'?>" class="btn btn-dark">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
                        // Reset form and show success message
                        $('#create-form')[0].reset();
                        alert('Employee Record Added Successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred while adding employee record');
                    }
                });
            });
        });
    </script>
</body>
</html>
