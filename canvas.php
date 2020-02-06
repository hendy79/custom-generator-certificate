<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generator Sertifikat</title>
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Custom JavaScript -->
    <link href="dist/css/pages/progressbar-page.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/fabric/dist/fabric.min.js"></script>
    <script src="node_modules/jszip/dist/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
<!-- canvas -->
<?php
    $psize = $_COOKIE['spsize'];
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
    echo '<canvas id="bg" width="'.$width.'" height="'.$height.'" style="border:1px solid black;"></canvas>';
?>
<!-- end canvas -->

<!-- tambah gambar -->
<input type="file" onchange="previewFile()" id="fileinput">
<img src="" height="200" alt="Image preview...">
<!-- end tambah gambar -->

<!-- fit to background -->
<button id="ftbg" onclick="fitSelectedObject()" >Fit to Background</button>
<!-- end fit to background -->


<!-- delete all -->
<button id="delall">Delete All</button>
<!-- end delete all -->

<!-- delete selected layer -->
<button id="delsel">Delete</button>
<!-- end delete selected layer -->

<!-- add text -->
<button id="addtxt">Add Text</button>
<!-- end add text -->

<!-- send to back -->
<button onclick="sendSelectedObjectBack()">Send To back</button><!-- semua layer -->
<!-- end send to back -->
<!-- bring to front -->
<button onclick="sendSelectedObjectFront()">Send To Front</button>
<!-- semua layer -->
<!-- end send to back -->
<!-- send to back -->
<button onclick="sendSelectedObjectBackward()">bring backward</button>
<!-- satu layer -->
<!-- end send to back -->
<!-- send to back -->
<button onclick="sendSelectedObjectForward()">bring forward</button>
<!-- end send to back -->
<!-- change color -->
<input type="color" id="warna">
<!-- end change color -->
<!-- set font-family -->
<select id="fontFamily" name="fontFamily">
    <option value="" disabled selected>Font Family</option>
    <option value="Times New Roman">Times New Roman</option>
    <option value="candara">Candara</option>
    <option value="calibri">Calibri</option>
    <option value="sans-serif">Sans-Serif</option>
    <option value="monospace">Monospace</option>
    <option value="cursive">Cursive</option>
    <option value="arial">Arial</option>
    <option value="courier">Courier</option>
    <option value="tahoma">Impact</option>
    <option value="impact">Tahoma</option>
    <option value="Brush Script MT">Brush Script MT</option>
</select>
<!-- end set font-family -->

<!-- set font-size -->
<input type="number" id="fontSize" name="points" step="1" placeholder="Font Size">
<!-- end set font-size -->

<!-- generate canvas -->
<button id="generate">Generate!</button>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog center-screen">
            <!-- <div class="progress">
                <div class="progress-bar" role="progressbar" id="myBar" style="width:0%">
                <small class="justify-content-center d-flex position-absolute w-100">0%</small>
                </div>
            </div> -->
            <div class="center-screen">
                <img src="assets/images/a-loader.gif" alt="">
            </div>
        </div>
    </div>
</div>  

    <script>
    var values = <?php echo $_COOKIE['values']; ?>;
    var canvas = new fabric.Canvas('bg',{preserveObjectStacking :true});

    

    // upload gambar
    function previewFile() {
        var preview = document.querySelector('img');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            fabric.Image.fromURL(preview.src, function(oImg) { 
                oImg.scaleToWidth(50);
                oImg.scaleToHeight(50);
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
        canvas.add(text[i]);
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

    // generate values
    /*canvas.getObjects().forEach(function(o) {
        for(j=0;j<i;j++){
            if(j == o.id){
                o.set('text',values[1][j]);
            }
        }
    });*/
    
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
    var ctx = canvas.getContext("2d");

    // generate sertifikat
    $(document).ready(function(){
        $("#generate").click(function(){
            //$("#myModal").modal("show");
            $("#myModal").modal({
                backdrop: "static", //remove ability to close modal with click
                keyboard: false, //remove option to close with keyboard
                show: true //Display loader!
                
            });

            $("#myModal").on('shown.bs.modal', function(){
            var zip = new JSZip();
            for(i=1;i<values.length;i++){
                canvas.getObjects().forEach(function(o) {
                    for(j=0;j<values[0].length;j++){
                        if(j == o.id){
                            o.set('text',values[i][j]);
                        }
                    }
                });
                canvas.renderAll();
                <?php 
                $pformat = $_COOKIE['sformat'];
                if($pformat == '"1"'){
                    echo 'var imgData = cvs.toDataURL("image/png", 1.0);';
                        if($psize == '"1"'){
                            echo 'var pdf = new jsPDF("l","pt","a3");';
                        }elseif($psize == '"2"'){
                            echo 'var pdf = new jsPDF("l","pt","a4");';
                        }elseif($psize == '"3"'){
                            echo 'var pdf = new jsPDF("l","pt","a5");';
                        }elseif($psize == '"4"'){
                            echo 'var pdf = new jsPDF("l","pt","b4");';
                        }elseif($psize == '"5"'){
                            echo 'var pdf = new jsPDF("l","pt","b5");';
                        }elseif($psize == '"6"'){
                            echo 'var pdf = new jsPDF("l","pt","letter");';
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
                }
                ?>
        
                /*  Increment Progress Bar
                var elem = document.getElementById("myBar");
                elem.style.width = 100 * i/(values.length) + "%";
                elem.innerHTML = 100 * i/(values.length)  + "%";*/

            }
            zip.generateAsync({type:"blob"}).then(function (blob) {
                saveAs(blob, "SertifikatBundle.zip");
            }, function (err) {
                jQuery("#blob").text(err);
            });
                /* Increment Progress Bar
                var elem = document.getElementById("myBar");
                elem.style.width = 100  + "%";
                elem.innerHTML = 100  + "%";*/
                alert("Berhasil generate "+i+" Sertifikat !!");
                $('#myModal').modal('hide');  
                
            });
        });
    });

    canvas.renderAll();

    </script>

</body>
</html>