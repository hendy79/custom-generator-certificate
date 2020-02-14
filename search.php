<?php
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generator Sertifikat</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
    <body>
        <div class="container-fluid h-100 content-row" alt="Max-width 100%">
            <div class="row page-titles">
                <div class="col-md-12 align-self-center">
                    <div class="row">
                        <h4>Generator Sertifikat</h4>
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
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <!-- Content here -->
                                <form method="post" id="searchme" name="searchme">
                                    <div class="text-center">
                                        <h1>Search ID</h1><br>   
                                        <?php 
                                        $idsearch=null;
                                        if(!empty($_GET['id'])){
                                            $idsearch=$_GET['id']; 
                                        }
                                        ?> 
                                        <input type="text" name="findme" id="findme" size="75" value="<?php echo $idsearch; ?>">
                                    </div>
                                    <div class="text-center">
                                    <br>
                                    <button type="submit" id="find" name="find">Search Now!</button>
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
            $sql= "SELECT * FROM `sertifikat` WHERE `id`='$search_val'";
            $srt = $con->query($sql);  
            $row = mysqli_fetch_assoc($srt);
        }
        if(!empty($row)){
            echo '
                <div class="row justify-content-center" id="dataserti">
                    <div class="col-3">
                        <div class="card card-body justify-content-center">
                            <div class="row" >
                                <div class="col-sm-12 col-xs-12 align-items-center">
                                    <p>ID Sertifikat  = ';echo $row['id']; echo'</p>
                                    <p>Nama Pemilik   = ';echo $row['nama']; echo'</p>
                                    <p>Event          = ';echo $row['event']; echo'</p>
                                    <p>Organizer      = ';echo $row['organizer']; echo'</p>
                                    <p>Tanggal Keluar = ';echo $row['tgl_keluar']; echo'</p>
                                    <p>Tanggal Expire = ';echo $row['tgl_exp']; echo'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';      
        }else{
            echo '
                <div class="row justify-content-center" id="dataserti">
                    <div class="col-3">
                        <div class="card card-body justify-content-center">
                            <div class="row" >
                                <div class="col-sm-12 col-xs-12 text-center">
                                    <p>Data Kosong</p>
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
        if (typeof(element) == 'undefined' || element == null)
        {   
            <?php 
                $link=null;
                if(!empty($_GET['id'])){
                    $link=$_GET['id']; 
                }
            ?>
            var x= '<?php echo $link;?>';
            if(!(x == "" || x==null)){
                document.getElementById('find').click();   
            }
        }
        
    </script>
    </body>
    
</html>