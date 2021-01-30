<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class QuienesSomosController extends Controller
{
    public function index()
    {
        return View('quienes_somos.index');
    }
}
