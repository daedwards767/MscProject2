<?php
declare(strict_types=1);
namespace worker; 

abstract class Schedule{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: An abstract representation of a schedule
     */
    public abstract function getDatesUnavailable();
}
