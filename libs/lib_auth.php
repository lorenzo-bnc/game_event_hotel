<?php
// Dev by Pablo
include("lib_token.php");

function verifCnx(){
    if(isset($_COOKIE['auth'])){
        if(!checkJWT($_COOKIE['auth'])){
            unset($_COOKIE['auth']);
            header('Location: login.php');
        }
    }
}


?>