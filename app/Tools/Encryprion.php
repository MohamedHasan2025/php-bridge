<?php

    require_once 'HDAPITools.php'; 

    $encryptor = new HDAPITools();

    $jsonData = '{"authcode":"vx62BL1uOqY3zjN+pDc20UZChB/PBr=dAfJcuDMg/g8n"}';       

    $data = json_decode($jsonData, true);

    $encryptedMessage = $encryptor->encrypt(json_encode($data));
    echo "Encrypted: " . $encryptedMessage . "\n";

?>