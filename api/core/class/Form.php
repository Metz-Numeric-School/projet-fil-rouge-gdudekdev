<?php
namespace Core\Class;
/**
 * Exemple d'utilisation de la class Form pour créer un formulaire
 * 
 * $form = new Form("#","post","Formulaire");
 * 
 * $form->input("text","Nom","",true);
 * $form->input("text","Prenom","Gauthier");
 * $form->input("number","Age","3",true);
 * $form->input("date","Date de naissance");
 * $form->submit("Envoyer");
 * $content= $form->render();
 */
class Form
{

      private $current = "";
      private $method = "";
      private $action = "";
      private $fieldset = false;

      public function __construct(string $action, string $method = "get", $fieldset = false)
      {
            $this->action = $action;
            $this->method = $method;
            $this->fieldset = $fieldset;
      }
      private function fieldset(string $content, string $name = '')
      {
            $html = "<fieldset>" .
                  "<legend>" . $name . "</legend>"
                  . $content
                  . "</fieldset>";
            $this->current = $html;
      }
      private function form(string $content)
      {
            $html = "<form action = '" . $this->action . "' method = '" . $this->method . "'>" . $content . "</form>";
            $this->current = $html;
      }
      public function render()
      {
            if ($this->fieldset) {
                  $this->fieldset($this->current, $this->fieldset);
            }
            $this->form($this->current);

            return $this->current;
      }
      public function input(string $type, string $name, $value = "", bool $readonly = false)
      {
            $html = "
            <label for='" . strtolower($name) . "'>"
                  . ucfirst($name) . ":     "  .
                  "<br/>
                  <input type='" . $type . "' id='" . strtolower($name) . "' value ='" . $value . "'name ='" . strtolower($name) . "'
            ";
            $readonly ? $html .= "readonly='readonly' />" : '/>';
            $html .= "</label>";
            $html .= "<br/>";

            $this->current .= $html;
      }
      public function submit(string $value)
      {
            $html = "<br/>
            <input type = 'submit' value = '" . $value . "' />
            <br/>
            ";
            $this->current .= $html;
      }
}
