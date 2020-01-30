<?php
    if (isset($_COOKIE['values'])) {
        unset($_COOKIE['values']); 
        setcookie('values', null, -1, '/'); 
    }
    header('Location:pilihcsv.html');
?>