<?php

include("./libs/lib_auth.php");
include("./libs/lib_token.php");


$payload = getPayloadJWT($_COOKIE["auth"]);

$idUser = $payload["id_utilisateur"];

echo $idUser;

$pdo = getDB();


$rqt = "SELECT * FROM utilisateurs WHERE id_utilisateur = :idUser";

?>