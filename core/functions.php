<?php

function debug($var){
    if(Conf::$debug > 0){
        $debug = debug_backtrace();
        foreach ($debug as $key => $value) {
            echo '<strong>'.$value['file'].'</strong> at line '.$value['line'];
            echo '<br>';
        }
        echo '<br><br>';
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}


?>