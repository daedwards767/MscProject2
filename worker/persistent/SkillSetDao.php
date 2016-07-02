<?php
declare(strict_types=1);
namespace worker\persistent;

abstract class SkillSetDao extends \database\DatabaseDao{
    
    protected $idname;
    
    public function __construct(string $tablename, string $idname = 'id'){
        $this->tablename = "$tablename JOIN Skill ON $tablename.skill = Skill.name";
        $this->idname = $idname;
    }


    public function getByCriteria(string $criteria, Array $values, string $errorMsg = "No results match the criteria supplied") {
        return new \worker\SkillSet(parent::getByCriteria($criteria, $values, $errorMsg));
    }
    
    public function getById(string $id) {   
        //overrides return of first object in the array
        return $this->getByCriteria("$this->idname=?", array($id), "No results match the id supplied");
    }       
    
    protected function makeObject(array $rawResult) {
        $skill = new \worker\Skill($rawResult['name'], $rawResult['min_value'], $rawResult['max_value']);
        return new \worker\SkillLevel($skill, $rawResult['skill_level']);
    }
}