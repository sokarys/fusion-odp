<?php
function executeXSLContenu(){
    $urlSource = "./../xslt/list.xml";
    $urlXSL = "./../xslt/copyFinal.xsl";
    $urlTarget = "./../document/resultat/content.xml";
    echo($urlSource);
    $xml = new DOMDocument;
    $xml->load($urlSource);

    $xsl = new DOMDocument;
    $xsl->load($urlXSL);

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);

    $newFile = fopen($urlTarget, "w+");
    fputs($newFile, $proc->transformToXML($xml));
    fclose($newFile);
}
?>
