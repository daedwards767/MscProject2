<?php
declare(strict_types=1);
namespace worker; 

class Skill implements \database\Persistent
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: One of the worker skills in the system
     */
    
    protected $name;
    protected $min;
    protected $max;
    
    public function __construct(string $name, int $min = 0, int $max = 5){
        $this->name = $name;
        $this->min = $min;
        $this->max = $max;        
    }
    
    public static function constructByRow(array $results) {       
        assert(array_key_exists ('id', $results) && array_key_exists ('min_value', $results ) && array_key_exists ('max_value', $results ),
                'ERROR: Required keys not in array provided');
        return new Skill($results['id'], $results['min_value'], $results['max_value']);
    }
    
    public function getid(){
        return getName();
    }
    
    public function getName() {
        return $this->name;
    }

    public function getMin() {
        return $this->min;
    }

    public function getMax() {
        return $this->max;
    }
    
}