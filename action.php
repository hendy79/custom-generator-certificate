<?php
    if(isset($_POST['getc'])){  
        print_begin(); 
        include 'CsvReader.php';
        $fn = 'csv/data.csv';
        $csv = new CsvReader(null);
        $values = $csv->dataread($fn);
        set_cookie('values',$values);
        echo $csv->print_table($values);
        $fh = fopen($fn, 'w');
        fclose($fh);
        print_end();
    }    
    if(isset($_POST["Import"])){
        print_begin();
        include 'CsvReader.php';
        $csv = new CsvReader($_FILES["file"]);
        set_cookie('csv',$_FILES["file"]);
        $values = $csv->read();
        set_cookie('values',$values);
        if($_FILES["file"]["size"] > 0){
            echo $csv->print_table($values);
        }
        print_end();
    }
    if(isset($_POST['submit'])){
        print_begin();
        include 'CsvReader.php';
        if(!empty($_COOKIE['csv'])){
            $file = json_decode($_COOKIE['csv'], true);
        }else{
            $file = null;
        }
        $csv = new CsvReader($file);
        $values = json_decode($_COOKIE['values'], true);
        if(!empty($_POST['Kolom'])){
            $tmpv = array();
            $selectedCollumn=$_POST['Kolom'];
            foreach($selectedCollumn as $value){
                for($count = 0;$count < count($values);$count++){
                    unset($values[$count][$value]);
                }
            }
            for($count = 0;$count < count($values);$count++){
                $tmpv[] = array_values($values[$count]);
            }
            $values = $tmpv;
        }
        if(!empty($_POST['Baris'])){
            $selectedRow=$_POST['Baris'];
            foreach($selectedRow as $value){
                unset($values[$value]);
            }
            $values = array_values($values);
        }
        if(!empty($values[0]) && (count($values) != 1)){
            set_cookie('values',$values);
            echo $csv->print_table($values);
        }else{
            header("Location:index.php");
        }   
        print_end();
    }
    if(isset($_POST['submit1'])){
        header("Location:canvas.php");
    }
    if (isset($_POST['simpan'])) {
        $fdata = $_POST['head'];
        $fileName = fopen("csv/data.csv","w");
        fwrite($fileName, implode(';',$fdata)."\n");
        fclose($fileName);
    }
    function set_cookie($cookiename, $v){
        setcookie($cookiename, json_encode($v), time() + (3600));
    }
    function print_end(){
        echo '
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </body>
        </html>';
    }
    function print_begin(){
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Array Maker from CSV</title>
            <link href="dist/css/style.min.css" rel="stylesheet">
            <![endif]-->
        </head>
        <body>
        <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <div class="row">
                    <h4>Generator Sertifikat</h4>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)"><p class="text-dark">Home</p></a></li>
                            <li class="breadcrumb-item active">Pilih Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-12">
        <div class="card card-body">
        <h4 class="card-title">Pilih data CSV yang Digunakan untuk Buat Sertifikat</h4>
        <div class="row">
        <div class="col-sm-12 col-xs-12">';
    }
?>