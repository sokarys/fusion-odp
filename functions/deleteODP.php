<?php
include 'deleteODPFIle.php';
if(isset($_GET['model'])){
    deleteODPFile($_GET['model'],true);

}
if(isset($_GET['fichier'])){
    deleteODPFile($_GET['fichier'],false);

}
?>
