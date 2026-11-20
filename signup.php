<?php
//Dev by Pablo

include('./libs/lib_bdd.php');
if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"])){
    try{
        
        $username = $_POST["prenom"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $pdo = getDB();

        $rqt = "INSERT INTO utilisateurs (prenom, email, mot_de_passe) 
                VALUES (:username, :email, SHA2(:pwd, 256))";

        $stmt = $pdo->prepare($rqt);
        $stmt->execute([
            ":username" => $username,
            ":email" => $email,
            ":pwd" => $password
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Inscription</title>
</head>
<body>
    <header style="display: none">
    </header>
    <main>
        <form method="POST">
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
    </main>
    <footer>

    </footer>
</body>
</html>