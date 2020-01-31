<?php
    if(isset($_POST["Submit"])){
        if (isset($_COOKIE['spsize'])) {
            del_cookie();
        }
        set_cookie('spsize', $_POST["igpsize"]);
        set_cookie('sformat', $_POST["igformat"]);
        set_margin($_POST["matas"], $_POST["mbawah"], $_POST["mkanan"], $_POST["mkiri"]);
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
        set_cookie('spsize', $_POST["igpsize"]);
        set_cookie('sformat', $_POST["igformat"]);
        set_margin($_POST["matas"], $_POST["mbawah"], $_POST["mkanan"], $_POST["mkiri"]);
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
    function set_margin($t, $b, $r, $l){
        if(empty($t)){
            $t = "0";
        }
        if(empty($b)){
            $b = "0";
        }
        if(empty($r)){
            $r = "0";
        }
        if(empty($l)){
            $l = "0";
        }
        set_cookie('mt', $t);
        set_cookie('mb', $b);
        set_cookie('mr', $r);
        set_cookie('ml', $l);
    }
    function del_cookie(){
        unset($_COOKIE['spsize']); 
        setcookie('spsize', null, -1, '/'); 
        unset($_COOKIE['sformat']); 
        setcookie('sformat', null, -1, '/'); 
        unset($_COOKIE['mt']); 
        setcookie('mt', null, -1, '/'); 
        unset($_COOKIE['mb']); 
        setcookie('mb', null, -1, '/'); 
        unset($_COOKIE['mr']); 
        setcookie('mr', null, -1, '/'); 
        unset($_COOKIE['ml']); 
        setcookie('ml', null, -1, '/'); 
    }
?>