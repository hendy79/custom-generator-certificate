<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- tittle -->
    <title>Canvas</title>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="canvas.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <span class="navbar-brand mb-0 h1 col-md-7">Nama_Sertifikat</span>

        <!-- JENIS FONT BUTTON -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Font tulisan
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" id="arial">Arial</a>
            <a class="dropdown-item" id="sans">Sans</a>
        </div>
        </div>

        <!-- ukuran kertas -->
        <div class="collapse navbar-collapse col-6 col-md-4" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0">
            <span class="navbar-brand mb-0 h3">Ukuran Kertas</span>
            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" id="btna4">A4</button>
            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" id="btna5">A5</button>
            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" id="btnltr">Letter</button>
            </form>
        </div>
    </nav>

<!-- Canvas -->
<!-- edit tools pake jquery -->
<div class="container mt-3">
<canvas id="myCanvas" width="842" height="595" style="border:1px solid black;"></canvas>
</div>


<!-- TOOLS -->
<!-- TODO: -->
<!-- geser atas, bwh,kiri,kanan, ganti font, ukuran font -->
<!-- add gambar, geser gambar, resize gambar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">

        <!-- ukuran font -->
        <input type="text" class="ml-4" placeholder="ukuran font..">
        <input type="submit" class="mr-5" >

        <!-- geser-->
        <!-- kiri -->
        <button id="geser1" class="btn btn-primary">kiri</button>
        <!-- atas -->
        <button id="geser2" class="btn btn-primary">atas</button>
        <!-- bawah -->
        <button id="geser3" class="btn btn-primary">bawah</button>
        <!-- kanan -->
        <button id="geser4" class="btn btn-primary">kanan</button>



        <div class="collapse navbar-collapse col-6 col-md-4 ml-5" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0">
                <!-- upload gambar -->
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
            </div>
            
            </form>
        </div>
    </nav>


        <script type="text/javascript">
            var canvas = document.getElementById("myCanvas");
            var ctx = canvas.getContext("2d");
            ctx.textAlign = 'center';
            var values = <?php echo $_COOKIE['values'];?>;
            // an array to store every word
            var recentWord = [];
            
            var koorx = canvas.width/2;
            var koory = canvas.height/2;

            function fontarial(){
                var jnshrf = "arial";
                ctx.font = "30px "+jnshrf;
            };

            function fontsans(){
                var jnshrf = "sans";
                ctx.font = "30px "+jnshrf;
            };

            function draw(){
                for(i=0;i<values[0].length;i++){
                    ctx.fillText(values[0][i],koorx,koory);
                }
            };
            ctx.font = "30px Arial"
            draw();

            // jquery ganti font sans
            $(document).ready(function(){
                $("#sans").click(function(){
                    // cls
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                // addagain
                fontsans();
                draw();
                });
            });
            // end
            
            // jquery ganti font arial
            $(document).ready(function(){
                $("#arial").click(function(){
                    // cls
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                // addagain
                fontarial();
                draw();
                });
            });
            // end

            ctx.font = "64px Arial";
            for(i=0;i<values[0].length;i++){
                ctx.strokeText(values[0][i],100,120);
            }
            recentWord.push(canvas.toDataURL('image/jpeg', 1.0));


            
            




            // variable koordinat mouse
            var mouseX = 0;
            var mouseY = 0;
            var startingX = 0;

            

            //function to save canvas state after key press
            function saveState(){
                undoList.push(canvas.toDataURL());
            }

            // function to called when backspace press
            var undoList = [];
            // function undo(){
            //     undoList.pop();

            //     var imgData = undoList[undoList.leght];
            //     var image = new image();

            //     // display old saved state
            //     image.src = imgData;
            //     image.onload = function(){
            //         context.clearRect(0,0, canvas.width, canvas.height);
            //         context.drawImage(image, 0, 0, canvas.width, canvas.height, 0, 0, canvas.width, canvas.height);
            //     }
            // }

            //by default, save the canvas state first
            saveState();


            //function pemanggil ketika mouse di click
            // function add(){
            // canvas.addEventListener("click", function(e){
            //     // get position on click
            //     mouseX = e.pageX - canvas.offsetLeft;
            //     mouseY = e.pageY - canvas.offsetTop;
            //     startingX = mouseX;
            //     var text = "User"
            //     var igm = ctx.fillText(text, mouseX, mouseY);
            //     recentWord.push(canvas.toDataURL('image/jpeg', 1.0));
                
            //     console.log(recentWord);
            //     return false;
            // },false);
            // }


            $(document).ready(function(){
                $("#tambah").click(function(){
                    canvas.addEventListener("click", function(e){
                        // get position on click
                        mouseX = e.pageX - canvas.offsetLeft;
                        mouseY = e.pageY - canvas.offsetTop;
                        startingX = mouseX;
                        var text = "User"
                        var igm = ctx.fillText(text, mouseX, mouseY);
                       
                        
                        return false;
                    },{once:true});
                });
            });


            

            // add keydown event to canvas
            // canvas.addEventListener("keydown",function(e){
            //     //set canvas font
            //     ctx.font = "6px Arial";
            //     var text = ""
            //     //write to canvas
            //     // ctx.fillText(text, mouseX, mouseY);

            //     // move cursor forward
            //     mouse += ctx.measureText(text).width;
            // },false);




        </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>