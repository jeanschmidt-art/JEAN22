<?php
require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';
require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
require_once __DIR__ . '/../app/Http/Controllers/LoginController.php';
require_once __DIR__ . '/../app/Http/Controllers/IdadeController.php';
require_once __DIR__ . '/../app/Http/Controllers/NotasController.php';
require_once __DIR__ . '/../app/Http/Controllers/JsonController.php';



// Listando em arrays as rotas que vamos criar.
return [
    'GET' => [
        'portfolio' => [new PortifolioController(), 'index'],
        //'helpdesk' => [new HelpdeskController(), 'index'],
        'jogos' => [new JogosController(), 'index'],
        'json'  => [new JsonController(), 'index'],
        'notas' => [new NotasController(), 'index'],
        'login' => [new LoginController(), 'index'],
        'idade' => [new IdadeController(), 'index'],


        
         //outras atividades...
    ],
    'POST' => [
        //'helpdesk' => [new HelpdeskController(), '']
    ]
  ];

?>