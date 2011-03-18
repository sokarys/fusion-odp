<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Compilez vos présentations OPD</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
            <caption>Modèle à appliquer à votre présentation</caption>
            <input name="modele" type="file" size="50" maxlength="100000"/><br/>
            <caption>Vos présentations à fusionner</caption>
            <input name="fichier[]" type="file" size="50" maxlength="100000" accept="text/*"/>
        </fieldset>
        <input type="submit" name="Envoyer"/>
    </form>
    <?php    
    if(isset($_FILES['modele']['name'])){
        echo("Votre modèle : ".$_FILES['modele']['name']);
    }
    else{
       echo("Veuillez sélectionner un modèle.");
    }
    ?>
    <form action="traitement.php" enctype="multipart/form-data" method="post">
        <ul id="sortable">
            <li class="ui-state-default"><input type="hidden" name=document[]" value="t1"/>Item 1</li>
            <li class="ui-state-default"><input type="hidden" name=document[]" value="t2"/>Item 2</li>
            <li class="ui-state-default">Item 3</li>
            <li class="ui-state-default">Item 4</li>
            <li class="ui-state-default">Item 5</li>
            <li class="ui-state-default">Item 6</li>
            <li class="ui-state-default">Item 7</li>
        </ul>
       <input type="submit" value="Créer la présentation"/>
    </form>
</body>
</html>



    
