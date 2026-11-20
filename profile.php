<?php

include("./libs/lib_auth.php");


$payload = getPayloadJWT($_COOKIE["auth"]);

$idUser = $payload["id_utilisateur"];

echo $idUser;

$pdo = getDB();


$rqt = "SELECT * FROM utilisateurs WHERE id_utilisateur = :idUser";

$stmt = $pdo->prepare($rqt);
        $stmt->execute([
            ":idUser" => $idUser
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

?>