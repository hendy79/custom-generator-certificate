<?php 
    include "connection.php";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi Sertifikat</title>
    <link href="dist/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/r-2.2.3/sc-2.0.1/sp-1.0.1/datatables.min.css"/>
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/r-2.2.3/sc-2.0.1/sp-1.0.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/jhyland87/DataTables-Keep-Conditions/118c5e107f1f603b1b91475dc139df6f53917e38/dist/dataTables.keepConditions.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/natural.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid h-100 content-row" alt="Max-width 100%">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <div class="row">
                <h4 style="color: white;"><b>Certificate Generator</b></h4>
            </div>
            <div class="row">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><p class="text-dark">Home</p></a></li>
                    <li class="breadcrumb-item active">Verifiy Certificate</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card card-body">
                <table id="serti" class="table table-responsive table-hover table-bordered text-center"> 
                    <?php   
                    $sql = "SELECT * FROM `sertifikat`";
                    $srt = $con->query($sql);
                    
                    ?>
                    <thead>
                        <tr>
                            <th>Serial Code</th>
                            <th>Participant Name</th>
                            <th>Event</th>
                            <th>Organizer</th>
                            <th>Printed Date</th>
                            <th>Expiry Date</th>
                            <th>ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($srt as $row):?>
                            <tr>
                                <td><?php echo $row['serial'];?></td>
                                <td><?php echo $row['nama'];?></td>
                                <td><?php echo $row['event'];?></td>
                                <td><?php echo $row['organizer'];?></td>
                                <td><?php echo $row['tgl_keluar'];?></td>
                                <td><?php echo $row['tgl_exp'];?></td>
                                <td><?php echo $row['id'];?></td>
                            </tr>
                        <?php endforeach;?>     
                    </tbody>
                    <tfoot>
                        <tr>
                            <?php 
                                $idsearch=null;
                                if(!empty($_GET['id'])){
                                    $idsearch=$_GET['id']; 
                                }
                            ?>
                            <th><input type="text" name="idsearch" id="idsearch" value="<?php echo $idsearch; ?>"/></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>    
        </div>
    </div>    
</div>
    

<script>
        
$(document).ready(function() {  
    // DataTable
    var table = $('#serti').DataTable({
        responsive: true,
        "order": [[ 6, "asc" ]],
        columnDefs: [
            { type: 'natural', targets: [4,5,6] }
        ]  
    });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change clear load', function () {
            table.fnFilter("^" + this.value + "$", 0, false);
            if ( that.search() !== this.value ) {
                that
                    .search( this.value ,true, false,true)
                    .draw();
            }
        });
    });
    
    table.columns().every( function () {
        var e = jQuery.Event("keydown", {
        keyCode: 13
        });
        var that = this;
        $( 'input', this.footer() ).on( 'keydown', function () {
            if (e.keyCode === 13) {
                that
                    .search( this.value ,true, false,true)
                    .draw();
            }
        });
        $( 'input', this.footer() ).trigger(e);
    });

});


        
</script>
</body>
</html>