<?php
function unzip(){
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

function chmodr($path, $filemode) {
    if (!is_dir($path))
        return chmod($path, $filemode);

    $dh = opendir($path);
    while (($file = readdir($dh)) !== false) {
        if($file != '.' && $file != '..') {
            $fullpath = $path.'/'.$file;
            echo("<li>".$fullpath."</li>");
            if(is_link($fullpath))
                return FALSE;
            elseif(!is_dir($fullpath) && !chmod($fullpath, $filemode))
                    return FALSE;
            elseif(!chmodr($fullpath, $filemode))
                return FALSE;
        }
    }

    closedir($dh);

    if(chmod($path, $filemode))
        return TRUE;
    else
        return FALSE;
}
?>