<?php

namespace Src\Back\Preferences\Controller;

use Src\Controller\Auth;

class Preferences
{

      public function handle($url)
      {
            Auth::getInstance()->protect();
            $title = "Page de gestion des Preférences";
            $model = new \Src\Back\Preferences\Model\Preferences;
            extract($model->handle($url));
            if (isset($url['id'])) {
                  include __DIR__ . '/../view/preferences_detail.php';
            } else if (isset($url['add'])) {
                  include __DIR__ . '/../view/preferences_create.php';
            } else {
                  include __DIR__ . '/../view/preferences.php';
            }
      }
}
