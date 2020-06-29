<?php

namespace App\Model;

use App\Model\Views\TaskView;

class TaskReadRepository
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return TaskView[]
     */
    public function getAll(int $offset, int $limit): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM posts ORDER BY id DESC LIMIT ? OFFSET ?');
        $stmt->execute([$limit, $offset]);

        return array_map([$this, 'hydratePost'], $stmt->fetchAll());
    }

    public function find($id): ?TaskView
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);

        return ($row = $stmt->fetch()) ? $this->hydratePost($row) : null;
    }

    private function hydratePost(array $row): TaskView
    {
        $view = new TaskView();

        return $view;
    }

    public function countAll(): int
    {
        $stmt = $this->pdo->query('SELECT COUNT(id) FROM tasks');
        return $stmt->fetchColumn();
    }
}