<?php


namespace App\Product\Domain\Query;


class GetProducts
{
    private int $page;

    private int $perPage;

    public function __construct(int $page = 1, int $perPage = 1)
    {
        $this->page = $page;
        $this->perPage = $perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
