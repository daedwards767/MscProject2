<?php
declare(strict_types=1);
namespace worker; 

class Worker implements \database\Persistent
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: An entity with a skillset, an availability calendar, payment information and preferences who can do work 
     */
    protected $firstName;
    protected $lastName;
    protected $skillSet;
    protected $skillPreferences = array();
    protected $availability;
    protected $paymentInfo;
    
    use \database\PersistentTrait;
    
    public function __construct(string $id){
        $this->id = $id;
    }
    
    public static function constructByRow(array $results) {
        
        $worker = new Worker(strval($results['id']));
        $worker->setFirstName($results['first_name']);
        $worker->setLastName($results['last_name']);
        $worker->setSkillSet($results['skill_set']);
        $worker->setAvailability($results['availability']);
        foreach($results['skill_preference'] as $skillPreference){
            $worker->addSkillPreference($skillPreference);
        }
        $wage = new Wage(floatval($results['hourly_wage']),floatval($results['overtime_wage']));
        $worker->setPaymentInfo($wage);
        return $worker;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setFirstName(string $firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName) {
        $this->lastName = $lastName;
    }

        public function getSkillSet() {
        return $this->skillSet;
    }

    public function getSkillPreferences() {
        return $this->skillPreferences;
    }

    public function getAvailability() {
        return $this->availability;
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

    public function setAvailability(Availability $availability) {
        $this->availability = $availability;
    }

    public function setPaymentInfo(PaymentInfo $paymentInfo) {
        $this->paymentInfo = $paymentInfo;
    }

}
