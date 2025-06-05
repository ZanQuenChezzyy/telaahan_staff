<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/print/{nomor}', [PdfController::class, 'print'])->name('telaahanStaff.print');
