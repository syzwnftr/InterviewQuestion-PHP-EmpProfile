<?php
$name = $phone = $email = $address = '';

$errors = [
    'name_p' => '',
    'birth_date' => '',
    'phone' => '',
    'gender' => '',
    'email' => '',
    'address' => '',
    'nationality' => '',
    'hired_date' => '',
];

if (isset($_POST['submit'])) {
    // check name
    if (empty($_POST['name_p'])) {
        $errors['name_p'] = 'Name is required';
    } else {
        $name = $_POST['name_p'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name_p'] = 'Name must be letters and spaces only';
        }
    }

    // check gender
    if (empty($_POST['gender'])) {
        $errors['gender'] =  'Gender is required';
    } else {
        $gender = $_POST['gender'];
        // echo htmlspecialchars($_POST['gender']);
    }

    // check birth_date
    if (empty($_POST['birth_date'])) {
        $errors['birth_date'] = 'Date of birth is required';
    } else {
        // echo htmlspecialchars($_POST['birth_date']);
        $birth_date = $_POST['birth_date'];
    }

    // check phone
    if (empty($_POST['phone'])) {
        $errors['phone'] = 'Phone no is required';
    } else {
        $phone = $_POST['phone'];
        if (!preg_match('/^(\+?6?01)[0-46-9]-*[0-9]{7,8}$/', $phone)) {
            $errors['phone'] = 'Phone number must be a valid phone number';
        }
    }

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // check address
    if (empty($_POST['address'])) {
        $errors['address'] = 'Address is required';
    } else {
        $address = $_POST['address'];
        // echo htmlspecialchars($_POST['address']);
    }

    // check status
    if (empty($_POST['status'])) {
        echo 'Status is required';
    } else {
        $status = $_POST['status'];
        // echo htmlspecialchars($_POST['status']);
    }


    // check nationality
    if (empty($_POST['nationality'])) {
        echo 'Nationality is required';
    } else {
        $nationality = $_POST['nationality'];
        // echo htmlspecialchars($_POST['nationality']);
    }

    // check hired_date
    if (empty($_POST['hired_date'])) {
        $errors['hired_date'] = 'Hired date is required';
    } else {
        $hired_date = $_POST['hired_date'];
        // $errors['hired_date'] = htmlspecialchars($_POST['hired_date']);
    }

    // check department
    if (empty($_POST['department'])) {
        echo 'department is required';
    } else {
        $dept = $_POST['department'];
        // echo htmlspecialchars($_POST['department']);
    }

    // check if $errors is empty
    if (array_filter($errors)) {
    } else {
        $user_data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'address' => $address,
            'hired_date' => $hired_date,
            'birth_date' => $birth_date,
            'status' => $status,
            'department' => $dept,
            'nationality' => $nationality
        );

        if (filesize('employee.json') == 0) {
            // if this is a first record in json
            $first_record = array($user_data);

            $data_to_save = $first_record;
        } else {
            $old_records = json_decode(file_get_contents('employee.json'));

            array_push($old_records, $user_data);

            $data_to_save = $old_records;
        }

        if (!file_put_contents('employee.json', json_encode($data_to_save, JSON_PRETTY_PRINT), LOCK_EX)) {
            $err = 'Error in storing data';
        } else {
            $succ = 'Data stored successfully';
        }

        header('Location: employee_list.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<div class="form-wrapper">
    <h2>Add New Employee</h2>
    <form action="index.php" method="POST">
        <div class="wrapper">
            <label>Employee Name</label>
            <input type="text" name="name_p" value="<?php echo htmlspecialchars($name); ?>">
            <div class="red-text">
                <?php echo $errors['name_p']; ?>
            </div>
        </div>

        <div class="wrapper wrapper-flex">
            <div class="wrapper-select">
                <label>Gender</label>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="wrapper-select">
                <label>Date of Birth</label>
                <input type="date" name="birth_date" value="<?php echo $birth_date; ?>">
                <div class="red-text">
                    <?php echo $errors['birth_date']; ?>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-flex">
            <div class="wrapper-select">
                <label>Phone No</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                <div class="red-text">
                    <?php echo $errors['phone']; ?>
                </div>
            </div>
            <div class="wrapper-select">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <div class="red-text">
                    <?php echo $errors['email']; ?>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <label>Address</label>
            <textarea name="address" rows="4" cols="50"><?php echo htmlspecialchars($address); ?></textarea>
            <div class="red-text">
                <?php echo $errors['address']; ?>
            </div>
        </div>


        <div class="wrapper wrapper-flex">
            <div class="wrapper-select">
                <label>Marital Status</label>
                <select name="status">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                </select>
            </div>
            <div class="wrapper-select">
                <label>Nationality</label>
                <select id="nationality" name="nationality">
                    <!-- <option value="Malaysia">Malaysia</option>
                    <option value="China">China</option> -->
                </select>
            </div>
        </div>

        <div class="wrapper wrapper-flex">
            <div class="wrapper-select">
                <label>Hired Date</label>
                <input type="date" name="hired_date" value="<?php echo $hired_date; ?>">
                <div class="red-text">
                    <?php echo $errors['hired_date']; ?>
                </div>
            </div>
            <div class="wrapper-select">
                <label>Department</label>
                <select name="department">
                    <option value="Asset Management">Asset Management</option>
                    <option value="Business Development">Business Development</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Finance / Accounting">Finance / Accounting</option>
                    <option value="Human Resource">Human Resource</option>
                    <option value="IT">IT</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Production">Production</option>
                    <option value="Sales">Sales</option>
                </select>
            </div>
        </div>

        <div class="wrapper wrapper-flex btn">
            <div class="wrapper-select btnwrapper">
                <input class="btnSubmit" type="submit" name="submit" value="Submit">
            </div>
        </div>
    </form>
</div>

</html>