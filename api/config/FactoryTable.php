<?php

namespace Config;

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use Config\Config;
use Core\Class\Database;
use Dom\Document;

// TODO faire un fichier pour créer des classes plus rapidement

// L'objectif de cette classe est de créer dans le directory class la classe, si elle n'existe pas encore de tous les éléments TABLE_CONFIG
// Aussi, je cherche à créer une class qui crée les fichiers php des classes de manières dynamiques ainsi que leur manager, de manière dynamique et variant d'une table en fonction de ses champs en base de données  
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
      private function createClass(string $table, string $class)
      {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/app/class/' . $class . '.php';
            $fields = Database::getInstance()->getFields($table);
            $newFields = [];

            // On retire les champs que fournit de base sql sur la table accounts
            foreach($fields as $field){
                  if(!ctype_upper($field['COLUMN_NAME'][0])){
                        $newFields[] = $field ;
                  }
            }
            $fields = $newFields;

            // start of file
            $content = "<?php\n\n";
            $content .= "namespace App\\Class;\n\n";
            $content .= "class $class\n{\n";

            // defining attributes
            foreach ($fields as $field) {
                  $fieldName = $field['COLUMN_NAME'];
                  $fieldType = $field['COLUMN_TYPE'];
                  $defaultValue = $this->getDefaultValueForType($fieldType);
                  $content .= "    private \$$fieldName = $defaultValue;\n";
            }

            // function construct($data)
            $content .= "\n    public function __construct(\$data = null)\n    {\n";
            $content .= "        if (\$data) {\n";
            $content .= "            \$this->hydrate(\$data);\n";
            $content .= "        }\n";
            $content .= "    }\n";

            // function hydrate($data)
            $content .= "\n    private function hydrate(\$data)\n    {\n";
            foreach ($fields as $field) {
                  $fieldName = $field['COLUMN_NAME'];
                  $content .= "        \$this->set" . ucfirst($fieldName) . "(\$data['{$field['COLUMN_NAME']}']);\n";
            }
            $content .= "    }\n";

            // function setters and getters
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
       * Retourne la valeur par défaut en fonction du type de la colonne, à étoffer si nécessaire
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
            // return $type;
      }

      // FIXME comment needed for maintenance
      private function createManager(string $table, string $manager)
      {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/app/controller/' . $manager . '.php';
            $class = substr($table, 0, -1);

            $content = "<?php\n\n";
            $content .= "namespace App\\Controller;\n\n";
            $content .= "require \$_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';\n\n";
            $content .= "use App\\Class\\" . ucfirst($class) . ";\n";
            $content .= "use Core\\Class\\Database;\n\n";
            $content .= "class $manager {\n";

            $content .= "    private static \$instance = null;\n\n";
            $content .= "    public static function getInstance(){\n";
            $content .= "        if (is_null(self::\$instance)) {\n";
            $content .= "            self::\$instance = new self;\n";
            $content .= "        }\n";
            $content .= "        return self::\$instance;\n";
            $content .= "    }\n\n";

            $content .= "    public function getById(\$value){\n";
            $content .= "        return Database::getInstance()->getOneFrom('$table', '{$table}_id', \$value);\n";
            $content .= "    }\n\n";

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

            $content .= "    public function blank(\$data = null){\n";
            $content .= "        \$obj = new " . ucfirst($class) . "(\$data);\n";
            $content .= "        return \$obj->getData();\n";
            $content .= "    }\n\n";

            $content .= "    public function createObj(\$data = null){\n";
            $content .= "        return new " . ucfirst($class) . "(\$data);\n";
            $content .= "    }\n";

            $content .= "}\n";

            file_put_contents($path, $content);
      }
}
