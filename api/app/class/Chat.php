<?php

namespace App\Class;

class Chat
{
    private $id = null;
    private $created_at = null;
    private $last_message = null;
    private $last_message_at = null;
    private $messages_id = null;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setId($data['id']);
        $this->setCreated_at($data['created_at']);
        $this->setLast_message($data['last_message']);
        $this->setLast_message_at($data['last_message_at']);
        $this->setMessages_id($data['messages_id']);
    }

    public function id()
    {
        return htmlspecialchars($this->id);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function created_at()
    {
        return htmlspecialchars($this->created_at);
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function last_message()
    {
        return htmlspecialchars($this->last_message);
    }

    public function setLast_message($last_message)
    {
        $this->last_message = $last_message;
    }

    public function last_message_at()
    {
        return htmlspecialchars($this->last_message_at);
    }

    public function setLast_message_at($last_message_at)
    {
        $this->last_message_at = $last_message_at;
    }

    public function messages_id()
    {
        return htmlspecialchars($this->messages_id);
    }

    public function setMessages_id($messages_id)
    {
        $this->messages_id = $messages_id;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'last_message' => $this->last_message,
            'last_message_at' => $this->last_message_at,
            'messages_id' => $this->messages_id,
        ];
    }
}
