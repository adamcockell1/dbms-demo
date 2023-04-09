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
        <h1>Customer Management Page</h1>
        <hr>
        <h2>Customers in database</h2>
            <div>
                <table>
                    <tr>
                        <th>Email Address</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th>Postal Code</th>
                        <th>Home Address</th>
                        <th>Credit</th>
                        <th>Remove From Database</th>
                    </tr>
                    <?php
                        $result = $conn -> query("SELECT DISTINCT * FROM customer");
                        while ($row = $result -> fetch()) {
                            $email = $row["email"];
                            $name = $row["firstName"].' '.$row["lastName"];
                            $phone = $row["phone"];
                            $city = $row["city"];
                            $postalCode = $row["postalCode"];
                            $address = $row["address"];
                            $credit = $row["credit"];
                            echo "<tr>";
                                echo "<td>".$email."</td>";
                                echo "<td>".$name."</td>";
                                echo "<td>".$phone."</td>";
                                echo "<td>".$city."</td>";
                                echo "<td>".$postalCode."</td>";
                                echo "<td>".$address."</td>";
                                echo "<td>".$credit."</td>";
                                echo "<form action='./accessdb.php' method='POST'>";
                                echo "<td>"."<input type='hidden' name='email' value=".$email.">";
                                echo "<button type='submit' name='formButton' value='rmvCustomer'
                                    class='btn-rmv'>Remove Customer</button></form>"."</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </form>
        <hr style="margin-bottom: 20px">
        <h2>Add new customer</h2>
        <form action="./accessdb.php" method="POST">
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
                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" placeholder="1234567890" required>
            </div>
            <div class="formdiv">
                <label for="city">City:</label>
                <input type="text" name="city" placeholder="New York" required>
            </div>
            <div class="formdiv">
                <label for="postalCode">Postal Code:</label>
                <input type="text" name="postalCode" placeholder="10001" required>
            </div>
            <div class="formdiv">
                <label for="address">Home Address:</label>
                <input type="text" name="address" placeholder="123 Example Street" required>
            </div>
            <div>
                <button type="submit" name="formButton" value="addCustomer"
                    class="btn-add">Add Customer</button>
            </div>
        </form>
        <hr style="margin-top: 20px">
        <h2>Navigation</h2>
        <div>
            <a href="../restaurant.html">
                <button type="button">Main Page</button>
            </a>
            <a href="./manageemployees.php">
                <button type="button">Manage Employees</button>
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
