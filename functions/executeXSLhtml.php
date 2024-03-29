<?php

function executeXSLhtml($name){
    echo "<br/>";
    echo "***********************************************<br/>";
    echo " EXECUTEXSLHTML<br/>";
    echo "***********************************************<br/>";
    echo "<pre>";
    $urlSource = "./../document/resultat/content.xml";
    $urlXSL = "./../xslt/createHTML5.xsl";
    $urlDirTarget = "./../document/final/";
    $urlTarget = $urlDirTarget.$name;
    $xml = new DOMDocument();
    $xml->load($urlSource);

    $xsl = new DOMDocument();
    $xsl->load($urlXSL);

    $proc = new XSLTProcessor();
    $proc->importStyleSheet($xsl);


    $proc->transformToURI($xml,$urlDirTarget.$name);

    echo "</pre>";
}

?>
