<?php

namespace App\Model;

use App\Model\Views\TaskView;

class UserReadRepository
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);

        return $row = $stmt->fetch();
    }

    public function validate($fields)
    {
        $username = $fields['username'] ?? null;
        $password = $fields['password'] ?? null;
        $error = false;

        if (empty($username) || strlen($username) > 255)
        {
            $error = true;
            $_SESSION['errors']['username'] = 'Username is required and must be less 255 symbols.';
        }
        if (empty($password)) {
            $error = true;
            $_SESSION['errors']['email'] = 'Invalid password.';
        }

        if (md5($password) !== $this->getPassword()[0]['password']) {
            $error = true;
        }

        if ($error) {
            $_SESSION['params']['username'] = $fields['username'] ?? '';
            return false;
        }
        return true;
    }

    private function getPassword()
    {
        $stmt = $this->pdo->prepare("SELECT `password` FROM users WHERE login = 'admin'");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}