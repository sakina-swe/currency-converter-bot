<?php

declare(strict_types=1);

class DB
{
    public $pdo;
    public function __construct()
    {
        $this->pdo =  new PDO('mysql:host=localhost;dbname=ccy_bot', 'root', '1234');
    }

    public function setState($chatId, $state)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (chat_id, conversion_type) VALUES (:chatId, :conversion_type)");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':conversion_type', $state);
        $stmt->execute();

        $stmt = $this->pdo->prepare("INSERT INTO users_view (chat_id, conversion_type) VALUES (:chatId, :conversion_type)");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':conversion_type', $state);
        $stmt->execute();

        return 1;
    }

    public function getState($chat_id)
    {
        $stmt = $this->pdo->prepare("SELECT conversion_type FROM users WHERE chat_id = :chat_id");
        $stmt->bindParam(':chat_id', $chat_id);
        $stmt->execute();
        $conversionType = $stmt->fetchColumn();

        return $conversionType;
    }

    public function clearTable()
    {
        $stmt = $this->pdo->prepare("TRUNCATE TABLE users");
        $stmt->execute();
    }

}