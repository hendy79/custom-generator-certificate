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
    <title>Array Maker from CSV</title>
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
<div class="container-fluid mt-4">
<div class="row">
<div class="col-12">
<div class="card card-body">
<h4 class="card-title">Pilih data CSV yang Digunakan untuk Buat Sertifikat</h4>
<div class="row">
<div class="col-sm-12 col-xs-12">
<?php
    if(isset($_POST["Import"])){
        include 'CsvReader.php';
        $csv = new CsvReader($_FILES["file"]);
        set_cookie('csv',$_FILES["file"]);
        $values = $csv->read();
        set_cookie('values',$values);
        if($_FILES["file"]["size"] > 0){
            echo $csv->print_table($values);
        }
    }
    if(isset($_POST['submit'])){
        include 'CsvReader.php';
        $file = json_decode($_COOKIE['csv'], true);
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
    }
    if(isset($_POST['submit1'])){
        header("Location:canvas.php");
    }
    function set_cookie($cookiename, $v){
        setcookie($cookiename, json_encode($v), time() + (3600));
    }
?>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>