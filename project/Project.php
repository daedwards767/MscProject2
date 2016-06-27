<?php
declare(strict_types=1);
namespace project; 

class Project extends WorkIteration implements \database\Persistent{
    protected $projectName;
    protected $client;
    protected $organization;
    protected $tasks = array();
    protected $estimation;
    
    use database\PersistentTrait;
    
    public static function constructByRow(array $results) {
        ;
    }
    
    public function getProjectName() {
        return $this->projectName;
    }

    public function getClient() {
        return $this->client;
    }

    public function getOrganization() {
        return $this->organization;
    }

    public function getTasks() {
        return $this->tasks;
    }

    public function getEstimation() {
        return $this->estimation;
    }

    public function setProjectName($projectName) {
        $this->projectName = $projectName;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function setOrganization($organization) {
        $this->organization = $organization;
    }

    public function setTasks($tasks) {
        $this->tasks = $tasks;
    }

    public function setEstimation(WorkEstimation $estimation) {
        $this->estimation = $estimation;
    }


}

