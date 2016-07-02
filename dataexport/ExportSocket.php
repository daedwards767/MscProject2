<?php
declare(strict_types=1);
namespace dataexport; 
include ('../autoload.php');

class ExportSocket{
      static function getProjectData(){
        if(isset($_POST['format'])){
           $projectDao = new \project\persistent\ProjectDao();
           $project = $projectDao->getById('1');
           return json_encode($project->getDataExport());
        }
      }
      
      static function getCandidates(){
            $candidates = CandidateController::getAllCandidates();
            return $candidates;
        }
        
   
}

if(isset($_POST['function'])){
    $funcName = $_POST['function']; //get the function name from the post array
    echo ExportSocket::$funcName();
    
}