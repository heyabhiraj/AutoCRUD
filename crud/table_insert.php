<?php
if(isset($_REQUEST['tablename']))
    $tableName = $_REQUEST['tablename'];
else
    die("dead");

include("config.php");
include("table_functions.php");

/* Fetching all attribute names from 
$columnNames = getColumnNames($tableName);  
$columnNames = filterColumns($columnNames);

$where = "";
$row = getRecords($tableName,$where)

?>

