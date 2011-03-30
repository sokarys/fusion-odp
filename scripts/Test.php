<?php
include('./../functions/chmodr.php');
include('./../functions/unzip.php');
include('./../functions/zip.php');
include('./../functions/executeXSLContenu.php');
include('./../functions/recursiveCopy.php');
include('./../functions/picturesCopy.php');

unzip();
smartCopy('./../xslt/tmp/model', './../document/resultat');
picturesCopy();
executeXSLContenu();
zip();
?>
