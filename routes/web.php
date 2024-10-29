<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/welcome/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('main');
});
Route::get('/formdata/', [
    FormController::class,
    'show'
]);
Route::post('/formdata/create', [
    FormController::class,
    'create'
]);
Route::get('/paginator/{page?}/', [
    FormController::class,
    'paginator'
]);
Route::get('/csv/export', [
    FormController::class,
    'csvExport'
]);

?>