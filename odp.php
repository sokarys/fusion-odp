<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="./jquery/css/ui-lightness/jquery-ui-1.8.6.custom.css"/>
    <link rel="stylesheet" href="style.css"/>
    
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

</head>
<body>
	<div id="main">
        <div id="header">   
        	<img src="images/text_03.png" width="500" height="70" />
        </div>
        <div id="content">
			<?php
                include('./functions/htmlExist.php');
                include('./functions/deleteResultat.php');
                if(isset($_GET['resultat'])){
                    ?>
                    <div class="presentationHTML">
	                    <link rel=stylesheet type="text/css" href="<?php echo('./document/final/'.$_GET['resultat'].'.css');?>">
                    </div>
					<?php
                    require_once('./document/final/'.$_GET['resultat'].'.html');
                }
            ?>
            <div class="blocPresentationList">
                <h2>Liste de vos présentations</h2>
                <div class="presentationList"> 
                    <div class="ui-widget-header-top" style="height:30px !important;">
                    </div>
                    <div class="ui-widget-header-middle">
                        <ul id="ul_modele">
                        <?php
                             $dirname = './document/final';
                             $dir = opendir($dirname);
                             $count=0;
                             while($file = readdir($dir)) {
                                if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file) && strstr($file, '.html')==false  && strstr($file, '.css')==false)
                                {
                                $count++;
                                }
                             }
                            $courant=1;
                             $dir2 = opendir($dirname);
                             while($file = readdir($dir2)) {
                                if($file != ".svn" && $file != '.' && $file != '..' && !is_dir($dirname.$file) && strstr($file, '.html')==false && strstr($file, '.css')==false)
                                {
                                   if($courant<$count){
                                       echo '<li class="ui-state-default"><img src="images/btnSupprimer.png" width="30" height="30" onclick="javascript:deleteFinal(\''.$file.'\')"  style="cursor:pointer;"/>';
                                       if(htmlExist(strstr($file, '.', true))){
                                          echo '<a href="odp.php?resultat='.strstr($file, '.', true).'"><img src="./jquery/css/HTML5.png" width="30" height="30" style="border:none;width:32px;padding-right:20px;"/></a>';
                                       }           
                                       echo '<a href="'.$dirname.'/'.$file.'">'.$file.'</a><input type="hidden" name="modele[]" value="'.$file.$courant.'"/></li>';
                                       $courant++;
                        
                                   }else{
                                       echo '<li class="ui-state-default"><img src="images/btnSupprimer.png" width="30" height="30" onclick="javascript:deleteFinal(\''.$file.'\')" style="cursor:pointer;"/>';
                                       if(htmlExist(strstr($file, '.', true))){
                                          echo '<a href="odp.php?resultat='.strstr($file, '.', true).'"><img src="./jquery/css/HTML5.png" width="30" height="30" style="border:none;width:32px;padding-right:20px;"/></a>';
                                       }
                                        echo '<a href="'.$dirname.'/'.$file.'">'.$file.'</a><input type="hidden" name="modele[]" value="'.$file.'"/><img src="images/new.png" width="30" height="30" style="padding-left:20;"></li>';
                                   }
                                }
                             }
                        ?>
                        </ul>
                    </div>
                	<div class="ui-widget-header-bottom" style="height:30px !important;">
               		</div>
                </div>
            </div>
        </div>
        <div id="footer">
      		<img src="images/text_06.png" width="160" height="30">
    	</div>
    </div>
</body>
</html>