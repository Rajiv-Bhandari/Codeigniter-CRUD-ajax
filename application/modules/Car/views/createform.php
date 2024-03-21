<form id="createCarModel" method="post" name="createCarModel">
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Car Name">
            <p class="nameError"></p>
        </div>
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" class="form-control" id="color" name="color" placeholder="Enter Car Color">
            <p class="colorError"></p>
        </div>
        <div class="form-group">
            <label for="transmission">Transmission:</label>
            <select class="form-control" id="transmission" name="transmission">
                <option value="Automatic">Automatic</option>
                <option value="Manual">Manual</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter Car Price">
            <p class="priceError"></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form>