<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}