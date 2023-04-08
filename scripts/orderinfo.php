<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../style.css">
        <title>Restaurant Database Management Website</title>
    </head>
    <body>
        <?php include './connectdb.php'; ?>
        <div>
            <img src="../logo.png" alt="Restaurant Logo">
        </div>
        <h1>Order Info Page</h1>
        <hr>
        <h2>Navigation</h2>
        <div>
            <a href="./managecustomers.php">
                <button type="button">Manage Customers</button>
            </a>
            <a href="./manageemployees.php">
                <button type="button">Manage Employees</button>
            </a>
            <a href="./schedule.php">
                <button type="button">View Employee Schedule</button>
            </a>
            <a href="../restaurant.html">
                <button type="button">Main Page</button>
            </a>
        </div>
        <?php
            $conn = NULL;
        ?>
    </body>
</html>
