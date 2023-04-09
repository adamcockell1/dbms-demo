<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../style.css">
        <title>Restaurant Database Management Website</title>
    </head>
    <body>
        <?php include "./connectdb.php"; ?>
        <div>
            <img src="../logo.png" alt="Restaurant Logo">
        </div>
        <h1>Order Information Page</h1>
        <hr style="margin-bottom: 20px">
        <form action="./accessdb.php" method="POST">
            <div class="formdiv">
                <label for="date">Search by Date:</label>
                <input type="date" name="date" required>
            </div>
            <div>
                <button type="submit" name="formButton" value="ordersOnDay" class="btn-add">
                    View Day</button>
            </div>
            <?php
                if (isset($_POST["date"])) {
                    $date = $_POST["date"];
                } else {
                    $date = null;
                }
            ?>
            <h2>Orders on <?php echo $date;?></h2>
            <div>
                <table>
                    <tr>
                        <th>Customer Name</th>
                        <th>Items Ordered</th>
                        <th>Total</th>
                        <th>Tip</th>
                        <th>Delivery Employee</th>
                    </tr>
                    <?php
                        $result = $conn -> query("SELECT * FROM customer
                        JOIN orderinfo ON (customer.email = orderinfo.customerEmail)
                        JOIN orderid ON (orderinfo.orderId = orderid.id)
                        JOIN contains ON (orderid.id = contains.orderId)
                        JOIN delivers ON (orderid.id = delivers.orderId)
                        JOIN employee ON (delivers.employeeId = employee.id)
                        WHERE orderinfo.date = '$date'");
                        while ($row = $result -> fetch()) {
                            $customerName = $row["customer.firstName"].
                                " ".$row["customer.lastName"];
                            $foodName = $row["foodName"];
                            $foodName = $row["total"];
                            $foodName = $row["tip"];
                            $employeeName = $row["employee.firstName"].
                                " ".$row["employee.lastName"];
                            echo "<tr>";
                                echo "<td>".$customerName."</td>";
                                echo "<td>".$foodName."</td>";
                                echo "<td>".$total."</td>";
                                echo "<td>".$tip."</td>";
                                echo "<td>".$employeeName."</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </form>
        <hr>
        <h2>Orders per day</h2>
        <div>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Number of Orders</th>
                </tr>
                <?php
                    $result = $conn -> query("SELECT date, COUNT(*) AS num
                        FROM orderinfo GROUP BY date");
                    while ($row = $result -> fetch()) {
                        echo "<tr>
                                <td>".$row["date"]."</td>
                                <td>".$row["num"]."</td>
                            </tr>";
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
