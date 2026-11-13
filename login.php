<!-- Dev by Pablo and Astou  -->
<?php
include('./libs/lib_bdd.php');
include('./libs/lib_token.php');



if(isset($_POST["email"]) && isset($_POST["password"])){

    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $connexion = mysqli_connect("localhost","root","","game_event_hotel");

    $sql = "SELECT COUNT(*) AS nb, id_utilisateur, prenom FROM utilisateurs WHERE email = ? AND mot_de_passe = ?";

    $requete = mysqli_prepare($connexion, $sql);

    mysqli_stmt_bind_param($requete, "ss", $email, $password);

    mysqli_stmt_execute($requete);

    $resultat = mysqli_stmt_get_result($requete);

    $chaqueLigne = mysqli_fetch_assoc($resultat);


    $resultat = mysqli_query($connexion, $sql);

    while($chaqueLigne = mysqli_fetch_assoc($resultat)){
        if($chaqueLigne["nb"] == 1){

            $id_utilisateur = $chaqueLigne["id_utilisateur"];
            $prenom = $chaqueLigne["prenom"];



            $header = [
                "alg" => "sha256",
                "typ" => "JWT"
            ];

            $payload = [
                "id_utilisateur" => "$id_utilisateur",
                "prenom" => "$prenom"
            ];

            $jwt = makeJWT($header, $payload);

            setcookie("auth",$jwt);

            header("Location: index.php");
        }
        else{
            header("Location: login.php");
        }

    }

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>
        <form method="POST">
            
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>