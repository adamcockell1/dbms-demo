<?php
include("./connectdb.php");

/* Function for adding a customer to the database */
function addCustomer($conn) {
    /* Check that form values exist and format them according to data type */
    if (isset($_POST["email"], $_POST["firstName"], $_POST["lastName"], $_POST["phone"],
            $_POST["city"], $_POST["postalCode"], $_POST["address"])) {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $firstName = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
        $lastName = filter_var($_POST["lastName"], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST["phone"], FILTER_SANITIZE_NUMBER_INT);
        $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
        $postalCode = filter_var($_POST["postalCode"], FILTER_SANITIZE_STRING);
        $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
        /* Attempt to insert given values into customer table */
        try {
            $query = $conn -> query("INSERT INTO customer VALUES
                ('$email', '$firstName', '$lastName', '$phone', '$city',
                '$postalCode', '$address', 5.00)");
        } catch (PDOException $err) {
            print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        /* Load the page which made the POST request */
        header("location:./managecustomers.php");
    } else {
        print "Error: Add customer not successful".var_dump($_POST)."<br>".
            "<a href='../restaurant.html'>Main Page</a>";
        exit();
    }
}

/* Function for removing a customer from the database */
function rmvCustomer($conn) {
    /* Check that form values exist and format them according to data type */
    if (isset($_POST["email"])) {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        /* Attempt to remove given customer from employee table */
        try {
            $query = $conn -> query("DELETE FROM customer WHERE email = '$email'");
        } catch (PDOException $err) {
            print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        /* Load the page which made the POST request */
        header("location:./managecustomers.php");
    } else {
        print "Error: Remove customer not successful".var_dump($_POST)."<br>".
            "<a href='../restaurant.html'>Main Page</a>";
        exit();
    }
}

/* Function for adding an employee to the database */
function addEmployee($conn) {
    /* Check that form values exist and format them according to data type */
    if (isset($_POST["id"], $_POST["email"], $_POST["firstName"],
            $_POST["lastName"], $_POST["restaurantName"])) {
        $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $firstName = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
        $lastName = filter_var($_POST["lastName"], FILTER_SANITIZE_STRING);
        $restaurantName = filter_var($_POST["restaurantName"], FILTER_SANITIZE_STRING);
        /* Attempt to insert given values into employee table */
        try {
            $query = $conn -> query("INSERT INTO employee VALUES
                ('$id', '$email', '$firstName', '$lastName', '$restaurantName')");
        } catch (PDOException $err) {
            print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        /* Load the page which made the POST request */
        header("location:./manageemployees.php");
    } else {
        print "Error: Add employee not successful".var_dump($_POST)."<br>".
            "<a href='../restaurant.html'>Main Page</a>";
        exit();
    }
}

/* Function for removing an employee from the database */
function rmvEmployee($conn) {
    /* Check that form values exist and format them according to data type */
    if (isset($_POST["id"])) {
        $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        /* Attempt to remove given employee from employee table */
        try {
            $query = $conn -> query("DELETE FROM employee WHERE id = '$id'");
        } catch (PDOException $err) {
            print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        /* Load the page which made the POST request */
        header("location:./manageemployees.php");
    } else {
        print "Error: Remove employee not successful".var_dump($_POST)."<br>".
            "<a href='../restaurant.html'>Main Page</a>";
        exit();
    }
}

/* Function for viewing an employee schedule */
function viewSchedule($conn) {
    /* Check that form values exist and format them according to data type */
    if (isset($_POST["id"])) {
        $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        /* Attempt to retrieve employee schedule for given employee id */
        try {
            $query = $conn -> query("SELECT DISTINCT * FROM shift
                WHERE employeeId = '$id'");
        } catch (PDOException $err) {
            print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        /* Load the page which made the POST request */
        header("location:./schedule.php");
    } else {
        print "Error: View schedule not successful".var_dump($_POST)."<br>".
            "<a href='../restaurant.html'>Main Page</a>";
        exit();
    }
}

/* Function for viewing all orders on a given day */
function ordersOnDay($conn) {
    /* Check that form values exist and format them according to data type */
    if (isset($_POST["date"])) {
        $date = filter_var($_POST["date"], FILTER_SANITIZE_NUMBER_INT);
        /* Attempt to retrieve orders made on a given date */
        try {
            $query = $conn -> query("SELECT * FROM orderinfo
                WHERE date = '$date'");
        } catch (PDOException $err) {
            print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        /* Load the page which made the POST request */
        header("location:./orderinfo.php");
    } else {
        print "Error: View orders on date not successful".var_dump($_POST)."<br>".
            "<a href='../restaurant.html'>Main Page</a>";
        exit();
    }
}

/* Function for viewing all orders on a given day */
function numOrders($conn) {
    /* Check that form values exist and format them according to data type */
    if (isset($_POST["date"])) {
        $date = filter_var($_POST["date"], FILTER_SANITIZE_NUMBER_INT);
        /* Attempt to retrieve orders made on a given date */
        try {
            $query = $conn -> query("SELECT DISTINCT * FROM shift
                WHERE employeeId = '$id'");
        } catch (PDOException $err) {
            print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        /* Load the page which made the POST request */
        header("location:./orderinfo.php");
    } else {
        print "Error: View orders per day not successful".var_dump($_POST)."<br>".
            "<a href='../restaurant.html'>Main Page</a>";
        exit();
    }
}

/* Switch/case for different methods from different form submit buttons */
switch($_POST["formButton"]) {

    /* Case 1 */
    case "addCustomer":
        addCustomer($conn);
        break;

    /* Case 2 */
    case "rmvCustomer":
        rmvCustomer($conn);
        break;

    /* Case 3 */
    case "addEmployee":
        addEmployee($conn);
        break;

    /* Case 4 */
    case "rmvEmployee":
        rmvEmployee($conn);
        break;

    /* Case 5 */
    case "viewSchedule":
        viewSchedule($conn);
        break;

    /* Case 6 */
    case "ordersOnDay":
        numOrders($conn);
        break;

    /* Case 7 */
    case "numOrders":
        numOrders($conn);
        break;

    /* Return to main page if no case is matched */
    default:
        header("location:../restaurant.html");
}
?>
