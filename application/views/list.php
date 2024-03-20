<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">CRUD APPLICATION</a>
        </div>
    </div>
    <div class="container mt-5">
        <h2>User List:</h2>
        <a href="<?php echo base_url().'index.php/users/create'?>" class="btn btn-info" style="margin-top:-80px; margin-left:1000px;">Create</a>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php 
                $success = $this->session->userdata('success');
                if($success != "") {
                ?>
                    <div class="alert alert-success"><?php echo $success?></div>
                <?php
                    $this->session->unset_userdata('success');
                }
                ?>
                <?php 
                $error = $this->session->userdata('error');
                if($error != "") {
                    ?>
                    <div class="alert alert-danger"><?php echo $error?></div>
                    <?php
                        $this->session->unset_userdata('error');
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php if(!empty($users)) { foreach($users as $user) {?>
                    <tr>
                        <td><?php echo $user['user_id']?></td>
                        <td><?php echo $user['name']?></td>
                        <td><?php echo $user['email']?></td>
                        <td><a href="<?php echo base_url().'index.php/users/edit/'. $user['user_id']?>" class="btn btn-success">Edit</a></td>
                        <td><a href="<?php echo base_url().'index.php/users/delete/'. $user['user_id']?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <?php } } else { ?>
                       <tr>
                            <td colspan="5">Records Empty</td>
                       </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
