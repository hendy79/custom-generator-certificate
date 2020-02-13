<?php
   require("connection.php");
   $a = $_GET['id_ser'];
   $b = $_GET['nama'];
   $c = $_GET['username'];
   $yearadded = $_COOKIE['sexp'];
   $event = "Kerja Praktek"; //$_COOKIE['sevent']
   $organizer = "UKK Pusbangki FKUI"; //$_COOKIE['organizer']

   $aa = mysqli_escape_string($con, $a);
   $bb = mysqli_escape_string($con, $b);
   $cc = mysqli_escape_string($con, $c);

   if($yearadded == '"0"' || $yearadded == 0){
      $query = mysqli_query($con, "INSERT INTO `sertifikat` (`id`, `nama`, `tgl_keluar`, `tgl_exp`, `username_id`, `event`, `organizer`)
                                 VALUES ('$aa', '$bb', CURRENT_DATE(), NULL, '$cc', '$event', '$organizer')");
   }else{
      $query = mysqli_query($con, "INSERT INTO `sertifikat` (`id`, `nama`, `tgl_keluar`, `tgl_exp`, `username_id`, `event`, `organizer`)
                                 VALUES ('$aa', '$bb', CURRENT_DATE(), DATE_ADD(CURDATE(), INTERVAL $yearadded YEAR), '$cc', '$event', '$organizer')");
   }
   header('Location: canvas.php');
?>