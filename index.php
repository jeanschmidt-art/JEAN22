<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEAN22 aluno</title>
</head>
<body>
<?php

$nome = "Jean";
$idade = 17;



if ($idade >= 18) {
    $Status = "Você é maior de idade";
} else {
   $Status = "Você é menor de idade";
}
?>

<h1>Nome: <?= $nome ?></h1>
<p>Idade: <?= $idade ?></p>
<p>status: <?= $Status ?></p>

<form action="formulario" method="get">
<label for="idade">Idade:</label>
<input type="text" id="idade" name="idade">
<button type="submit">Enviar</button>

</form> 

</body>
</html>