<?php
class Connection extends PDO
{
    private $hostName = 'localhost';
    private $dbName = 'ejercicio';
    private $bdUser = 'root';
    private $bdPassword = '';

    public function __construct()
    {
        try {
            parent::__construct("mysql:host=$this->hostName;dbname=$this->dbName", $this->bdUser, $this->bdPassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $er) {
            echo 'Error: ', $er->getMessage();
            exit;
        }
    }
    
}