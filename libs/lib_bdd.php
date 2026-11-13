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

    function insertInTable(string $tableName, array $values) : bool|PDOException
    {
        try{
            $pdo = getDB();

            $filler = "";
            foreach($values as $value) {
                $filler .= "?, ";
            }

            $filler = rtrim($filler, ', ');
            
            $rqt = <<<SQL
                INSERT INTO $tableName SELECT $filler
            SQL;

            $stmt = $pdo->prepare($rqt);
            $result = $stmt->execute($values);

            if($result){
                return true;
            }
            
            return false;
        }
        catch(PDOException $error){
            return $error;
        }
    };

    