<?php
require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';
require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';


// Listando em arrays as rotas que vamos criar.
return [
    'GET' => [
        'portfolio' => [new PortifolioController(), 'index'],
        //'helpdesk' => [new HelpdeskController(), 'index'],
        'jogos' => [],
         //outras atividades...
    ],
    'POST' => [
        //'helpdesk' => [new HelpdeskController(), '']
    ]
  ];

?>