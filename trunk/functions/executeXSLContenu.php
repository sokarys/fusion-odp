<?php
function executeXSLContenu(){
    echo "***********************************************<br/>";
    echo " EXECUTEXSLCONTENU<br/>";
    echo "***********************************************<br/>";

    $urlSource = "./../xslt/list.xml";
    $urlXSL = "./../xslt/copyFinal.xsl";
    $urlDirTarget = "./../document/resultat/";
    $urlTarget = $urlDirTarget."content.xml";
    $xml = new DOMDocument();
    $xml->load($urlSource);

    $xsl = new DOMDocument();
    $xsl->load($urlXSL);

    $proc = new XSLTProcessor();
    $proc->importStyleSheet($xsl);


    $newFile = fopen($urlTarget, "w+");
    fputs($newFile, $proc->transformToXml($xml));
    
    fclose($newFile);
    chmod($urlTarget,0777);
}
?>
