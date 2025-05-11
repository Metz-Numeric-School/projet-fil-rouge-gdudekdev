<?php
namespace Src\Services;

use App;

class DivisionService
{
      public function deleteByEntrepriseId(int $entrepriseId): void
      {
            App::$db->deleteFromWhere('divisions', [
                  'stmt' => 'entreprises_id = :id',
                  'params' => [':id' => $entrepriseId]
            ]);
      }

      public function deleteByDivisionId(int $divisionId): void
      {
            App::$db->delete('divisions', $divisionId);
      }
      public function createDivision(array $data): void
      {
            App::$db->add('divisions', $data);
      }
}
