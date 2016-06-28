<?php
declare(strict_types=1);
namespace worker; 

class SkillPreference
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A worker's preference towards the use/development of certain skills. May be based on a variety of factors including
     *          personality type
     */
    protected $skill;
    protected $min;
    protected $max;
    protected $preference;
    
    public function __construct(Skill $skill, int $min = 1, int $max = 5, int $preference = -1) {
        $valid = (assert($min >= 0, "ERROR: Lower bound on skill preference (min) is not positive") &&
                    assert($max >= $min, "ERROR: Upper bound is less than lower bound")); 
        if (!valid){
            throw new Exception('Invalid skill preference parameters in constructor');
        }
        else{
            $this->skill = $skill;
            $this->min = $min;
            $this->max = $max;
            if ($preference < $min) $preference = floor(($min + $max)/2); //the default is the midpoint of the available range 
            $this->preference = $preference;
        }
    }
    
    public function getSkill() {
        return $this->skill;
    }

    public function getMin() {
        return $this->min;
    }

    public function getMax() {
        return $this->max;
    }

    public function getPreference() {
        return $this->preference;
    }
    
    public function setPreference(int $preference){
        $valid = (assert($this->min <= $preference, "ERROR: Preference value provided is lower than the lower bound") &&
                assert($this->max >= $preference, "ERROR: Preference value provided is bigger than the upper bound"));
        if ($valid){
            $this->preference = $preference;
        }
    }
    
}
