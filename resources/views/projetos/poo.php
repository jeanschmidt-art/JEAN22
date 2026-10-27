<?php

// Exemplo SEM PDO
$nome = "Jean";
$vida = 100;

function atacar($nome) {
    echo "$nome realizou um ataque!";
}

atacar($nome);


// Exemplos COM PDO
class Personagem {
    public $nome;
    private $vida;
    public $dano;

    public function __construct($nome, $vida, $dano) {
$this->nome = $nome;
$this->vida = $vida;
$this->dano = $dano;
    }

    // GETTER
    public function getVIDA() {
        return $this->vida;
    }
          
    // SETTER
    public function setVIDA($vida) {
        if ($vida < 0) {
            echo "A vida não pode ser negativa!\n";
            return;
        }

        $this->vida = $vida;
    }      

    public function atacar() {
        echo "$this->nome realizou um ataque!";
    }
}

$Jean = new Personagem("Jean", 100, 10);

$Jean->setVida(50);

$personagem = new Personagem("Jean", 100, 10);
$aurora = new Personagem("Aurora", 50, 5);
$personagem ->atacar("Chloe", 30, 3);

$andre = new Personagem("Andre", 100, 10);
$personagem2->nome = "Jean";

$Jean->atacar(); // método herdado
$Guerreiro->defender(); // método próprio

class Mago extends Personagem {
    public function lancaMagia() {
        echo "$this->nome lançou um bola de fogo!\n";
    }
}

$mago = new Mago("Aurora", 50, 5);

$mago->atacar();      // Herdado de Personagem
$mago->lancaMagia(); // Própria de Mago


class Guerreiro extends Personagem {
    public function defender() {
        echo "$this->nome levantou o escudo!";
    }
}

$Guerreiro = new Guerreiro("Jean", 100, 10);

$Guerreiro->atacar(); //Método Herdado
$Guerreiro->defender();//Métedo Próprio
?>