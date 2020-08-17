<?php

class Router {

    static $routes = array();    
    /**
     * Allows parsing a URL by dividing it into interpretable segments
     * @param $url URL to parse
     * @return table of parameters
     */
    static function parse($url, $request) {
        $url = trim($url, '/');
        $params = explode('/', $url);
        $request->controller = $params[0];
        $request->action = isset($params[1]) ? $params[1] : 'index';
        $request->params = array_slice($params, 2);
        return true;
    }
    /**
     * Retrives $redirect and $url, then parses the last one using RegularExpressions and stores the results in the routes array
     * @param $redirect the redirection url in the configuration
     * @param $url the requested url in the configuration
     */
    static function connect($redirect, $url){
        $r = array();
        $r['redirect'] = $redirect;
        $r['origin'] = '/'.$url.'/';
        $r['origin'] = preg_replace('/([0-9a-z]+):([^\/])'.'/','${1}:(?P<$1>${2})',$r['origin']);
        self::$routes[] = $r;
    }
    /**
     * Retrieves the requested parameters from index and replaces them with their values in the redirection url
     * @param $url requested from index
     * @return self::$routes[$value]['redirect']
     */
    static function url($url){
        foreach (self::$routes as $value) {
            if(preg_match($value['origin'], $url, $match)){
                foreach ($match as $key => $m) {
                    if (!is_numeric($key)) {
                        $value['redirect'] = str_replace(":$key", $m, $value['redirect']);
                    }
                }
                return $value['redirect'];
            }
        }
        return $url;
        //this is master branch
    }

}