<?php
function unzip($filename){
    $zip = new ZipArchive;
    if ($zip->open($filename) === TRUE) {
        $zip->extractTo('./../document/temp/');
        $zip->close();
        echo 'ok';
    } else {
        echo 'échec';
    }
}
?>