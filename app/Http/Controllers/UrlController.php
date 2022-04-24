<?php

namespace App\Http\Controllers;

use Rollbar\Laravel\RollbarServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class UrlController extends Controller
{
    public function index()
    {
        Log::debug('Test debug message');
        print_r("Превед медвед!");
    }
}
