<?php
declare(strict_types=1);
namespace database;

interface DataAccessObject {
    /*
     * Author: Davidson Anthony Edwards
     * Purpose: A standard inferface for objects which interact with a data source
     */
    
    public function getAll();
    public function getById(string $id);
    public function getByCriteria(string $criteria, Array $values);
    public function update(Persistent $entity);
    public function delete(string $id);
    public function add(Persistent $entity);

}
