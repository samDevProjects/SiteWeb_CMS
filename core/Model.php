<?php
class Model{

    static $connections = array();
    public $conf = 'default';
    public $table = false;
    public $db;

    public function __construct(){
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
        // I initialize variables for the sub-model "Post"
        // this condition will transform "Post" to "posts"
        //if($this->table === false){
            $this->table = strtolower(get_class($this)).'s';
        //}
        //print_r($this->table);die();
    }

    public function find($req){
        $sql = 'SELECT * FROM '.$this->table.' as '.get_class($this).' ';
        //condition construction
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
                    $cond[] = "$key=$value";
                }
                $sql .= implode(' AND ', $cond);
            }
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
}