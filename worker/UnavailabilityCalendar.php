<?php
declare(strict_types=1);
namespace worker; 

class UnavailabilityCalendar extends Availability{
    protected $dates = array();
    
    public function __construct(Array $dates){
        foreach ($dates as $date){
            $this->addDate($date);
        }
    }
    
    protected function addDate(String $date){
        if(assert(\util\DateValidator::validateDate($date), "ERROR: String supplied is not a valid date")){
            array_push($this->dates, $date);
        }
    }
    
    public function getDatesUnavailable() {
        return $this->dates;
    }
}
