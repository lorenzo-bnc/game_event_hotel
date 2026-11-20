<?php

include('./libs/lib_bdd.php');

$pdo = getDB();

        $rqt = "SELECT * FROM evenements";

        $execution = $pdo->query($rqt);

        $result = $execution->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'acceuil des différents évenements</title>
  <link rel="stylesheet" href="style.css" >
</head>
<body>
     

    <div class="container">
        <?php
            foreach($result as $unResult){
                echo '<div><p>'.$unResult['nom'].'</p></div>';
                echo '<div><p>'.$unResult['description'].'</p></div>';
                echo '<div><p>'.$unResult['places_max'].'</p></div>';
                echo '<div><p>'.$unResult['date_heure_debut'].'</p></div>';
                echo '<div><p>'.$unResult['date_heure_fin_prevue'].'</p></div>';
                echo '<div><p>'.$unResult['date_heure_fin'].'</p></div>';
                echo '<div><p>'.$unResult['date_heure_debut_prevue'].'</p></div>';
                echo '<br/>';
            }
        ?>
        <div class="container1"></div>
        <div class="container2"></div>
        <div class="container3"></div>
    </div>
</body>
</html>
