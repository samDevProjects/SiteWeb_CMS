<?php
class Model{

    static $connections = array();
    public $conf = 'default';
    public $table = false;
    public $db;
    public $primaryKey = 'id';

    public function __construct(){
        // I initialize variables for the sub-model "Post"
        // this condition will transform "Post" to "posts"
        //if($this->table === false){
            $this->table = strtolower(get_class($this)).'s';
        //}
        //echo $this->table;die();
        // I charge and connect to the database
        $conf = Conf::$database[$this->conf];
        if (isset(Model::$connections[$this->conf])) {
            $this->db = Model::$connections[$this->conf];
            return true;
        }
        try {
            $pdo = new PDO(
                'mysql:host='.$conf['host'].'; dbname='.$conf['database'].';',$conf['login'],$conf['password']);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            Model::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
        } catch (PDOException $e) {
            if (Conf::$debug >= 1) {
                die($e->getMessage());    
            }else {
                die('Impossible de se connecter à la base de donnée');
            }
        }
        
    }

    public function find($req){
        $sql = 'SELECT ';
        //checking if there are any fields to add to our sql request
        if(isset($req['fields'])){
            if (is_array($req['fields'])) {
                $sql .= implode(', ', $req['fields']);
            }else {
                $sql .= $req['fields'];
            }
        }else {
            $sql .= '*';
        }
        $sql .= ' FROM '.$this->table.' as '.get_class($this).' ';
        //checking if there are any conditions to add to our sql request
        if(isset($req['conditions'])){
            $sql .= 'WHERE ';
            if (!is_array($req['conditions'])) {
                $sql .= $req['conditions'];
            }else {
                $cond = array();
                foreach ($req['conditions'] as $key => $value) {
                    if (!is_numeric($value)) {
                        $value = $this->db->quote($value);
                    }
                    //key and value are defined in conditions in the PostController
                    $cond[] = "$key=$value";
                }
                $sql .= implode(' AND ', $cond);
            }
        }
        //checking if there is a limitation of data number
        if (isset($req['limit'])) {
            $sql .= 'LIMIT '.$req['limit'];
        }
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * It returns the first element only saved by find($req)
    */
    public function findFirst($req){
        return current($this->find($req));
    }

    public function findCount($conditions){
        $res = $this->findFirst(array(
            'fields' => 'COUNT(id) as count',
            'conditions' => $conditions
        ));
        return $res->count;
    }
}