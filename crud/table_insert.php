<?php
if(isset($_REQUEST['tablename']))
    $tableName = $_REQUEST['tablename'];
else
    die("dead");

include("config.php");
include("table_alias.php");
include("table_functions.php");



$columnNames = getFilteredColumns($tableName);

//
$required =  isRequired($tableName,$columnNames[0]);
              
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="stylesheet" href="style.scss">
    <style></style>
</head>
<body>
    
    <form action="table_save.php" method="get">

        <input type="hidden" name="pagename" value="Add">
        <input type="hidden" name="tablename" value="<?php echo $tableName ?>">
        
        <h1 style="text-align: center;margin-top: 20px;margin-bottom: 20px;font-size: 30px;color: #1a1a1a;font-weight: bold; letter-spacing: 2px;border-bottom: 1px solid;">
           <?php echo "Add ". $tableAliases[$tableName] ?> </h1>


        <?php
        $value = "";
        foreach($columnNames as $column){
            if(isHidden($column))
            continue;
            createLabel($column,$aliases[$column]);
            
            createInput($tableName,$column,$value);
            echo "<br>";
        }
        ?>
    <input type="submit" value="Insert">

    </form>
    


<?php



?>