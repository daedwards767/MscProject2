<?php
declare(strict_types=1);
namespace worker\persistent;

class UnavailabilityCalendarDao extends \database\DatabaseDao{
    
    protected $tablename = 'DatesUnavailable';
    
    protected function commit(\database\Persistent $entity) {
        
    }
    
    public function getById(string $id) {
        $dates = array();
        try {
            $dates = $this->getByCriteria('worker_id=?', array($id), "No results match the id supplied");
        }
        catch (\database\NoResultException $e){
            $e->getMessage();
        }
        $calendar = new \worker\UnavailabilityCalendar($dates);
        return $calendar;
    }

    protected function makeObject(array $rawResult) {
        return $rawResult['_date'];
    }

}
