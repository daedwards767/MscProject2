<?php
declare(strict_types=1);
namespace worker\persistent;

class WorkerSkillSetDao extends SkillSetDao{
    
    protected $tablename = "WorkerSkillSet";
    protected $idname = "worker_id";
    
    public function __construct(){
        parent::__construct($this->tablename, $this->idname);
    }
    
    protected function commit(\database\Persistent $entity) {
        
    }

}