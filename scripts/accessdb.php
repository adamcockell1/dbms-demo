<?php
include("./connectdb.php");

/* Switch/case for different methods from different form submit buttons */
switch($_POST["formButton"]) {

    /* Case 1 */
    case "addEmployee":
        /* Method for adding an employee to the database */
        if (isset($_POST["id"], $_POST["email"], $_POST["firstName"],
                $_POST["lastName"], $_POST["restaurantName"])) {
            $id = $_POST["id"];
            $email = $_POST["email"];
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $restaurantName = $_POST["restaurantName"];
            try {
                $query = $conn -> query("INSERT INTO employee VALUES
                    ('$id', '$email', '$firstName', '$lastName', '$restaurantName')");
            } catch (PDOException $err) {
                print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
                exit();
            }
            header("location:./manageemployees.php");
        } else {
            print "Error: Add employee not successful"."<br/>".var_dump($_POST)."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        break;

    /* Case 2 */
    case "rmvEmployee":
        /* Method for removing an employee from the database */
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            try {
                $query = $conn -> query("DELETE FROM employee WHERE id = '$id'");
            } catch (PDOException $err) {
                print "Error: ".$err -> getMessage()."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
                exit();
            }
            header("location:./manageemployees.php");
        } else {
            print "Error: Remove employee not successful"."<br/>".var_dump($_POST)."<br/>".
                "<a href='../restaurant.html'>Main Page</a>";
            exit();
        }
        break;

    /* Default Case */
    default:
        /* Return to main page if no case is matched */
        header("location:../restaurant.html");
}
?>
