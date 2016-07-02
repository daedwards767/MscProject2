<?php
declare(strict_types=1);
namespace project; 

class Project extends WorkIteration implements \database\Persistent, \dataexport\Exportable{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A collection of interlinked tasks carried out by a team towards the completion of a goal
     */
    
    protected $projectName;
    protected $tasks = array();
    protected $estimation;
    protected $taskPrecedence;
    
    use \database\PersistentTrait;
    
    public function __construct(int $id){
        $this->setId($id);
        $this->taskPrecedence = \util\RootNode::getInstance();
    }
    
    public static function constructByRow(array $results) {
        if(assert(array_key_exists ('id', $results) 
                && array_key_exists ('project_name', $results ) 
                && array_key_exists ('effort', $results )
                && array_key_exists ('cost', $results )
                && array_key_exists ('duration', $results )
                && array_key_exists ('start_date', $results )
                && array_key_exists ('end_date', $results )
                && array_key_exists ('max_effort', $results )
                && array_key_exists ('budget', $results )
                && array_key_exists ('max_duration', $results )
                && array_key_exists ('latest_start_date', $results )
                && array_key_exists ('latest_end_date', $results )
                && array_key_exists ('est_effort', $results )
                && array_key_exists ('est_cost', $results )
                && array_key_exists ('est_duration', $results )
                && array_key_exists ('est_start_date', $results )
                && array_key_exists ('est_end_date', $results )
                && array_key_exists ('skill_set', $results ),
                'ERROR: Required keys not in array provided'))
            {        
                $project = new Project($results['id']);
                $project->setProjectName(strval($results['project_name']));
                $project->setEffort(intval($results['effort']));

                $project->setCost(floatval($results['cost']));
                $project->setDuration(intval($results['duration']));
                $project->setStartDate(\util\DateValidator::mysqlToPhp($results['start_date']));
                $project->setEndDate(\util\DateValidator::mysqlToPhp($results['end_date']));
                $constraints = new Constraints();
                $constraints->setBudget(floatval($results['budget']));
                $constraints->setMaxEffort(intval($results['max_effort']));
                $constraints->setMaxDuration(intval($results['max_duration']));
                $constraints->setLatestStartDate(\util\DateValidator::mysqlToPhp($results['latest_start_date']));
                $constraints->setLatestEndDate(\util\DateValidator::mysqlToPhp($results['latest_end_date']));
                $project->setConstraints($constraints);
                $estimation = new WorkEstimation();
                $estimation->setEffort(intval($results['est_effort']));
                $estimation->setCost(floatval($results['est_cost']));
                $estimation->setDuration(intval($results['est_duration']));
                $estimation->setStartDate(\util\DateValidator::mysqlToPhp($results['est_start_date']));
                $estimation->setEndDate(\util\DateValidator::mysqlToPhp($results['est_end_date']));
                $project->setEstimation($estimation);
                $project->setSkillSet($results['skill_set']);
                return $project;
            }
    }
    
    public function getDataExport() {
         return new ProjectData($this);
    }
    
    public function getProjectName() {
        return $this->projectName;
    }

    public function getTasks() {
        return $this->tasks;
    }

    public function getEstimation() {
        return $this->estimation;
    }

    public function setProjectName(string $projectName) {
        $this->projectName = $projectName;
    }

    public function setTasks(Array $tasks){
        foreach ($tasks as $task){
            $this->addTask($task);
        }
    }
    
    public function addTask(Task $task) {
            $this->tasks[$task->getId()] = $task;
    }

    public function setEstimation(WorkEstimation $estimation) {
        $this->estimation = $estimation;
    }


}

