<?php
  /**
   * DB-Class: handles connections/querys
   *
   * @author  David Krawec
   * @date    20.09.2017
   */
  class DB {
    var $DB;

    public function __construct($db_ip, $db_name, $db_user=null, $db_pass=null){
        if(isset($db_user) && isset($db_pass)){
            $this->DB = new MongoDB\Driver\Manager("mongodb://" . $db_user . ':' . $db_pass . '@' . $db_ip . '/' . $db_name);
        }
        else{
            $this->DB = new MongoDB\Driver\Manager("mongodb://" . $db_ip . ':27017');
        }
    }

    public function testQuery($bTrue){
        $filter = array('name' => [ '$eq' => 'test' ]);
        $options = array('sort' => [ 'name' => -1 ]);
        $query = new MongoDB\Driver\Query($filter, $options);

        $ret = array();
        $cursor = $this->DB->executeQuery('bountytask.user', $query);

        foreach($cursor as $document){
            array_push($ret, $document);
        }
        return $ret;
    }

    public function connection_established(){
        if($this->DB != null)
            return(true);
        return(false);
    }

    public function initCollections(){
    }

    public function getUser($username, $pass){

    }

    public function createUser(){

    }

    /////////////////
    // TASK-QUERYS //
    ////////////////

    public function Task_add($oTask){
    }

    public function Tasks_get(){
    }

    public function Task_delete($_id){
    }

    public function Task_update($_id, $oTask){
    }

  }
?>
