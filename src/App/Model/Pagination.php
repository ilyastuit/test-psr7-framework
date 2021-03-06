<?php

namespace App\Model;

class Pagination
{
    private $totalCount;
    private $page;
    private $perPage;
    private $params;

    public function __construct(int $totalCount, int $page, int $perPage, $params = null)
    {
        $this->totalCount = $totalCount;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->params = $params;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPagesCount(): int
    {
        return ceil($this->totalCount / $this->perPage);
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getLimit(): int
    {
        return $this->perPage;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->perPage;
    }
}