<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpdeskController;

Route::get('/', function() {
return view('portfolio');


});


Route::get('/helpdesk', [HelpdeskController::class, 
'index'])->name('helpdesk');

Route::post('/helpdesk', [HelpdeskController::class, 
'salvar'])->name('helpdesk.salvar');

<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');