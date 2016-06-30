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
        return ($d && $d->format('Y-m-d') === $date) || ($date === date('0000-00-00'));
    }
    
    public static function phpToMysql(string $date){
        return $mysqldate = date( 'Y-m-d H:i:s', $date ); 
    }
    
    public static function mysqlToPhp(string $date = NULL){
        $phpdate = date('0000-00-00');
        if (!(empty($date))) $phpdate = date('Y-m-d', strtotime( $date ));
        return $phpdate;
    }
}

