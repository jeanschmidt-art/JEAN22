<?php
require "conexao.php";

// Tabela já com o novo campo ano_lancamento
$pdo->exec("CREATE TABLE IF NOT EXISTS jogos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    genero VARCHAR(50),
    nota INT,
    ano_lançamento INT
)");

// Se a tabela já existia (criada na versão sem o campo), adiciona a coluna
$existe = $pdo->query("SHOW COLUMNS FROM jogos LIKE 'ano_lancamento'")->rowCount();
if ($existe == 0) {
    $pdo->exec("ALTER TABLE jogos ADD ano_lancamento INT");
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome           = $_POST["nome"];
    $genero         = $_POST["genero"];
    $nota           = (int) $_POST["nota"];
    $ano_lancamento = (int) $_POST["ano_lancamento"];

    $nomeSeguro   = $pdo->quote($nome);
    $generoSeguro = $pdo->quote($genero);

    $sql = "INSERT INTO jogos (nome, genero, nota, ano_lancamento)
            VALUES ($nomeSeguro, $generoSeguro, $nota, $ano_lancamento)";
    $pdo->exec($sql);

    $mensagem = "Jogo cadastrado com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Jogos (Desafio)</title>
</head>
<body>
    <h1>Cadastro de Jogos</h1>

    <?php if ($mensagem): ?>
        <p style="color: green;"><strong><?= $mensagem ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome do jogo:</label><br>
        <input type="text" name="nome" maxlength="100" required><br><br>

        <label>Gênero:</label><br>
        <input type="text" name="genero" maxlength="50" required><br><br>

        <label>Nota:</label><br>
        <input type="number" name="nota" min="0" max="10" required><br><br>

        <label>Ano de lançamento:</label><br>
        <input type="number" name="ano_lancamento" min="1970" max="2100" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>