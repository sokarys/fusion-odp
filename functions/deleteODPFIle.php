<?php

function deleteODPFile($fileName,$model){
    echo "<br/>";
    echo "***********************************************<br/>";
    echo " DELETE ODP FILE<br/>";
    echo "***********************************************<br/>";

    if(isset($model) && $model == true){
        $ODPTempDirectory = "./../document/temp_model/";
    }else{
        $ODPTempDirectory = "./../document/temp/";
    }

    if(is_file($ODPTempDirectory.$fileName)){
        if(unlink($ODPTempDirectory.$fileName)){ echo $ODPTempDirectory.$fileName."<br/>"; }
    }else{
        echo "ERROR - File not found: ".$ODPTempDirectory.$fileName."<br/>";
    }
}
?>
