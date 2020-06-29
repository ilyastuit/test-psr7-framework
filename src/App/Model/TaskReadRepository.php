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
        $stmt = $this->pdo->prepare('SELECT * FROM tasks ORDER BY id DESC LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();

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

        $view->id = (int)$row['id'];
        $view->updated_at = new \DateTimeImmutable($row['updated_at']);
        $view->created_at = new \DateTimeImmutable($row['created_at']);
        $view->username = $row['username'];
        $view->email = $row['email'];
        $view->checked = (boolean)$row['checked'];
        $view->content = $row['content'];

        return $view;
    }

    public function countAll(): int
    {
        $stmt = $this->pdo->query('SELECT COUNT(id) FROM tasks');
        return $stmt->fetchColumn();
    }
}