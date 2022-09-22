<?php

use Weareframework\PostmarkMadeEasy\Http\Controllers\Web\DashboardController;

Route::prefix('weareframework/postmark-made-easy')->group(function () {

    Route::get('/', ['\\'. DashboardController::class, 'index'])->name('weareframework.postmark-made-easy.dashboard.index');
    Route::post('/update', ['\\'. DashboardController::class, 'update'])->name('weareframework.postmark-made-easy.dashboard.update-settings');
    Route::get('/send-test', ['\\'. DashboardController::class, 'sendTest'])->name('weareframework.postmark-made-easy.dashboard.send-test');

});

