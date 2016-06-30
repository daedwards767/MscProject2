<?php
declare(strict_types=1);
namespace project; 

class Constraints{
    
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: Bounds on the attributes of work
     */
    protected $budget;
    protected $maxDuration;
    protected $latestStartDate;
    protected $latestEndDate;
    protected $maxEffort;
    
    public function getBudget() {
        return $this->budget;
    }

    public function getMaxDuration() {
        return $this->maxDuration;
    }

    public function getLatestStartDate() {
        return $this->latestStartDate;
    }

    public function getLatestEndDate() {
        return $this->latestEndDate;
    }

    public function getMaxEffort() {
        return $this->maxEffort;
    }

    public function setBudget(float $budget) {
        $this->budget = $budget;
        assert($this->budget >= 0);
    }

    public function setMaxDuration(int $maxDuration) {
        $this->maxDuration = $maxDuration;
        assert($this->maxDuration >= 0);
    }

    public function setLatestStartDate(string $latestStartDate) {
        if (assert(\util\DateValidator::validateDate($latestStartDate), 'ERROR: Invalid date format')){
            $this->latestStartDate = $latestStartDate;
        }    
    }

    public function setLatestEndDate(string $latestEndDate) {
         if (assert(\util\DateValidator::validateDate($latestEndDate), 'ERROR: Invalid date format')){
            $this->latestEndDate = $latestEndDate;
        }    
    }

    public function setMaxEffort(int $maxEffort) {
        $this->maxEffort = $maxEffort;
        assert($this->maxEffort >= 0);
    }


}

