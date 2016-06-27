<?php
declare(strict_types=1);
namespace project; 

abstract class Work 
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A description of work which is to be done or which has been done
     */
    protected $id;
    protected $iterationNo;
    protected $effort;
    protected $cost;
    protected $duration;
    protected $startDate;
    protected $endDate;
    protected $skillSet;
    protected $assignment; 
    protected $constraints;
    
    public function getId(){
        return $this->id;
    }

    public function getIterationNo() {
        return $this->iterationNo;
    }

    public function getEffort() {
        return $this->effort;
    }

    public function getCost() {
        return $this->cost;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
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

    public function setIterationNo(int $iterationNo) {
        $this->iterationNo = $iterationNo;
        assert($this->iterationNo >= 0);
    }

    public function setEffort(int $effort) {
        $this->effort = $effort;
        assert($this->effort >= 0);
    }

    public function setCost(float $cost) {
        $this->cost = $cost;
        assert($this->cost >= 0);
    }

    public function setDuration(int $duration) {
        $this->duration = $duration;
        assert($this->duration >= 0);
    }

    public function setStartDate(string $startDate) {
        assert(\util\DateValidator::validateDate($startDate), 'ERROR: Invalid date format');
        $this->startDate = $startDate;
    }

    public function setEndDate(string $endDate) {
        assert(\util\DateValidator::validateDate($endDate), 'ERROR: Invalid date format');
        assert(!empty($this->startDate), 'ERROR: Start date not set');
        $this->endDate = $endDate;
        assert(strtotime($this->endDate) >= strtotime($this->startDate), 'ERROR: End date before start date');
    }

    public function setSkillSet(\worker\SkillSet $skillSet) {
        $this->skillSet = $skillSet;
    }

    public function setAssignment($assignment) {
        $this->assignment = $assignment;
    }

    public function setConstraints(Constraints $constraints) {
        $this->constraints = $constraints;
    }



}