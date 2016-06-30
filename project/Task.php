<?php
declare(strict_types=1);
namespace project; 

class Task extends WorkIteration{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: Work done towards the completion of a project using human resources from a project team. May require
     *          mutiple iterations/estimations before completion
     */
    
    
    protected $project;
    protected $iterations = array();
    protected $estimations = array();
    protected $node;
    
    public function __construct(Project $project, string $id, \util\Node $node = NULL, Array $iterations = array(), Array $estimations = array()) {
        $this->project = $project; 
        $this->id = $id;
        if (!empty($node)){
            $node = new Node($id);
        }
        $this->setNode($node);
        foreach ($iterations as $iteration){
            $this->addIteration($iteration);
        }
        foreach ($estimations as $estimation){
            $this->addEstimation($estimation);
        }
    }
    
    public function getProject() {
        return $this->project;
    }
    
    public function getNode(){
        return $this->node;
    }
    
    public function getIterations() {
        return $this->iterations;
    }

    public function getEstimations() {
        return $this->estimations;
    }
    
    public function setNode(Node $node){
        $this->node = $node;
    }
    
    public function addIteration(WorkIteration $iteration){
        $this->iterations[$iteration->iterationNo] = $iteration;
    }
    
    public function addEstimation(WorkEstimation $estimation){
        $this->estimations[$estimation->iterationNo] = $estimation;
    }
    
    public function removeIteration(string $iterationNo){
        assert(array_key_exists($iterationNo, $this->iterations));  //the iteration should exist in the iterations array )
        unset($this->iterations[$iterationNo]);
    }
    
    public function removeEstimation(string $estimationNo){
        assert(array_key_exists($estimationNo, $this->estimations));  //the iteration should exist in the iterations array )
        unset($this->estimations[$estimationNo]);
    }
    
    public function getCurrentIteration() {

        $return = (assert($this->iterationNo != 0, 'ERROR: No iterations of this task have started') &&
                   assert(!empty($this->iterations), 'ERROR: No accessible iterations of this task. Iterations may not have been loaded') &&
                   assert(array_key_exists($this->iterationNo, $this->iterations), 'ERROR: No entry for the current iteration number in the iteration array') &&
                   assert(!empty($this->iterations[$this->iterationNo]), 'ERROR: The entry for the current iteration number in the iteration array is NULL'));
        if (!$return) throw new Exception ('Current iteration not accessible');
        return $this->iterations[$this->iterationNo]; 
    }

    public function getCurrentEstimation() {
        $return =   (assert(!empty($this->estimations), 'ERROR: No accessible estimations for this task. Estimations may not have been loaded') &&
                    assert(array_key_exists($this->iterationNo, $this->estimations), 'ERROR: No entry for the current iteration number in the estimation array') &&
                    assert(!empty($this->estimations[$this->iterationNo]), 'ERROR: The entry for the current iteration number in the iteration array is NULL'));
        if(!$return) throw new Exception ('Current estimation not accessible');
        return $this->estimations[$this->iterationNo];
    }

    public function getEffort() {
        $totalEffort = 0;
        foreach($this->iterations as $iteration){
            $totalEffort += $iteration->getEffort();
        }
        return $totalEffort;
    }

    public function getCost() {
        $totalCost = 0;
        foreach($this->iterations as $iteration){
            $totalCost += $iteration->getCost();
        }
        return $totalCost;
    }

    public function getDuration() {
        $totalDuration = 0;
        foreach($this->iterations as $iteration){
            $totalDuration += $iteration->getDuration();
        }
        return $totalDuration;
    }

}

