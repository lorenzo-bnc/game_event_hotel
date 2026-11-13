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

    /**
     * Résumé de insertInTable
     * @param string $tableName
     * @param array $champsAndValues
     * @return bool | PDOException
     */
    function insertInTable(string $tableName, array $champsAndValues): bool|PDOException
    {
        try {
            $pdo = getDB();

            $champs = "";
            $placeholders = "";
            $values = [];

            foreach ($champsAndValues as $nameChamp => $valuesChamp) {
                $champs = $champs . $nameChamp . ", ";
                $placeholders = $placeholders . ":" . $nameChamp . ", ";
                $values[":" . $nameChamp] = $valuesChamp;
            }

            $champs = rtrim($champs, ", ");
            $placeholders = rtrim($placeholders, ", ");

            $rqt = "INSERT INTO $tableName ($champs)
                    VALUES ($placeholders)";

            $stmt = $pdo->prepare($rqt);
            $result = $stmt->execute($values);

            return $result ? true : false;
        }
        catch (PDOException $error) {
            return $error;
        }
    }