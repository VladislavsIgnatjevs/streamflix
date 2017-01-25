<?php

/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 24/01/2017
 * Time: 17:39
 */
class StreamflixMongo
{

    public $result = false;
    public $db = false;
    public $collection = false;
    public $parameters = false;
    public $connection = false;



    public function __construct()
    {


        $this->Connect();
        $this->parameters = [];
    }


    function Connect() {
        $this->connection = new MongoClient('mongodb');
    }

    function selectCollection($collection) {
        $this->collection= new MongoCollection($this->connection->selectDB('streamflixmongodb'), trim($collection));
    }



}