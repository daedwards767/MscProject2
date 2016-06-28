<?php
declare(strict_types=1);
namespace worker; 

interface PaymentInfo
{
    public function getPayment(int $duration);
}