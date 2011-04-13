<?php

function executeXSLhtml($name){
    echo "<br/>";
    echo "***********************************************<br/>";
    echo " EXECUTEXSLHTML<br/>";
    echo "***********************************************<br/>";
    echo "<pre>";
    $urlSource = "./../document/resultat/content.xml";
    $urlXSL = "./../xslt/copyFinal.xsl";
    $urlDirTarget = "./../document/final/";
    $urlTarget = $urlDirTarget.$name;
    $xml = new DOMDocument();
    $xml->load($urlSource);

    $xsl = new DOMDocument();
    $xsl->load($urlXSL);

    $proc = new XSLTProcessor();
    $proc->importStyleSheet($xsl);


    $newFile = fopen($urlTarget, "w+");
    fputs($newFile, $proc->transformToURI($xml));

    fclose($newFile);
    chmod($urlTarget,0777);
    echo "</pre>";
}

?>
