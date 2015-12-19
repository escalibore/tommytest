<?php
    // Add mysqli connection details below...
    if(!$mySqlGridConnection) {      
        if($mySqlGridOptions['database']) { // got here from the target script
            $mySqlGridConnection = connectMysqli(); 
            mysqli_select_db($mySqlGridConnection, $mySqlGridOptions['database']);  
        }
        elseif($optionsArray['database']) { // got here from mysqlgridajax.php
            require "../../includes/z_shared/shared_functions.inc";
            $mySqlGridConnection = connectMysqli();
            mysqli_select_db($mySqlGridConnection, $optionsArray['database']);   
        }
        if($mySqlGridConnection->connect_error) die('Connect Error (' . $mySqlGridConnection->connect_errno . ') '. $mySqlGridConnection->connect_error);
    }
?>