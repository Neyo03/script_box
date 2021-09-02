<?php 


class Database extends PDO{


    public function __construct(){
        $dbname =substr(__DIR__,16,10);
        parent::__construct("mysql:host=localhost;dbname=$dbname; charset=UTF8","root",
        "");
        // $this->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
           

    }





}