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
        <form action="./schedule.php" method="POST">
            <div class="formdiv">
                <label for="id">Select Employee:</label>
                <select type="option" name="id" id="id">
                    <?php
                        $result = $conn -> query("SELECT DISTINCT * FROM employee");
                        while ($row = $result -> fetch()) {
                            echo '<option>'.$row['firstName'].' '.$row['lastName'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div>
                <button type="submit" name="formButton" value="viewSchedule"
                    class="btn-add">View Schedule</button>
            </div>
        </form>
        <?php
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
            } else {
                $id = 11;
                $firstName = 'Mary';
                $lastName = 'Nguyen';
            }
        ?>
        <h2>Schedule for <?php echo $firstName.' '.$lastName;?></h2>
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
                    while ($row = $result -> fetch()) {
                        echo '<tr>
                                <td>';
                                if ($row['day'] == 'Monday') {
                                    echo 'Start time: '.$row['startTime'].
                                    '<br><br>End time: '.$row['endTime'];
                                } else { echo 'No shift'; }
                                echo '</td>'.'<td>';
                                if ($row['day'] == 'Tuesday') {
                                    echo 'Start time: '.$row['startTime'].
                                    '<br><br>End time: '.$row['endTime'];
                                } else { echo 'No shift'; }
                                echo '</td>'.'<td>';
                                if ($row['day'] == 'Wednesday') {
                                    echo 'Start time: '.$row['startTime'].
                                    '<br><br>End time: '.$row['endTime'];
                                } else { echo 'No shift'; }
                                echo '</td>'.'<td>';
                                if ($row['day'] == 'Thursday') {
                                    echo 'Start time: '.$row['startTime'].
                                    '<br><br>End time: '.$row['endTime'];
                                } else { echo 'No shift'; }
                                echo '</td>'.'<td>';
                                if ($row['day'] == 'Friday') {
                                    echo 'Start time: '.$row['startTime'].
                                    '<br><br>End time: '.$row['endTime'];
                                } else { echo 'No shift'; }
                                echo '</td>'.
                            '</tr>';
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
