<?php
declare(strict_types=1);
namespace database;

trait PersistentTrait {
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: Trait to allow easy implementation of the Persistent interface
     */

    protected $id;
    
    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }
}



