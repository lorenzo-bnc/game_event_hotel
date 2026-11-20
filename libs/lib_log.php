<?php

function addLog($message, $type){
    $autorizedType = ["DEBUG", "INFO", "WARN", "DANGER"];
    
    foreach($autorizedType as $aType){
        if($aType == strtoupper($type)){
            $log = "[$aType] - $message;";
            file_put_contents("./logs/log_".date("Y-m-d").".log", $log, FILE_APPEND);
        }
    }
}