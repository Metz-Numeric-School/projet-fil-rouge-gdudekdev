<?php

namespace App\Class;

class Account
{
    private $accounts_id = 0;
    private $accounts_name = '';
    private $accounts_birthday = null;
    private $accounts_email = '';
    private $accounts_password = '';
    private $accounts_phone = '';
    private $accounts_created_at = null;
    private $plannings_id = 0;
    private $routes_id = 0;
    private $preferences_id = 0;
    private $companies_id = 0;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setAccounts_id($data['accounts_id']);
        $this->setAccounts_name($data['accounts_name']);
        $this->setAccounts_birthday($data['accounts_birthday']);
        $this->setAccounts_email($data['accounts_email']);
        $this->setAccounts_password($data['accounts_password']);
        $this->setAccounts_phone($data['accounts_phone']);
        $this->setAccounts_created_at($data['accounts_created_at']);
        $this->setPlannings_id($data['plannings_id']);
        $this->setRoutes_id($data['routes_id']);
        $this->setPreferences_id($data['preferences_id']);
        $this->setCompanies_id($data['companies_id']);
    }

    public function accounts_id()
    {
        return htmlspecialchars($this->accounts_id);
    }

    public function setAccounts_id($accounts_id)
    {
        $this->accounts_id = $accounts_id;
    }

    public function accounts_name()
    {
        return htmlspecialchars($this->accounts_name);
    }

    public function setAccounts_name($accounts_name)
    {
        $this->accounts_name = $accounts_name;
    }

    public function accounts_birthday()
    {
        return htmlspecialchars($this->accounts_birthday);
    }

    public function setAccounts_birthday($accounts_birthday)
    {
        $this->accounts_birthday = $accounts_birthday;
    }

    public function accounts_email()
    {
        return htmlspecialchars($this->accounts_email);
    }

    public function setAccounts_email($accounts_email)
    {
        $this->accounts_email = $accounts_email;
    }

    public function accounts_password()
    {
        return htmlspecialchars($this->accounts_password);
    }

    public function setAccounts_password($accounts_password)
    {
        $this->accounts_password = $accounts_password;
    }

    public function accounts_phone()
    {
        return htmlspecialchars($this->accounts_phone);
    }

    public function setAccounts_phone($accounts_phone)
    {
        $this->accounts_phone = $accounts_phone;
    }

    public function accounts_created_at()
    {
        return htmlspecialchars($this->accounts_created_at);
    }

    public function setAccounts_created_at($accounts_created_at)
    {
        $this->accounts_created_at = $accounts_created_at;
    }

    public function plannings_id()
    {
        return htmlspecialchars($this->plannings_id);
    }

    public function setPlannings_id($plannings_id)
    {
        $this->plannings_id = $plannings_id;
    }

    public function routes_id()
    {
        return htmlspecialchars($this->routes_id);
    }

    public function setRoutes_id($routes_id)
    {
        $this->routes_id = $routes_id;
    }

    public function preferences_id()
    {
        return htmlspecialchars($this->preferences_id);
    }

    public function setPreferences_id($preferences_id)
    {
        $this->preferences_id = $preferences_id;
    }

    public function companies_id()
    {
        return htmlspecialchars($this->companies_id);
    }

    public function setCompanies_id($companies_id)
    {
        $this->companies_id = $companies_id;
    }

    public function getData()
    {
        return [
            'accounts_id' => $this->accounts_id,
            'accounts_name' => $this->accounts_name,
            'accounts_birthday' => $this->accounts_birthday,
            'accounts_email' => $this->accounts_email,
            'accounts_password' => $this->accounts_password,
            'accounts_phone' => $this->accounts_phone,
            'accounts_created_at' => $this->accounts_created_at,
            'plannings_id' => $this->plannings_id,
            'routes_id' => $this->routes_id,
            'preferences_id' => $this->preferences_id,
            'companies_id' => $this->companies_id,
        ];
    }
}
