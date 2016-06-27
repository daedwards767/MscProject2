<?php
declare(strict_types=1);
namespace project; 

class Assignment{
    protected $work;
    protected $workers = array();
    
    public function __construct(Work $work, Array $workers){
        $this->setWork($work);
        foreach($workers as $worker){
            $this->addWorker($worker);
        }
    }
    
    public function getWork() {
        return $this->work;
    }

    public function getWorkers() {
        return $this->workers;
    }

    protected function setWork(Work $work) {
        $this->work = $work;
    }

    protected function addWorker(\worker\Worker $worker) {
        $this->workers[$worker->getId()];
    }


}
