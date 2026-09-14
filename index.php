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

?>

<h1>Nome: <?= $nome ?></h1>
<p>Idade: <?= $idade ?></p>

<?php

if ($idade >= 18) {
    
    "<p>Você é maior de idade.</p>";
} else {
     "<p>Você é menor de idade.</p>";
}

?>

</body>
</html>