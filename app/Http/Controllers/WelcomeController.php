<?php

namespace App\Http\Controllers;

use App\Services\UtilService;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function welcome(UtilService $utilService){

        $letters = $utilService->letters();

        return view('welcome', compact('letters'));
    }
}
