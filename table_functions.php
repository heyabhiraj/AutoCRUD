<?php
// Functions
    function getColumnNames($tableName){
        global $conn;

        $sql = "desc $tableName";
        $result=$conn->query($sql) or die("nevermind, bye");

        $col = []; //An array to store the names

        for($i=0;$row = $result->fetch_assoc();$i++){
            // Storing the attribute names in $col array
            $col[$i] = $row['Field'];
        }
        return $col;

        
        /* If i used 'foreach' here like:
        foreach($result->fetch_assoc() as $row){
        echo $row;
        }
        'foreach' actually returns each element of the first fetched array and not perform the fetch method again like 'for' loop did
        */
    }

    // ALias Handling
    function filterColumns($columnNames){
        global $aliases;
        define("LEN",count($columnNames));  // to keep the lenght constant

        // unsetting elements; to set again add more aliases
        for($i=0;$i<LEN;$i++){
            if(!isset($aliases[$columnNames[$i]]))
            unset($columnNames[$i]);
        }
        $columnNames = array_values($columnNames);
        return $columnNames;
    }

    function renameColumns($columnNames){
        global $aliases;
        define("NEWLEN",count($columnNames));  // to keep the lenght constant

        for($i=0;$i<NEWLEN;$i++){
            if(isset($aliases[$columnNames[$i]]))
            $columnNames[$i] = $aliases[$columnNames[$i]];
        }
        return $columnNames;

    }

    function showColumnNames($columnNames){
        foreach($columnNames as $col){
            // Show the attribute names stored
            echo $col . "<br>";
        }
    }

    function getRecords($tableName,$where){
        global $conn;
        $sql = "SELECT * FROM $tableName $where";
        $result= $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        
        return $row;


        //printing records 
        for($i = 0 ; $row = $result->fetch_row();$i++){
            foreach($row as $r){
                echo $r;
            }
        }
        
    }

    
    ?>