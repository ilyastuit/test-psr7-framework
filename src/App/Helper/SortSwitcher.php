<?php


namespace App\Helper;


class SortSwitcher
{
    public function sortSwitcher($sort)
    {
        if ($sort === 'desc') {
            return 'asc';
        }
        return 'desc';
    }

    public function arrowSwitcher($sort)
    {
        if ($sort === 'desc') {
            return '<i class="fa fa-arrow-down" aria-hidden="true"></i>';
        }
        return '<i class="fa fa-arrow-up" aria-hidden="true"></i>';
    }

}