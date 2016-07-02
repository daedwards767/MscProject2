<?php
declare(strict_types=1);
namespace database;

abstract class DatabaseDao implements DataAccessObject{
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: An abstract class for accessing objects stored in a database
     */
    
    protected $tablename;
    
    public function __construct() {
        assert(!empty($this->tablename), 'ERROR: Table name cannot be empty');
    }
    
    public function getByCriteria(string $criteria, Array $values, string $errorMsg = "No results match the criteria supplied") {
        $connection = new \database\Connection();
        $sql = "SELECT * FROM $this->tablename WHERE $criteria";
        $statement = $connection->getConnection()->prepare($sql);
        // I want to be able to send multiple values!
        //changed value from string to array
        
        
        
        $types = '';
        $typeMap = array (
            'integer' => 'i',
            'string' => 's',
            'double' => 'd'
        ); 
        foreach ($values as $value){
            $types .= $typeMap[gettype($value)];
        } 
        assert($types != '', 'ERROR: The type string is empty');
        
        $bind_parameters = array();
        $bind_parameters[] = &$types;
        foreach ($values as $value){
            $bind_parameters[] = &$value ;
        }
        
       //print_r($sql);
        call_user_func_array(array($statement, 'bind_param'), $bind_parameters);
        //$statement->bind_param("s", $value);
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();
        $connection->getConnection()->close();

        if ($result->num_rows == 0){
            throw new NoResultException();
        } else { 
            
             $objectArray = array();
             
             while ($resultArray = $result->fetch_assoc()) {
                 $object = $this->makeObject($resultArray);
                 array_push($objectArray, $object);
             }

             return $objectArray;
       }
    }
    
    public function getAll() {
        return $this->getByCriteria('?', array(1), "There were no results in the table specified, $this->tablename");
    }
    
    public function getById(string $id) {      
        return $this->getByCriteria('id=?', array($id), "No results match the id supplied")[0];
    }
    
    public function add(Persistent $entity) {
        $this->commit($entity);
    }
    
    public function update(Persistent $entity) {
        $this->commit($entity);
    }
    
    public function delete(string $id) {
        $connection = new \database\Connection();
        $sql = "DELETE FROM $this->tablename WHERE id=?";
        $statement = $connection->getConnection()->prepare($sql);
        $statement->bind_param("s", $id);
        $statement->execute();
        $statement->close();
        $connection->getConnection()->close();
    }
    
    abstract protected function commit(Persistent $entity);
    abstract protected function makeObject(Array $rawResult);
}
