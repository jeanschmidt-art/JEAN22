<?php
/* ==========================================================
   SISTEMA DE MÉDIA DO ALUNO - VERSÃO POST
   ========================================================== */


/* ---------- 1. FUNÇÕES ---------- */

// Calcula a média ponderada (soma dos pesos = 2+3+1+1+3 = 10)
function calcularMedia($n1, $n2, $n3, $n4, $n5)
{
    return ($n1 * 2 + $n2 * 3 + $n3 * 1 + $n4 * 1 + $n5 * 3) / 10;
}

// Decide a situação do aluno de acordo com a média
function definirSituacao($media)
{
    if ($media >= 7) {
        return "APROVADO";
    } elseif ($media >= 5) {
        return "RECUPERAÇÃO";
    } else {
        return "REPROVADO";
    }
}


/* ---------- 2. VARIÁVEIS INICIAIS ---------- */
// Começam vazias: o resultado só existe depois do envio
$enviado  = false;
$nome     = "";
$idade    = 0;
$media    = 0;
$situacao = "";


/* ---------- 3. PROCESSAMENTO (somente se houve POST) ---------- */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 3.1 Receber os dados
    $nome  = trim($_POST["nome"]);
    $idade = (int) $_POST["idade"];
    $nota1 = (float) $_POST["nota1"];
    $nota2 = (float) $_POST["nota2"];
    $nota3 = (float) $_POST["nota3"];
    $nota4 = (float) $_POST["nota4"];
    $nota5 = (float) $_POST["nota5"];

    // 3.2 Calcular e classificar
    $media    = calcularMedia($nota1, $nota2, $nota3, $nota4, $nota5);
    $situacao = definirSituacao($media);

    $enviado = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Média do Aluno (POST)</title>
    <style>
        body      { font-family: Arial, sans-serif; max-width: 420px; margin: 30px auto; padding: 0 15px; }
        label     { display: block; margin-top: 10px; }
        input     { width: 100%; padding: 6px; box-sizing: border-box; }
        button    { margin-top: 15px; padding: 8px 16px; cursor: pointer; }
        .resultado { margin-top: 25px; padding: 15px; border: 1px solid #999; border-radius: 6px; }
    </style>
</head>
<body>

    <h2>Cálculo de Média (método POST)</h2>

    <!-- ---------- FORMULÁRIO ---------- -->
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

    <!-- ---------- RESULTADO (só aparece após o envio) ---------- -->
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