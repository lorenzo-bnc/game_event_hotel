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

            if (preg_match('/[A-Za-z_][A-Za-z0-9_]*/', $tableName) === 0) {
                throw new PDOException("Nom de table invalide");
            }

            $champs = [];
            $placeholders = [];
            $values = [];

            foreach ($champsAndValues as $unChamp) {
                $name = trim($unChamp['name']);
                $value = $unChamp['value'];

                if (preg_match('/[A-Za-z_][A-Za-z0-9_]*/', $name) === 0) {
                    throw new PDOException("Nom de colonne invalide : " . $name);
                }

                $champs[] = $name;
                $placeholders[] = ':' . $name;
                $values[':' . $name] = $value;
            }

            $champsSql = implode(', ', $champs);
            $valuesSql = implode(', ', $placeholders);

            $rqt = <<<SQL
                INSERT INTO $tableName ($champsSql)
                VALUES ($valuesSql)
            SQL;

            $stmt = $pdo->prepare($rqt);
            $result = $stmt->execute($values);

            return $result ? true : false;
        } catch (PDOException $error) {
            return $error;
        }
    }