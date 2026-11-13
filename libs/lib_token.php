<?php
//Dev by Pablo
$cle_secrete = "875b71e974075d5b65960329fcdc48ca6c3f9801dcc9429835dd91c029c292fc";

function makeJWT($header, $payload, $cle_secrete){
    $header64 = base64_encode(json_encode($header));
    $payload64 = base64_encode(json_encode($payload));
    $signature = base64_encode(hash_hmac("sha256",$header64.".".$payload64,$cle_secrete,true));

    return $header64.".".$payload64.".".$signature;
}
function getPayloadJWT($jwt){
    $tokenParts = explode(".",$jwt);

    $payload = $tokenParts[1];

    return json_decode(base64_decode($payload));
}
function checkJWT($jwt){

    $regex = "/(([A-Za-z0-9+\/!=]+)\.){2}(?2)/";

    if(preg_match($regex,$jwt) === 1){
        
        $tokenParts = explode(".",$jwt);

        $data = $tokenParts[0].".".$tokenParts[1];

        $hashWithSecret = hash_hmac("sha256",$data,"caca",true);

        $hashWithSecret_encode64 = base64_encode($hashWithSecret);

        return hash_equals($tokenParts[2],$hashWithSecret_encode64);
    }

}

?>