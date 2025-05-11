<?php
namespace Src\Services;

use App;

class EntrepriseService
{
      public DivisionService $divisionService;
      public function __construct()
      {
            $this->divisionService = new DivisionService();
      }
      public function deleteEntreprise(int $entrepriseId): void
      {
            $this->divisionService->deleteByEntrepriseId($entrepriseId);
            App::$db->delete('entreprises', $entrepriseId);
      }

      public function updateEntreprise(array $data): void
      {
            App::$db->update('entreprises', $data);
      }
      public function createEntreprise(array $data): void
      {
            App::$db->add('entreprises', $data);
      }
}
