<?php
if(isset($_REQUEST['tablename']))
    $tableName = $_REQUEST['tablename'];
else die("Table Query Not Found");

if(isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
else  die("Record Query Not Found");

include("config.php");
include("table_alias.php");
include("table_functions.php");

$form = new Form();
$columnNames = getFilteredColumns($tableName);
$required =  isRequired($tableName,$columnNames[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update <?php echo $tableAliases[$tableName];?></title>
    <!-- <link rel="stylesheet" href="style.scss"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style></style>
</head>
<body>
<div class="flex h-screen justify-center items-center ml-20">
<div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-5 overflow-hidden">
    <form action="table_save.php" method="post">
        <input type="hidden" name="pagename" value="Edit">
        <input type="hidden" name="tablename" value="<?php echo $tableName ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        
        <h1 class="text-4xl font-extrabold border-b text-yellow-700"> 
           <?php echo "Edit ". $tableAliases[$tableName] ?> </h1>
        <?php
        $value = ""; $where = "";
        foreach($columnNames as $column){

            // detect which column will store the id
            if(isHidden($column)){
                $where = "$column = $id";

            }
            
            $form->createLabel($column,$columnAliases[$column]);
            
            $value = $form->getInputValues($tableName,$column,$where);
            
            $form->createInput($tableName,$column,$value);
            echo "<br>";
        }
        ?>   
    <input class="bg-black rounded p-3 text-white mt-5" type="submit" value="Update">
    </form>
</div>
</div>
</body>
<?php



?>