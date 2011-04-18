<?php
include 'deleteODPFIle.php';
include 'deleteResultat.php';
if(isset($_GET['model'])){
    deleteODPFile($_GET['model'],true);

}
if(isset($_GET['fichier'])){
    deleteODPFile($_GET['fichier'],false);

}
if(isset($_GET['final'])){
    deleteResultat($_GET['final']);

}
?>
