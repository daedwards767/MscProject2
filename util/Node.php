<?php
declare(strict_types=1);
namespace util; 

class Node extends AbstractNode{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A very general type of node. Can be used to build trees, forests, graphs, multitrees through extension
     */

    protected static $nodeCount = 0;
    
    public function __construct(String $id, Array $parents = array(), Array $children = array()) {
        $this->id = $id;
        self::$nodeCount++;
        foreach ($parents as $parent){
            assert(is_a($parent, 'Node'), 'ERROR: Object in array parents is not a Node');
            $this->addParent($parent);
        }
        foreach ($children as $child){
            assert(is_a($child, 'Node'), 'ERROR: Object in array children is not a Node');
            $this->addChild($child);
        }
        $this->updateNodeDepth();
    }
    
  
    public function addChild(AbstractNode $n){
        if(assert(!array_key_exists($n->getId(), $this->children), 'ERROR: The key specified already exists in the children array')){ 
            //the key should not currently exist in the children array  
            $n->addParent($this);
            $this->children[$n->getId()] = $n;
            $this->childCount++;
        }
    }
    
    public function removeChild(AbstractNode $n){
        if(assert(array_key_exists($n->getId(), $this->children), 'ERROR: The key specified does not exist in the children array')){  
        //the key should exist in the children array  
            $n->removeParent($this);
            unset($this->children[$n->getId()]);
            $this->childCount--;
        }
    }
    
    public function addParent(AbstractNode $n){
        if(assert(!array_key_exists($n->getId(), $this->parents), 'ERROR: The key specified already exists in the parents array')){  //the key should not currently exist in the parent array  
            $this->parents[$n->getId()] = $n;
            $this->parentCount++;
            $this->updateNodeDepth(); //reset the depth of this node
        }
    }
    
    public function removeParent(AbstractNode $n){
        if (assert(array_key_exists($n->getId(), $this->parents), 'ERROR: The key specified does not exist in the parents array')){ 
        //the key should exist in the parent array  
            unset($this->parents[$n->getId()]);
            $this->parentCount--;
            $this->updateNodeDepth(); //reset the depth of this node
        }
    }

    public static function getNodeCount(){
        return self::$nodeCount; 
    }
    
    protected function updateNodeDepth(){
        $depth = 0;
        foreach($this->parents as $parent){ //find the deepest parent
            if ($parent->getNodeDepth() > $depth){
                $depth = $parent->getNodeDepth();
            }
        }
        $depth++; //add one
        if (($this->nodeDepth == 1) && ($depth > 1)) RootNode::getInstance()->removeChild($this);
        //if this node would have been previously added to the root then remove it
        $this->nodeDepth = $depth;
        if ($depth == 1) RootNode::getInstance ()->addChild($this);
        //if this node is at the lowest level connect it to the root
        
    }
    
}