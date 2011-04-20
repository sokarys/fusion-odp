<?php
 function recursiveCopy($dirSource, $dirTarget){
    if(!is_dir($dirTarget."/")){ mkdir($dirTarget); }
    $hdir = opendir( $dirSource );
    while ($item = readdir($hdir)){
        if($item == "." | $item == ".." | $item == ".svn") continue;
        if(is_dir($dirSource.'/'.$item)){
            recursiveCopy($dirSource.'/'.$item, $dirTarget.'/'.$item);
        }else{
            copy($dirSource.'/'.$item, $dirTarget.'/'.$item);
        }
    }
    closedir($hdir);
    chmodr($dirTarget, 0777);
 }


?>
