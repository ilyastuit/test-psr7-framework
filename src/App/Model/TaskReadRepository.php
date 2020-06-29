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
    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM tasks ORDER BY id DESC');

        return array_map([$this, 'hydratePost'], $stmt->fetchAll());
    }

    public function find($id): ?TaskView
    {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);

        return ($row = $stmt->fetch()) ? $this->hydratePost($row) : null;
    }

    private function hydratePost(array $row): TaskView
    {
        $view = new TaskView();

        return $view;
    }
}