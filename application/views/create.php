<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">CRUD APPLICATION</a>
        </div>
    </div>
    <div class="container mt-5">
        <h2>Create User:</h2>
        <hr>
            <form method="post" name="createUser" action="<?php echo base_url().'index.php/users/create';?>">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name');?>">
                    <?php echo form_error('name');?>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email');?>">
                    <?php echo form_error('email');?>
                </div>

                <button class="btn btn-success">Create</button>
                <a href="<?php echo base_url().'index.php/users/index'?>" class="btn btn-dark">Cancel</a>
            </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
