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
        <title>Custom Sertifikat</title>
        <!-- Custom CSS -->
        <link href="dist/css/style.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            function validateForm() {
            var x = document.forms["formpaper"]["igpsize"].value;
            var y = document.forms["formpaper"]["igformat"].value;
            var za = document.forms["formpaper"]["matas"].value;
            var zb = document.forms["formpaper"]["mbawah"].value;
            var zc = document.forms["formpaper"]["mkanan"].value;
            var zd = document.forms["formpaper"]["mkiri"].value;
                if (x == "" || y == "") {
                    alert("Masukan Berlogo * dibutuhkan!");
                    return false;
                }
                if(isNaN(za) || isNaN(zb) || isNaN(zc) || isNaN(zd)){
                    alert("Masukan Bukan Angka! (Angka Koma Menggunakan .)");
                    return false;
                }
            }
            /* Check if cookie exists
            function getCookie(name) {
                var dc = document.cookie;
                var prefix = name + "=";
                var begin = dc.indexOf("; " + prefix);
                if (begin == -1) {
                    begin = dc.indexOf(prefix);
                    if (begin != 0) return null;
                }
                else
                {
                    begin += 2;
                    var end = document.cookie.indexOf(";", begin);
                    if (end == -1) {
                    end = dc.length;
                    }
                }
                // because unescape has been deprecated, replaced with decodeURI
                //return unescape(dc.substring(begin + prefix.length, end));
                return decodeURI(dc.substring(begin + prefix.length, end));
            } 

            function doSomething() {
                var myCookie = getCookie("MyCookie");

                if (myCookie != null) {
                    // do cookie doesn't exist stuff;
                }
            }
            */
        </script>
    </head>
    
    <body>
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-12 align-self-center">
                    <div class="row">
                        <h4 class="text-white">Generator Sertifikat</h4>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Atur Kertas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <h4 class="card-title">Atur Kertas yang Diekspor</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <!-- Content here -->
                                <form action="parsepaper.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" name="formpaper" required>
                                    <div class="form-group mb-3 mt-3">
                                        <label class="form-group-text" for="igpsize" >Ukuran Kertas*</label>
                                        <select class="form-control custom-select" id="igpsize" name="igpsize">
                                            <option value="" disabled selected>Pilih Disini</option>
                                            <option value="1">A3</option>
                                            <option value="2">A4</option>
                                            <option value="3">A5</option>
                                            <option value="4">B4</option>
                                            <option value="5">B5</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Masukan Pilihan Ukuran Kertas
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-group-text" for="igformat">Format Ekspor*</label>
                                        <select class="form-control custom-select" id="igformat" name="igformat">
                                            <option value="" disabled selected>Pilih Disini</option>
                                            <option value="1">pdf</option>
                                            <option value="2">jpg</option>
                                            <option value="3">png</option>
                                        </select>
                                    </div>
                                    <label class="form-group-text">Ukuran Margin (Default = No Margin)</label>
                                    <div class="form-group mb-3 row">
                                        <input class="form-control col ml-3" id="matas" placeholder="Margin Atas (cm)" name="matas">
                                        <input class="form-control col ml-3" id="mbawah" placeholder="Margin Bawah (cm)" name="mbawah">
                                        <input class="form-control col ml-3" id="mkanan" placeholder="Margin Kanan (cm)" name="mkanan">
                                        <input class="form-control col ml-3 mr-3" id="mkiri" placeholder="Margin Kiri (cm)" name="mkiri">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="btn btn-rounded btn-block btn-outline-dark btn-lg" name="Submit">Submit & Impor CSV</button>
                                            </div>
                                            <p class="mt-3" style="text-align: center;">atau</p>
                                            <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="btn btn-rounded btn-block btn-outline-dark btn-lg" name="Submit1">Submit & Buat CSV</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<button type="submit" class="btn btn-success mb-2" name="Submit">Submit</button>-->
                                    <div class="text-muted mt-3">
                                        * = Required
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>