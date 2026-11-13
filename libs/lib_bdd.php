<?php
// Dev by Lorenzo
    function getDB() : PDO|PDOException
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=game_event_hotel;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        }
        catch(PDOException $error){
            return $error;
        }
    };

    function insertInTable(string $name, array $champs_and_values) : PDO|PDOException
    {
        try{
            $pdo = getDB();

            $rqt = <<<SQL
                INSERT INTO :name
                VALUES 
            SQL;

            $stmt = $pdo->prepare($rqt);
        }
    };

    