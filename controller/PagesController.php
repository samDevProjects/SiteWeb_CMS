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
        //to avoid injections (in the URL) when passing the id
    //we're going to pass the conditions in an array
    function view($id){
        $this->loadModel('Post');
        $d['page'] = $this->Post->findFirst(array(
            'conditions' => array('id' => $id, 'type'=>'page')
        ));
        if(empty($d['page'])){
            $this->e404('Page Introuvable');
        }
        $d['pages'] = $this->Post->find(array(
            'conditions' => array('type' => 'page')
        ));
        $this->set($d);
    }
}