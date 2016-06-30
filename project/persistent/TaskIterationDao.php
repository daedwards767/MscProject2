<?php
declare(strict_types=1);
namespace project\persistent;

class TaskIterationDao extends \database\DatabaseDao{
    protected $tablename = 'TaskIteration';

    public function getById(string $taskId, int $iterationNo = NULL) {
        if (empty($iterationNo)){
            return $this->getByCriteria('ti_id=?', array($taskId), "No results match the id supplied");
        }else {
            return $this->getByCriteria('ti_id=? AND iteration_no=?', array($taskId, $iterationNo), "No results match the id supplied")[0];
        }
    }
    
    protected function commit(\database\Persistent $entity) {
        
    }

    protected function makeObject(array $rawResult) {
        print_r($rawResult);
        $iteration = new \project\WorkIteration();
        $iteration->setIterationNo(intval($rawResult['iteration_no']));
        $iteration->setEffort(intval($rawResult['effort']));
        $iteration->setCost(floatval($rawResult['cost']));
        $iteration->setDuration(intval($rawResult['duration']));
        $iteration->setStartDate(\util\DateValidator::mysqlToPhp($rawResult['start_date']));
        $iteration->setEndDate(\util\DateValidator::mysqlToPhp($rawResult['end_date']));
        return $iteration;
    }

}