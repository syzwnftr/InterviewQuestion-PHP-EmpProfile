<?php
if (filesize('employee.json') == 0) {
    $employee_count = 0;
} else {
    $employee = json_decode(file_get_contents('employee.json'));
    $employee_count = count($employee);
}

?>

<head>
    <title>Employee Management System</title>
    <link rel="stylesheet" href="styles/style.css">

    <!-- use below to fix cache issue, css change doesn't reflect -->
    <!-- <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>"> -->
</head>

<body>
    <nav>
        <a href="index.php" class="mywave-link">
            <img src="./img/mywave.png" alt="Mywave logo">
        </a>
        <div class="tab-link">
            <div class="link-wrapper first">
                <a href="index.php" class="link create">Add New Employee</a>
            </div>
            <div class="link-wrapper">
                <a href="employee_list.php" target="_blank">Employee List <?php echo "($employee_count)"; ?></a>
            </div>
        </div>
    </nav>