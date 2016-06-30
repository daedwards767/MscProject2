<?php
declare(strict_types=1);
namespace database;

class NoResultException extends \Exception{
    public function errorMessage($message = 'No results were returned in the query'){
        return $message;
    }
}
