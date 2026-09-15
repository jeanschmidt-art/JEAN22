<?php

$nome = "";
$idade = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $idade = $_POST["idade"];

    if ($idade >= 18) {
        $resultado = "$nome, você é maior de idade.";
    } else {
        $resultado = "$nome, você é menor de idade.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verificação de Idade</title>
</head>

<body>

    <h1>Verificação de Idade</h1>

    <form method="POST">

        <label for="nome">Nome:</label>
        <input
            type="text"
            id="nome"
            name="nome"
            required
        >

        <br><br>

        <label for="idade">Idade:</label>
        <input
            type="number"
            id="idade"
            name="idade"
            min="0"
            required
        >

        <br><br>

        <button type="submit">Enviar</button>

    </form>

    <?php if ($resultado != "") { ?>

        <p><?= $resultado ?></p>

    <?php } ?>

</body>

</html>