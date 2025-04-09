<?php

namespace App\Class;

class Message
{
    private $id = null;
    private $jsonb = null;
    private $users_id = null;
    private $users_id_1 = null;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setId($data['id']);
        $this->setJsonb($data['jsonb']);
        $this->setUsers_id($data['users_id']);
        $this->setUsers_id_1($data['users_id_1']);
    }

    public function id()
    {
        return htmlspecialchars($this->id);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function jsonb()
    {
        return htmlspecialchars($this->jsonb);
    }

    public function setJsonb($jsonb)
    {
        $this->jsonb = $jsonb;
    }

    public function users_id()
    {
        return htmlspecialchars($this->users_id);
    }

    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;
    }

    public function users_id_1()
    {
        return htmlspecialchars($this->users_id_1);
    }

    public function setUsers_id_1($users_id_1)
    {
        $this->users_id_1 = $users_id_1;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'jsonb' => $this->jsonb,
            'users_id' => $this->users_id,
            'users_id_1' => $this->users_id_1,
        ];
    }
}
