<?php 
namespace Core\Class;

class Notification{
      
      private $table;
      private $action;
      private $params;

      public function __construct($table,$action,$params){
            $this->table = $table;
            $this->action = $action;
            $this->params = $params;
      }
      public function create(){
            return [
                  'table'=> $this->table,
                  'action'=> $this->action,
                  'params'=>$this->params,
            ];
      }
}
?>