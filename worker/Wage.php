<?php
declare(strict_types=1);
namespace worker; 

class Wage implements \worker\PaymentInfo
{
    protected $hourlyWage;
    protected $overtimeWage;
    protected $regularHours;
    
    public function __construct(float $hourlyWage, float $overtimeWage = NULL, int $regularHours = 40){
        if(
                assert($hourlyWage >= 0, 'ERROR: Hourly wage is negative') &&
                assert((($overtimeWage >= 0) || empty($overtimeWage)), 'ERROR: Hourly wage is negative') &&
                assert($hourlyWage >= 0, 'ERROR: Hourly wage is negative')
           )
        {
            $this->hourlyWage = $hourlyWage;
            if (empty($overtimeWage)) {
                $overtimeWage = $hourlyWage;
            }
            $this->overtimeWage = $overtimeWage;
            $this->regularHours = $regularHours;
        }
        else throw new \Exception('ERROR: Invalid parameters passed to constructor');
        
    }
    
    public function getPayment(int $duration) {
        assert($duration >= 0, 'ERROR: Duration provided is negative');
        $payment = 0;
        if ($duration > $this->regularHours) {
            $payment += ($duration - $this->regularHours) * $this->overtimeWage;
            $payment += $this->regularHours * $this->hourlyWage;
        }
        else $payment += $duration * $this->regularHours;
        assert($payment >= 0, 'ERROR: Payment calculated is negative');
        return $payment;
    }
    
    public function getHourlyWage() {
        return $this->hourlyWage;
    }

    public function getOvertimeWage() {
        return $this->overtimeWage;
    }

    public function getRegularHours() {
        return $this->regularHours;
    }

    public function setHourlyWage($hourlyWage) {
        $this->hourlyWage = $hourlyWage;
    }

    public function setOvertimeWage($overtimeWage) {
        $this->overtimeWage = $overtimeWage;
    }

    public function setRegularHours($regularHours) {
        $this->regularHours = $regularHours;
    }



}