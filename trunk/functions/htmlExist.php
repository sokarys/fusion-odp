<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function htmlExiste($name){

     $dirname = './../document/temp_model/';
         $dir = opendir($dirname);
         while($file = readdir($dir)) {
            if(strstr($file, $name.'.hmtl') && !is_dir($dirname.$file))
            {
                return true;
            }
         }
         return false;
}

?>
