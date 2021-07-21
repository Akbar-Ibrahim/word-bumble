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

    public function getWord() {
        return Dictionary::inRandomOrder()->first();
    }
    
    public function everyLetter(Request $request){

        if ($request->has('word') && !empty($request->input('word'))) {
            $word = $request->word;
            // $last_letter = $word[-1];
            $letter = $request->letter;

            $check = Dictionary::where(["word" => $word])->first();

            if ($check) {
                return Dictionary::where("id", "!=", $check->id)->where("word", "like", "%" . $letter)->inRandomOrder()->first();

            } else {
                return [];
            }
        } else {
            return "hello";
        }
    }


}