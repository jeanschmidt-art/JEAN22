<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="idade.php">VERIFICADOR DE IDADE</a>
    <a href="notas.php">VERIFICADOR DE notas</a>

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