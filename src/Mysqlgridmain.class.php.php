<?php
namespace mysqlgridspace;

class Page {
    public function __construct()
    {
        echo "hello, i am a page.<br>";
    }
}

class Book {
    public function __construct()
    {
        echo "hello, i am a book.<br>";
    }
}

function lego() {
    echo 'You are now a master builder.';
}

class Mysqlgridmain
{
    var $name;
    public $mySqlGridOptions;
    public $path;


    function set_params($mySqlGridOptions)
    {
        $this->mySqlGridOptions = $mySqlGridOptions;
    }

    function __construct($mySqlGridOptions)
    {
        $this->mySqlGridOptions = $mySqlGridOptions;

        //var_dump($this->mySqlGridOptions);
        //echo "I'm here too<br>";
        $this->path = $this->mySqlGridOptions['includePath'];
        //echo "<br>path:" . $this->path . "<br>";
        // require $this->path . "mysqlgrid.php";
        //$myfun = 'good';
        //echo "$myfun";


        if ($this->mySqlGridOptions['includePath']) $mySqlGridPath = $this->mySqlGridOptions['includePath']; else $mySqlGridPath = 'vendor/tommytest/tommytest/src/';
        $lineCount = $this->mySqlGridOptions['lineCount'] ? $this->mySqlGridOptions['lineCount'] : 25;
        require $mySqlGridPath . 'dbconnect.php';
        echo "<div style='margin-left:30%' id='mySqlGridLoading'>Loading... <img class='mySqlGridSpinner' src='{$mySqlGridPath}images/725.GIF'></div>";
        $mySqlGridOptionsEncode = rawurlencode(base64_encode(serialize($this->mySqlGridOptions)));
        $mySqlGridData = 'mySqlGridOptions=' . $mySqlGridOptionsEncode;
        $postString = "'mySqlGridData':'$mySqlGridData'";
        ?>
        <link rel="stylesheet" href="<?php echo "$mySqlGridPath"; ?>theme.css">
        <link rel="stylesheet" href="<?php echo "$mySqlGridPath"; ?>jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo "$mySqlGridPath"; ?>style.css"/>
        <script>window.jQuery || document.write('<script src="<?php echo "$mySqlGridPath"; ?>jquery-2.1.3.min.js">\x3C/script>')</script>
        <script src="<?php echo "$mySqlGridPath"; ?>jquery-ui.min.js"></script>
        <script src="<?php echo "$mySqlGridPath"; ?>jquery.bootpag.min.js"></script>
        <script type="text/javascript">
            function mySqlGridUpdate() {
                $('#mySqlGridSpinner').show();
                var mySqlGridPageCnt = document.getElementById('mySqlGridPageCnt').value;
                var formData = $('#mySqlGridForm').serialize();
                $("#mySqlGridTable").load('<?php echo $mySqlGridPath; ?>mysqlgridajax.php', {'mySqlGridData': formData});
                $('#mySqlGridPagination').unbind('page')
                $("#mySqlGridPagination").bootpag({
                    total: mySqlGridPageCnt, // total number of pages
                    page: 1, //initial page
                    maxVisible: 10 //maximum visible links
                }).on("page", function (e, num) {
                    e.preventDefault();
                    $('#mySqlGridSpinner').show();
                    $("#mySqlGridTable").load('<?php echo $mySqlGridPath; ?>mysqlgridajax.php', {
                        'page': num,
                        'mySqlGridData': formData
                    });
                });
            }
            $(document).ready(function () {
                $("#mySqlGridPagination").css("display", "none"); // prevents pagination bar from appearing before table.
                $("#mySqlGridTable").load('<?php echo $mySqlGridPath; ?>mysqlgridajax.php', {<?php echo $postString; ?>});  //initial page number to load
                $("#mySqlGridPagination").bootpag({
                    total: 1, // total number of pages
                    <?php //  echo "total: $pages,";?> // total number of pages
                    page: 1, //initial page
                    maxVisible: 10 //maximum visible links
                }).on("page", function (e, num) {
                    $('#mySqlGridSpinner').show();
                    e.preventDefault();
                    $("#mySqlGridTable").load('<?php echo $mySqlGridPath; ?>mysqlgridajax.php', {'page': num, <?php echo $postString; ?>});
                });
            });
            function printableView() {
                var elem = document.getElementById("mySqlGridTop");
                // elem.parentNode.removeChild(elem);
                var elem = document.getElementById("mySqlGridSearchRow");
                elem.parentNode.removeChild(elem);

                var inputs = document.getElementsByTagName("BUTTON");
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].style.display = "none";
                }
                var inputs = document.querySelectorAll("input[type=button]");
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].style.display = "none";
                }
                var inputs = document.getElementsByClassName("mySqlGridControlCell");
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].style.display = "none";
                }
                var inputs = document.getElementsByTagName("INPUT");
                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].type == "submit") {
                        inputs[i].style.display = "none";
                    } else {
                        inputs[i].readOnly = true;
                        inputs[i].onclick = function () {
                            return false;
                        }
                    }
                }
                var inputs = document.getElementsByTagName("IMG");
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].style.display = "none";
                }
                $("#mySqlGridPagination").hide();
            }
            function ExpandSelect(select, maxOptionsVisible) {
                //
                // ExpandSelect 1.00
                // Copyright (c) Czarek Tomczak. All rights reserved.
                //
                // License:
                //      New BSD License (free for any use, read more at http://www.opensource.org/licenses/bsd-license.php)
                //
                // Project's website:
                //      http://code.google.com/p/expandselect/
                //

                if (typeof maxOptionsVisible == "undefined") {
                    maxOptionsVisible = 20;
                }
                if (typeof select == "string") {
                    select = document.getElementById(select);
                }
                if (typeof window["ExpandSelect_tempID"] == "undefined") {
                    window["ExpandSelect_tempID"] = 0;
                }
                window["ExpandSelect_tempID"]++;

                var rects = select.getClientRects();

                // ie: cannot populate options using innerHTML.
                function PopulateOptions(select, select2) {
                    select2.options.length = 0; // clear out existing items
                    for (var i = 0; i < select.options.length; i++) {
                        var d = select.options[i];
                        select2.options.add(new Option(d.text, i))
                    }
                }

                var select2 = document.createElement("SELECT");
                //select2.innerHTML = select.innerHTML;
                PopulateOptions(select, select2);
                select2.style.cssText = "visibility: hidden;";
                if (select.style.width) {
                    select2.style.width = select.style.width;
                }
                if (select.style.height) {
                    select2.style.height = select.style.height;
                }
                select2.id = "ExpandSelect_" + window.ExpandSelect_tempID;

                select.parentNode.insertBefore(select2, select.nextSibling);
                select = select.parentNode.removeChild(select);

                if (select.length > maxOptionsVisible) {
                    select.size = maxOptionsVisible;
                } else {
                    select.size = select.length;
                }

                if ("pageXOffset" in window) {
                    var scrollLeft = window.pageXOffset;
                    var scrollTop = window.pageYOffset;
                } else {
                    // ie <= 8
                    // Function taken from here: http://help.dottoro.com/ljafodvj.php
                    function GetZoomFactor() {
                        var factor = 1;
                        if (document.body.getBoundingClientRect) {
                            var rect = document.body.getBoundingClientRect ();
                            var physicalW = rect.right - rect.left;
                            var logicalW = document.body.offsetWidth;
                            factor = Math.round ((physicalW / logicalW) * 100) / 100;
                        }
                        return factor;
                    }

                    var zoomFactor = GetZoomFactor();
                    var scrollLeft = Math.round(document.documentElement.scrollLeft / zoomFactor);
                    var scrollTop = Math.round(document.documentElement.scrollTop / zoomFactor);
                }

                select.style.position = "absolute";
                select.style.left = (rects[0].left + scrollLeft) + "px";
                select.style.top = (rects[0].top + scrollTop) + "px";
                select.style.zIndex = "1000000";

                var keydownFunc = function (e) {
                    e = e ? e : window.event;
                    // Need to implement hiding select on "Escape" and "Enter".
                    if (e.altKey || e.ctrlKey || e.shiftKey || e.metaKey) {
                        return 1;
                    }
                    // Escape, Enter.
                    if (27 == e.keyCode || 13 == e.keyCode) {
                        select.blur();
                        return 0;
                    }
                    return 1;
                };

                if (select.addEventListener) {
                    select.addEventListener("keydown", keydownFunc, false);
                } else {
                    select.attachEvent("onkeydown", keydownFunc);
                }

                var tempID = window["ExpandSelect_tempID"];

                var clickFunc = function (e) {
                    window.focus();
                    e = e ? e : window.event;
                    if (e.target) {
                        if (e.target.tagName == "OPTION") {
                            select.blur();
                        }
                    } else {
                        // IE case.
                        if (e.srcElement.tagName == "SELECT" || e.srcElement.tagName == "OPTION") {
                            select.blur();
                        }
                    }

                };

                if (select.addEventListener) {
                    select.addEventListener("click", clickFunc, false);
                } else {
                    select.attachEvent("onclick", clickFunc);
                }

                var blurFunc = function () {
                    if (select.removeEventListener) {
                        select.removeEventListener("blur", arguments.callee, false);
                        select.removeEventListener("click", clickFunc, false);
                        select.removeEventListener("keydown", keydownFunc, false);
                    } else {
                        select.detachEvent("onblur", arguments.callee);
                        select.detachEvent("onclick", clickFunc);
                        select.detachEvent("onkeydown", keydownFunc);
                    }
                    select.size = 1;
                    select.style.position = "static";
                    select = select.parentNode.removeChild(select);
                    var select2 = document.getElementById("ExpandSelect_" + tempID);
                    select2.parentNode.insertBefore(select, select2);
                    select2.parentNode.removeChild(select2);
                    mySqlGridUpdate();  // added by Berthold for mySqlGrid
                };

                if (select.addEventListener) {
                    select.addEventListener("blur", blurFunc, false);
                } else {
                    select.attachEvent("onblur", blurFunc);
                }

                document.body.appendChild(select);
                select.focus();
            }
        </script>


        <?php
    }
}