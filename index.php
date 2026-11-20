<?php

include('./libs/lib_bdd.php');

$pdo = getDB();

        $rqt = "SELECT * FROM evenements";

        $execution = $pdo->query($rqt);

        $result = $execution->fetchAll(PDO::FETCH_ASSOC);

        var_dump($result);
    

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
        <div class="container1"></div>
        <div class="container2"></div>
        <div class="container3"></div>
    </div>
</body>
</html>
