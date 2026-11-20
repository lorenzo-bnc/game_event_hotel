<?php
include("lib_token.php");

function logOut(){
    setcookie("auth", "suppression...", 1);
    header('Location: login.php');
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

function isAdmin($jwt){
    $payload = getPayloadJWT($jwt);
    $id_utilisateur = $payload["id_utilisateur"];

    
}