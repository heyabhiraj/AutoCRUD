<?php
// Functions



/************ DISPLAY FUNCTIONS **************/

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
    function getFilteredColumns($tableName){
        global $aliases;
        $columnNames= getColumnNames($tableName);
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
     * Rename columns based on aliases array.
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
/**/

/************ SAVE FUNCTIONS ***************/
function keyByValue($array, $value){
    foreach ($array as $key => $val){
        if ($val == $value)
            return $key;
    }
    return null;
}



function saveRecord($tableName,$columnNames){
    global $conn;
    foreach($columnNames as $column){
        if(isHidden($column))
        continue;

        if(isset($_REQUEST[$column]))                
        $record[$column] = $_REQUEST[$column];
        else 
        $record[$column] = "";
        
        array_push($fields,$column);
    }      
    $sql = "INSERT INTO $tableName(".implode(",",$fields).") 
    VALUES('".implode("','",$record)."')";
    
    echo $sql;
    $conn->query($sql) or die("Query failed");
}


/**/

/*********** INSERT/ UPDATE FUNCTIONS ***********/


function createInput($tableName, $columnName, $value){
    global $foreignKey;
    $check=setInputType($tableName,$columnName);
    if($check == "enum")
    return createSelection($tableName,$columnName,$value);
    $check= isTextArea($columnName);
    if($check == "text")
    return createTextArea($columnName,$value);
    if(in_array($columnName,$foreignKey)!==false)
    return createCategorySelection($columnName,$value);
    return createInputTag($tableName,$columnName,$value);
}

        /** Input Tag Functions **/
        /**
         *  Create inpput tags except for enums and descriptions
         * 
         *  @param string $tableName - The name of the table used in other function calls.
         *  @param string $columnName - The name of the column from the columnNames array.
         *  @param string $selectedValue - The selected value.
         *
        **/
        function createInputTag($tableName, $columnName, $value){
            global $aliases;
            $required = isRequired($tableName,$columnName);     // Check if column is required 
            $inputType = setinputType($tableName, $columnName) ;
            $hidden = isHidden($columnName);           // Check if column is hidden
            $required = $hidden? "": $required ;
            $inputType = $hidden? "hidden": $inputType ;
            
            $spell = "spellcheck=true" ;
            echo "<input type=$inputType name=$columnName 
                    id=$aliases[$columnName] value='$value' $spell $required >";
        }
        
                /**
                 *  Set the input type of a Field.
                 *  Combines getFieldType and getDataTypeName, defined below.
                 * 
                 *  @param string $tableName - The name of the table.
                 *  @param string $columnName - The name of the field.
                 *  @return string - The input type of the field.
                 */
                function setInputType($tableName, $columnName){
                    $fieldType = getFieldType($tableName, $columnName) ;
                    $inputType = getDataTypeName($fieldType) ;
                    return $inputType ; 
                }
                    /** Get Data Type Functions **/

                        /**
                         *  Get the Type of a Field from DB. Eg. varchar(100), int(5), enum("",""), etc
                         * 
                         * @param string $tableName - The name of the table.
                         * @param string $columnName - The name of the field.
                         * @return string - The type of the field.
                         **/
                        function getFieldType($tableName, $columnName){
                            global $conn ;
                            $sql = "DESCRIBE $tableName $columnName" ;
                            $result = $conn->query($sql) or die("Query failed");
                            $row = $result->fetch_assoc() ;
                            return $row['Type'] ;
                        }

                        /** 
                        * Get the name of the data type from an array in alias.php to be used in input tag type. E.g varchar(100) becomes 'text', int(5) becomes 'number' 
                        *
                        * @param $fieldType - data type of the field 
                        * @return - name of the data type
                        **/
                        function getDataTypeName($fieldType) {
                            global $dataTypes;  
                            foreach ($dataTypes as $key => $value) {    // $key is a string while $value is an array here    
                                foreach ($value as $v) {
                                    // Check if any of the elements $v of array $value match from field type
                                    if(stripos($fieldType,$v)!==false)  
                                    return $key;
                                }
                            }
                            return 'text';
                        }
                    /***/
        /**
         * 
         *  Create a text area for description
         * 
         *  @param string $columnName - The name of the column from the columnNames array.
         *  @param string $selectedValue - The selected value.
         * 
         * */
        function createTextArea($columnName, $value){
            if(!isTextArea($columnName)){
                echo "TextArea not applicable here.";
                return;
            }
            global $aliases;
            
            $spell = "spellcheck=true" ;
            global $required;
            echo "<textarea name=$columnName id=$aliases[$columnName] '$spell' cols=22 rows=5 $required>$value</textarea>";
        }
        /**
         *  Create a selection for enum
         * 
         *  @param string $tableName
         *  @param string $columnName
         *  @param string $selectedValue
         */
        function createSelection($tableName, $columnName, $selectedValue){
            if(setInputType($tableName,$columnName)!=="enum"){
                echo "Selection not applicable here.";
                return;
            }
            $required = isRequired($tableName,$columnName);
            global $aliases;
            echo "<select name=$columnName id=$aliases[$columnName] $required>";      // Selection tag

            echo "<option disabled selected>Select</option>";            // Disabled option
            $enum = getEnumValues($tableName,$columnName);                  // Get enum values
            foreach($enum as $value){
                    $selected = isSelected($value,$selectedValue);
                    echo "<option value=$value $selected>$value</option>";
            }

            echo "</select>";
        }

                /** Get Enum Values Functions **/        
                    /**
                     *  Get the predefined values of enum.
                     * 
                     *   @param string $tableName - The name of the table.
                     *   @param string $columnName - The name of the field.
                     *   @return array - An array containing the predefined values of the enum.
                     *  E.g. getEnumValues("table_name","column_name")
                     */
                    function getEnumValues($tableName,$columnName){
                        global $conn; 
                        $sql = "DESC $tableName $columnName";        //  Query
                        $result = $conn->query($sql);
                        $row=$result->fetch_array();
                        $enum = $row['Type'];       // retrieves the value of the 'Type' column from the current row. E.g "enum('Yes','No','Maybe')"
                        $enum = substr($enum,6,-2);        // extracts a substring from the 'Type' value. The substring starts at position 6 and ends 2 characters before the end of the string 
                        //E.g "enum('Yes','No','Maybe')" becomes "Yes','No','Maybe"                         
                        $enum = explode("','",$enum);       // split the string into an array based onthe delimiter (in this case, ',')
                        // E.g "Yes','No','Maybe" becomes array("Yes","No","Maybe")
                        return $enum;
                    }
                /***/
        
                
        function getForeignKeys(){
            global $conn, $foreignKey, $categoryList;
            foreach($foreignKey as $tableName => $columnName){
                $otherColumns = implode(", ",$categoryList[$columnName]);
                $sql = "SELECT $columnName, $otherColumns FROM $tableName";
                $result = $conn->query($sql) or die("naw");
                $row = $result->fetch_all(MYSQLI_NUM);
                return $row;
           }
                
        }

        function createCategorySelection($columnName,$selectedValue){
            $list=[];
            global $conn,$categoryList,$foreignKey,$aliases;
            $row = getForeignKeys();
            for($i=0;$i<count($row);$i++){
                $list[$row[$i][0]]= $row[$i][1];
            } 
            echo "<select name=$columnName id=$aliases[$columnName] required>"; // Selection tag
            echo "<option disabled selected>Select</option>";    // Disabled option
            foreach($list as $id=>$name){  
                $selected = isSelected($id,$selectedValue);
                echo "<option value= $id>$name</option>";
            }
                    

            echo "</select>";   
            
        }   
                                   
            
            
        
        // }

        /**
         *  Create lables for input fields
         * 
         *  @param string $columnName - The name of the column from the columnNames array.
         *  @param string $columnRename - The name of the column from the columnRenames array.
         * 
         * */
        function createLabel($columnName,$columnRename){
            if(isHidden($columnName))   // Check if column is hidden

            return;
            echo "<label for=$columnName>$columnRename</label>";
            
        
        }


/**
 *  Check if a column is required based on NOT NULL
 * 
 *  @param string $tableName - The name of the table.
 *  @param string $columnName - The name of the column from the columnNames array.
 * 
 * */
function isRequired($tableName, $columnName){
    global $conn;
    $sql = "DESC $tableName $columnName";
    $result= $conn->query($sql);
    $null = $result->fetch_assoc();
    if($null['Null']=="NO")
        return "required" ;
    else
        return "" ;
}
 

function isSelected($value,$selectedValue){
    if($value==$selectedValue)
                $selected = "selected";
    else $selected ="";
    return $selected;
}

function isHidden($columnName){
    global $toHide,$aliases;
    foreach($toHide as $hide){
        if(stripos($aliases[$columnName],$hide)!==false)
            return "hidden" ;
        }
        return "" ;
}
function isTextArea($columnName){
    global $forTextArea;
    foreach($forTextArea as $value){
    if(stripos($columnName,$value)!==false)
    return "text";
    }
}




/**
 

//UNAPPROVED

function createCheckbox($tableName, $columnName, $selectedValue){
    $fieldType = getFieldType($tableName, $columnName) ;
    $inputType = setinputType($tableName, $columnName) ;
    global $conn ;
    echo "<input type='checkbox' name='$columnName' id='$columnName' class='form-control' value='$selectedValue'>";
    return $inputType ; 
}

function createRadio($tableName, $columnName, $selectedValue){
    $fieldType = getFieldType($tableName, $columnName) ;
    $inputType = setinputType($tableName, $columnName) ;
    global $conn ;
    echo "<input type='radio' name='$columnName' id='$columnName' class='form-control' value='$selectedValue'>";
    return $inputType ; 
}




function isSelected($value,$selectedValue){
    if($value==$selectedValue)
        return "selected" ;
    else
        return "" ;
}

function isDisabled($value,$selectedValue){
    if($value==$selectedValue)
        return "disabled" ;
    else
        return "" ;
}

function isReadOnly($value,$selectedValue){
    if($value==$selectedValue)
        return "readonly" ;
    else
        return "" ;
}



function isMultiple($value,$selectedValue){
    if($value==$selectedValue)
        return "multiple" ;
    else
        return "" ;
}



function isChecked($value,$selectedValue){
    if($value==$selectedValue)
        return "checked" ;
    else
        return "" ;
}

function isAutoFocus($value,$selectedValue){
    if($value==$selectedValue)
        return "autofocus" ;
    else
        return "" ;
}

function isAutoComplete($value,$selectedValue){
    if($value==$selectedValue)
        return "autocomplete" ;
    else
        return "" ;
}

function isMin($value,$selectedValue){
    if($value==$selectedValue)
        return "min" ;
    else
        return "" ;
}

function isMax($value,$selectedValue){
    if($value==$selectedValue)
        return "max" ;
    else
        return "" ;
}

function isStep($value,$selectedValue){
    if($value==$selectedValue)
        return "step" ;
    else
        return "" ;
}

function isPattern($value,$selectedValue){
    if($value==$selectedValue)
        return "pattern" ;
    else
        return "" ;
}

function isPlaceholder($value,$selectedValue){
    if($value==$selectedValue)
        return "placeholder" ;
    else
        return "" ;
}

function isList($value,$selectedValue){
    if($value==$selectedValue)
        return "list" ;
    else
        return "" ;
}

function isSize($value,$selectedValue){
    if($value==$selectedValue)
        return "size" ;
    else
        return "" ;
}

// BEH
function isForm($value,$selectedValue){
    if($value==$selectedValue)
        return "form" ;
    else
        return "" ;
}

function isFormAction($value,$selectedValue){
    if($value==$selectedValue)
        return "formaction" ;
    else
        return "" ;
}

function isFormEncType($value,$selectedValue){
    if($value==$selectedValue)
        return "formenctype" ;
    else
        return "" ;
}

function isFormMethod($value,$selectedValue){
    if($value==$selectedValue)
        return "formmethod" ;
    else
        return "" ;
}

function isFormNoValidate($value,$selectedValue){
    if($value==$selectedValue)
        return "formnovalidate" ;
    else
        return "" ;
}

function isFormTarget($value,$selectedValue){
    if($value==$selectedValue)
        return "formtarget" ;
    else
        return "" ;
}

function isFormAcceptCharset($value,$selectedValue){
    if($value==$selectedValue)
        return "formacceptcharset" ;
    else
        return "" ;
}

function isFormName($value,$selectedValue){
    if($value==$selectedValue)
        return "formname" ;
    else
        return "" ;
}

function isFormType($value,$selectedValue){
    if($value==$selectedValue)
        return "formtype" ;
    else
        return "" ;
}

function isFormActionURL($value,$selectedValue){
    if($value==$selectedValue)
        return "formactionurl" ;
    else
        return "" ;
}

function isFormActionMethod($value,$selectedValue){
    if($value==$selectedValue)
        return "formactionmethod" ;
    else
        return "" ;
}

function isFormActionURLMethod($value,$selectedValue){
    if($value==$selectedValue)
        return "formactionurlmethod" ;
    else
        return "" ;
}

// Close PHP tag
*/
?>
