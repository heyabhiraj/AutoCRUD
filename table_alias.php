<?php
if(isset($_REQUEST['tablename'])){
    $tableName = $_REQUEST['tablename']    ;
    }
    else die("No table found");
$aliases = [];
switch($tableName){
    case 'item_category':
        $aliases = [
            'category_id' => 'Serial No.',
            'category_name' => 'Name',
            'status' => 'Status',
            'category_description' => 'Description',
            'category_image' => 'Image'
           ] ; 
      
        break;
        
    case 'item_list':
        $aliases = [
            'item_id' => 'Serial No.',
            'item_name' => 'Name',
            'item_price' => 'Price',
            'item_description' => 'Description',
            'item_status' => 'Status',
            'prep_time' => 'Time',
           ] ;  
        break;

    case 'item_schedule':

        break;
        
    default:
    break;
}

$where = "";

?>