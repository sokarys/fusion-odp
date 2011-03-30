<?php
function zip(){
    echo "***********************************************<br/>";
    echo " ZIP<br/>";
    echo "***********************************************<br/>";

    $urlDirSource = "./../document/resultat";
    $urlDirTarget = "./../document/final";
    $finalName = "resulat".time().".odp";

    # Parcours du répertoire courant à la recherche des fichiers php qui constitueront la liste des fichiers à zipper
    $repertoire = $urlDirSource;
    $fichiers = array();
    $dir = opendir($repertoire);
    while (($file = readdir($dir)) !== FALSE) {
        echo($file);
        if ($file == '.' or $file == '..' or $file == '.svn') {
            echo(" NOK"."<br/>");
            continue;
        }
        if (preg_match('/\.php[45]?$/', $file)) {
            echo(" OK"."<br/>");
            $fichiers[] = $file;
        }
        echo("<br/>");
    }
    closedir($dir);

    creer_archive($urlDirTarget."/".$finalName, $fichiers, "")
        or die("Echec lors de la création de l'archive");
}

function creer_archive($nom, $fichiers, $commentaire = '')
{
    if (is_array($fichiers)) {
        $zip = new ZipArchive();
        if ($zip->open($nom, ZIPARCHIVE::OVERWRITE) !== TRUE) {
            return FALSE;
        }
        foreach ($fichiers as $k => $f) {
            if (!$zip->addFile($f)) {
                return FALSE;
            }
            if (is_string($k)) {
                $zip->setCommentName($f, $k);
            }
        }
        if ($commentaire) {
            $zip->setArchiveComment($commentaire);
        }
        return $zip->close();
    }
    return FALSE;
}
?>