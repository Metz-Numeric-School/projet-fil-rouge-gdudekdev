<?php 

namespace Core\Model;

class Singleton{
      protected static $instance = null;

      public static function getInstance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }
}