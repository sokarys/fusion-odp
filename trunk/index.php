<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Compilez vos présentations OPD</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="./jquery/css/ui-lightness/jquery-ui-1.8.6.custom.css"/>
    <link rel="stylesheet" href="style.css"/>
    <script src="./jquery/js/jquery-1.4.2.min.js"></script>
    <script src="./jquery/js/jquery-ui-1.8.6.custom.min.js"></script>
    
    <style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
    </style>
	<script>
	$(function() {
		$( "#sortable" ).sortable({
			placeholder: "ui-state-highlight"
		});
		$( "#sortable" ).disableSelection();
	});
	</script>

</head>
<body>
    <form action="index.php" enctype="multipart/form-data" method="post">
        <fieldset>
            <caption>Model à appliquer à votre présentation</caption>
            <input name="modele[]" type="file" size="50" maxlength="100000" accept="text/*"/><br/>
            <caption>Vos présentations à fusionner</caption>
            <input name="fichier[]" type="file" size="50" maxlength="100000" accept="text/*"/>
        </fieldset>
        <input type="submit" name="Envoyer"/>
    </form>
    <?php
    //upload
    if(isset($_FILES['fichier'])){
        if($_FILES['fichier']['name'][0] !=""){
            $dossier = './document/temp/';
            $fichier = basename($_FILES['fichier']['name'][0]);
            $extensions = array('.odp');
            $extension = strrchr($_FILES['fichier']['name'][0], '.');
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
                 if(move_uploaded_file($_FILES['fichier']['tmp_name'][0], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                 {
                      echo 'Upload effectué avec succès !';
                 }
                 else //Sinon (la fonction renvoie FALSE).
                 {
                      echo 'Echec de l\'upload !';
                 }
            }
            else
            {
                 echo $erreur;
            }
        }else if(isset($_FILES['modele']['name'][0])){
            $dossier = './document/temp_model/';
            $fichier = basename($_FILES['modele']['name'][0]);
            $extensions = array('.odp');
            $extension = strrchr($_FILES['modele']['name'][0], '.');
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
                 if(move_uploaded_file($_FILES['modele']['tmp_name'][0], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                 {
                      echo 'Upload effectué avec succès !';
                 }
                 else //Sinon (la fonction renvoie FALSE).
                 {
                      echo 'Echec de l\'upload !';
                 }
            }
            else
            {
                 echo $erreur;
            }
        }
    }
    ?>




    <form action="./scripts/traitement.php" enctype="multipart/form-data" method="post">

        <div class="block_fichier ui-widget-header">
            <ul id="ul_modele">
            <?php
                 $dirname = './document/temp_model';
                 $dir = opendir($dirname);
                 while($file = readdir($dir)) {
                    if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file))
                    {
                    echo '<li class="ui-state-default"><input type="hidden" name="document[]" value="'.$file.'"/>'.$file.'</li>';
                    }
                    }
            ?>
            </ul>
        </div>
        
        <div class="block_fichier ui-widget-header">
            <ul id="sortable">
            <?php
                 $dirname = './document/temp';
                 $dir = opendir($dirname);
                 while($file = readdir($dir)) {
                    if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file))
                    {
                    echo '<li class="ui-state-default"><input type="hidden" name="document[]" value="'.$file.'"/>'.$file.'</li>';
                    }
                    }
            ?>
        </ul>
        </div>
       <input type="submit" value="Créer la présentation"/>
    </form>
</body>
</html>