<?php
declare(strict_types=1);
namespace util; 

abstract class AbstractNode {
    /*
     * Author: Davidson Anthony Edwards 
     * Purpose: An abstraction of a node
     */
    
    protected $id;
    protected $parents = array();
    protected $children = array();
    protected $childCount = 0;
    protected $parentCount = 0;
    protected $nodeDepth;
    
    public function getId(){
        return $this->id;
    }
    
    public abstract function addChild(AbstractNode $n);
    public abstract function removeChild(AbstractNode $n);
    public abstract function addParent(AbstractNode $n);
    public abstract function removeParent(AbstractNode $n); 
    
    public function getParents() {
        return $this->parents;
    }

    public function getChildren() {
        return $this->children;
    }

    public function getChildCount() {
        return $this->childCount;
    }

    public function getParentCount() {
        return $this->parentCount;
    }
    
    public function getNodeDepth(){
        return $this->nodeDepth;
    }
}
