<?php

function executeXSLcss($name){
    echo "<br/>";
    echo "***********************************************<br/>";
    echo " EXECUTEXSLCSS<br/>";
    echo "***********************************************<br/>";
    echo "<pre>";
    $urlSource = "./../document/resultat/styles.xml";
    $urlXSL = "./../xslt/createCSS.xsl";
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
