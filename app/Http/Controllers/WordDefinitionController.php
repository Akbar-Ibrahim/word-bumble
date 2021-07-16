<?php

namespace App\Http\Controllers;

use App\Models\CommonWord;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WordDefinitionController extends Controller
{
    //

    public function getWords() {
        
        return CommonWord::where('word', 'not like', '%ness')->inRandomOrder()->take(20)->get();

        // $response = Http::get('https://api.dictionaryapi.dev/api/v2/entries/en_US/elephant');
    }
}
