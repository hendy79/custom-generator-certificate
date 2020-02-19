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
    require_once 'config.php';

    // Get posted object
    $json = json_decode(file_get_contents('php://input'), true);
    
    // Backup file by moving it to csvbackup folder. If file exists it will be overwritten!
    $csvfile = $json["csvfile"];
    $csvfileorg = SDFE_CSVFolder . "/" . $csvfile;
    $csvfilebackup = SDFE_CSVFolderBackup . "/" . $csvfile;
    copy($csvfileorg, $csvfilebackup);
    
    // Read first line (header) from current CSV file
    $newcsvfile = fopen($csvfileorg, "r") or die("Unable to open file!");
    $header = fgets($newcsvfile);
    fclose($newcsvfile);
    
    // Delete existing data in current CSV file and Write new content
    $newcsvfile = fopen($csvfileorg, "w") or die("Unable to open file!");

    // write header
    fwrite($newcsvfile, $header);

    $columns = $json["columns"];
    $lines = $json["lines"];
    
    // for every line array lopp through and write a line to the csv
    for($lineCnt=0; $lineCnt<$lines; $lineCnt++) {
        $lineContent = ""; // reset line content
        $lineObj = $json["data"]["line-".$lineCnt];
        for($columnCnt=0; $columnCnt<$columns; $columnCnt++) {
            if($columnCnt>0) {
                $lineContent .= SDFE_CSVSeparator;
            }
            $lineContent .= $lineObj["col-".$columnCnt]; 
        }

        // add new line char to the end of line
        if($lineCnt<$lines-1) {
            $lineContent .= SDFE_CSVLineTerminator;
        }
        // write line content
        fwrite($newcsvfile, $lineContent);
    }
    fclose($newcsvfile);

    return;
?>