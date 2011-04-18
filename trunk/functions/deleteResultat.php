<?php

function deleteResultat($fileName){
    echo "<br/>";
    echo "***********************************************<br/>";
    echo " DELETE RESULTAT<br/>";
    echo "***********************************************<br/>";

        $ResultatDirectory = "./../document/final/";

    if(is_file($ResultatDirectory.$fileName)){
        if(unlink($ResultatDirectory.$fileName)){ echo $ResultatDirectory.$fileName."<br/>"; }
    }else{
        echo "ERROR - File not found: ".$ResultatDirectory.$fileName."<br/>";
    }
}
?>
