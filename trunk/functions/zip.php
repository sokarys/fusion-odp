<?php
function zip($filename){
    $zip = new ZipArchive;
    if ($zip->open($filename) === TRUE) {
        $zip->addFile('./../document/resumtat/', 'newname.txt');
        $zip->close();
        echo 'ok';
    } else {
        echo 'échec';
    }
}
?>
