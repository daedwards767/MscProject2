<?php
declare(strict_types=1);
namespace worker;
//TODO: COnvert into workerskilllevel 
class SkillLevelDao extends \database\DatabaseDao
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: To persist skill properties to the database  
     */
    protected $tablename = 'SkillLevel';
     
    protected function commit(\database\Persistent $entity) {
        assert(is_a($entity, '\worker\SkillLevel'));
        $connection = new \database\Connection();
        $sql = "INSERT INTO $this->tablename (id, skill, skill_level) VALUES (?, ?, ?) "
                . "ON DUPLICATE KEY UPDATE skill = VALUES(min_value), max_value = VALUES(max_value)";
        $statement = $connection->getConnection()->prepare($sql);
        echo "<pre>";
        var_dump($entity);
        echo '</pre>';
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