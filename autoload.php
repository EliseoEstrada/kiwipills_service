<?php
// creamos función para autocargar los archivos de clases
function controllers_autoload($classname){
  
    $directory = ROOT."/controllers/{$classname}.php";
    if(file_exists($directory)) {
        include $directory;
    }
}
// se usa la función de registro de autoload y se le pasa la funcón anterior
spl_autoload_register('controllers_autoload');

