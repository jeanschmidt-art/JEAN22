<?php
/* ==========================================================
   SISTEMA DE MÉDIA DO ALUNO - VERSÃO POST
   ========================================================== */
   /* ---------- 1. FUNÇÕES ---------- */

   
function calcularmedia($n1, $n2, $n3, $n4, $n5)
{
    return ($n1 * 2 + $n2 * 3 + $n3 * 1 + $n4 * 1 + $n5 *3) / 10;
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


    $media    = calcularMedia($nota1, $nota2, $nota3, $nota4, $nota5);
    $situacao = definirSituacao($media);

    $enviado = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br"
</head>
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
    
    <?php
/* ==========================================================
   SISTEMA DE MÉDIA DO ALUNO - VERSÃO GET
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

// Escolhe a classe de cor do resultado (também decidido pelo PHP)
function definirClasse($media)
{
    if ($media >= 7) {
        return "aprovado";
    } elseif ($media >= 5) {
        return "recuperacao";
    } else {
        return "reprovado";
    }
}


/* ---------- 2. VARIÁVEIS INICIAIS ---------- */
// Começam vazias: o resultado só existe depois do envio
$enviado  = false;
$nome     = "";
$idade    = 0;
$media    = 0;
$situacao = "";
$classe   = "";


/* ---------- 3. PROCESSAMENTO (somente se houve envio via GET) ---------- */
// Com GET, abrir a página também é uma requisição GET.
// Por isso conferimos também se os dados chegaram (isset).
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["nome"])) {

    // 3.1 Receber os dados
    $nome  = trim($_GET["nome"]);
    $idade = (int) $_GET["idade"];
    $nota1 = (float) $_GET["nota1"];
    $nota2 = (float) $_GET["nota2"];
    $nota3 = (float) $_GET["nota3"];
    $nota4 = (float) $_GET["nota4"];
    $nota5 = (float) $_GET["nota5"];

    // 3.2 Calcular e classificar
    $media    = calcularMedia($nota1, $nota2, $nota3, $nota4, $nota5);
    $situacao = definirSituacao($media);
    $classe   = definirClasse($media);

    $enviado = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Média do Aluno (GET)</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 30px 15px;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            background-attachment: fixed;
        }

        /* Bolhas de luz no fundo */
        body::before, body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            z-index: -1;
        }
        body::before { width: 350px; height: 350px; background: #7f5af0; top: -80px; left: -80px; opacity: .55; }
        body::after  { width: 400px; height: 400px; background: #2cb1bc; bottom: -100px; right: -100px; opacity: .45; }

        .card {
            max-width: 440px;
            margin: 0 auto;
            padding: 28px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 18px;
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        h2 { margin: 0 0 15px; text-align: center; }

        label { display: block; margin-top: 12px; font-size: 14px; color: #d6d6ff; }

        input {
            width: 100%;
            margin-top: 5px;
            padding: 10px 12px;
            color: #fff;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 8px;
            outline: none;
        }
        input:focus { border-color: #7f5af0; box-shadow: 0 0 0 3px rgba(127, 90, 240, 0.35); }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            background: linear-gradient(90deg, #7f5af0, #2cb1bc);
            border: none;
            border-radius: 10px;
            transition: transform .15s, box-shadow .15s;
        }
        button:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(127, 90, 240, 0.5); }

        .resultado {
            margin-top: 25px;
            padding: 18px;
            border-radius: 12px;
            border-left: 6px solid;
            background: rgba(0, 0, 0, 0.3);
        }
        .resultado p { margin: 8px 0; }
        .resultado .situacao { font-size: 22px; font-weight: bold; text-align: center; margin-top: 14px; }

        .aprovado    { border-color: #2ecc71; }
        .aprovado .situacao    { color: #2ecc71; }
        .recuperacao { border-color: #f1c40f; }
        .recuperacao .situacao { color: #f1c40f; }
        .reprovado   { border-color: #e74c3c; }
        .reprovado .situacao   { color: #e74c3c; }
    </style>
</head>
<body>

    <div class="card">

        <h2>📚 Cálculo de Média (GET)</h2>

        <!-- ---------- FORMULÁRIO ---------- -->
        <form method="GET" action="">

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
            <div class="resultado <?= $classe ?>">
                <p><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></p>
                <p><strong>Idade:</strong> <?= $idade ?> anos</p>
                <p><strong>Média:</strong> <?= number_format($media, 2, ",", ".") ?></p>
                <p class="situacao"><?= $situacao ?></p>
            </div>
        <?php endif; ?>

    </div>

    <?php
/* ==========================================================
   SISTEMA DE MÉDIA DO ALUNO - notas.php (versão POST)
   ========================================================== */


/* ---------- 1. FUNÇÕES ---------- */

// Calcula a média ponderada (soma dos pesos = 2+3+1+1+3 = 10)
function calcularMedia($n1, $n2, $n3, $n4, $n5)
{
    return ($n1 * 2 + $n2 * 3 + $n3 * 1 + $n4 * 1 + $n5 * 3) / 10;
}

// Valida se uma nota está entre 0 e 10
function notaValida($nota)
{
    return $nota >= 0 && $nota <= 10;
}

// Decide a situação do aluno, considerando média e frequência
function definirSituacao($media, $frequencia)
{
    if ($media >= 7 && $frequencia < 75) {
        return "REPROVADO POR FREQUÊNCIA";
    }

    if ($media == 10 && $frequencia >= 75) {
        return "APROVADO COM EXCELÊNCIA";
    }

    if ($media >= 7 && $frequencia >= 75) {
        return "APROVADO";
    }

    if ($media >= 5) {
        return "RECUPERAÇÃO";
    }

    return "REPROVADO";
}

// Escolhe a classe de cor do resultado (também decidido pelo PHP)
function definirClasse($situacao)
{
    if ($situacao === "APROVADO" || $situacao === "APROVADO COM EXCELÊNCIA") {
        return "aprovado";
    }

    if ($situacao === "RECUPERAÇÃO") {
        return "recuperacao";
    }

    // REPROVADO ou REPROVADO POR FREQUÊNCIA
    return "reprovado";
}

// Calcula quantos pontos faltam para a média 7 (só faz sentido abaixo de 7)
function pontosFaltantes($media)
{
    return 7 - $media;
}


/* ---------- 2. VARIÁVEIS INICIAIS ---------- */
// Começam vazias: o resultado só existe depois do envio
$enviado  = false;
$erro     = "";
$nome     = "";
$idade    = 0;
$media    = 0;
$situacao = "";
$classe   = "";
$faltam   = null;
$frequencia = 0;


/* ---------- 3. PROCESSAMENTO (somente se houve POST) ---------- */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 3.1 Receber os dados
    $nome       = trim($_POST["nome"]);
    $idade      = (int) $_POST["idade"];
    $nota1      = (float) $_POST["nota1"];
    $nota2      = (float) $_POST["nota2"];
    $nota3      = (float) $_POST["nota3"];
    $nota4      = (float) $_POST["nota4"];
    $nota5      = (float) $_POST["nota5"];
    $frequencia = (float) $_POST["frequencia"];

    // 3.2 Validações
    if ($idade <= 0) {
        $erro = "A idade deve ser maior que 0.";
    } elseif (
        !notaValida($nota1) || !notaValida($nota2) || !notaValida($nota3) ||
        !notaValida($nota4) || !notaValida($nota5)
    ) {
        $erro = "As notas devem estar entre 0 e 10.";
    } elseif ($frequencia < 0 || $frequencia > 100) {
        $erro = "A frequência deve estar entre 0% e 100%.";
    }

    // 3.3 Só calcula se passou nas validações
    if ($erro === "") {
        $media    = calcularMedia($nota1, $nota2, $nota3, $nota4, $nota5);
        $situacao = definirSituacao($media, $frequencia);
        $classe   = definirClasse($situacao);

        // Pontos que faltam só fazem sentido quando a média é menor que 7
        if ($media < 7) {
            $faltam = pontosFaltantes($media);
        }
    }

    $enviado = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Média do Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="card">

        <h2>📚 Cálculo de Média</h2>

        <!-- ---------- FORMULÁRIO ---------- -->
        <form method="POST" action="">

            <label>Nome do aluno:
                <input type="text" name="nome" required>
            </label>

            <label>Idade:
                <input type="number" name="idade" min="1" required>
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

            <label>Frequência (%):
                <input type="number" name="frequencia" step="0.1" min="0" max="100" required>
            </label>

            <button type="submit">Enviar</button>
        </form>

        <!-- ---------- MENSAGEM DE ERRO ---------- -->
        <?php if ($enviado && $erro !== ""): ?>
            <div class="resultado erro">
                <p><?= htmlspecialchars($erro) ?></p>
            </div>
        <?php endif; ?>

        <!-- ---------- RESULTADO (só aparece após envio válido) ---------- -->
        <?php if ($enviado && $erro === ""): ?>
            <div class="resultado <?= $classe ?>">
                <p><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></p>
                <p><strong>Idade:</strong> <?= $idade ?> anos</p>
                <p><strong>Média:</strong> <?= number_format($media, 2, ",", ".") ?></p>
                <p><strong>Frequência:</strong> <?= number_format($frequencia, 1, ",", ".") ?>%</p>

                <?php if ($faltam !== null): ?>
                    <p>Faltaram <?= number_format($faltam, 2, ",", ".") ?> pontos para atingir a média 7.</p>
                <?php endif; ?>

                <p class="situacao"><?= $situacao ?></p>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>

</body>
</html>

</body>
</html>

