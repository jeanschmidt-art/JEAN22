<?php

$nome = "";
$idade = 0;
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];

    if ($idade >= 18) {
        $resultado = "Você é maior de idade";
    } else {
        $resultado = "Você é menor de idade";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JEAN22 aluno</title>
    </head>
    <body>

        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">
            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade">
            <button type="submit">Enviar</button>
        </form> 

        <?php if($resultado != "") { ?>
            <p><?= $resultado ?></p>
        <?php } ?>

    </body>
</html>