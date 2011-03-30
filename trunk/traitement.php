<?php
include_once 'functions/unzip.php';
include_once 'functions/executeXSLContenu.php';
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
    executeXSLContenu();
}else{
   echo("Cette page n'est pas accessible !!!");
}
?>
