<!-- Dev by Astou  -->
<?php
require_once('libs\lib_bdd.php');



if (isset($_POST['valider'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $num_tel = $_POST['num_tel'];
    $date_naiss = $_POST['date_naiss'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Hachage du mot de passe

    $result = insertInTable(
        'utilisateurs', 
        [null, $nom, $prenom, $mdp, $email, $num_tel, $date_naiss]
    );
    
    if ($result) {
        $message = "Inscription réussie !";
    } else {
        $message = "Erreur lors de l'inscription.";
    }
}









?>










<!DOCTYPE html>
 <html lang="fr">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page d'Inscription</title>
 </head>
 <body>
        <h1>Inscription ou création de compte</h1>
      <form method="post">
          <input type="text" name="nom" placeholder="nom" required><br><br>
         <input type="text" name="prenom" placeholder="prenom" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
         <input type="tel" name="num_tel" placeholder="Telephone" required><br><br>
        <input type="date" name="date_naiss" placeholder="Date de naissance" required><br><br>
        <input type="password" name="mdp" placeholder="Mot de passe" required><br><br>
        <button type="submit" name="valider">S'inscrire</button>
      </form>

    </div>
 </body>
 </html>