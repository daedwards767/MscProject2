<?php
declare(strict_types=1);
namespace worker\persistent;

class WorkerDao extends \database\DatabaseDao{
    
    protected $tablename = "Worker LEFT JOIN PaymentInfo ON Worker.id = PaymentInfo.worker_id";
    
    protected function commit(\database\Persistent $entity) {
        
    }

    protected function makeObject(array $rawResult) {
        $skillDao = new WorkerSkillSetDao();
        $skillSet = $skillDao->getById(strval($rawResult['id']));
        $rawResult['skill_set'] = $skillSet;
        $availabilityDao = new UnavailabilityCalendarDao();
        $availability = $availabilityDao->getById(strval($rawResult['id']));
        $rawResult['availability'] = $availability;
        $skillPreferenceDao = new SkillPreferenceDao();
        $skillPreference = $skillPreferenceDao->getById(strval($rawResult['id']));
        $rawResult['skill_preference'] = $skillPreference;
        return \worker\Worker::constructByRow($rawResult);
    }

}