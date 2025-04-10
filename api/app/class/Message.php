<?php

namespace App\Class;

class Message
{
    private $messages_id = 0;
    private $messages_jsonb = '';
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
        $this->setMessages_id($data['messages_id']);
        $this->setMessages_jsonb($data['messages_jsonb']);
        $this->setAccounts_id($data['accounts_id']);
        $this->setAccounts_id_1($data['accounts_id_1']);
    }

    public function messages_id()
    {
        return htmlspecialchars($this->messages_id);
    }

    public function setMessages_id($messages_id)
    {
        $this->messages_id = $messages_id;
    }

    public function messages_jsonb()
    {
        return htmlspecialchars($this->messages_jsonb);
    }

    public function setMessages_jsonb($messages_jsonb)
    {
        $this->messages_jsonb = $messages_jsonb;
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
            'messages_id' => $this->messages_id,
            'messages_jsonb' => $this->messages_jsonb,
            'accounts_id' => $this->accounts_id,
            'accounts_id_1' => $this->accounts_id_1,
        ];
    }
}
