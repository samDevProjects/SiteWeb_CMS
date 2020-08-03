<?php
class PagesController extends Controller{

    /**
     * Initializing variables for the rendered page
     * @param $requestedPage 
     */
    /*function view($requestedPage){
        //Here we're populating vars in Controller.php
        $this->set(array(
            'sentence' => 'Salut',
            'name' => 'Toi!'
        ));
        $this->render('index');
    }*/
    function index(){
        $this->render('index');
    }
}