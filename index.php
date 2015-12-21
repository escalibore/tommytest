<?php
require __DIR__ . '/vendor/autoload.php';

$mysqlgrid = new mysqlgrid\mysqlgrid([
    'sql' => "select * from tommytable",
    'lineCount' => 15,
    //'database' => $_SESSION['session_database'],
    //'noSearch' => true,
    //'noReport' => true,
    //'hideColumns' => array('Walkthrough_ID'),
    //'defaultOrderBy' => 'ORDER BY `Review Date` DESC',
    //'noReset' => true,
    //'noToolTip' => true,
    //'hideSelects' => array('Uncompleted Actions', 'Score', 'Address', 'Household_Name'),
    // 'noSelects' => true,
    //'noPaginate' => true,
    //'alwaysPaginate' => true,
//    'includePath' => './vendor/tommytest/tommytest/src/mysqlgrid/',
    //   'includePath' => $thePath,
    //  'includePath' => 'C:/xampp/htdocs/tommy/vendor/tommytest/tommytest/src/mysqlgrid/',
    // 'includePath' => '../mysqlgrid/',
    //  'gridControlKey' => 'Office_Name',
    //'gridControlKey' => 'Walkthrough_ID',
    //'gridControlHtml' => "<div style='white-space: nowrap;'><input type='button' onClick='location.href=\"?showUpdateForm=gridControlKey\"' value=\"Edit\"><input type='button' onClick='location.href=\"?showUpdateForm=gridControlKey&printable=1\"' value=\"View\"><input type='button' onClick='if(confirm(\"Do you really want to delete this row?\")) location.href=\"?deleteId=gridControlKey\";' value=\"Delete\"></div>",
    //     'gridControlHtml' => "<div style='white-space: nowrap;'><input type='button' onClick='location.href=\"ar_progress_qa.php?showUpdateForm=gridControlKey&printable=1\"' value=\"View\"></div>",
    //'gridControlHtml' => "<a target='_blank' href='?List=T&urlSqlFilters=$urlSqlFilters&urlDisplayFilters=$urlDisplayFilters&urlJoinProgram=$urlJoinProgram&$gridControlKey=gridControlKey'>List</a>",
]);

?>
<div style='text-align:center;'>
    <div style="display: inline-block; text-align: center;">
        <div id="mySqlGridTable"></div>
        <div id="mySqlGridPagination" style='text-align: center;'></div>
    </div>
</div>
