<?php

?>

<!DOCTYPE html>
<html lang="en">


<?php include('./templates/header.php'); ?>

<h2 class="list-h2">List Of Employee</h2>
<div class="tb-container">
    <table>
        <!-- table header -->
        <tr>
            <th>Employee Name</th>
            <th>Gender</th>
            <th>Date Of Birth</th>
            <th>Phone No</th>
            <th>Email</th>
            <th>Address</th>
            <th>Marital Status</th>
            <th>Nationality</th>
            <th>Hired Date</th>
            <th>Department</th>
        </tr>

        <?php

        if (filesize('employee.json') != 0) {
            $json_data = file_get_contents('employee.json');

            $products = json_decode($json_data, true);
            if (count($products) != 0) {
                foreach ($products as $product) {
        ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['gender']; ?></td>
                        <td><?php echo $product['birth_date']; ?></td>
                        <td><?php echo $product['phone']; ?></td>
                        <td><?php echo $product['email']; ?></td>
                        <td><?php echo $product['address']; ?></td>
                        <td><?php echo $product['status']; ?></td>
                        <td><?php echo $product['nationality']; ?></td>
                        <td><?php echo $product['hired_date']; ?></td>
                        <td><?php echo $product['department']; ?></td>
                    </tr>
        <?php
                }
            }
        }
        ?>
    </table>
</div>

<?php include('./templates/footer.php'); ?>

</html>