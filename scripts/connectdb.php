<?php
try {
    $conn = new PDO("mysql:host=localhost; dbname=restaurantdb", "root", "");
} catch (PDOException $err) {
    print "Error: ".$err -> getMessage()."<br/>";
    exit();
}
?>
