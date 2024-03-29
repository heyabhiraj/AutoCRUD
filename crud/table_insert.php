<?php
if(isset($_REQUEST['tablename']))
    $tableName = $_REQUEST['tablename'];
else
    die("Table Not Found");

include("config.php");
include("table_alias.php");
include("table_functions.php");

$form = new Form();

$columnNames = getFilteredColumns($tableName);

//
$required =  isRequired($tableName,$columnNames[0]);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add <?php echo $tableAliases[$tableName];?></title>
    <!-- <link rel="stylesheet" href="style.scss"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style></style>
</head>
<body>
<div class="flex h-screen justify-center items-center ml-20">
<div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-5 overflow-hidden">
    <form action="table_save.php" method="post">

        <input type="hidden" name="pagename" value="Add">
        <input type="hidden" name="tablename" value="<?php echo $tableName ?>">
        
        <h1 class="text-4xl font-bold border-b text-yellow-600">
           <?php echo "Add ". $tableAliases[$tableName] ?> </h1>


        <?php
        $value = "";
        foreach($columnNames as $column){
            
            //skip id column
            if(isHidden($column))
            continue;
            
            $form->createLabel($column,$columnAliases[$column]);
            
            $form->createInput($tableName,$column,$value);
            echo "<br>";
        }
        ?>
    <input class="bg-black rounded p-3 text-white mt-5" type="submit" value="Insert">
    </form>
    


<?php



?>