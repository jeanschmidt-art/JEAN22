<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan:: command('inspire', function () {
$this->comment(Inspirin:: quote());
})->purpose('Display an inspiring quote');


?>