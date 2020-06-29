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

    public function create($params): void
    {
        $sql = "INSERT INTO tasks (username, email, content) VALUES (:username, :email , :content)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $params['username'], \PDO::PARAM_STR);
        $stmt->bindParam(':email', $params['email'], \PDO::PARAM_STR);
        $stmt->bindParam(':content', $params['text'], \PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @return TaskView[]
     */
    public function getAll(int $offset, int $limit, $params): array
    {
        $sort = $this->getSortParam($params['sort']);
        $field = $this->getSortField($params['field']);

        $stmt = $this->pdo->prepare("SELECT * FROM tasks ORDER BY $field $sort LIMIT :limit OFFSET :offset");

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
        $view->if_edited = (boolean)$row['if_edited'];
        $view->content = $row['content'];

        return $view;
    }

    public function countAll(): int
    {
        $stmt = $this->pdo->query('SELECT COUNT(id) FROM tasks');
        return $stmt->fetchColumn();
    }

    private function getSortParam($sort)
    {
        return strcasecmp($sort, 'asc') === 0 ? 'ASC' : (strcasecmp($sort, 'desc') === 0 ? 'DESC' : 'ASC');
    }

    private function getSortField($field)
    {
        if (strcasecmp($field, 'email') === 0) {
            return 'email';
        }
        if (strcasecmp($field, 'checked') === 0) {
            return 'checked';
        }
        return 'username';
    }

    public function validate($fields)
    {
        session_start();
        $username = $fields['username'] ?? null;
        $email = $fields['email'] ?? null;
        $text = $fields['text'] ?? null;
        $error = false;

        if (empty($username) || strlen($username) > 255)
        {
            $error = true;
            $_SESSION['errors']['username'] = 'Username is required and must be less 255 symbols.';
        }
        if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error = true;
            $_SESSION['errors']['email'] = 'E-mail is required and must be valid format.';
        }
        if (empty($text)) {
            $error = true;
            $_SESSION['errors']['text'] = 'Task is required.';
        }
        if ($error) {
            $_SESSION['params'] = $fields;
            return false;
        }
        return true;
    }
}