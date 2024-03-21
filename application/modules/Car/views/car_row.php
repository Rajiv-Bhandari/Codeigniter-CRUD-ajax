<tr id="row-<?php echo $row['id']?>">
    <td class="modelId"><?php echo $row['id']?></td>
    <td class="modelName"><?php echo $row['name']?></td>
    <td class="modelColor"><?php echo $row['color']?></td>
    <td class="modelTransmission"><?php echo $row['transmission']?></td>
    <td class="modelPrice"><?php echo $row['price']?></td>
    <td class="modelCreated_at"><?php echo $row['created_at']?></td>
    <td>
        <a href="javascript:void(0);" onClick="showEditForm(<?php echo $row['id']?>);" class="btn btn-success edit-btn" >Edit</a>
    </td>
    <td>
        <a href="javascript:void(0);" onClick="confirmDeleteModel(<?php echo $row['id']?>);" class="btn btn-danger delete-btn">Delete</a>
    </td>
</tr>