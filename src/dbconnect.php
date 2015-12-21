<?php
    // Add mysqli connection details below...
    if(!$mySqlGridConnection) {
        $mySqlGridConnection = new mysqli('localhost', 'root', '', 'tommytest');
        if($mySqlGridConnection->connect_error) die('Connect Error (' . $mySqlGridConnection->connect_errno . ') '. $mySqlGridConnection->connect_error);
    }
?>