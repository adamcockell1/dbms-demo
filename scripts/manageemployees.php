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
        <h1>Employee Management Page</h1>
        <hr>
        <h2>Employees in database</h2>
        <div>
            <table>
                <tr>
                    <th>Employee ID</th>
                    <th>Email Address</th>
                    <th>Name</th>
                    <th>Restaurant</th>
                    <th>Remove from Database</th>
                </tr>
                <?php
                    $result = $conn -> query("SELECT DISTINCT * FROM employee");
                    while ($row = $result -> fetch()) {
                        $id = $row["id"];
                        $email = $row["email"];
                        $name = $row["firstName"].' '.$row["lastName"];
                        $restaurantName = $row["restaurantName"];
                        echo "<tr>";
                            echo "<td>".$id."</td>";
                            echo "<td>".$email."</td>";
                            echo "<td>".$name."</td>";
                            echo "<td>".$restaurantName."</td>";
                            echo "<form action='./accessdb.php' method='POST'>";
                            echo "<td>"."<input type='hidden' name='id' value=".$id.">";
                            echo "<button type='submit' name='formButton' value='rmvEmployee'
                                class='btn-rmv'>Remove Employee</button></form>"."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
        <hr style="margin-bottom: 20px">
        <h2>Add new employee</h2>
        <form action="./accessdb.php" method="POST">
            <div class="formdiv">
                <label for="id">Employee ID:</label>
                <input type="text" name="id" placeholder="12345678" required>
            </div>
            <div class="formdiv">
                <label for="email">Email:</label>
                <input type="text" name="email" placeholder="johndoe@example.com" required>
            </div>
            <div class="formdiv">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" placeholder="John" required>
            </div>
            <div class="formdiv">
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" placeholder="Doe" required>
            </div>
            <div class="formdiv">
                <label for="restaurantName">Restaurant:</label>
                <select type="option" name="restaurantName" id="restaurantName">
                    <?php
                        $result = $conn -> query("SELECT DISTINCT name FROM restaurant");
                        while ($row = $result -> fetch()) {
                            echo "<option>".$row["name"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div>
                <button type="submit" name="formButton" value="addEmployee"
                    class="btn-add">Add Employee</button>
            </div>
        </form>
        <hr style="margin-top: 20px">
        <h2>Navigation</h2>
        <div>
            <a href="./managecustomers.php">
                <button type="button">Manage Customers</button>
            </a>
            <a href="../restaurant.html">
                <button type="button">Main Page</button>
            </a>
            <a href="./schedule.php">
                <button type="button">View Employee Schedule</button>
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
