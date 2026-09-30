<?php

require "conexao.php";
echo "debug 1";

//Cria a tabela 
$sql = "CREATE TABLE IF NOT EXISTS jogos (
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100),
genero VARCHAR(50),
nota INT
)";

$pdo->exec($sql);
echo "debug 2";

//Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
echo "debug 3";

$nome = $_POST["nome"];
$genero = $_POST["genero"];
$nota = $_POST["nota"];

// Cadastrar jogo
$sql = "INSERT INTO jogos (nome, genero, nota,)
        VALUES ('$nome', '$genero','$nota')";

      $pdo->exec($sql);
      echo "debug 4";

      echo "Jogo cadastrado com sucesso!";

      // Buscar todos os jogos ristrados no banco de dados 
      $buscar = "SELECT * FROM jogos";

      //exerc() = executa algo quando voce NÃO precisa registros de volta 
      // query() = executa uma consulta quando voce QUER receber dados de volta
      $stat = $pdo->query($buscar);

      // fetchAll = buscar todos os registros 
      $jogos = $stmt->fetchAll (PDO::FETCH_ASSOC);

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cadastro de Jogos</title>
</head>

<body>
    
    <h2>Jogos cadastrados</h2>

    <form method="POST">

    <div>
        <label for="nome">Nome do jogo:</label>
        <input
        type="text"
        id="nome"
        name="nome"
        placeholder="Digite o nome do jogo"
        required
>
    </div>

    <br>


    <div>
        <label for="genero">Genero:</label>
        <input
        type="number"
        id="nota"
        name="nota"
        placeholder="Digite a nota"
        required

        >
    </div>

    <br>

    <buttom type="submit">Cadastrar</button>

</form>
</body>

</html>