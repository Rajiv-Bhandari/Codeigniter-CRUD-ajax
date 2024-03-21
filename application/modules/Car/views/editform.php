<form id="editCarModel" method="post" name="editCarModel">
    <input type="hidden" name="id" value="<?php echo $row['id']?>">
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" value="<?php echo $row['name']?>" name="name" placeholder="Enter Car Name">
            <p class="nameError"></p>
        </div>
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" class="form-control" id="color" value="<?php echo $row['color']?>" name="color" placeholder="Enter Car Color">
            <p class="colorError"></p>
        </div>
        <div class="form-group">
            <label for="transmission">Transmission:</label>
            <select class="form-control" id="transmission" name="transmission">
                <option value="Automatic" <?php echo ($row['transmission'] == "Automatic") ? 'selected' : ''?>>Automatic</option>
                <option value="Manual" <?php echo ($row['transmission'] == "Manual") ? 'selected' : ''?>>Manual</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" value="<?php echo $row['price']?>" id="price" name="price" placeholder="Enter Car Price">
            <p class="priceError"></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>