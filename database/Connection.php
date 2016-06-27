<?php
namespace database;

final class Connection{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: To represent a database connection
    */    
    
    private $user;
    private $password;
    private $db;
    private $server;
    private $connection;
    
    const errorMsg = "ERROR: Unsuccessful connection: ";
    
    function __construct(string $user = 'root', string $password = '', string $db = 'prototype', string $server = 'localhost'){
        $this->connect($server, $user, $password, $db);
    }
    
    private function connect($server, $user, $password, $db){
        $this->server = $server;       
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;     
        $this->connection = new \mysqli($server, $user, $password, $db);
        $this->checkFailure();
    }
    
    private function checkFailure(){
        if ($this->connection->connect_error) {
            die(self::errorMsg . $this->connection->connect_error);
        }
    }
    
    public function getConnection(){
        return $this->connection;
    }
    
}




