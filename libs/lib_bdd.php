<?php

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
    }

    