<?php
    if(isset($_POST["Submit"])){
        if (isset($_COOKIE['spsize'])) {
            del_cookie();
        }
        $qr = (isset($_POST['igqr'])) ? 1 : 0;
        set_cookie('spsize', $_POST["igpsize"]);
        set_cookie('sformat', $_POST["igformat"]);
        set_cookie('sqr', $qr);
        set_cookie('sexp', $_POST["igexp"]);
        if (isset($_COOKIE['values'])) {
            unset($_COOKIE['values']); 
            setcookie('values', null, -1, '/'); 
        }
        //echo untuk mencoba melihat cookie
        header('Location:importcsv.php');
    }
    if(isset($_POST["Submit1"])){
        if (isset($_COOKIE['spsize'])) {
            del_cookie();
        }
        $qr = (isset($_POST['igqr'])) ? 1 : 0;
        set_cookie('spsize', $_POST["igpsize"]);
        set_cookie('sformat', $_POST["igformat"]);
        set_cookie('sqr', $qr);
        set_cookie('sexp', $_POST["igexp"]);
        if (isset($_COOKIE['values'])) {
            unset($_COOKIE['values']); 
            setcookie('values', null, -1, '/'); 
        }
        //echo untuk mencoba melihat cookie
        header('Location:add.php');
    }
    function set_cookie($cookiename, $v){
        setcookie($cookiename, json_encode($v), time() + (86400));
    }
    function del_cookie(){
        unset($_COOKIE['spsize']); 
        setcookie('spsize', null, -1, '/'); 
        unset($_COOKIE['sformat']); 
        setcookie('sformat', null, -1, '/'); 
        unset($_COOKIE['sqr']); 
        setcookie('sqr', null, -1, '/'); 
        unset($_COOKIE['sexp']); 
        setcookie('sexp', null, -1, '/'); 
    }
?>