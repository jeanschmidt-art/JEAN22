<?php
     // 1. DECLARAR O CAMINHO DO ARQUIVO JSON
     $caminho = __DIR__ . "/dados.json";

     // 2. ABRIR/LER O ARQUIVO JSON
     $json = file_get_contents($caminho);

     // 3. TRANSFORMAR JSON EM ARRAY PHP
     $alunos = json_decode($json, true);

     // 4. CRIAR UM ALUNO
     $novoAluno = [
        "nome"=> "JEAN",
        "idade"=> 17,
        "curso"=> "Desenvolvimento de Sistemas"
     ];

     // 5. ADICIONAR O ALUNO NO ARRAY
     $alunos[] = $novoAluno;

     // 6. TRANSFORMAR ARRAY PHP EM JSON
     $jsonAtualizado = json_encode($alunos,
           JSON_PRETTY_PRINT  |
           JSON_UNESCAPED_UNICODE
    );

    // 7. SALVAR NO ARQUIVO
    file_put_contents($caminho,
    $jsonAtualizado);

    echo "DADOS RISTRADOS EM dados.json";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="Formulario">
        <h2 id="titulo">Formulario</h2>
        <form action="" method="POST"></form>

</div class="nome">
<label for="nome"> Nome:</label>
<input type="text" id="name" name="nome" placeholder="DIGITE SEU NOME COMPLETO"required>

    
</form>

<h2>ALUNOS CADASTRADOS</h2>
<?php foreach($alunos as $aluno) { ?>
     <h3><?= $aluno["nome"] ?></h3>
     <p>Idade: <?= $aluno["idade"] ?></p>
     <p>Curso: <?= $aluno["curso"] ?></p>
 <?php } ?>

</body>
</html>
