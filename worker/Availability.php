<?php
declare(strict_types=1);
namespace worker; 

abstract class Availability{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: An abstract representation of a workers availability
     */
    public abstract function getDatesUnavailable();
}
