<?php

$record = [];
if(!isset($_REQUEST['tablename'])){
    die("dead");
}


    $tableName = $_REQUEST['tablename'];
    $pageName = $_REQUEST['pagename'];
    $fields = [];
    
    include("config.php");
    include("table_functions.php");
    include("table_alias.php");  

    $columnNames = getFilteredColumns($tableName);
    $columnRenames = renameColumns($columnNames);

    switch($pageName){
        case 'Add':
            saveRecord($tableName,$columnNames);
            
            echo "<script>
            alert('Record Inserted.');
            window.location.href='table_insert.php?tablename=$tableName';
            </script>";
            

        break;
        case 'Edit':

        break;
    } 
    
    









// header("Location: table_insert.php");
























/* For reference */
/**
    *
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $address = $_POST['Address'];
    $gender = $_POST['Gender'];
    $dob = $_POST['DOB'];
    $blood_group = $_POST['blood_group'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp,"images/$image");
        
    
    */
?>