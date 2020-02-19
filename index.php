<!DOCTYPE html>
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
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Certificate Generator</title>
            <link href="dist/css/style.min.css" rel="stylesheet">
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
                                <li class="breadcrumb-item active">Home</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="height: 30rem;">
                <div class="col-4">
                    <div class="card card-body bg-primary h-100 justify-content-center" onclick="window.location.href = 'kertas.php';">
                        <div class="row">
                            <div class="col text-white align-items-center" style="text-align: center;">
                                <h1 class="font-weight-bold">Create Certificate</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-body bg-purple h-100 justify-content-center" onclick="window.location.href = 'verify.php';">
                        <div class="row">
                            <div class="col text-white align-items-center" style="text-align: center;">
                                <h1 class="font-weight-bold">Verify Certificate</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-body bg-warning h-100 justify-content-center" onclick="window.location.href = 'search.php';">
                        <div class="row">
                            <div class="col text-white align-items-center" style="text-align: center;">
                                <h1 class="font-weight-bold">Check Certificate</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>