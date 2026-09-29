<?php

// dados para conectar o mySQL
$host = "localhost";
$banco = "jean315";
$usuario = "jean315";
$senha = "315!@#";


//PDO - php data objects - ferramenta do php para conversar com o banco de dados
try {
     

     $pdo = new PDO("mysql:host=$host;dbnane:$banco;charset=utf8mb4",$usuario, $senha);
     $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
     );

    echo"Conectado com Sucesso";

    } catch (PDOException $erro) {
        echo "erro ao Conectar:".$erro->getMessage();
    }

