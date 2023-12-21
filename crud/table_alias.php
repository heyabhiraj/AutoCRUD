<?php

$aliases = [];      // or storing aliases of the table fields
$where = "";        //for storing where clause of the query
switch($tableName){
    case 'item_category':
        $aliases = [
            'category_id' => 'Id',
            'category_name' => 'Name',
            'category_status' => 'Status',
            'category_description' => 'Description',
            'category_image' => 'Image'
           ] ; 
      
        break;
        
    case 'item_list':
        $aliases = [
            'item_id' => 'Id',
            'item_name' => 'Name',
            'item_price' => 'Price',
            'item_description' => 'Description',
            'item_status' => 'Status',
            'prep_time' => 'Preparation Time',
           ] ;  
        break;

    case 'item_schedule':
        $aliases = [
            'schedule_id' => 'Id',
            
        ];

        break;
        
    default:
    break;
}
/* Strings here */
    $order = "";        //for storing order by clause of the query
    $limit = "";        //for storing limit clause of the query
    $join = "";         //for storing join clause of the query
    $group = "";        //for storing group by clause of the query
    $having = "";       //for storing having clause of the query
    $select = "";       //for storing select clause of the query
    $from = "";         //for storing from clause of the query
    $groupBy = "";      //for storing group by clause of the query
    $having = "";       //for storing having clause of the query
    $orderBy = "";      //for storing order by clause of the query
    $limit = "";        //for storing limit clause of the query
    $join = "";         //for storing join clause of the query
    $group = "";        //for storing group by clause of the query
    $having = "";       //for storing having clause of the query
    $select = "";       //for storing select clause of the query
/**/

$dataTypes = array(
    'number ' => array(
        'INT',
        'TINYINT',
        'SMALLINT',
        'MEDIUMINT',
        'BIGINT'
    ),
    'number step = 0.01 ' => array(
        'DECIMAL',
        'FLOAT',
        'DOUBLE',
    ),
    'date ' => array(
        'DATE'
    ),
    'text ' => array(
        'CHAR',
        'VARCHAR',
        'TINYTEXT',
        'TEXT',
        'MEDIUMTEXT',
        'LONGTEXT',
    ),
    'enum' => array(
        'ENUM'
    ),
    'spatial ' => array(
        'GEOMETRY',
        'POINT',
        'LINESTRING',
        'POLYGON',
        'MULTIPOINT',
        'MULTILINESTRING',
        'MULTIPOLYGON',
        'GEOMETRYCOLLECTION'
    )
);

$forTextArea = array(
    'COMMENT',
    'FEEDBACK',
    'DESCRIPTION',
    'BIO',
    'ADDRESS',
    'LOCATION',
    'NOTES',
    'REVIEWS'
);

$toHide= array(
    'Id'
     
);




?>