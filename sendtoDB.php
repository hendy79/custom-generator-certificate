<?php
 require("connection.php");
 $a = $_GET['id_ser'];
 $b = $_GET['nama'];

 $aa = mysqli_escape_string($con, $a);
 $bb = mysqli_escape_string($con, $b);




 /* Modify id for the system  */
 $query = mysqli_query($con, "INSERT INTO `sertifikat` (`id`, `nama`, `tgl_keluar`, `tgl_exp`, `username_id`, `event_id`, `organizer_id`)
                             VALUES ('$aa', '$bb', CURRENT_DATE(), NULL, 'pusbangki', 1, 1)");
 echo('Question has been saved');
    header('Location: canvas.php');
 ?>