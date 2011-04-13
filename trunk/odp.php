<link rel="stylesheet" href="./jquery/css/ui-lightness/jquery-ui-1.8.6.custom.css"/>
<link rel="stylesheet" href="style.css"/>
<style type="" >
	#sortable { list-style-type: none; margin: 0; padding: 0;}
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>
<?php
if(isset($GET['resultat'])){

}
?>
<div class="block_fichier ui-widget-header">
    <h2> Liste de vos pr&eacute;sentations </h2>
     <ul id="ul_modele">
<?php
     $dirname = './document/final';
     $dir = opendir($dirname);
     $count=0;
     while($file = readdir($dir)) {
        if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file))
        {
        $count++;
        }
     }
    $courant=1;
     $dir2 = opendir($dirname);
     while($file = readdir($dir2)) {
        if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file))
        {
           if($courant<$count){
               echo '<li class="ui-state-default"><img src="./jquery/css/icon_delete_action.gif" onclick="javascript:delet(\''.$file.'\')"/><a href="'.$dirname.'/'.$file.'">'.$file.'</a><input type="hidden" name="modele[]" value="'.$file.$courant.'"/></li>';
               $courant++;
           }else{
               echo '<li class="ui-state-default"><img src="./jquery/css/icon_delete_action.gif" onclick="javascript:delet(\''.$file.'\')"/><a href="'.$dirname.'/'.$file.'">'.$file.'</a><input type="hidden" name="modele[]" value="'.$file.'"/><img src="./jquery/css/new.png" style="padding-left:50%;"></li>';
           }
        }
     }
?>
    </ul>
</div>

