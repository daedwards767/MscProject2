<?php
declare(strict_types=1);
namespace project; 

class WorkIteration extends Work
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A description of an iteration of work which has been done/is being done
     */
    
    public function hasStarted(){
        return !empty($this->startDate);
    }
    
    public function hasEnded(){
        return !empty($this->endDate);
    }
}

