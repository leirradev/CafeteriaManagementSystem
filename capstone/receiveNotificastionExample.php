<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include('ChikkaSMS.php');
$clientId = 'f04ac114bc8654d73e111d24947b3ad6cb9654d85de0153f16be0d2c2e8c7712';
$secretKey = '56e5e2c131d8f76240b76c6831579fbf3beef92b2f9bb1c6ad4a3b4425b262a5';
$shortCode = '29290123123';
$chikkaAPI = new ChikkaSMS($clientId, $secretKey, $shortCode);

if($_POST){
    
    if ($chikkaAPI->receiveNotifications() === null) {
            header("HTTP/1.1 400 Error");
            echo "Message has not been processed.";
        }
    else{
        echo "Message has been successfully processed.";
    }
    var_dump($chikkaAPI->receiveNotifications());
}
?>
