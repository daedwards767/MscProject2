<?php
declare(strict_types=1);
namespace project\persistent;

class ProjectSkillSetDao extends \worker\persistent\SkillSetDao{
    protected $tablename = 'ProjectSkillSet';
    
    public function __construct(){
        parent::__construct($this->tablename);
    }

    protected function commit(\database\Persistent $entity) {
        
    }        

}
