<!DOCTYPE html>
<html lang="en">
<!--
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
-->
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
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        
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
                if (x == "" || y == "") {
                    alert("Masukan Berlogo * dibutuhkan!");
                    return false;
                }
            }
        </script>
    </head>
    
    <body>
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
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <h4 class="card-title">Set the Paper for Export Result</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <!-- Content here -->
                                <form action="parsepaper.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" name="formpaper" required>
                                    <div class="form-group mb-3 mt-3">
                                        <label class="form-group-text" for="igpsize" >Paper Size*</label>
                                        <select class="form-control custom-select" id="igpsize" name="igpsize">
                                            <option value="" disabled selected>Choose Here</option>
                                            <option value="1">A3</option>
                                            <option value="2">A4</option>
                                            <option value="3">A5</option>
                                            <option value="4">B4</option>
                                            <option value="5">B5</option>
                                            <option value="6">Letter</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-group-text" for="igformat">Export Format*</label>
                                        <select class="form-control custom-select" id="igformat" name="igformat">
                                            <option value="" disabled selected>Choose Here</option>
                                            <option value="1">pdf (Separated)</option>
                                            <option value="4">pdf (1 File)</option>
                                            <option value="2">png</option>
                                            <option value="3">jpeg</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="btn btn-rounded btn-block btn-outline-dark btn-lg" name="Submit">Submit & Import CSV</button>
                                            </div>
                                            <p class="mt-3" style="text-align: center;">or</p>
                                            <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="btn btn-rounded btn-block btn-outline-dark btn-lg" name="Submit1">Submit & Create CSV</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<button type="submit" class="btn btn-success mb-2" name="Submit">Submit</button>-->
                                    <div class="text-muted mt-3">
                                        * = Required
                                    </div>
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h2 class="text-right">
                                                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Advanced Option
                                                    </button>
                                                </h2>
                                            </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="igqr" class="col-sm-2 col-form-label">Use QR Code</label>
                                                    <input id="igqr" name="igqr" type="checkbox" data-toggle="toggle" checked>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="igserti" class="col-sm-2 col-form-label">Use Certificate Serial Code</label>
                                                    <input id="igserti" name="igserti" type="checkbox" data-toggle="toggle" checked>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="igexp" class="col-sm-2 col-form-label">Expired Date</label>
                                                    <select class="custom-select" style="width: 10%;" name="igexp" id="igexp">
                                                        <option value="0">Permanent</option>
                                                        <option value="1">1 Year</option>
                                                        <option value="2">2 Years</option>
                                                        <option value="3">3 Years</option>
                                                        <option value="4">4 Years</option>
                                                        <option value="5">5 Years</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
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