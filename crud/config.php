<?php
$conn;
/************ DATABASE FUNCTIONS **************/
function connectToDB(){
    global $conn;
    $servername = "localhost";
    $username = "root";
    $password = "TPPkWL]fCQRdmY]r";
    $dbname = "canteen_ordering_system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function closeDB(){
    global $conn;
    $conn->close();
}

function getTables(){
    global $conn;
    $sql = "SHOW TABLES";
    $result = $conn->query($sql) or die("Query failed");

    $tables = [];
    while ($row = $result->fetch_assoc()){
        $tables[] = $row['Tables_in_canteen_ordering_system'];
    }
    return $tables;
}


connectToDB();

$tables = getTables();

?>