<?php
include('./../functions/chmodr.php');
include('./../functions/unzip.php');
include('./../functions/zip.php');
include('./../functions/executeXSLContenu.php');
include('./../functions/executeXSLhtml.php');
include('./../functions/executeXSLcss.php');
include('./../functions/recursiveCopy.php');
include('./../functions/picturesCopy.php');
include('./../functions/deleteTempFiles.php');

if(isset($_POST)){
     //crée le fichier list.xml
    $dom = new DomDocument('1.0', 'utf-8');
    $node=$dom->createElement("list");
    $dom->appendChild($node);
    foreach($_POST['document'] as $valeur)
    {
        $valeur_fin = str_replace(".odp","",$valeur);
        $nodeDoc=$dom->createElement("doc");
        $nodeDoc->setAttribute("src", $valeur_fin);
        $node->appendChild($nodeDoc);
    }
    $dom->save('./../xslt/list.xml');
    chmod('./../xslt/list.xml',0777); //donne les droits au fichier pour qu'il soit exploitable


    //renamme et deplacement de model
        $dirname = './../document/temp_model/';
         $dirnameFinal = './../document/final/';
         $dir = opendir($dirname);
         while($file = readdir($dir)) {
            if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file))
            {
            rename($dirname.$file, $dirname."model.odp");
           
            }
         } 
        copy ($dirname."model.odp","./../document/temp/model.odp"); //deplace le model et le renomme
        unlink($dirname."model.odp");//supprime le model temporaire
        unzip(); // dezip les fichier odp
        recursiveCopy('./../xslt/tmp/model', './../document/resultat');  //copie les fichier dans le repertoire de traitement
        picturesCopy();//copie les images des présentations
        executeXSLContenu();//execute le xslt de fusion
        $finalName = "resulat".time(); //génére un nom unique a l'odp final
        executeXSLcss($finalName.".html"); //execute le xslt qui génére le css
        rename($dirnameFinal.$finalName.".html",$dirnameFinal.$finalName.".css"); //change l'extension du fichier générer en css
        executeXSLhtml($finalName.".html");  //execute le xslt qui génére le html
        zip($finalName.".odp"); // compresse la présentation généré
        deleteTempFiles();  // supprime les fichiers temporaires
        header('Location: ../odp.php?resultat='.$finalName); //redirige sur la page de résultat
}else{
   echo("Cette page n'est pas accessible !!!");
}
?>
