<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ServiciosController extends Controller
{
    public function index()
    {
        return View('servicios.index');
    }
}
