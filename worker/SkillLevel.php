<?php
declare(strict_types=1);
namespace worker; 

class SkillLevel
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A skill and its associated proficiency
     */
    
    protected $skill;
    protected $level;
  
    
    public function __construct(Skill $skill, int $level = -1){
        if ($level < $skill->getMin()){ $level = $skill->getMin ();}
        $this->skill = $skill;
        $this->setLevel($level);
    }
    
    public function getSkill(){
        return $this->skill; 
    }

    public function getLevel() {
        return $this->level;
    }

    public function setLevel($level) {
        assert(!empty($this->skill), 'ERROR: Skill not set');
        assert($level >= $this->skill->getMin(), 'ERROR: Skill level smaller than minimum value');
        assert($level <= $this->skill->getMax(), 'ERROR: Skill level greater than maximum value');
        $this->level = $level;
    }


}
