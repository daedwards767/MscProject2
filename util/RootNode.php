<?php
declare(strict_types=1);
namespace util; 

final class RootNode extends AbstractNode{
    
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: The root node of a tree, implemented as a singleton 
     */
    private static $instance;
    
    private function __construct(){
        $this->id = 'ROOT';
        $this->nodeDepth = 0;
        $this->childCount = 0;
        $this->parentCount = 0;
        $this->parents = NULL;
        $this->children = array();
    }
    
    public static function getInstance() {
        //Singleton implementation
        if (empty(self::$instance)){
            self::$instance = new RootNode();
        }
        return self::$instance;
    }
    
    public function addChild(AbstractNode $n) {
        $valid = assert(!array_key_exists($n->getId(), $this->children), "ERROR: The key specified already exists in the children array") && 
                assert(($n->nodeDepth == 1), "ERROR: Only nodes at level one can be connected to the root");
        if($valid){  //the key should not currently exist in the children array  
            $this->children[$n->getId()] = $n;
            $this->childCount++;
        }
    }

    public function removeChild(AbstractNode $n) {
        if(array_key_exists($n->getId(), $this->children)){  //the key should exist in the children array  
            unset($this->children[$n->getId()]);
            $this->childCount--;
        }
    }
    
    public function addParent(AbstractNode $n) {
        throw new RootException('ERROR: Cannot add parent to the root node.');
    }

    public function removeParent(AbstractNode $n) {
        throw new RootException('ERROR: Root node has no parents.');
    }
    
    public function getParents() {
        throw new RootException('ERROR: Root node has no parents.');
    }
    
}
