<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/fabric/dist/fabric.min.js"></script>
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
<input type="file" onchange="previewFile()">
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
<button onclick="sendSelectedObjectBack()">Send To back</button>
<!-- end send to back -->

<!-- generate canvas -->
<button id="generate">Generate!</button>


    <script>
    var values = <?php echo $_COOKIE['values'];?>;
    var canvas = new fabric.Canvas('bg');

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
    };


    // upload background
    var object;
    canvas.on('object:selected', function(event) {
    object = event.target;
    });

    var fitSelectedObject = function() {
        canvas.set({
                    scaleX: 300 / canvas.width,
                });
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
        canvas.remove(canvas.getActiveObject());
    });
    });

    // input text manual
    $(document).ready(function(){
    $("#addtxt").click(function(){
        var txtmnl = new fabric.IText("your text here ...");
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
            centeredScaling: true,});
        textId = i;
        canvas.add(text[i]);
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
    var objectToSendBack;
    canvas.on('object:selected', function(event) {
    objectToSendBack = event.target;
    });

    var sendSelectedObjectBack = function() {
    canvas.sendToBack(objectToSendBack);
    }

    var rect = new fabric.Rect({
        left : 100,
        top : 150,
        fill : 'red',
        width : 200,
        height :20
    });
    
    canvas.add(rect);


    // generate sertifikat
    $(document).ready(function(){
        $("#generate").click(function(){
            for(i=1;i<values.length;i++){
                canvas.getObjects().forEach(function(o) {
                    for(j=0;j<values[0].length;j++){
                        if(j == o.id){
                            o.set('text',values[i][j]);
                        }
                    }
                });
                canvas.renderAll();
            }
        });
    });

    canvas.renderAll();

    </script>

</body>
</html>