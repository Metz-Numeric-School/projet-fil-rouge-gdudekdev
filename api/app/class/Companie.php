<?php

namespace App\Class;

class Companie
{
    private $companies_id = 0;
    private $companies_name = '';
    private $companies_location = '';

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setCompanies_id($data['companies_id']);
        $this->setCompanies_name($data['companies_name']);
        $this->setCompanies_location($data['companies_location']);
    }

    public function companies_id()
    {
        return htmlspecialchars($this->companies_id);
    }

    public function setCompanies_id($companies_id)
    {
        $this->companies_id = $companies_id;
    }

    public function companies_name()
    {
        return htmlspecialchars($this->companies_name);
    }

    public function setCompanies_name($companies_name)
    {
        $this->companies_name = $companies_name;
    }

    public function companies_location()
    {
        return htmlspecialchars($this->companies_location);
    }

    public function setCompanies_location($companies_location)
    {
        $this->companies_location = $companies_location;
    }

    public function getData()
    {
        return [
            'companies_id' => $this->companies_id,
            'companies_name' => $this->companies_name,
            'companies_location' => $this->companies_location,
        ];
    }
}
