<?php

namespace Src\Model;

use App;

class Car_models extends Model
{
      public static $table = 'car_models';
      public static $dependencies = ['vehicules'];
}
