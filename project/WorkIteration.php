<?php
declare(strict_types=1);
namespace project; 

class WorkIteration extends Work
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A description of an iteration of work which has been done/is being done
     */
    
    protected $id;
    protected $skillSet;
    protected $assignment; 
    protected $constraints;
    
    public function getId(){
        return $this->id;
    }
    
    public function getSkillSet() {
        return $this->skillSet;
    }

    public function getAssignment() {
        return $this->assignment;
    }
         
    public function getConstraints() {
        return $this->constraints;
    }
    
    public function setSkillSet(\worker\SkillSet $skillSet) {
        $this->skillSet = $skillSet;
    }

    public function setAssignment(Assignment $assignment) {
        $this->assignment = $assignment;
    }
    
    public function setConstraints(Constraints $constraints) {
        $this->constraints = $constraints;
    }
    
    
    public function hasStarted(){
        return !empty($this->startDate);
    }
    
    public function hasEnded(){
        return !empty($this->endDate);
    }
}

