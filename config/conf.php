<?php
class Conf{
    
    static $debug = 1;
    
    static $database = array(
        'default' => array(
            'host' => 'localhost',
            'database' => 'my_website_cms',
            'login' => 'root',
            'password' => ''
        )
    );
}

//Router::connect('/','posts/index');
Router::connect('post/:slug-:id','posts\/view\/id:([0-9]+)\/slug:([a-z0-9\-]+)');