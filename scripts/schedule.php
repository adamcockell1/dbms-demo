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
        <h1>Employee Schedule Page</h1>
        <hr style="margin-bottom: 20px">
        <form action="./accessdb.php" method="post">
            <div class="formdiv">
                <label for="employeeName">Employee:</label>
                <select type="option" name="id" id="employeeName">
                    <?php
                        $result = $conn -> query("SELECT DISTINCT * FROM employee");
                        while ($row = $result -> fetch()) {
                            echo '<option>'.$row['firstName'].' '.$row['lastName'].
                                ' ('.$row['id'].')</option>';
                        }
                        $id = filter_var($_POST["employeeName"], FILTER_SANITIZE_NUMBER_INT);
                    ?>
                </select>
            </div>
            <div>
                <button type="submit" name="formButton" value="viewSchedule"
                    class="btn-add">View Schedule</button>
            </div>
        </form>
        <div>
            <table>
                <tr>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                </tr>
                <?php
                    $result = $conn -> query("SELECT DISTINCT * FROM shift
                        WHERE employeeId = '$id'");
                        echo $id;
                    while ($row = $result -> fetch()) {
                        echo '<tr>
                                <td>'.$row['day'].'</td>
                                <td>'.$row['day'].'</td>
                                <td>'.$row['day'].'</td>
                                <td>'.$row['day'].'</td>
                                <td>'.$row['day'].'</td>
                            </tr>';
                    }
                ?>
            </table>
        </div>
        <hr>
        <h2>Navigation</h2>
        <div>
            <a href="./managecustomers.php">
                <button type="button">Manage Customers</button>
            </a>
            <a href="./manageemployees.php">
                <button type="button">Manage Employees</button>
            </a>
            <a href="../restaurant.html">
                <button type="button">Main Page</button>
            </a>
            <a href="./orderinfo.php">
                <button type="button">View Order Information</button>
            </a>
        </div>
        <?php
            $conn = NULL;
        ?>
    </body>
</html>
