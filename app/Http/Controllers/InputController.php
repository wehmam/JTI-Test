<?php

namespace App\Http\Controllers;

use App\Services\Socket;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Container\Container;
use Pusher\Pusher as Pusher;

class InputController extends Controller
{
    public function index() {
        return view('pages.input');
    }
}
