<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index() {
        return 'Hello';
    }

    public function world_message() {
        return 'Wolrd';
    }
}
