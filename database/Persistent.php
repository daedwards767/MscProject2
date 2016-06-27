<?php
declare(strict_types=1);
namespace database;

interface Persistent {
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: Interface to guarantee every persistent object has an accessible id
     */
    
    public function getId();
    public static function constructByRow(Array $results);

}