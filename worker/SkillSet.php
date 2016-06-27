<?php
declare(strict_types=1);
namespace worker; 

class SkillSet 
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A set of skills and their respective proficiencies
     */
    
    protected $skillLevels = array(); //skill levels indexed by skill name
    
    public function __construct(Array $skillLevels = array()) {
        
        foreach ($skillLevels as $skillLevel){
            $this->addSkillLevel($skillLevel);
        }
    }
    
    public function addSkillLevel(SkillLevel $skillLevel){
        $this->skillLevels[$skillLevel->getSkill()->getName()] = $skillLevel;
    }
    
    public function updateSkillLevel(Skill $skill, int $newLevel){
        //if skill is in skillLevels then update it
        if (array_key_exists ($skill->getName() , $this->skillLevels)) $this->skillLevels[$skill->getName()]->setLevel($newLevel);
        else {
            //else add a new skill to skillLevels
            $this->addSkillLevel(new SkillLevel($skill, $newLevel));
        }
    }
    
    public function getSkillLevel(Skill $skill){
        
        $skillLevel;
        //check whether skill is in skillLevels array, if it is, return the relevant skillLevel
        if (array_key_exists ($skill->getName() , $this->skillLevels)) $skillLevel = $this->skillLevels[$skill->getName()];
        else $skillLevel = new SkillLevel($skill, $skill->getMin ());
        //if not return a new skill level with the minimum value for the skill and add it to the array for future reference
        $this->addSkillLevel($skillLevel);
        return $skillLevel;
        
        //NOTE: It may seem peculiar that an arror is not thrown if the skill level does not exist, this is because the system
        //considers every worker to have every skill, with the lowest proficiency representing them 'not having' it
        //therefore, both the presence and absense of skills are meaningful
    }
}
