<?php
// Functions

/**
 * Get column names of a table.
 * 
 * @param string $tableName - The name of the table.
 * @return array - An array containing the column names.
 */
function getColumnNames($tableName){
    global $conn;

    // SQL query to get column information
    $sql = "DESC $tableName";
    
    // Execute the query
    $result = $conn->query($sql) or die("Query failed");

    $col = []; // An array to store the names

    // Fetch each row and store the column names
    for ($i = 0; $row = $result->fetch_assoc(); $i++){
        $col[$i] = $row['Field'];
    }
    
    // Return the array of column names
    return $col;
}

/**
 * Filter columns based on aliases.
 * 
 * @param array $columnNames - An array containing column names.
 * @return array - An array containing filtered column names.
 */
function filterColumns($columnNames){
    global $aliases;
    define("LEN", count($columnNames)); // to keep the length constant

    // Unset elements based on aliases
    for ($i = 0; $i < LEN; $i++){
        if (!isset($aliases[$columnNames[$i]]))
            unset($columnNames[$i]);
    }

    // Re-index the array and return
    $columnNames = array_values($columnNames);
    return $columnNames;
}

/**
 * Rename columns based on aliases.
 * 
 * @param array $columnNames - An array containing column names.
 * @return array - An array containing renamed column names.
 */
function renameColumns($columnNames){
    global $aliases;

    // Iterate through column names and rename based on aliases
    for ($i = 0; $i < count($columnNames); $i++){
        if (isset($aliases[$columnNames[$i]]))
            $columnNames[$i] = $aliases[$columnNames[$i]];
    }

    // Return the array of renamed column names
    return $columnNames;
}

/**
 * Display column names.
 * 
 * @param array $columnNames - An array containing column names.
 */
function showColumnNames($columnNames){
    foreach ($columnNames as $col){
        // Show the attribute names
        echo $col . "<br>";
    }
}

/**
 * Get records from a table based on a WHERE condition.
 * 
 * @param string $tableName - The name of the table.
 * @param string $where - The WHERE condition for the query.
 * @return array - An array containing the fetched records.
 */
function getRecords($tableName, $where){
    global $conn;

    // SQL query to select all records with a WHERE condition
    $sql = "SELECT * FROM $tableName $where";

    // Execute the query
    $result = $conn->query($sql);

    // Fetch all records as an associative array
    $row = $result->fetch_all(MYSQLI_ASSOC);

    // Return the array of records
    return $row;
}

// Close PHP tag
?>
