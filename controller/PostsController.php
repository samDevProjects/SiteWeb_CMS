<?php
class PostsController extends Controller{
    /**
     * Lists all the articles in a variable called 'posts'
     */
    function index(){
        $this->loadModel('Post');
        $perPage = 1;
        $condition = array('online' => 1, 'type'=>'post');
        $d['posts'] = $this->Post->find(array(
            'conditions' => $condition,
            //'LIMIT n OFFSET m' === 'LIMIT m, n'
            'limit' => ($perPage*($this->request->page - 1)).','.$perPage
        ));
        //$d['total'] = count($d['posts']);
        $d['perPage'] = $perPage;
        $d['totalPosts'] = $this->Post->findCount($condition);
        $d['totalPages'] = ceil($d['totalPosts'] / $perPage);
        $this->set($d);
    }
    /**
     * View the article's id
     */
    function view($id){
        $this->loadModel('Post');
        $condition = array('online' => 1, 'id' => $id,'type'=>'post');
        $d['post'] = $this->Post->findFirst(array(
            'conditions' => $condition
        ));
        if(empty($d['post'])){
            $this->e404('Page Introuvable');
        }
        $this->set($d);
    }
}