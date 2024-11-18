<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DBController extends Controller
{
    public function backup() {
        return Artisan::call('db:backup');
    }
}
