<?php

namespace Config;

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use Config\Config;
use Core\Class\Database;

// The main purpose of this class is generating all the class and manager associated for each table of the database we're working with
class FactoryTable
{


      private static $instance = null;

      private function __construct()
      {
            $this->handleTables();
      }

      public static function getInstance()
      {
            return self::$instance ?? new self;
      }
      /**
       * This function maps the database tables and create the class and manager associated if they do not exist yet
       */
      private function handleTables()
      {
            $to_verify  = array_keys(Config::TABLE_CONFIG);

            foreach ($to_verify as $tableName) {
                  // On retire le s à la fin des noms des tables présents systèmatiquement
                  $class = ucfirst(substr($tableName, 0, -1));
                  if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/app/class/" . $class . ".php")) {
                        $this->createClass($tableName, $class);
                  }
                  $manager  = $class . 'Manager';
                  if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/app/controller/" . $manager . ".php")) {
                        $this->createManager($tableName, $manager);
                  }
            }
      }
      // TODO ajouter des parametres au niveau de la gestion via les setters de certains attributs, à voir
      /**
       * This function generate a class file content relative to a given table 
       * @var table : the database table as written in the db
       * @var class : the name core of the file (without .php)
       */
      private function createClass(string $table, string $class)
      {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/app/class/' . $class . '.php';
            $fields = Database::getInstance()->getFields($table);

            // File header 
            $content = "<?php\n\n";
            $content .= "namespace App\\Class;\n\n";
            $content .= "class $class\n{\n";

            // Defining attributes
            foreach ($fields as $field) {
                  $fieldName = $field['COLUMN_NAME'];
                  $fieldType = $field['COLUMN_TYPE'];
                  $defaultValue = $this->getDefaultValueForType($fieldType);
                  $content .= "    private \$$fieldName = $defaultValue;\n";
            }

            // Function construct($data)
            $content .= "\n    public function __construct(\$data = null)\n    {\n";
            $content .= "        if (\$data) {\n";
            $content .= "            \$this->hydrate(\$data);\n";
            $content .= "        }\n";
            $content .= "    }\n";

            // Function hydrate($data)
            $content .= "\n    private function hydrate(\$data)\n    {\n";
            foreach ($fields as $field) {
                  $fieldName = $field['COLUMN_NAME'];
                  $content .= "        \$this->set" . ucfirst($fieldName) . "(\$data['{$field['COLUMN_NAME']}']);\n";
            }
            $content .= "    }\n";

            // Function setters and getters
            //    FIXME Ajouter un traitement via la config si nécessaire
            /**
             *  Comparaison en chaine de character  :  '>0' de l'attribut et valeur par défaut associé si la condition n'est pas remplie
             */
            foreach ($fields as $field) {
                  $fieldName = $field['COLUMN_NAME'];
                  $content .= "\n    public function " . $fieldName . "()\n    {\n";
                  $content .= "        return htmlspecialchars(\$this->$fieldName);\n";
                  $content .= "    }\n";

                  $content .= "\n    public function set" . ucfirst($fieldName) . "(\$$fieldName)\n    {\n";
                  $content .= "        \$this->$fieldName = \$$fieldName;\n";
                  $content .= "    }\n";
            }

            // function getData()
            $content .= "\n    public function getData()\n    {\n";
            $content .= "        return [\n";
            foreach ($fields as $field) {
                  $fieldName = $field['COLUMN_NAME'];
                  $content .= "            '$fieldName' => \$this->$fieldName,\n";
            }

            // end of file
            $content .= "        ];\n";
            $content .= "    }\n";

            $content .= "}\n";

            file_put_contents($path, $content);
      }

      /**
       * This function return the default value relative to the type
       * @var type: the type we need the default value from
       */
      private function getDefaultValueForType($type)
      {
            if ($type == 'int') {
                  return 0;
            } elseif (in_array($type, ['string', 'varchar(50)','varchar(20)', 'text'])) {
                  return "''";
            } elseif (in_array($type, ['date','datetime'])) {
                  return 'null';
            }else{
                  return 0;
            }
      }
      /**
       * This function generate a manager file content relative to a given table 
       * @var table : the database table as written in the db
       * @var manager : the name core of the file (without .php)
       */
      private function createManager(string $table, string $manager)
      {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/app/controller/' . $manager . '.php';
            $class = substr($table, 0, -1);
            // File header     
            $content = "<?php\n\n";
            $content .= "namespace App\\Controller;\n\n";
            $content .= "require \$_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';\n\n";
            $content .= "use App\\Class\\" . ucfirst($class) . ";\n";
            $content .= "use Core\\Class\\Database;\n\n";
            $content .= "class $manager {\n";

            // Defining singleton instance
            $content .= "    private static \$instance = null;\n\n";
            $content .= "    public static function getInstance(){\n";
            $content .= "        if (is_null(self::\$instance)) {\n";
            $content .= "            self::\$instance = new self;\n";
            $content .= "        }\n";
            $content .= "        return self::\$instance;\n";
            $content .= "    }\n\n";

            //Defining basic managing functions
            $content .= "    public function getById(\$value){\n";
            $content .= "        return Database::getInstance()->getOneFrom('$table', '{$table}_id', \$value);\n";
            $content .= "    }\n\n";

            // CRUD functions
            $content .= "    public function delete(int \$value){\n";
            $content .= "        Database::getInstance()->delete('$table', \$value);\n";
            $content .= "    }\n\n";
            
            $content .= "    public function save(array \$data){\n";
            $content .= "        \$obj = new " . ucfirst($class) . "(\$data);\n";
            $content .= "        if (\$obj->" . $table ."_id() == 0) {\n";
            $content .= "            \$this->add(\$obj);\n";
            $content .= "        } else {\n";
            $content .= "            \$this->update(\$obj);\n";
            $content .= "        }\n";
            $content .= "    }\n\n";

            $content .= "    private function update(" . ucfirst($class) . " \$obj){\n";
            $content .= "        \$data = \$obj->getData();\n";
            $content .= "        Database::getInstance()->update('$table', \$data);\n";
            $content .= "    }\n\n";

            $content .= "    private function add(" . ucfirst($class) . " \$obj){\n";
            $content .= "        \$data = \$obj->getData();\n";
            $content .= "        Database::getInstance()->add('$table', \$data);\n";
            $content .= "    }\n\n";

            // Function returning an array with objects fields with blank value relative to the manager 
            $content .= "    public function blank(\$data = null){\n";
            $content .= "        \$obj = new " . ucfirst($class) . "(\$data);\n";
            $content .= "        return \$obj->getData();\n";
            $content .= "    }\n\n";

            // Function to create an instance of the managed class
            $content .= "    public function createObj(\$data = null){\n";
            $content .= "        return new " . ucfirst($class) . "(\$data);\n";
            $content .= "    }\n";

            $content .= "}\n";

            // Creating, opening and writing in the desired file the constructed content
            file_put_contents($path, $content);
      }
}
