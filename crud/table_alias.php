<?php

$aliases = [];      // for storing aliases of the table fields
$where = "";        //for storing where clause of the query

/**
 *  Alias to be displayed instead of columnNames
 */
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
            'category_id' => 'Category',
            'item_name' => 'Name',
            'item_price' => 'Price',
            'item_description' => 'Description',
            'item_status' => 'Status',
            'prep_time' => 'Preparation Time',
            'item_image' => 'Image',
           ] ;  
        break;

    case 'item_schedule':
        $aliases = [
            'schedule_id' => 'Id',
            
        ];
        $aliases[$columnName];
        break;
        
    default:
    break;
}

$tableAliases= [
    'item_category' => 'Food Category',
    'item_list' => 'Food Item',
    'item_schedule' => 'Serve Schedule',

];

$foreignKey=[];     // Store data of foreign keys like 'related_table' => 'primary_key'
// not final

switch($tableName){
    case 'item_list':
        $foreignKey = [
            'item_category' => 'category_id'
        ];
        break;
    case 'item_schedule':
        $foreignKey = [
            'item_list' => 'item_id'
        ];
        break;
    default:
    break;
}



$categoryColumnList = []; // Stores the relevant column name to be fetched using the foriegnkey
switch($tableName){
    case 'item_list':
        $categoryColumnList = [

            'item_category'=>'category_name'
                // Add more
        ];
        break;
    default:
    break;
}



/** 2-D array of all input types and their corresponding data type in MySQL
 * Key is the input type and value is the corresponding data type in MySQL
 * Example: $dataTypes['number step = 0.01 '] = array('DECIMAL', 'FLOAT', 'DOUBLE');
 * This means that if the user selects the data type 'number step = 0.01 ' in the form,
 * the corresponding data type in MySQL will be 'DECIMAL', 'FLOAT', or 'DOUBLE'.
 */
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

/** Field Names to create Text Area
 *  Check against aliases/columnRenames.
 *  If alias match any in the below array a function is defined to create a textArea 
 */
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

/**
 *  Check against aliases/columnRenames.
 */
$toHide= array(
    'Id'
     
);











/* Strings for sql clauses */
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

?>