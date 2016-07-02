<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace project;

/**
 * Description of ProjectData
 *
 * @author Anthony
 */
class ProjectData implements \JsonSerializable{
    
    public $id;
    public $project_name;
    public $effort;
    public $cost;
    public $duration;
    public $start_date;
    public $end_date;
    public $max_effort;
    public $budget;
    public $max_duration;
    public $latest_start_date;
    public $latest_end_date;
    public $est_effort;
    public $est_cost;
    public $est_duration;
    public $est_start_date;
    public $est_end_date;
    public $skill_set; 
            
    public function __construct(Project $project){
        $this->id = $project->getId();
        $this->project_name = $project->getProjectName();
        $this->effort = $project->getEffort();
        $this->cost = $project->getCost();
        $this->duration = $project->getDuration();
        $this->start_date = $project->getStartDate();
        $this->end_date = $project->getEndDate();
        $this->max_effort = $project->getConstraints()->getMaxEffort();
        $this->budget = $project->getConstraints()->getBudget();
        $this->max_duration = $project->getConstraints()->getMaxDuration();
        $this->latest_start_date = $project->getConstraints()->getLatestStartDate();
        $this->latest_end_date = $project->getConstraints()->getLatestEndDate();
        $this->est_effort = $project->getEstimation()->getEffort();
        $this->est_cost = $project->getEstimation()->getCost();
        $this->est_duration = $project->getEstimation()->getDuration();
        $this->est_start_date = $project->getEstimation()->getStartDate();
        $this->est_end_date = $project->getEstimation()->getEndDate();
        $this->skill_set = $project->getSkillSet()->getDataExport(); 
    }
    
    public function JsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}
