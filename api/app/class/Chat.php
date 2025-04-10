<?php

namespace App\Class;

class Chat
{
    private $chats_id = 0;
    private $chats_created_at = null;
    private $chats_last_message = '';
    private $chats_last_message_at = null;
    private $messages_id = 0;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setChats_id($data['chats_id']);
        $this->setChats_created_at($data['chats_created_at']);
        $this->setChats_last_message($data['chats_last_message']);
        $this->setChats_last_message_at($data['chats_last_message_at']);
        $this->setMessages_id($data['messages_id']);
    }

    public function chats_id()
    {
        return htmlspecialchars($this->chats_id);
    }

    public function setChats_id($chats_id)
    {
        $this->chats_id = $chats_id;
    }

    public function chats_created_at()
    {
        return htmlspecialchars($this->chats_created_at);
    }

    public function setChats_created_at($chats_created_at)
    {
        $this->chats_created_at = $chats_created_at;
    }

    public function chats_last_message()
    {
        return htmlspecialchars($this->chats_last_message);
    }

    public function setChats_last_message($chats_last_message)
    {
        $this->chats_last_message = $chats_last_message;
    }

    public function chats_last_message_at()
    {
        return htmlspecialchars($this->chats_last_message_at);
    }

    public function setChats_last_message_at($chats_last_message_at)
    {
        $this->chats_last_message_at = $chats_last_message_at;
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
            'chats_id' => $this->chats_id,
            'chats_created_at' => $this->chats_created_at,
            'chats_last_message' => $this->chats_last_message,
            'chats_last_message_at' => $this->chats_last_message_at,
            'messages_id' => $this->messages_id,
        ];
    }
}
