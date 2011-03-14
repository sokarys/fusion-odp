<?php

$doc = new DOMDocument();
$xsl = new XSLTProcessor();

$doc->load($xsl_filename);
$xsl->importStyleSheet($doc);

$doc->load($xml_filename);
echo $xsl->transformToXML($doc);

?>

<?php

// Load the XML source
$xml = new DOMDocument;
$xml->load('collection.xml');

$xsl = new DOMDocument;
$xsl->load('collection.xsl');

// Configure the transformer
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // attach the xsl rules

echo $proc->transformToXML($xml);

?>


