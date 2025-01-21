<?php

//Gera as duas chaves "juntas"
$chaves = sodium_crypto_sign_keypair();

//Extrair as chaves e converte para hexadecimal
$chavePublica = bin2hex(sodium_crypto_sign_publickey($chaves));
$chavePrivada = bin2hex(sodium_crypto_sign_secretkey($chaves));


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Chaves</h1>
    <p>chave privada</p>
    <?php echo $chavePrivada; ?>
    <p>chave publica</p>
    <?php echo $chavePublica; ?>
</body>
</html>