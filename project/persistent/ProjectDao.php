<?php
declare(strict_types=1);
namespace project\persistent;

class ProjectDao extends \database\DatabaseDao{
    
    protected $tablename = 'Project LEFT JOIN ProjectConstraints ON Project.id = Projectconstraints.pc_id LEFT JOIN ProjectEstimation ON Project.id = Projectestimation.pe_id';
    
    protected function commit(\database\Persistent $entity) {
        assert(is_a($entity, '\worker\Project'));
        //get variables
        $connection = new \database\Connection();
        
        //Table: Project
        $id = $entity->getId();
        $projectName = $entity->getProjectName();
        $effort = $entity->getEffort();
        $cost = $entity->getCost();
        $duration = $entity->getDuration();
        $startDate = $entity->getStartDate();
        $endDate = $entity->getEndDate();
        
        $pSql = "INSERT INTO Project (id, project_name, effort, cost, duration, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?, ?) "
                . "ON DUPLICATE KEY UPDATE project_name = VALUES(project_name), effort = VALUES(effort), cost = VALUES(cost), "
                . "duration = VALUES(duration), start_date = VALUES(start_date), end_date = VALUES(end_date)";
        $pStatement = $connection->getConnection()->prepare($pSql);
        $pStatement->bind_param("isidiss", $id, $projectName, $effort, $cost, $duration, $startDate, $endDate);
        
        //Table: ProjectEstimation
        $estEffort = $entity->getEstimation()->getEffort(); 
        $estCost = $entity->getEstimation()->getCost(); 
        $estDuration = $entity->getEstimation()->getDuration(); 
        $estStartDate = $entity->getEstimation()->getStartDate();   
        $estEndDate = $entity->getEstimation()->getEndDate(); 
        
        $peSql = "INSERT INTO ProjectEstimation (pe_id, est_effort, est_cost, est_duration, est_start_date, est_end_date) VALUES (?, ?, ?, ?, ?, ?) "
                . "ON DUPLICATE KEY UPDATE est_effort = VALUES(est_effort), est_cost = VALUES(est_cost), "
                . "est_duration = VALUES(est_duration), est_start_date = VALUES(est_start_date), est_end_date = VALUES(est_end_date)";
        $peStatement = $connection->getConnection()->prepare($peSql);
        $peStatement->bind_param("iidiss", $id, $estEffort, $estCost, $estDuration, $estStartDate, $estEndDate);
        
        //Table: ProjectConstraints
        $budget = $entity->getConstraints()->getBudget(); 
        $maxEffort = $entity->getConstraints()->getMaxEffort(); 
        $maxDuration = $entity->getConstraints()->getMaxDuration(); 
        $latestStartDate = $entity->getConstraints()->getLatestStartDate(); 
        $latestEndDate = $entity->getConstraints()->getLatestEndDate();
        
        $pcSql = "INSERT INTO ProjectConstraints (pc_id, max_effort, budget, max_duration, latest_start_date, latest_end_date) VALUES (?, ?, ?, ?, ?, ?) "
                . "ON DUPLICATE KEY UPDATE max_effort = VALUES(max_effort), budget = VALUES(budget), "
                . "max_duration = VALUES(max_duration), latest_start_date = VALUES(latest_start_date), latest_end_date = VALUES(latest_end_date)";
        $pcStatement = $connection->getConnection()->prepare($pcSql);
        $pcStatement->bind_param("iidiss", $id, $maxEffort, $budget, $maxDuration, $latestStartDate, $latestEndDate);
        
        
        //test transaction
        $pStatement->execute();
        $peStatement->execute();
        $pcStatement->execute();
        $pStatement->close();
        $peStatement->close();
        $pcStatement->close();
        $connection->getConnection()->close();
    }
    
    protected function makeObject(array $rawResult) {
        $dao = new ProjectSkillSetDao();
        $skillSet = $dao->getById(strval($rawResult['id']));
        $rawResult['skill_set'] = $skillSet;
        return \project\Project::constructByRow($rawResult);
    }
}