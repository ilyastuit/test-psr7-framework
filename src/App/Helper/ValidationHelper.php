<?php


namespace App\Helper;


class ValidationHelper
{

    public function getError($field)
    {
        if (!empty($_SESSION['errors'][$field])) {
            return $_SESSION['errors'][$field];
        }
    }

    public function isValidated(): string
    {
        return isset($_SESSION['errors']) ? 'was-validated' : '';
    }

    public function getOldValue($field): string
    {
        if (!empty($_SESSION['params'][$field])) {
            return $_SESSION['params'][$field];
        }
        return '';
    }
}