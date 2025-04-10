<?php

namespace App\Class;

class Preference
{
    private $preferences_id = 0;
    private $preferences_jsonb = '';

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setPreferences_id($data['preferences_id']);
        $this->setPreferences_jsonb($data['preferences_jsonb']);
    }

    public function preferences_id()
    {
        return htmlspecialchars($this->preferences_id);
    }

    public function setPreferences_id($preferences_id)
    {
        $this->preferences_id = $preferences_id;
    }

    public function preferences_jsonb()
    {
        return htmlspecialchars($this->preferences_jsonb);
    }

    public function setPreferences_jsonb($preferences_jsonb)
    {
        $this->preferences_jsonb = $preferences_jsonb;
    }

    public function getData()
    {
        return [
            'preferences_id' => $this->preferences_id,
            'preferences_jsonb' => $this->preferences_jsonb,
        ];
    }
}
