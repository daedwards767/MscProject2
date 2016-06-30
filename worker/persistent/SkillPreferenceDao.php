<?php
declare(strict_types=1);
namespace worker\persistent;

class SkillPreferenceDao extends \database\DatabaseDao{
    

    protected $tablename = "WorkerSkillPreference JOIN Skill ON WorkerSkillPreference.skill = Skill.name";
    
    public function getById(string $id) {    
        //overrides behaviour returning of first object in the array
        return $this->getByCriteria('worker_id=?', array($id), "No results match the id supplied");
    }       
    
    protected function makeObject(array $rawResult) {
        $skill = new \worker\Skill($rawResult['name'], $rawResult['min_value'], $rawResult['max_value']);
        return new \worker\SkillPreference($skill, $rawResult['preference']);
    }

    protected function commit(\database\Persistent $entity) {
        
    }

}