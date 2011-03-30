<?php
include('./../functions/chmodr.php');
include('./../functions/unzip.php');
include('./../functions/zip.php');
include('./../functions/executeXSLContenu.php');
include('./../functions/recursiveCopy.php');
include('./../functions/picturesCopy.php');

if(isset($_POST)){
    $dom = new DomDocument('1.0', 'utf-8');
    $node=$dom->createElement("list");
    $dom->appendChild($node);
    foreach($_POST['document'] as $valeur)
    {
        $nodeDoc=$dom->createElement("doc");
        $nodeDoc->setAttribute("src", $valeur);
        $node->appendChild($nodeDoc);
    }
    $dom->save('./xslt/list.xml');

    //renamme et deplacement de model
        $dirname = '../document/temp_model';
         $dir = opendir($dirname);
         while($file = readdir($dir)) {
            if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file))
            {
            rename($dirname.$file, "../temp/.$file");
            }
         }

    rename("./document", "/home/user/login/docs/my_file.txt");
    unzip();
    smartCopy('./../xslt/tmp/model', './../document/resultat');
    picturesCopy();
    executeXSLContenu();
}else{
   echo("Cette page n'est pas accessible !!!");
}
?>
