<?php
function zip($finalName){
    echo "<br/>";
    echo "***********************************************<br/>";
    echo " ZIP<br/>";
    echo "***********************************************<br/>";

    $urlDirSource = "./../document/resultat";
    $urlDirTarget = "./../document/final";    

    $zip = new ZipArchive();
    if ($zip->open($urlDirTarget."/".$finalName, ZipArchive::OVERWRITE) !== TRUE) {
        die("Impossible de créer l'archive");
    }
    zip_recursif( $urlDirSource, $zip);
    echo($urlDirTarget."/".$finalName);
    $zip->close();
}

function zip_recursif($chemin, $zip, $prefixe = '')
{
    if (substr($chemin, -1, 1) != DIRECTORY_SEPARATOR) {
        $chemin .= DIRECTORY_SEPARATOR;
    }
    if (file_exists($chemin)) {
        if (is_dir($chemin)) {
            if (!($dh = opendir($chemin))) {
                return FALSE;
            }
            while (($fichier = readdir($dh)) !== FALSE) {
                if ($fichier == '.' || $fichier == '..') {
                    continue;
                }
                if (is_dir($chemin . $fichier)) {
                    $zip->addEmptyDir($prefixe . $fichier);
                    if (!zip_recursif($chemin . $fichier . DIRECTORY_SEPARATOR, $zip, $prefixe . $fichier . DIRECTORY_SEPARATOR)) {
                        return FALSE;
                    }
                } else {
                    if (!$zip->addFile($chemin . $fichier, $prefixe . $fichier)) {
                        return FALSE;
                    }
                }
            }
            closedir($dh);
            return TRUE;
        } else {
            if (!$zip->addFile($chemin)) {
                return FALSE;
            }
            return TRUE;
        }
    }
    return FALSE;
}
?>