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
        //use if installed mongo.so for php <= php-fpm 5.9
        //$this->connection = new MongoClient('mongodb');
        $this->connection  = (new MongoDB\Client('mongodb://mongodb_streamflix'));

    }

    function selectCollection($collection) {

        $this->collection = $this->connection->streamflixmongodb->$collection;
        //use if installed mongo.so for php <= php-fpm 5.9
        //$this->collection= new MongoCollection($this->connection->selectDB('streamflixmongodb'), trim($collection));
    }



}