<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assinaturaHex = $_POST['assinatura'];
    $chavepub = $_POST['chavepub'];

    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $arquivoConteudo = file_get_contents($_FILES['arquivo']['tmp_name']);
        $assinatura = hex2bin($assinaturaHex);

        // Verifica a assinatura com o conteúdo do arquivo original
        $verificado = sodium_crypto_sign_verify_detached($assinatura, $arquivoConteudo, hex2bin($chavepub));

        if ($verificado) {
            echo "A assinatura é válida!";
        } else {
            echo "A assinatura é inválida!";
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
} else {
    echo "Nenhum dado foi enviado.";
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
    <h1>Verificação de Assinatura Digital</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="assinatura">Assinatura em hexadecimal</label>
        <br>
        <textarea name="assinatura" id="assinatura" rows="5" cols="60" required></textarea>
        <br>
        <label for="chavepub">Informe a chave pública</label>
        <br>
        <input type="text" name="chavepub" id="chavepub" required>
        <br>
        <label for="arquivo">Selecione o arquivo original</label>
        <br>
        <input type="file" name="arquivo" id="arquivo" required>
        <br>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>
