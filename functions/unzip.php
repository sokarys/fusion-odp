<?php
function unzip(){
    echo "***********************************************<br/>";
    echo " UNZIP<br/>";
    echo "***********************************************<br/>";
    $urlDirSource = "./../document/temp/";
    $urlDirTarget = "./../xslt/tmp/";

    $dirSource = opendir($urlDirSource) or die('Erreur');
    echo '<ul>';
	while($file = @readdir($dirSource)) {
            if($file != ".svn" && $file != "." && $file != ".."){
                $zip = new ZipArchive;
                if ($zip->open($urlDirSource.$file) == TRUE) {
                    $dirZip = explode(".",$file);
                    echo($file);
                    $zip->extractTo($urlDirTarget.$dirZip[0]."/");
                    $zip->close();
                    echo '<ul>';
                    chmodr($urlDirTarget.$dirZip[0],0777);
                    echo '</ul>';
                    echo ' ok<br/>';
                } else {
                    echo ' échec<br/>';
                }
            }
	}
    echo '</ul>';
    closedir($dirSource);
}
?>