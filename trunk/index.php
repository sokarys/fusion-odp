<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Compilez vos présentations OPD</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
</body>
</html>



    
