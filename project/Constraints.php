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

    public function setBudget($budget) {
        $this->budget = $budget;
    }

    public function setMaxDuration($maxDuration) {
        $this->maxDuration = $maxDuration;
    }

    public function setLatestStartDate($latestStartDate) {
        $this->latestStartDate = $latestStartDate;
    }

    public function setLatestEndDate($latestEndDate) {
        $this->latestEndDate = $latestEndDate;
    }

    public function setMaxEffort($maxEffort) {
        $this->maxEffort = $maxEffort;
    }


}

