<?php

include("./libs/lib_auth.php");
include("./libs/lib_token.php");


$idUser = getPayloadJWT($_COOKIE["auth"])["id_utilisateur"];

echo $idUser;

$pdo = getDB();


$rqt = "SELECT * FROM utilisateurs WHERE id_utilisateur = :idUser";

?>