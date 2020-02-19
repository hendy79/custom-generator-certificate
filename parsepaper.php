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
    if(isset($_POST["Submit"])){
        if (isset($_COOKIE['spsize'])) {
            del_cookie();
        }
        $qr = (isset($_POST['igqr'])) ? true : false;
        $idserti = (isset($_POST['igserti'])) ? true : false;
        set_cookie('spsize', $_POST["igpsize"]);
        set_cookie('sformat', $_POST["igformat"]);
        set_cookie('sqr', $qr);
        set_cookie('sidserti', $idserti);
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
        $qr = (isset($_POST['igqr'])) ? true : false;
        $idserti = (isset($_POST['igserti'])) ? true : false;
        set_cookie('spsize', $_POST["igpsize"]);
        set_cookie('sformat', $_POST["igformat"]);
        set_cookie('sqr', $qr);
        set_cookie('sidserti', $idserti);
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