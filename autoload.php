<?php

class autoload
{
    private static $result;

    public static function scanDirectory($dir, $fileName)
    {
        $scanner = scandir($dir); 
        foreach ($scanner as $scan) {
            switch ($scan) {
                case '.': 
                case '..':
                    break;
                default:              
                    $item = $dir . '/' . $scan; 

                    if(is_file($item)) {
                        if(!strcmp($fileName, $scan)){
                            self::$result = $item; 
                            return;
                        }
                    } elseif (is_dir($item)) {                  
                        self::scanDirectory($item, $fileName); 
                    }
            }
        }
    }

    public static function loadObject(string $classname, string $num_page = NULL){      
        self::scanDirectory(ROOT, $classname.'.php');

        if(self::$result != NULL){

            require_once(self::$result);
        }

        self::$result = NULL;
    }
}
?>