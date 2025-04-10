<?php

namespace App\Class;

class Rating
{
    private $ratings_id = 0;
    private $ratings_value = 0;
    private $ratings_created_at = null;
    private $rides_id = 0;
    private $accounts_id = 0;
    private $accounts_id_1 = 0;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setRatings_id($data['ratings_id']);
        $this->setRatings_value($data['ratings_value']);
        $this->setRatings_created_at($data['ratings_created_at']);
        $this->setRides_id($data['rides_id']);
        $this->setAccounts_id($data['accounts_id']);
        $this->setAccounts_id_1($data['accounts_id_1']);
    }

    public function ratings_id()
    {
        return htmlspecialchars($this->ratings_id);
    }

    public function setRatings_id($ratings_id)
    {
        $this->ratings_id = $ratings_id;
    }

    public function ratings_value()
    {
        return htmlspecialchars($this->ratings_value);
    }

    public function setRatings_value($ratings_value)
    {
        $this->ratings_value = $ratings_value;
    }

    public function ratings_created_at()
    {
        return htmlspecialchars($this->ratings_created_at);
    }

    public function setRatings_created_at($ratings_created_at)
    {
        $this->ratings_created_at = $ratings_created_at;
    }

    public function rides_id()
    {
        return htmlspecialchars($this->rides_id);
    }

    public function setRides_id($rides_id)
    {
        $this->rides_id = $rides_id;
    }

    public function accounts_id()
    {
        return htmlspecialchars($this->accounts_id);
    }

    public function setAccounts_id($accounts_id)
    {
        $this->accounts_id = $accounts_id;
    }

    public function accounts_id_1()
    {
        return htmlspecialchars($this->accounts_id_1);
    }

    public function setAccounts_id_1($accounts_id_1)
    {
        $this->accounts_id_1 = $accounts_id_1;
    }

    public function getData()
    {
        return [
            'ratings_id' => $this->ratings_id,
            'ratings_value' => $this->ratings_value,
            'ratings_created_at' => $this->ratings_created_at,
            'rides_id' => $this->rides_id,
            'accounts_id' => $this->accounts_id,
            'accounts_id_1' => $this->accounts_id_1,
        ];
    }
}
