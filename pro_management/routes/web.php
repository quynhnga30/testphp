<?php
use App\Http\Controllers\productController;
use App\Http\Controllers\categoryController;
use Illuminate\Support\Facades\Route;


// Redirects to the product Resource Controller
Route::get('/', function () {
    return redirect('/products');
});

Route::resource('products', productController::class);

Route::get('/', function () {
    return redirect('/categories');
});

Route::resource('categories', categoryController::class);
?>

