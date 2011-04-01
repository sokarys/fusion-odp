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
	
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#dialog-confirm" ).dialog({
                        autoOpen: false,
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"ODP": function() {
					$( this ).dialog( "close" );
                                        document.formList.submit();
				},
                                "HTML5": function() {
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
                $( "#dialog-message, #dialog-message2" ).dialog({
                        autoOpen: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	});
        function openDialogue(){
        var contenu = $.trim($("#ul_modele").html());
        var contenu2 = $.trim($("#sortable").html());
            if(contenu == "")
                $("#dialog-message").dialog('open');
            else if(contenu2 == "")
                $("#dialog-message2").dialog('open');
            else
                $("#dialog-confirm").dialog('open');

        }
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
    include('./functions/deleteODPFIle.php');
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




    <form name="formList" action="./scripts/traitement.php" enctype="multipart/form-data" method="post">

        <div class="block_fichier ui-widget-header">
            <ul id="ul_modele">
            <?php
                 $dirname = './document/temp_model';
                 $dir = opendir($dirname);
                 while($file = readdir($dir)) {
                    if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file))
                    {
                    echo '<li class="ui-state-default">'.$file.'<img style="padding-left: 88%;" src="./jquery/css/icon_delete_action.gif" onclick="deleteODPFile(\''.$file.'\',true);"/><input type="hidden" name="modele[]" value="'.$file.'"/></li>';
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
                    echo '<li class="ui-state-default"><input type="hidden" name="document[]" value="'.$file.'"/>'.$file.'<img style="padding-left: 88%;" src="./jquery/css/icon_delete_action.gif" onclick="deleteODPFile(\''.$file.'\',false);"/></li>';
                    }
                    }
            ?>
        </ul>
        </div>
        
       <input type="button" value="Créer la présentation" onclick="javascript:openDialogue();"/>
    </form>

<div id="dialog-confirm" title="Quel format voulez-vous ?">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
<div id="dialog-message" title="Fichiers manquants">
	<p>
		<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
		Le modèle de votre présentation est manquant. Veuillez le rajouter.
	</p>

</div>
    <div id="dialog-message2" title="Fichiers manquants">
	<p>
		<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
		Vous avez oublié votre présentation. Veuillez la rajouter.
	</p>

</div>


</body>
</html>