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
   require("connection.php");
   $a = $_GET['id_ser'];
   $b = $_GET['nama'];
   $c = $_GET['username'];
   $d = $_GET['serial'];
   $yearadded = $_COOKIE['sexp'];
   $event = "Kerja Praktek"; //$_COOKIE['sevent']
   $organizer = "UKK Pusbangki FKUI"; //$_COOKIE['organizer']

   $aa = mysqli_escape_string($con, $a);
   $bb = mysqli_escape_string($con, $b);
   $cc = mysqli_escape_string($con, $c);
   $dd = mysqli_escape_string($con, $d);

   if($yearadded == '"0"'){
      $query = mysqli_query($con, "INSERT INTO `sertifikat` (`id`, `nama`, `tgl_keluar`, `tgl_exp`, `username_id`, `event`, `organizer`, `serial`)
                                 VALUES ('$aa', '$bb', CURRENT_DATE(), NULL, '$cc', '$event', '$organizer','$dd')");
   }else{
      $query = mysqli_query($con, "INSERT INTO `sertifikat` (`id`, `nama`, `tgl_keluar`, `tgl_exp`, `username_id`, `event`, `organizer`, `serial`)
                                 VALUES ('$aa', '$bb', CURRENT_DATE(), DATE_ADD(CURDATE(), INTERVAL $yearadded YEAR), '$cc', '$event', '$organizer','$dd')");
   }
   header('Location: canvas.php');
?>