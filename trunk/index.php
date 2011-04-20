<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Fusionnez vos présentations ODP</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="./jquery/css/ui-lightness/jquery-ui-1.8.6.custom.css"/>
    <link rel="stylesheet" href="style.css"/>
    <script src="./jquery/js/jquery-1.4.2.min.js"></script>
    <script src="./jquery/js/jquery-ui-1.8.6.custom.min.js"></script> 
    <style>
	#sortable { list-style-type: none; margin: 0; padding: 0;}
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
    </style>
	<script>
	$(function() {
		$( "#sortable" ).sortable({ //drag and drop liste de fichier
			placeholder: "ui-state-highlight"
		});
		$( "#sortable" ).disableSelection();
	
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#dialog-confirm" ).dialog({ //pop up e dialogue
            autoOpen: false,
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"ODP": function() {
					$( this ).dialog( "close" );
                                        document.formList.submit();
				},
                "ODP+HTML5": function() {
					$( this ).dialog( "close" );
                                        $("#formList").attr("action","./scripts/traitement_html.php");
                                        document.formList.submit();
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
         $( "#dialog-message, #dialog-message2" ).dialog({ // popup de dialog
            autoOpen: false,
			resizable: false,
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
        function deleteOdp(name){ //supprimer le model
            $.ajax({
                type:"GET",
                url:"./functions/deleteODP.php?model="+name,
                success: function(msg){
                    document.location.href="index.php";
                }
            })
        }
        function deleteOdpfichier(fichier){ //supprimer une présentation
            $.ajax({
                type:"GET",
                url:"./functions/deleteODP.php?fichier="+fichier,
                success: function(msg){
                    document.location.href="index.php";
                }
            })
        }
        </script>
</head>
<body>
	<div id="main">
        <div id="header">   
        	<img src="images/text_03.png" width="500" height="70" />
        </div>
        <div id="content">
            <div id="uploadForm">
                <form action="index.php" enctype="multipart/form-data" method="post" name="uploadForm">
                    <fieldset>
                        <table class="uploadTable">
                            <tr>
                            	<td><img src="images/text_14.png" width="40" height="50" /></td>
                                <td class="uploadTitle">Modèle à appliquer à votre présentation :</td>
                                <td><input name="modele[]" type="file" size="40" maxlength="100000" accept="text/*"/></td>
                            </tr>
                            <tr>
                            	<td><img src="images/text_12.png" width="40" height="50" /></td>
                                <td class="uploadTitle">Vos présentations à fusionner :</td>
                                <td><input name="fichier[]" type="file" size="40" maxlength="100000" accept="text/*"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    <div id="uploadBtnSubmit">
                        <table cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td name="Envoyer" class="btnValidateTxt"><a href="javascript:document.uploadForm.submit();">Envoyer votre fichier</a></td>
                                <td width="40"><a href="javascript:document.uploadForm.submit();"><img src="images/text_16.png" width="40" height="50" /></a></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <div>
            	<div class="errorMessage">
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
                        if(!in_array($extension, $extensions)){ //Si l'extension n'est pas dans le tableau
                             $erreur = 'Vous devez uploader un fichier de type odp.';
                        }
                        if(!isset($erreur)){ //S'il n'y a pas d'erreur, on upload
                             //On formate le nom du fichier ici...
                             $fichier = strtr($fichier,
                                  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                                  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                             $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                             if(move_uploaded_file($_FILES['fichier']['tmp_name'][0], $dossier . $fichier)){ //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                                  echo '<img src="images/OK.png" width="24" height="24"/>'.'&nbsp;'.'Upload effectué avec succès !';
                             }else{ //Sinon (la fonction renvoie FALSE).
                                  echo '<img src="images/warning.png" width="24" height="24"/>'.'Echec de l\'upload !';
                             }
                        }else{
                             echo $erreur;
                        }
                    }else if(isset($_FILES['modele']['name'][0])){
                        $dossier = './document/temp_model/';
                        $fichier = basename($_FILES['modele']['name'][0]);
                        $extensions = array('.odp');
                        $extension = strrchr($_FILES['modele']['name'][0], '.');
                        //Début des vérifications de sécurité...
                        if(!in_array($extension, $extensions)){ //Si l'extension n'est pas dans le tableau
                             $erreur = 'Vous devez uploader un fichier de type odp.';
                        }
                        if(!isset($erreur)){ //S'il n'y a pas d'erreur, on upload
                             //On formate le nom du fichier ici...
                             $fichier = strtr($fichier,
                                  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                                  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                             $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                             if(move_uploaded_file($_FILES['modele']['tmp_name'][0], $dossier . $fichier)){ //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                                  echo '<img src="images/OK.png" width="24" height="24"/>'.'&nbsp;'.'Upload effectué avec succès !';
                             }else{ //Sinon (la fonction renvoie FALSE).
                                  echo '<img src="images/warning.png" width="24" height="24"/>'.'&nbsp;'.'Echec de l\'upload !';
                             }
                        }else{
                             echo '<img src="images/warning.png" width="24" height="24"/>'.'&nbsp;'.$erreur;
                        }
                    }
                }
                ?>
                </div>
    
                <form id="formList" name="formList" action="./scripts/traitement.php" enctype="multipart/form-data" method="post">
                    <div class="block_fichier ui-widget-header">
                    	<div class="ui-widget-header-top">
                        </div>
                        <div class="ui-widget-header-middle">
                            <ul id="ul_modele">
                            <?php
                                 $dirname = './document/temp_model';
                                 $dir = opendir($dirname);
                                 while($file = readdir($dir)) { //liste le modele courrant utilisé
                                    if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file)){
                                        echo '<li class="ui-state-default"><div class="odpElement"><img src="images/btnSupprimer.png" width="30" height="30" onclick="javascript:deleteOdp(\''.$file.'\')" style="cursor:pointer;"/>'.$file.'<input type="hidden" name="modele[]" value="'.$file.'"/></div></li>';
                                    }
                                 }
                            ?>
                            </ul>
                        </div>
                        <div class="ui-widget-header-bottom">
                        </div>
                    </div>
                    <div class="block_fichier ui-widget-header">
                        <div class="ui-widget-header-top">
                        </div>
                        <div class="ui-widget-header-middle">
                            <ul id="sortable">
                            <?php
                                 $dirname = './document/temp';
                                 $dir = opendir($dirname);
                                 while($file = readdir($dir)) { //liste les présentation à fusionné
                                    if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file)){
                                        echo '<li class="ui-state-default"><div class="odpElement"><input type="hidden" name="document[]" value="'.$file.'"/><img src="images/btnSupprimer.png" width="30" height="30" onclick="javascript:deleteOdpfichier(\''.$file.'\')" style="cursor:pointer;"/>'.$file.'</div></li>';
                                    }
                                 }
                            ?>
                            </ul>
                        </div>
                        <div class="ui-widget-header-bottom">
                        </div>
                    </div>
                    <div id="btnValidate">
                    	<table cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td name="Valider" class="btnValidateTxt"><a href="#Valider" onclick="javascript:openDialogue();">Créer la présentation</a></td>
                                <td width="40"><a href="#Valider" onclick="javascript:openDialogue();"><img src="images/text_10.png" width="40" height="50" /></a></td>
                            </tr>
                        </table>
                    </div>
                </form>
    
                <div id="dialog-confirm" title="Quel format voulez-vous ?">
                    <p>
                        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?
                    </p>
                </div>
                <div id="dialog-message" title="Fichiers manquants">
                    <p>
                        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>Le modèle de votre présentation est manquant. Veuillez le rajouter.
                    </p>
                </div>
                <div id="dialog-message2" title="Fichiers manquants">
                    <p>
                        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>Vous avez oublié votre présentation. Veuillez la rajouter.
                    </p>
                </div>
            </div>
        </div>
        <div id="footer">
      		<img src="images/text_06.png" width="160" height="30">
    	</div>
    </div>
</body>
</html>