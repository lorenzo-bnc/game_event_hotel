<?php
include("lib_token.php");
include("lib_bdd.php");

function logOut(){
    setcookie("auth", "suppression...", 1);
    header('Location: login.php');
}

function isAdmin($jwt){
    $payload = getPayloadJWT($jwt);
    $id_utilisateur = $payload["id_utilisateur"];

    try{
        $pdo = getDB();

        $rqt = "SELECT COUNT(*) AS nb 
                FROM organisateurs
                WHERE id_organisateur = :id_utilisateur";

        $stmt = $pdo->prepare($rqt);
        $stmt->execute([
            ":id_utilisateur" => $id_utilisateur
        ]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result["nb"] == 1){
            return true;
        }

        return false;
    }
    catch(PDOException $error){
        $error->getMessage();
    }
}

function verifCnx(){
    if(isset($_COOKIE['auth'])){
        if(!checkJWT($_COOKIE['auth'])){
            logOut();
        }
    }
    else{
        header('Location: login.php');
    }
}
