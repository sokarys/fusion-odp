<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function htmlExist($name){

     $dirname = './document/final/';
         $dir = opendir($dirname);
         while($file = readdir($dir)) {
            $nameF=$name.".html";
            if(strstr($file,$nameF)!=FALSE && !is_dir($dirname.$file))
            {
                return true;                
            }
         }
         return false;
}

?>
