<?php 
include("config.php");
include("table_functions.php");


//

// Start
   

    include("table_alias.php");

    $columnNames = getColumnNames($tableName);  //columnNames is a 1D array of all the names of attributes

    // showColumnNames($columnNames);

    $row = [];
    $where = "";
    $row= getRecords($tableName,$where);     //
     
    $columnNames = filterColumns($columnNames);
    $columnRenames = renameColumns($columnNames);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Table</title>
</head>
<body>
    <table border="1" width = 100>
        <thead>
            <?php  foreach($columnRenames as $col){    ?>
            <th> <?php 
                echo $col; } ?>    </th>
            <th colspan="2">Options</th>
        </thead>

        <?php for($n=0; $n<count($row);$n++){   ?>
        <tr>
            <?php for($i=0;$i<count($columnNames);$i++){    ?>
            <td>  <?php echo $row[$n][$columnNames[$i]];    ?>   </td>
            <?php }?>   
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        <?php }?>
        
    </table>
</body>
</html>
