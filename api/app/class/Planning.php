<?php

namespace App\Class;

class Planning
{
    private $plannings_id = 0;
    private $plannings_jsonb = '';

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setPlannings_id($data['plannings_id']);
        $this->setPlannings_jsonb($data['plannings_jsonb']);
    }

    public function plannings_id()
    {
        return is_null($this->plannings_id) ? '' : htmlspecialchars($this->plannings_id);
    }

    public function setPlannings_id($plannings_id)
    {
        $this->plannings_id = $plannings_id;
    }

    public function plannings_jsonb()
    {
        return is_null($this->plannings_jsonb) ? '' : htmlspecialchars($this->plannings_jsonb);
    }

    public function setPlannings_jsonb($plannings_jsonb)
    {
        $this->plannings_jsonb = $plannings_jsonb;
    }

    public function getData()
    {
        return [
            'plannings_id' => $this->plannings_id,
            'plannings_jsonb' => $this->plannings_jsonb,
        ];
    }
}
