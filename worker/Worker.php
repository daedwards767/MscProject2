<?php
declare(strict_types=1);
namespace worker; 

class Worker implements \database\Persistent
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: An entity with a skillset, schedule, payment information and preferences who can do work 
     */
    protected $skillSet;
    protected $skillPreferences = array();
    protected $schedule;
    protected $paymentInfo;
    
    use database\PersistentTrait;
    
    public function __construct(SkillSet $skillSet, Schedule $schedule, PaymentInfo $paymentInfo, Array $skillPreferences = array()){
        
    }
    
    public static function constructByRow(array $results) {
        ;
    }
    
    public function getSkillSet() {
        return $this->skillSet;
    }

    public function getSkillPreferences() {
        return $this->skillPreferences;
    }

    public function getSchedule() {
        return $this->schedule;
    }

    public function getPaymentInfo() {
        return $this->paymentInfo;
    }

    public function setSkillSet(SkillSet $skillSet) {
        $this->skillSet = $skillSet;
    }

    public function addSkillPreference(SkillPreference $skillPreference) {
        $this->skillPreferences[$skillPreference->getSkill()->getId()] = $skillPreference;
    }

    public function setSchedule(Schedule $schedule) {
        $this->schedule = $schedule;
    }

    public function setPaymentInfo(PaymentInfo $paymentInfo) {
        $this->paymentInfo = $paymentInfo;
    }

}
