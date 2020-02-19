<?php
    /*
    MIT License

    Copyright (c) 2020 Hendy (M. Khoiri Muzaki, Alland C. Kesuma)

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
    */
    error_reporting(E_ALL);
    ini_set('display_errors', 0); // SET IT TO 0 ON A LIVE SERVER !!!
    include 'action.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!--<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">-->
    <title>Certificate Generator</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php
require_once 'config.php';

// Get array of CSV files
$csvpath = SDFE_CSVFolder . "/";
$files = scandir($csvpath); // this is all files in dir

// clean up file list (to exclude)should only include csv files
$csvfiles = array();
foreach ($files as $basename) {
    if(substr($basename, -3)==SDFE_CSVFileExtension) {
        array_push($csvfiles, $basename);}
}

// Set first csv file as default csv file to display in edit mode
if(sizeof($csvfiles)>0) {
    $csv = $csvfiles[0];
}

// Override default csv file if a csv file is provided
if(isset($_GET["file"])) {
    $csv = $_GET["file"];
}

// Open CSV file
$filename = SDFE_CSVFolder . "/" . $csv;
$fp = fopen($filename, "r");
$content = fread($fp, filesize($filename));
$lines = explode("\n", $content);
fclose($fp);
?>      
      
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <div class="row">
                <h4 style="color: white;"><b>Certificate Generator</b></h4>
            </div>
            <div class="row">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><p class="text-dark">Home</p></a></li>
                        <li class="breadcrumb-item active">CSV Maker</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h4 class="card-title">Insert New Data to Create Certificate</h4>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <?php
                        if(!isset($csv)) {}
                        else {
                            // CSV file is not empty, let's show the content
                            $row = explode(SDFE_CSVSeparator, $lines[0]);
                            $columns = sizeof($row);
                        ?>
                        <form class="form-inline" id="editf" action="action.php" method="post">
                            <div class="table-responsive">
                                <table class="table table-hover" id="csvtable">
                                    <thead>
                                        <tr>
                                        <?php
                                            // Show header
                                            for ($columnCnt=0; $columnCnt<$columns; $columnCnt++) {
                                                echo "<th>" . $row[$columnCnt] . "</th>";
                                            }
                                            echo "<th>&nbsp;</th>";
                                        ?>
                                        </tr>
                                    </thead>                        
                                    <tbody>
                                    <?php
                                        // Show content
                                        for ($lineCnt=1; $lineCnt<sizeof($lines); $lineCnt++) {
                                            $row = explode(SDFE_CSVSeparator, $lines[$lineCnt]);
                                            echo makeTableRow($lineCnt, $row, $columns);
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="col-sm-12 col-xs-12 mt-2">
                                <div class="text-right">
                                    <a data-target="#newModal" alt="default" data-toggle="modal" class="btn waves-effect waves-light btn-secondary mr-2" id="MainNavHelp" href="#newModal">
                                    <i class="fa fa-file"></i>   Create New</a>
                                    <a href="#" id="addrow" class="btn waves-effect waves-light btn-secondary"><i class="fa fa-plus"></i>   Add Data</a>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div>
                                    <!-- <a href="#" name="getc" id="getc" class="btn btn-primary"><i class="fa fa-save"></i>   Simpan</a>-->
                                    <button id="csave" name="csave" class="btn btn-primary">Save</button>    
                                    <button id="getc" name="getc" class="btn waves-effect waves-light btn-success ml-2">Generate</button>                                  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Buat CSV Baru-->

    <div class="modal fade" id="newModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="Menentukan Field" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert Collumn</h4>
                </div>
                <div class="modal-body">
                    <form name="subb" method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <div>
                                <label>Collumn :</label>
                            </div>
                            <div class="mob-box mb-3">
                                <input type="text" class="form-control form-ctr" id="head" name="head[]" placeholder="Masukan Nama Kolom">
                            </div>
                        </div>  
                        <div class="form-group">
                            <a href="javascript:void(0);" class="btn btn-success cust-btn add-field">Add</a>
                            <button type="submit" onclick="simpan()" id="simpan" name="simpan" class="btn btn-primary ml-2" value="simpan">Save</button>
                        </div>
                        <div class="text-muted mt-3">
                            The collumn for participant's name must be declared as "name"
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <script>
        var csvfile = "<?php echo $csv;?>";

        // Enable/disable row 
        $(document).on("click", "a[rel=editrow]", function(e) { 
        //    $("a[rel=editrow]").click(function(e) { 
            e.preventDefault();
            // get id clicked a and extract the linenumber
            var linenum = this.id.split("-")[1];

            // change button icon and row background color according to state
            var rowIsEnabled;
            if ($(this).children().attr("class") === "fa fa-unlock-alt") {
                rowIsEnabled = true;
                $(this).children().attr("class", "fa fa-lock");
            }
            else {
                rowIsEnabled = false;
                $(this).children().attr("class", "fa fa-unlock-alt");
            }
        //Toggle Enable/Disable
        $("#row-"+ linenum).toggleClass("success");
            // Toggle (disable/enable) every input field in row
        $("input[rel=input-"+ linenum + "]").each(function( i ) {
            $(this).prop("disabled", rowIsEnabled);
            });
        });    
        
        // Delete row
        $(document).on("click", "a[rel=deleterow]", function(e) { 
        //    $("a[rel=deleterow]").click(function(e) { 
            e.preventDefault();
            // get id clicked a and extract the linenumber
            var linenum = this.id.split("-")[1];
            // change background color of row to indicate that row is unlocked/locked
            $("#row-"+ linenum).hide();
        });

        // Add row
        $("#addrow").click(function(e) { 
            e.preventDefault();
            // get linenumber of last row
            var linenum = parseInt($("#csvtable tbody tr:last").attr("id").split("-")[1]);
            $("#csvtable tbody").append(makeTableRow(linenum+1, <?php echo $columns;?>, true));
        });
        
        // Save
        $("#csave").click(function(e) { 
            e.preventDefault();
            var csvlines = {};
            var columncnt = 0;
            var linecnt = 0;
            // Loop through all (visible only) table rows and make data
            $("[rel=row]:visible").each(function() {
                var linenum = this.id.split("-")[1];
                var thisline = {};
                columncnt = 0;
                    $("input[rel=input-"+ linenum + "]").each(function() {
                        thisline['col-'+columncnt] = $(this).val(); 
                        columncnt++;
                    });
                csvlines['line-'+linecnt] = thisline;
                linecnt++;
                });
                var csvdata = {csvfile: csvfile, lines: linecnt, columns: columncnt, data: csvlines};
                // Write data to file and show result to user
                $.ajax({
                    url: "savetocsv.php",
                    method: "POST",
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    async: false,
                    data: JSON.stringify(csvdata),
                    cache: false,
                });
                location.replace("add.php");
            });

        //Add header field
        $(document).on("click", ".add-field", function () {
            var field = '<div class="mob-box">' +
                '<input type="text" class="form-control form-ctr" id="head" name="head[]" placeholder="Insert Collumn Name">' +
                '<a href="javascript:void(0);" class="remove-field cust-btn">Delete</a>' +
                '<div class="clearfix"></div>' +
                '</div>';
            $(field).insertAfter('.mob-box:last');
        });
        //remove header field
        $(document).on("click", ".remove-field", function () {
            $(this).parent('.mob-box').remove();
        });
            
        //untuk menambah row data csv
        function makeTableRow(linenum, columns, isenabled) {
            var h = "<tr rel=\"row\" id=\"row-" + linenum + "\" class=\"" + (isenabled===true ? "success" : "") + "\">";
            for (var columncnt=0; columncnt<columns; columncnt++) {
                h += "<td><input class=\"form-control" + (columncnt==0 ? " input-col-first" : " input-col-rest") + "\" rel=\"input-" + linenum + "\"" + (isenabled===true ? "" : " disabled") + " type=\"text\" value=\"\"></td>";
            }
            h += "<td>";
            h += " <a href=\"#\" rel=\"editrow\" id=\"editrow-" + linenum + "\" title=\"Edit row\" class=\"btn btn-default btn-sm\"><i class=\"fa " + (isenabled===true ? "fa-unlock-alt" : "fa-lock") + "\"></i></a>";
            h += " <a href=\"#\" rel=\"deleterow\" id=\"deleterow-" + linenum + "\" title=\"Delete row\" class=\"btn btn-default btn-sm\"><i class=\"fa fa-trash\"></i></a>";
            h += "</td>";
            h += "</tr>";
            return h;
        }
    </script>
    </body>
</html>


<?php
//untuk menampilkan data csv
function makeTableRow($lineCnt, $row, $columns) {
    $h = "<tr rel=\"row\" id=\"row-" . $lineCnt . "\">";
    for ($columnCnt=0; $columnCnt<$columns; $columnCnt++) {
        $h .= "<td><input class=\"form-control" . ($columnCnt==0 ? " input-col-first" : " input-col-rest") . "\" rel=\"input-" . $lineCnt . "\" disabled type=\"text\" value=\"" . $row[$columnCnt] . "\"></td>";
    }
    $h .= "<td>";
    $h .= " <a href=\"#\" rel=\"editrow\" id=\"editrow-" . $lineCnt . "\" title=\"Edit row\" class=\"btn btn-default btn-sm\"><i class=\"fa fa-lock\"></i></a>";
    $h .= " <a href=\"#\" rel=\"deleterow\" id=\"deleterow-" . $lineCnt . "\" title=\"Delete row\" class=\"btn btn-default btn-sm\"><i class=\"fa fa-trash\"></i></a>";
    $h .= "</td>";
    $h .= "</tr>";
    
    return $h;
}
function makeCSVFileLink($basename, $activebasename) {
    // Include CSV files only (defined by extension)
    if(substr($basename, -3)==SDFE_CSVFileExtension) {
        $h = "<a href=\"?file=" . $basename . "\" ";
        $h .= "class=\"list-group-item" . ($basename==$activebasename ? " active" : "") . "\">";
        $h .= $basename . "</a>";
    }
    return $h;
}
?>
