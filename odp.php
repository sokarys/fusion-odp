<link rel="stylesheet" href="./jquery/css/ui-lightness/jquery-ui-1.8.6.custom.css"/>
<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" type="text/css" href="./timesheets/demo/style/layout.css">
<link rel="stylesheet" type="text/css" href="./timesheets/demo/style/transitions.css">
<link rel="stylesheet" type="text/css" href="./timesheets/demo/style/slideshow.css">
<script src="./jquery/js/jquery-1.4.2.min.js"></script>
<script src="./jquery/js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="./timesheets/timesheets.js"></script><script type="text/javascript" src="./timesheets/timesheets-navigation.js"></script>
<script>
            function deleteFinal(fichier){
                
            $.ajax({
                type:"GET",
                url:"./functions/deleteODP.php?final="+fichier,
                success: function(msg){
                    document.location.href="odp.php";
                }
            })
            }
        
</script>
<style type="" >
	#sortable { list-style-type: none; margin: 0; padding: 0;}
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>

<?php
include('./functions/htmlExist.php');
include('./functions/deleteResultat.php');
if(isset($_GET['resultat'])){
    require_once('./document/final/'.$_GET['resultat'].'.css');
    require_once('./document/final/'.$_GET['resultat'].'.html');
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
        if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file) && strstr($file, '.html')==false)
        {
        $count++;
        }
     }
    $courant=1;
     $dir2 = opendir($dirname);
     while($file = readdir($dir2)) {
        if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file) && strstr($file, '.html')==false)
        {
           if($courant<$count){
               echo '<li class="ui-state-default"><img src="./jquery/css/icon_delete_action.gif" onclick="javascript:deleteFinal(\''.$file.'\')"  style="cursor:pointer;"/>';
               if(htmlExist(strstr($file, '.', true))){
                  echo '<a href="odp.php?resultat='.strstr($file, '.', true).'"><img src="./jquery/css/HTML5.png" style="border:none;width:32px;padding:2px;"/></a>';
               }           
               echo '<a href="'.$dirname.'/'.$file.'">'.$file.'</a><input type="hidden" name="modele[]" value="'.$file.$courant.'"/></li>';
               $courant++;

           }else{
               echo '<li class="ui-state-default"><img src="./jquery/css/icon_delete_action.gif" onclick="javascript:deleteFinal(\''.$file.'\')" style="cursor:pointer;"/>';
               if(htmlExist(strstr($file, '.', true))){
                  echo '<a href="odp.php?resultat='.strstr($file, '.', true).'"><img src="./jquery/css/HTML5.png" style="border:none;width:32px;padding:2px;"/></a>';
               }
                echo '<a href="'.$dirname.'/'.$file.'">'.$file.'</a><input type="hidden" name="modele[]" value="'.$file.'"/><img src="./jquery/css/new.png" style="padding-left:50%;"></li>';
           }
        }
     }
?>
    </ul>
</div>

