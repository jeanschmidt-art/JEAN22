<?php

$enviado = false;
$nome = $idade = "";
$media = 0;
$situacao = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enviado = true;

    // Recebendo os dados com $_POST
    $nome  = trim($_POST["nome"]);
    $idade = (int) $_POST["idade"];
    $nota1 = (float) $_POST["nota1"];
    $nota2 = (float) $_POST["nota2"];
    $nota3 = (float) $_POST["nota3"];
    $nota4 = (float) $_POST["nota4"];
    $nota5 = (float) $_POST["nota5"];

    // Média ponderada (soma dos pesos = 2 + 3 + 1 + 1 + 3 = 10)
    $media = ($nota1 * 2 + $nota2 * 3 + $nota3 * 1 + $nota4 * 1 + $nota5 * 3) / 10;

    // A situação é decidida pelo PHP
    if ($media >= 7) {
        $situacao = "APROVADO";
    } elseif ($media >= 5) {
        $situacao = "RECUPERAÇÃO";
    } else {
        $situacao = "REPROVADO";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Média do Aluno (POST)</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 420px; margin: 30px auto; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 6px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 8px 16px; }
        .resultado { margin-top: 25px; padding: 15px; border: 1px solid #999; border-radius: 6px; }
    </style>
</head>
<body>
    <h2>Cálculo de Média (método POST)</h2>

    <form method="POST" action="">
        <label>Nome do aluno:
            <input type="text" name="nome" required>
        </label>
        <label>Idade:
            <input type="number" name="idade" min="0" required>
        </label>
        <label>Nota 1 (peso 2):
            <input type="number" name="nota1" step="0.1" min="0" max="10" required>
        </label>
        <label>Nota 2 (peso 3):
            <input type="number" name="nota2" step="0.1" min="0" max="10" required>
        </label>
        <label>Nota 3 (peso 1):
            <input type="number" name="nota3" step="0.1" min="0" max="10" required>
        </label>
        <label>Nota 4 (peso 1):
            <input type="number" name="nota4" step="0.1" min="0" max="10" required>
        </label>
        <label>Nota 5 (peso 3):
            <input type="number" name="nota5" step="0.1" min="0" max="10" required>
        </label>
        <button type="submit">Enviar</button>
    </form>

    <?php if ($enviado): ?>
        <div class="resultado">
            <p><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></p>
            <p><strong>Idade:</strong> <?= $idade ?> anos</p>
            <p><strong>Média:</strong> <?= number_format($media, 2, ",", ".") ?></p>
            <p><strong>Situação:</strong> <?= $situacao ?></p>
        </div>
    <?php endif; ?>
</body>
</html>