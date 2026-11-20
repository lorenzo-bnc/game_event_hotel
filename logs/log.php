<?php

include("config.php");

class Logger {

    private static function canLog($niveau) {
        global $niveau_log;
        return $niveau >= $niveau_log;
    }

    public static function infoLog($message){
        if (!self::canLog(3)) return;
        $log = $message;
        file_put_contents("logs/Les_Logs".date("Y-m-d").".log", $log, FILE_APPEND);
    }

    public static function errorLog($message){
        if (!self::canLog(2)) return;
        $log = $message;
        file_put_contents("logs/Les_Logs".date("Y-m-d").".log", $log, FILE_APPEND);
    }

    public static function warnLog($message){
        if (!self::canLog(1)) return;
        $log = $message;
        file_put_contents("logs/Les_Logs".date("Y-m-d").".log", $log, FILE_APPEND);
    }



    public static function debugLog($message){
        if (!self::canLog(0)) return;
        $log = $message;
        file_put_contents("logs/Les_Logs".date("Y-m-d").".log", $log, FILE_APPEND);
    }
    

}

?>