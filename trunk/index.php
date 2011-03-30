<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Compilez vos présentations OPD</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="./jquery/jquery-upload/jquery.fileupload-ui.css"/>
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
    <form id="file_upload" action="index.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" multiple/>
    <button>Upload</button>
    <div>Upload files</div>
    </form>
    <table id="files"></table>
        <script src="./jquery/jquery-upload/jquery.fileupload.js"></script>
        <script src="./jquery/jquery-upload/jquery.fileupload-ui.js"></script>
        <script>
        /*global $ */
        $(function () {
            $('#file_upload').fileUploadUI({
                uploadTable: $('#files'),
                downloadTable: $('#files'),
                buildUploadRow: function (files, index) {
                    return $('<tr><td>' + files[index].name + '<\/td>' +
                            '<td class="file_upload_progress"><div><\/div><\/td>' +
                            '<td class="file_upload_cancel">' +
                            '<button class="ui-state-default ui-corner-all" title="Cancel">' +
                            '<span class="ui-icon ui-icon-cancel">Cancel<\/span>' +
                            '<\/button><\/td><\/tr>');
                },
                buildDownloadRow: function (file) {
                    return $('<tr><td>' + file.name + '<\/td><\/tr>');
                }
            });
        });
        </script>
    <form action="index.php" enctype="multipart/form-data" method="post">
        <fieldset>
            <caption>Modèle à appliquer à votre présentation</caption>
            <input name="modele" type="file" size="50" maxlength="100000"/><br/>
            <caption>Vos présentations à fusionner</caption>
            <input name="fichier[]" type="file" size="50" maxlength="100000" accept="text/*"/>
        </fieldset>
        <input type="submit" name="Envoyer"/>
    </form>
    <?php
    //upload
    $dossier = './document/temp/';
    print_r($_FILES);
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
    if(isset($_FILES['modele']['name'])){
        echo("Votre modèle : ".$_FILES['modele']['name']);
    }
    else{
       echo("Veuillez sélectionner un modèle.");
    }
    ?>




    <form action="traitement.php" enctype="multipart/form-data" method="post">
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
       <input type="submit" value="Créer la présentation"/>
    </form>
</body>
</html>



    
