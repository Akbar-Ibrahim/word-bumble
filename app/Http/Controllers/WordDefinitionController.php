<?php

namespace App\Http\Controllers;

use App\Models\CommonWord;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class WordDefinitionController extends Controller
{
    //

    public function getWords() {
        
        return CommonWord::where('word', 'not like', '%ness')->inRandomOrder()->take(20)->get();

        // $response = Http::get('https://api.dictionaryapi.dev/api/v2/entries/en_US/elephant');
    }

    public function getWord($length) {
        // return Dictionary::inRandomOrder()->first();
        return DB::table('dictionaries')->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->take(1)->get();
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

    public function getTheWords($first, $last){

                return Dictionary::where("word", "like", $first . "%" . $last)->inRandomOrder()->take(20)->get();

    }


}
