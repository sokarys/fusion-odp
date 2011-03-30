<?php
$file = $_FILES['file'];
echo 'plop';
        //upload
        $dossier = './document/temp/';
        $fichier = basename($file['name']);
        $extensions = array('.odp');
        $extension = strrchr($file['name'], '.');
        //Début des vérifications de sécurité...
        if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
             $erreur = 'Vous devez uploader un fichier de type odp.';
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
             //On formate le nom du fichier ici...
             $fichier = strtr($fichier,
                  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
             $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
             if(move_uploaded_file($file['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
             {
                  //echo 'Upload effectué avec succès !';
             }
             else //Sinon (la fonction renvoie FALSE).
             {
                 // echo 'Echec de l\'upload !';
             }
        }
        if(isset($_FILES['modele']['name'])){
            echo("Votre modèle : ".$_FILES['modele']['name']);
        }else{
           echo("Veuillez sélectionner un modèle.");
        }

?>