<?php

function deleteTempFiles(){
    echo "***********************************************<br/>";
    echo " DELETE TEMP FILES<br/>";
    echo "***********************************************<br/>";

    echo "DELETED FILES :<br/>";
    
    $tempFilesDirectory = "./../document/temp";
    $tempModelDirectory = "./../document/temp_model";

    $files = glob($tempFilesDirectory."/*.odp" );
    foreach ($files as $filename){
        if(unlink($filename)){ echo $filename."<br/>"; }else{ echo "ERROR: ".$filename."<br/>"; }   
    }


    $files = glob($tempModelDirectory."/*.odp" );
    foreach ($files as $filename){
        if(unlink($filename)){ echo $filename."<br/>"; }else{ echo "ERROR: ".$filename."<br/>"; }
    }
}
?>
