<?php
declare(strict_types=1);
namespace util; 

class DateValidator
{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A utility class for validating and converting date strings
     */
    
    public static function validateDate(string $date)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
    
    public static function phpToMysql(string $date){
        return $mysqldate = date( 'Y-m-d H:i:s', $date ); 
    }
}

