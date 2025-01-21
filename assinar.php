<?php

// Verifica se o arquivo foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivo'])) {
    $arquivo = $_FILES['arquivo'];
    $chavepriv = $_POST['chavepriv'];

    // Lê o conteúdo do arquivo
    $conteudoarq = file_get_contents($arquivo['tmp_name']);

    // Assina o conteúdo do arquivo
    $conteudoassinado = sodium_crypto_sign_detached($conteudoarq, hex2bin($chavepriv));

    // Converte o conteúdo assinado para hexadecimal
    $conteudoassinadoHex = bin2hex($conteudoassinado);

    echo "Arquivo assinado com sucesso!<br>";
    echo "Conteúdo assinado:<br>";
    echo "<textarea>$conteudoassinadoHex</textarea>";
} else {
    echo "Nenhum arquivo foi enviado.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Assinatura Digital de Arquivo</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="arquivo">Selecione o arquivo</label>
        <br>
        <input type="file" name="arquivo" id="arquivo" required>
        <br>
        <label for="chavepriv">Informe sua chave privada</label>
        <br>
        <input type="text" name="chavepriv" id="chavepriv" required>
        <br>
        <button type="submit">Assinar</button>
    </form>
</body>
</html>
