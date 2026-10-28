<?php
//////////////////////////////////////////////
// SISTEMA DE CONTROLE DE PRODUÇÃO INDUSTRIAL//
///////////////////////////////////////////////

// 1. CLASSE ABSTRATA
abstract class Maquina {
    public $nome;
    private $produção;



    public function __construct($nome)
    {
        $this->nome = $nome;
        $this->produção = 0;
        
    }

    // ENCAPSULAMENTO - GETTER
    public function getProducao() {
        return $this->produção;
    }

    //ENCAPSULAMENTO - ALTERAÇÃO CONTROLADA
    public function registrarpRODUCAO($quantidade) {
        if ($quantidade <= 0) {
            return false;
        }

        $this->produção += $quantidade;
        return true;
    }

// ABSTRAÇÃO
abstract public function operar();
}

// 2. HERANÇA
class Esteira extends Maquina {
    public function operar() {
        return "Transportando peças. . .";
    }
}


class Prensa extends Maquina {
    public function operar() {
        return "Prensando peças. . .";
    }
}

class RoboSoldagem extends Maquina {
    public function operar () {
        return "Soldando peças. . .";
    }
}


// 3. SESSÃO = ARMAZENAMENTO TEMPORÁRIO

if (!isset($_SESSION["maquinas"])) {
    $_SESSION["maquinas"] = [];
}

$mensagem = "";

// 4. RECEBER FORMULARIO VIA POST


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST["nome"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $quantidade = $_POST["quantidade"] ?? null;

    if(
        $nome === ""  ||
        $quantidade === false ||
        $quantidade <= 0
    ){
       $mensagem = "Preencha os campos corretamente!";
} else{
    // CRIANDO OBJETOS COM BASE NO FORMULARIO
    if ($tipo === "esteira") {
        $maquina = new Esteira($nome);
    } elseif ($tipo === "prensa") {
        $maquina = new Prensa($nome);
    } elseif ($tipo === "robosoldagem") {
        $maquina = new RoboSoldagem($nome);
    }

    // EXECUTANDO OS MÉTODOS DO OBJETO
    $maquina->registrarProducao($quantidade);

    // GUARDADO O OBJETO NA SESSÃO
    $_SESSION["maquinas"][] = $maquina;

    $mensagem = "Maquina cadastrada com sucesso!";
   }
}

// Evitar interpretar textos como HTML
function escapar($texto) {
    return htmlspecialchars(
        (string) $texto,
        ENT_QUOTES,
        "UTF-8");
    
    }   
?>