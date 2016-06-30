<?php
declare(strict_types=1);
namespace project\persistent;

class TaskDao extends \database\DatabaseDao{
    protected $tablename = 'Task';

    protected function commit(\database\Persistent $entity) {
        
    }

    protected function makeObject(array $rawResult) {
        
    }

}
