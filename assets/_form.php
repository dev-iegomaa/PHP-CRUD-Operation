<label>Name: <input type="text" name="name" value="<?php echo isset($row) ? $row['name']  : '' ;?>"></label>
<label>Price: <input type="text" name="price" value="<?php echo isset($row) ? $row['price'] : '';  ?>"></label>
<label>Serial Number: <input type="text" name="serial_number" value="<?php echo isset($row) ? $row['serial_number'] : '';  ?>"></label>