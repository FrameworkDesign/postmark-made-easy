<?php

use Weareframework\PostmarkMadeEasy\Http\Controllers\Web\DashboardController;

Route::prefix('weareframework/postmark-made-easy')->group(function () {

    Route::get('/', ['\\'. DashboardController::class, 'index'])->name('weareframework.postmark-made-easy.dashboard.index');
    Route::post('/update', ['\\'. DashboardController::class, 'update'])->name('weareframework.postmark-made-easy.dashboard.update-settings');
    Route::get('/send-test', ['\\'. DashboardController::class, 'sendTest'])->name('weareframework.postmark-made-easy.dashboard.send-test');

    Route::post('/install-other-packages', ['\\'. DashboardController::class, 'installOtherPackages'])->name('weareframework.postmark-made-easy.dashboard.install-other-packages');
    Route::post('/remove-other-packages', ['\\'. DashboardController::class, 'removeOtherPackages'])->name('weareframework.postmark-made-easy.dashboard.remove-other-packages');

});

