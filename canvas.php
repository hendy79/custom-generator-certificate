<?php
    session_start();
    include "connection.php";
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Generator</title>
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Custom JavaScript -->
    <link href="dist/css/pages/progressbar-page.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/fabric/dist/fabric.min.js"></script>
    <script src="node_modules/jszip/dist/jszip.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Times+New+Roman|candara|calibri|sans-serif|monospace|cursive|arial|courier|tahoma|impact|Brush+Script+MT' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/pure-md5@latest/lib/index.js"></script>
    <script src="dist/js/qrious.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <div class="row">
                <h4 style="color: white;">Certificate Generator</h4>
            </div>
            <div class="row">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><p class="text-dark">Home</p></a></li>
                        <li class="breadcrumb-item active">Canvas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
    <!-- canvas -->
    <?php
        $psize = $_COOKIE['spsize'];
        $pformat = $_COOKIE['sformat'];
        $width  = 842;
        $height = 595;
        if($psize == '"1"'){
            $width  = 1191;
            $height = 842;
        }elseif($psize == '"2"'){
            //default
        }elseif($psize == '"3"'){
            $width  = 595;
            $height = 420;
        }elseif($psize == '"4"'){
            $width  = 1001;
            $height = 709;
        }elseif($psize == '"5"'){
            $width  = 709;
            $height = 599;
        }elseif($psize == '"6"'){
            $width  = 792;
            $height = 612;
        }
        echo '<div class="card card-body justify-content-center" style="height: 60rem;">
        <div class="row"><div class="col-sm-12 col-xs-12" align="center">
        <canvas id="bg" align="center" width="'.$width.'" height="'.$height.'" style="border:1px solid black;">
        </canvas></div></div></div>';
    ?>
        </div>
    </div>
    <div class="side-mini-panel" id="paleteMain" style="overflow: hidden; opacity: 0.25;">
        <ul class="mini-nav ps" data-ps-id="8f377b4d-de38-c34f-a446-c3e5d7cfe900" style="overflow: hidden;">
            <div class="togglediv"><a href="javascript:void(0)" id="togglebtn" class="" style="display: none;"><i class="ti-menu"></i></a></div>
            <!-- .Dashboard -->
            <li class="selected cnt-none">
                <a href="javascript:void(0)"><i class="ti-palette"></i></a>
                <div class="sidebarmenu">
                    <!-- Left navbar-header -->
                    <h3 class="menu-title">Tools for Canvas</h3>
                    <ul class="sidebar-menu ps ps--theme_default" data-ps-id="8c4e3556-5fc0-562a-c732-0b6ba5b6b21a">
                        <div class="col ml-3">
                        <div class="row mt-1 mr-3 mb-4">
                        <h6>Images Upload</h6>
                        <input type="file" onchange="previewFile()" id="fileinput">
                        </div>
                        <div class="row mt-1 mr-3 mb-4"><button id="ftbg" class="btn waves-effect waves-light btn-info" onclick="fitSelectedObject()" style="width: 100%;">Fit to Background</button></div>
                        <div class="row mt-1 mr-3 mb-4"><button id="addtxt" class="btn waves-effect waves-light btn-dark" style="width: 100%;">Add Text</button></div>
                        <div class="row mt-1 mr-3"><button id="delall" style="width: 100%;" class="btn waves-effect waves-light btn-rounded btn-outline-primary">Delete All</button></div>
                        <div class="row mt-1 mr-3 mb-4"><button id="delsel" style="width: 100%;" class="btn waves-effect waves-light btn-rounded btn-outline-primary">Delete</button></div>
                        <div class="row mt-1 mr-3 mb-4"><input type="color" class="form-control" id="warna" style="width: 100%;"></div>
                        <div class="row mt-1 mr-3 mb-4">
                        <select class="custom-select" id="fontFamily" style="width: 100%;" name="fontFamily">
                            <option value="" disabled selected>Font Family</option>
                            <option value="Times New Roman" style="font-family:Times new roman" >Times New Roman</option>
                            <option value="candara" style="font-family:candara">Candara</option>
                            <option value="calibri" style="font-family:calibri">Calibri</option>
                            <option value="sans-serif" style="font-family:sans-serif">Sans-Serif</option>
                            <option value="monospace" style="font-family:monospace">Monospace</option>
                            <option value="cursive" style="font-family:cursive">Cursive</option>
                            <option value="arial" style="font-family:arial">Arial</option>
                            <option value="courier" style="font-family:courier">Courier</option>
                            <option value="tahoma" style="font-family:tahoma">Tahoma</option>
                            <option value="impact" style="font-family:impact">Impact</option>
                            <option value="Brush Script MT" style="font-family:Brush Script MT">Brush Script MT</option>
                        </select>
                        </div>
                        <div class="row mt-1 mr-3 mb-4"><input class="form-control" type="number" id="fontSize" name="points" step="1" style="width: 100%;" placeholder="Font Size"></div>
                        <div class="row mt-1 mr-3 mb-4"><button id="eyeDropper" class="btn waves-effect waves-light btn-outline-info" style="width: 100%;">Eye Dropper</button></div>
                        <div class="row mt-1 mr-3"><button id="undo" class="btn waves-effect waves-light btn-outline-danger" style="width: 100%;" disabled>Undo</button></div>
                        <div class="row mt-1 mr-3 mb-4"><button id="redo" class="btn waves-effect waves-light btn-outline-danger" style="width: 100%;" disabled>Redo</button></div>
                        <div class="row mt-1 mr-3"><button class="btn waves-effect waves-light btn-outline-warning" style="width: 100%;" onclick="sendSelectedObjectBack()">Send To Back</button></div>
                        <div class="row mt-1 mr-3"><button class="btn waves-effect waves-light btn-outline-warning" style="width: 100%;" onclick="sendSelectedObjectFront()">Send To Front</button></div>
                        <div class="row mt-1 mr-3"><button class="btn waves-effect waves-light btn-outline-warning" style="width: 100%;" onclick="sendSelectedObjectBackward()">Bring Backward</button></div>
                        <div class="row mt-1 mr-3 mb-4"><button class="btn waves-effect waves-light btn-outline-warning" style="width: 100%;" onclick="sendSelectedObjectForward()">Bring Forward</button></div>
                        <div class="row mt-1 mr-3"><button id="generate" class="btn waves-effect waves-light btn-success" style="width: 100%;">Generate!</button></div>
                        </div>
                        </ul>
                    <!-- Left navbar-header end -->
                </div>
            </li>
            <!-- .Multi level -->
        <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 576px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 376px;"></div></div></ul>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog center-screen">
                <!-- <div class="progress">
                    <div class="progress-bar" role="progressbar" id="myBar" style="width:0%">
                    <small class="justify-content-center d-flex position-absolute w-100">0%</small>
                    </div>
                </div> -->
                <div class="center-screen">
                    <img src="assets/images/a-loader.gif" id="ModalImg" alt="">
                </div>
            </div>
        </div>
    </div> 
</div> 

    <script>
    var values = <?php echo $_COOKIE['values']; ?>;
    var canvas = new fabric.Canvas('bg',{preserveObjectStacking :true});
    var useqr = <?php echo $_COOKIE['sqr']; ?>;
    var useidserti = <?php echo $_COOKIE['sidserti']; ?>;
    // current unsaved state
    var state;
    // past states
    var undo = [];
    // reverted states
    var redo = [];

    var globalColor = "";

    var id_serti, hashed_id_serti;

    var paleteClick = true;

    $('#paleteMain').on('click', function() {
        var el = document.getElementById("paleteMain");
        if(paleteClick){
            el.style.opacity = 1;
        }else{
            paleteClick = true;
        }
    });

    $('#togglebtn').on('click', function() {
        var el = document.getElementById("paleteMain");
        el.style.opacity = 0.25;
        paleteClick = false;
    });

    //modul Certificate Generator
    if(useqr){
        var img = new Image();
        img.src = 'assets/images/qrdummy.png';
        fabric.Image.fromURL(img.src, function(oImg) { 
            oImg.set({id: 'imgQr',
                originX: 'center', 
                originY: 'center',});
            canvas.centerObject(oImg);
            canvas.add(oImg);
        });
    }
    //end modul

    // upload gambar
    function previewFile() {
        var preview = document.querySelector('img');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            fabric.Image.fromURL(preview.src, function(oImg) { 
                oImg.scaleToWidth(300);
                oImg.scaleToHeight(300);
                canvas.centerObject(oImg);
                canvas.add(oImg);
            });
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
        document.getElementById("fileinput").value = "";
    };


    // upload background
    var object;
    canvas.on('object:selected', function(event) {
    object = event.target;
    });

    var fitSelectedObject = function() {
        var imgwidth = canvas.getActiveObject().get("width");
        var imgheight = canvas.getActiveObject().get("height");
        canvas.getActiveObject().set({
            centeredScaling: true,
            scaleX: canvas.width / imgwidth,
            scaleY: canvas.height / imgheight
        });
        canvas.centerObject(canvas.getActiveObject());
        canvas.renderAll();
        sendSelectedObjectBack();
        save();
    };

    // delete all
    $(document).ready(function(){
        $("#delall").click(function(){
            canvas.clear();
        });
    });

    // delete selected layer
    $(document).ready(function(){
        $("#delsel").click(function(){
            var doomedObj = canvas.getActiveObject();
            if (doomedObj.type === 'activeSelection') {
                doomedObj.canvas = canvas;
                doomedObj.forEachObject(function(obj) {
                    canvas.remove(obj);
                });
            }//endif multiple objects
            else{
            //If single object, then delete it
                var activeObject = canvas.getActiveObject();
                //How to delete multiple objects?
                //if(activeObject !== null && activeObject.type === 'rectangle') {
                if(activeObject !== null ) {
                    canvas.remove(activeObject);
                }
            }
        });
    });

    // input text manual
    $(document).ready(function(){
        $("#addtxt").click(function(){
            var txtmnl = new fabric.IText("Enter Text Here",{
                originX: 'center', //added
                originY: 'center', //added
                centeredScaling: true});
            canvas.centerObject(txtmnl);
            canvas.add(txtmnl);
            save();
        });
    });

    var text    = new Array();

    // masukin text onload
    for(i=0;i<values[0].length;i++){
        text[i] = new fabric.IText(values[0][i],{id: i,
            originX: 'center', //added
            originY: 'center', //added
            centeredScaling: true});
        textId = i;
        canvas.centerObject(text[i]);
        canvas.add(text[i]);
    }
    
    //add dummy for nomor serial
    if(useidserti){
        text[values[0].length] = new fabric.IText("Serial Sertifikat (32 Digit)",{
            id: values[0].length,
            originX: 'center', //added
            originY: 'center', //added
            centeredScaling: true
        });
        canvas.centerObject(text[values[0].length]);
        canvas.add(text[values[0].length]);
    }

    // send to back
    var sendSelectedObjectBack = function() {
        canvas.sendToBack(canvas.getActiveObject());
        // canvas.discardActiveObject();
        canvas.renderAll();
    }

    // bring to front
    var sendSelectedObjectFront = function() {
        canvas.bringToFront(canvas.getActiveObject());
        // canvas.discardActiveObject();
        canvas.renderAll();
    }

    // send backward
    var sendSelectedObjectBackward = function(){
        canvas.sendBackwards(canvas.getActiveObject());
        // canvas.discardActiveObject();
        canvas.renderAll();
    }
    
    // send forward
    var sendSelectedObjectForward = function(){
        canvas.bringForward(canvas.getActiveObject());
        // canvas.discardActiveObject();
        canvas.renderAll();
    }
    var save = function() {
        // clear the redo stack
        redo = [];
        $('#redo').prop('disabled', true);
        // initial call won't have a state
        if (state) {
            undo.push(state);
            $('#undo').prop('disabled', false);
        }
        state = JSON.stringify(canvas);
    }

    var replay =  function (playStack, saveStack, buttonsOn, buttonsOff) {
        saveStack.push(state);
        state = playStack.pop();
        var on = $(buttonsOn);
        var off = $(buttonsOff);
        // turn both buttons off for the moment to prevent rapid clicking
        on.prop('disabled', true);
        off.prop('disabled', true);
        canvas.clear();
        canvas.loadFromJSON(state, function() {
            canvas.renderAll();
            // now turn the buttons back on if applicable
            on.prop('disabled', false);
            if (playStack.length) {
            off.prop('disabled', false);
            }
        });
    }
    var eyeDropper = function() {
        canvas.on('mouse:move', function(options) {
            const bg = document.getElementById("bg");
            const ctx = bg.getContext("2d");
            let pointer = canvas.getPointer(options.e)
            let x = parseInt(pointer.x - bg.offsetLeft);
            let y = parseInt(pointer.y - bg.offsetTop);
            let imagesData = ctx.getImageData(x, y, 1, 1);

            let newColor = [
            imagesData.data[0],
            imagesData.data[1],
            imagesData.data[2]
            ];

            globalColor = `rgb(${newColor.join()})`;
            let colorInput = $("#warna").val();

            colorInput = "#fff";
            console.log(colorInput);

            canvas.getActiveObject && canvas.getActiveObject().set({
                fill: globalColor,
            });
            canvas.renderAll();

            canvas.on('mouse:down', function() {
                // colorInput = "#fff"
                // console.log(colorInput);
                canvas.off('mouse:move', eyeDropper());
            })
        })
    }

    $("#eyeDropper").click(() => eyeDropper());

    // send to back
    var object;
    canvas.on('object:selected', function(event) {
        object = event.target;
        document.getElementById("warna").value = canvas.getActiveObject().get("fill");
        document.getElementById("fontFamily").value = canvas.getActiveObject().get("fontFamily");
        document.getElementById("fontSize").value = canvas.getActiveObject().get("fontSize");
        //console.log(object);
    });
    
    canvas.on('selection:updated', function(event) {
        object = event.target;
        document.getElementById("warna").value = canvas.getActiveObject().get("fill");
        document.getElementById("fontFamily").value = canvas.getActiveObject().get("fontFamily");
        document.getElementById("fontSize").value = canvas.getActiveObject().get("fontSize");
        //console.log(object);
    });
    canvas.on('object:modified', function() {
        save();
    });
    

    // event
    document.onkeydown = function(e) {
        switch (e.keyCode) {
            case 37:
                // left
                $("body").css("overflow", "hidden");
                canvas.getActiveObject().set({
                    left: object.left - 1 ,
                });
                canvas.renderAll(); 
                setTimeout(setVisible, 2000);
                function setVisible() {
                $("body").css("overflow", "visible");
                };
                break;
            case 38:
                // top
                $("body").css("overflow", "hidden");
                canvas.getActiveObject().set({
                    top: object.top - 1 ,
                });
                canvas.renderAll();
                setTimeout(setVisible, 2000);
                function setVisible() {
                $("body").css("overflow", "visible");
                };
                break;
            case 39:
                // right
                // $("body").css("overflow", "hidden");
                canvas.getActiveObject().set({
                    left: object.left + 1 ,
                });
                canvas.renderAll();
                setTimeout(setVisible, 2000);
                function setVisible() {
                $("body").css("overflow", "visible");
                };
                break;
            case 40:
                // down
                $("body").css("overflow", "hidden");
                canvas.getActiveObject().set({
                    top: object.top + 1 ,
                });
                canvas.renderAll();
                setTimeout(setVisible, 2000);
                function setVisible() {
                $("body").css("overflow", "visible");
                };
                break;
            case 46:
                // del
                canvas.remove(canvas.getActiveObject());
                break;
        }
    };
    $(document).ready(function() {
        var ctrlDown = false,
            ctrlKey = 17,
            cmdKey = 91,
            cKey = 67;
            vKey = 86,
            yKey = 89;
            zKey = 90;
        
        save();

        $(document).keydown(function(e) {
            if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        }).keyup(function(e) {
            if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = false;
        });

        $(".no-copy-paste").keydown(function(e) {
            if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
        });
        
        // Document Ctrl + C/V 
        $(document).keydown(function(e) {
            if (ctrlDown && (e.keyCode == cKey)){
                // function Copy() {
                    // clone what are you copying since you
                    // may want copy and paste on different moment.
                    // and you do not want the changes happened
                    // later to reflect on the copy.
                    canvas.getActiveObject().clone(function(cloned) {
                        _clipboard = cloned;
                    });
                // }
            };

            if (ctrlDown && (e.keyCode == vKey)) {
                // function Paste() {
                    // clone again, so you can do multiple copies.
                    _clipboard.clone(function(clonedObj) {
                        canvas.discardActiveObject();
                        clonedObj.set({
                            left: clonedObj.left + 10,
                            top: clonedObj.top + 10,
                            evented: true,
                        });
                        if (clonedObj.type === 'activeSelection') {
                            // active selection needs a reference to the canvas.
                            clonedObj.canvas = canvas;
                            clonedObj.forEachObject(function(obj) {
                                canvas.add(obj);
                            });
                            // this should solve the unselectability
                            clonedObj.setCoords();
                        } else {
                            canvas.add(clonedObj);
                        }
                        _clipboard.top += 10;
                        _clipboard.left += 10;
                        canvas.setActiveObject(clonedObj);
                        canvas.requestRenderAll();
                    });
                // }
            };

            if(ctrlDown && (e.keyCode == yKey)) {
                replay(redo, undo, '#undo', this);
            }

            if(ctrlDown && (e.keyCode == zKey)) {
                replay(undo, redo, '#redo', this);
            }
        });
    });
    // undo and redo buttons
    $('#undo').click(function() {
        replay(undo, redo, '#redo', this);
    });
    $('#redo').click(function() {
        replay(redo, undo, '#undo', this);
    })
    // color switch
    $(document).ready(function(){
        $("#warna").on('change',function(){
            canvas.getActiveObject().set({
                fill: this.value,
            });
            canvas.renderAll();
        });
    });

    // set fontFamily
    $(document).ready(function(){
        $("#fontFamily").on('change',function(){
            canvas.getActiveObject().set({
                fontFamily: this.value,
            });
            canvas.renderAll();
        });
    });
    
    // set fontSize
    $(document).ready(function(){
        $("#fontSize").on('change',function(){
            canvas.getActiveObject().set({
                fontSize: this.value,
            });
            canvas.renderAll();
        });
    });

    function getPixelColor(x, y) {
        var data = ctx.getImageData(Math.round(pointer.x), Math.round(pointer.y), 1, 1).data;
        // var pxData = canvas.getImageData(x, y, 1, 1);
        return ("rgb(" + data[0] + "," + data[1] + "," + data[2] + ")");

    }


    var cvs = document.getElementById("bg");
    var ctx = cvs.getContext("2d");
    var imgInstance;

    function waitForImageToLoad(imageElement){
        return new Promise(resolve=>{imageElement.onload = resolve})
    }

    var qrimg = [];
    var images = [];
    <?php 
        $sqlid = "SELECT COUNT(username_id) as id FROM `sertifikat`";
        $result = $con->query($sqlid);
        $row = mysqli_fetch_assoc($result);
    ?>
    var username = 'pusbangki'; //SELECT username FROM user_table (tunggu ada login);
    var id = parseInt(<?php echo $row['id']; ?>);
    
    //Fungsi untuk menggenerate semua qr dan menyimpan di url
    function generateAllQr(){
        id_serti = username + '_' + (id+i-1);
        hashed_id_serti = chunk(md5(id_serti).toString().toUpperCase(), 4).join("-");
        for(i=1;i<values.length;i++){
            var qr = new QRious({
                value: 'http://localhost/search.php?id='+hashed_id_serti
            });
            qrimg[i] = qr.toDataURL('image/png',1.0);
        }
    }

    //Fungsi untuk menggenerate melakukan load semua image qr dari url
    function preloadQr() {
        for (var i = 1; i < values.length; i++) {
            images[i] = new Image();
            images[i].src = qrimg[i];
            images[i].onload = canvas.renderAll();
        }
    }

    //Fungsi untuk menggenerate qr dari url ke canvas
    function generateqr(qrimg, objectElement, i){ 
        images[i].height = 100;
        images[i].width = 100;
        imgInstance = new fabric.Image(images[i], {
            id: objectElement[0],
            scaleX: objectElement[1] / 100,
            scaleY: objectElement[2] / 100
        });
        imgInstance.set({
            left: objectElement[3],
            top: objectElement[4],
            originX: 'center', 
            originY: 'center',
            opacity: 1
        });
        canvas.add(imgInstance).renderAll();
    }

    var objectElement = null;

    function chunk(str, n) {
        var ret = [];
        var i;
        var len;

        for(i = 0, len = str.length; i < len; i += n) {
            ret.push(str.substr(i, n));
        }

        return ret;
    };

    //Fungsi untuk menggenerate teks serta qr
    function generateall(i){
        id_serti = username + '_' + (id+i-1);
        hashed_id_serti = chunk(md5(id_serti).toString().toUpperCase(), 4).join("-");
        var objects = canvas.getObjects();
        objects.forEach(function(o) {
            for(j=0;j<values[0].length;j++){
                if(j == o.id){
                    o.set('text',values[i][j]);
                }
            }
            if(o.id === values[0].length && useidserti){
                o.set('text', hashed_id_serti);
            }
            if(o.id === 'imgQr' && useqr){
                if(i === 1){
                    objectElement = new Array(o.id,o.getScaledWidth(),o.getScaledHeight(),o.left,o.top);
                }

                canvas.remove(o);

                generateqr(qrimg, objectElement, i);
            }
        });
    }

    //var flagG = false;
    var zip = new JSZip();
    var pdf;
    var formatexport = <?php echo $_COOKIE['sformat'];?>;

    //Fungsi untuk melakukan looping utama keseluruh row
    function loopG(){
        id=<?php echo $row['id']; ?>;
        for(i=1;i<values.length;i++){
            generateall(i);
            sendtoDB(i);
            canvas.discardActiveObject().renderAll();
            if(i === 1 || formatexport != 4){
            <?php 
            $pformat = $_COOKIE['sformat'];
            if($pformat == '"1"'){
                echo 'var imgData = cvs.toDataURL("image/png", 1.0);';
                if($psize == '"1"'){
                    echo 'pdf = new jsPDF("l","pt","a3");';
                }elseif($psize == '"2"'){
                    echo 'pdf = new jsPDF("l","pt","a4");';
                }elseif($psize == '"3"'){
                    echo 'pdf = new jsPDF("l","pt","a5");';
                }elseif($psize == '"4"'){
                    echo 'pdf = new jsPDF("l","pt","b4");';
                }elseif($psize == '"5"'){
                    echo 'pdf = new jsPDF("l","pt","b5");';
                }elseif($psize == '"6"'){
                    echo 'pdf = new jsPDF("l","pt","letter");';
                }
                echo 'var width = pdf.internal.pageSize.getWidth();
                    var height = pdf.internal.pageSize.getHeight();
                    pdf.addImage(imgData,"PNG", 0, 0, width, height);
                    zip.file(\'Sertifikat\'+i+\'.pdf\', pdf.output(\'blob\'));';
            }elseif($pformat == '"2"'){
                echo 'var imgData = cvs.toDataURL("image/png", 1.0);
                zip.file(\'Sertifikat\'+i+\'.png\', imgData.split(\'base64,\')[1],{base64: true});';
            }elseif($pformat == '"3"'){
                echo 'var imgData = cvs.toDataURL("image/jpg", 1.0);
                zip.file(\'Sertifikat\'+i+\'.jpeg\', imgData.split(\'base64,\')[1],{base64: true});';
            }elseif($pformat == '"4"'){
                    echo 'var imgData = cvs.toDataURL("image/png", 1.0);';
                    if($psize == '"1"'){
                        echo 'pdf = new jsPDF("l","pt","a3");';
                    }elseif($psize == '"2"' || $psize == 2){
                        echo 'pdf = new jsPDF("l","pt","a4");';
                    }elseif($psize == '"3"'){
                        echo 'pdf = new jsPDF("l","pt","a5");';
                    }elseif($psize == '"4"'){
                        echo 'pdf = new jsPDF("l","pt","b4");';
                    }elseif($psize == '"5"'){
                        echo 'pdf = new jsPDF("l","pt","b5");';
                    }elseif($psize == '"6"'){
                        echo 'pdf = new jsPDF("l","pt","letter");';
                    }
                    echo 'var width = pdf.internal.pageSize.getWidth();
                        var height = pdf.internal.pageSize.getHeight();
                        pdf.addImage(imgData,"PNG", 0, 0, width, height);';
            }
            ?>
            }else{
                var imgData = cvs.toDataURL("image/png", 1.0);
                var width = pdf.internal.pageSize.getWidth();
                var height = pdf.internal.pageSize.getHeight();
                pdf.addPage();
                pdf.addImage(imgData,"PNG", 0, 0, width, height);
            }
    
            /*  Increment Progress Bar
            var elem = document.getElementById("myBar");
            elem.style.width = 100 * i/(values.length) + "%";
            elem.innerHTML = 100 * i/(values.length)  + "%";*/
        }
        postGenerate();
    }

    //Mengembalikan isi canvas ke posisi sebelum generate
    function postGenerate(){
        var objects = canvas.getObjects();
        objects.forEach(function(o) {
            for(xy=0;xy<values[0].length;xy++){
                if(xy === o.id){
                    o.set({text: values[0][xy]});
                }
            }
            if(o.id === values[0].length && useidserti){
                o.set('text', 'Serial Sertifikat (32 Digit)');
            }
            if(o.id === 'imgQr' && useqr){
                canvas.remove(o);
                fabric.Image.fromURL(img.src, function(oImg) { 
                    oImg.set({id: 'imgQr',
                        originX: 'center', 
                        originY: 'center',
                        id: objectElement[0],
                        scaleX: objectElement[1] / 203,
                        scaleY: objectElement[2] / 203,
                        left: objectElement[3],
                        top: objectElement[4]
                    });
                    canvas.add(oImg);
                });
            }
        });
        canvas.renderAll();
    }
    var indexnamapeserta;

    function getIndexNamaPeserta(){
        for(index=0;index<values[0].length;index++){
            if(values[0][index].toLowerCase() == "nama" || values[0][index].toLowerCase() == "name"){
                return index;
            }
        }
    }
    // generate sertifikat
    $(document).ready(function(){
        $("#generate").click(function(){
            indexnamapeserta = getIndexNamaPeserta();
            generateAllQr();
            preloadQr();
            
            $("#ModalImg").attr("src","assets/images/a-loader.gif");
            
            $("#myModal").modal({
                backdrop: "static", //remove ability to close modal with click
                keyboard: false, //remove option to close with keyboard
                show: true //Display loader!
            });

            

            $("#myModal").one('shown.bs.modal', function(){
                loopG();
                if(formatexport != 4){
                    zip.generateAsync({type:"blob"}).then(function (blob) {
                        saveAs(blob, "SertifikatBundle.zip");
                    }, function (err) {
                        jQuery("#blob").text(err);
                    })
                }else{
                    pdf.save('SertifikatBundle.pdf');
                }
                $('#myModal').modal('hide');
            });

            return;
        });
        return;
    });

    function sendtoDB(i){
        var dataString = 'id_ser='+id_serti+'&nama='+values[i][indexnamapeserta]+'&username='+username+'&serial='+hashed_id_serti;
        $.ajax
        ({
            url: "sendtoDB.php",
            type : "GET",
            cache : false,
            data : dataString
        });
    }

    canvas.renderAll();

    </script>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/popper/popper.min.js"></script>
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
</body>
</html>
