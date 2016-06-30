<?php
declare(strict_types=1);
namespace worker;


class SkillDao extends \database\DatabaseDao
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: To persist skill properties to the database  
     */
    protected $tablename = 'Skill';
     
    protected function commit(\database\Persistent $entity) {
        assert(is_a($entity, '\worker\Skill'));
        $connection = new \database\Connection();
        $sql = "INSERT INTO $this->tablename (id, min_value, max_value) VALUES (?, ?, ?) "
                . "ON DUPLICATE KEY UPDATE min_value = VALUES(min_value), max_value = VALUES(max_value)";
        $statement = $connection->getConnection()->prepare($sql);
        $name = $entity->getName();
        $min = $entity->getMin();
        $max = $entity->getMax();
        $statement->bind_param("sii", $name, $min, $max);
        $statement->execute();
        $statement->close();
        $connection->getConnection()->close();
    }
    
    protected function makeObject(array $rawResult) {
        return Skill::constructByRow($rawResult);
    }

}
