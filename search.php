<?php
    require("connection.php");
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate Generator</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="node_modules/inputmask/dist/jquery.inputmask.js"></script>
    <script src="node_modules/inputmask/dist/bindings/inputmask.binding.js"></script>
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
                            <li class="breadcrumb-item active">Search</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <!-- Content here -->
                                <form action="search.php" method="post" id="searchme" name="searchme">
                                    <div class="text-center">
                                        <h1>Search Serial Code</h1><br>   
                                        <?php 
                                        $idsearch=null;
                                        if(!empty($_GET['id'])){
                                            $idsearch=$_GET['id']; 
                                        }
                                        ?> 
                                        <input type="text" name="findme" id="findme" size="40" value="<?php echo $idsearch; ?>" 
                                        data-inputmask-regex="[\w]{4}-[\w]{4}-[\w]{4}-[\w]{4}-[\w]{4}-[\w]{4}-[\w]{4}-[\w]{4}">
                                    </div>
                                    <div class="text-center">
                                    <br>
                                    <button type="submit" id="find" class="btn btn-success mr-2" name="find">Search Now!</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            if(isset($_POST['find'])){
                $search_val=$_POST['findme'];
                $sql= "SELECT * FROM `sertifikat` WHERE `serial`='$search_val'";
                $srt = $con->query($sql);  
                $row = mysqli_fetch_assoc($srt);
            }
            if(!empty($row)){
                echo '
                    <div class="row justify-content-center" id="dataserti">
                        <div class="col-6">
                            <div class="card card-body justify-content-center">
                                <div class="row" >
                                    <div class="col-sm-12 col-xs-12 align-items-center">
                                        <table class="table table-responsive table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Serial Code</td>
                                                    <td>:</td>
                                                    <td>';echo $row['serial']; echo'</td>
                                                </tr>
                                                <tr>
                                                    <td>ID</td>
                                                    <td>:</td>
                                                    <td>';echo $row['id']; echo'</td>
                                                </tr>
                                                <tr>
                                                    <td>Participant Name</td>
                                                    <td>:</td>
                                                    <td>';echo $row['nama']; echo'</td>
                                                </tr>
                                                <tr>
                                                    <td>Event</td>
                                                    <td>:</td>
                                                    <td>';echo $row['event']; echo'</td>
                                                </tr>
                                                <tr>
                                                    <td>Organizer</td>
                                                    <td>:</td>
                                                    <td>';echo $row['organizer']; echo'</td>
                                                </tr>
                                                <tr>
                                                    <td>Printed Date</td>
                                                    <td>:</td>
                                                    <td>';echo $row['tgl_keluar']; echo'</td>
                                                </tr>
                                                <tr>
                                                    <td>Expiry Date</td>
                                                    <td>:</td>
                                                    <td>';echo $row['tgl_exp']; echo'</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';      
            }else{
                echo '
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="card card-body justify-content-center">
                                <div class="row" >
                                    <div class="align-items-center">
                                        <table class="table table-responsive table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Serial Code</td>
                                                    <td>:</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>ID</td>
                                                    <td>:</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Participant Name</td>
                                                    <td>:</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Event</td>
                                                    <td>:</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Organizer</td>
                                                    <td>:</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Printed Date</td>
                                                    <td>:</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Expiry Date</td>
                                                    <td>:</td>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';   
            }
            
        ?>
    </div>
    <script>
        var element =  document.getElementById('dataserti');
        //if div is not exists
        if (typeof(element) == 'undefined' || element == null){   
            var x= '<?php echo $idsearch;?>';
            if(!(x == "" || x == null)){
                document.getElementById('find').click();   
            }
        }
    </script>
    </body>
    
</html>