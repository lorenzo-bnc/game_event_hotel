<?php
include("./libs/lib_bdd.php");
include("./libs/lib_token.php");

if(isset($_COOKIE['auth'])){
   if(checkJWT($_COOKIE['auth'])){
        header('Location: index.php');
    }
}

if(isset($_POST["email"]) && isset($_POST["password"])){
    try{
        $pdo = getDB();

        $email = $_POST["email"];
        $password = $_POST["password"];

        $rqt = "SELECT COUNT(*) AS nb, id_utilisateur 
                FROM utilisateurs
                WHERE email = :email 
                AND mot_de_passe = SHA2(:pwd, 256)";

        $stmt = $pdo->prepare($rqt);
        $stmt->execute([
            ":email" => $email,
            ":pwd" => $password
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result["nb"] == 1){
            
            echo "connexion réussie";

            $expiration = date("Y-m-d H:i:s", strtotime("+15 minutes"));

            $idUser = $result["id_utilisateur"];

            $header = [
                "alg" => "sha256",
                "typ" => "JWT"
            ];

            $payload = [
                "id_utilisateur" => "$idUser",
                "expiration" => "$expiration"
            ];

            $jwt = makeJWT($header, $payload);
            setcookie("auth", $jwt);

            header('Location: index.php');
        }
        else{
            echo "connexion échouée";
        }
    }
    catch(PDOException $error){
        $error->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('./includes/header.php'); ?>
    <title>Connexion</title>
</head>
<body>
    <header style="display: none">
    </header>
    <main>
        <form method="POST">
            <input type="email" name="email" placeholder="Entrez votre email" required>
            <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </main>
    <footer>

    </footer>
</body>
</html>