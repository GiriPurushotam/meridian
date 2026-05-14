<?php

declare(strict_types=1);

namespace Meridian\Content;

use Meridian\Database;
use PDO;

class MessageRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    /**
     * persist a contact-form submission
     */

    public function save(array $data): bool
    {
        $sql = 'INSERT INTO messages (name, email, phone, message, created_at, is_read) VALUES (:name, :email, :phone, :message, NOW(), 0)';

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name'     => trim($data['name']),
            ':email'    => trim($data['email']),
            ':phone'    => trim($data['phone']),
            ':message'  => trim($data['message']),
        ]);
    }

    /**
     * Return all the message for the admin panel, newest first
     */

    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT id, name, email, phone, message, created_at, is_read FROM messages ORDER BY created_at DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * marked a single message as read
     */

    public function markRead(int $id): bool
    {
        $stmt = $this->pdo->prepare('UPDATE messages SET is_read = 1 WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    /**
     * count undread messages (used for admin badge)
     */

    public function countRead(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM messages WhERE is_read = 0')->fetchColumn();
    }
}
