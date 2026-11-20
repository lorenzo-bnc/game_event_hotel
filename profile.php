<?php

include("./libs/lib_auth");
include("./libs/lib_token");


$idUser = getPayloadJWT($_COOKIE["auth"])["id_utilisateur"];

echo $idUser;

$pdo = getDB();


$rqt = "SELECT * FROM utilisateurs WHERE id_utilisateur = :idUser";

?>