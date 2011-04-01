<?php

function picturesCopy(){
    echo "<br/>";
    echo "***********************************************<br/>";
    echo " PICTURESCOPY<br/>";
    echo "***********************************************<br/>";
    $urlDirSource = "./../xslt/tmp/";
    $urlDirPictures = "./../document/resultat/Pictures";

    $dirSource = opendir($urlDirSource) or die('Erreur');
    echo '<ul>';
	while($folder = @readdir($dirSource)) {
            $dirSource2 = opendir($urlDirSource.$folder) or die('Erreur');
            while($file = @readdir($dirSource2)){
                if($file == "Pictures"){
                    recursiveCopy($urlDirSource.$folder."/".$file, $urlDirPictures);
                }
            }
            closedir($dirSource2);
	}
    echo '</ul>';
    closedir($dirSource);
}

?>
