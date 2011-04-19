<?php
include('./../functions/chmodr.php');
include('./../functions/unzip.php');
include('./../functions/zip.php');
include('./../functions/executeXSLContenu.php');
include('./../functions/executeXSLhtml.php');
include('./../functions/recursiveCopy.php');
include('./../functions/picturesCopy.php');
include('./../functions/deleteTempFiles.php');

if(isset($_POST)){
    $dom = new DomDocument('1.0', 'utf-8');
    $node=$dom->createElement("list");
    $dom->appendChild($node);
    foreach($_POST['document'] as $valeur)
    {
        $valeur_fin = str_replace(".odp","",$valeur);
        $nodeDoc=$dom->createElement("doc");
        $nodeDoc->setAttribute("src", $valeur_fin);
        $node->appendChild($nodeDoc);
    }
    $dom->save('./../xslt/list.xml');
    chmod('./../xslt/list.xml',0777);

    //renamme et deplacement de model
        $dirname = './../document/temp_model/';
         $dir = opendir($dirname);
         while($file = readdir($dir)) {
            if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file))
            {
            rename($dirname.$file, $dirname."model.odp");
           
            }
         } 
        copy ($dirname."model.odp","./../document/temp/model.odp");
        unlink($dirname."model.odp");
        unzip();
        recursiveCopy('./../xslt/tmp/model', './../document/resultat');
        picturesCopy();
        executeXSLContenu();
        $finalName = "resulat".time();
        executeXSLcss($finalName.".html");
        rename($finalName.".html", $finalName.".css");
        executeXSLhtml($finalName.".html");        
        zip($finalName.".odp");
        deleteTempFiles();
        header('Location: ../odp.php?resultat='.$finalName);
}else{
   echo("Cette page n'est pas accessible !!!");
}
?>
