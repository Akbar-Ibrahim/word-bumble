<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    //

    public function words() {

    $words = Dictionary::select('word')->take(250000)->get();
    $vowels = ["a", "e", "i", "o", "u"];
    $consonants = ["b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "q", "r", "s", "t", "v", "w", "x", "y", "z"];


    $result = [];
    

    foreach ($words as $word) {
        if(strlen($word->word) == 8) {
            if (in_array($word->word[0], $consonants)
            &&
            in_array($word->word[2], $consonants)
            &&
            in_array($word->word[4], $consonants)
            ) {
                // echo $word->word . "<br>";
                array_push($result, $word->word);
            }

        }

        
    }
    return response()->json($result);
    }


    public function wordsWithSpecificLength($length, $size){

        $words = Dictionary::select('word')->take($size)->get();
        $length = $length + 2;

        $result = [];
    

    foreach ($words as $word) {
        if(strlen($word->word) !== $length) {
                continue;
        } else {
            array_push($result, $word->word);
        }
    }
    return response()->json($result);

    }

    
}
