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

    unzip();
    smartCopy('./../xslt/tmp/model', './../document/resultat');
    picturesCopy();
    executeXSLContenu();
}else{
   echo("Cette page n'est pas accessible !!!");
}
?>
