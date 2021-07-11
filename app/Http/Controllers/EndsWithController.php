<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class EndsWithController extends Controller
{
    //
    public function endsWith($letter)
    {
        $words = Dictionary::select('word')->get();

        $result = [];


        foreach ($words as $word) {
            if(strlen($word->word) > 3) {
            $last_letter = strlen($word->word);
            $l = $last_letter - 2;
            if ($word->word[$last_letter] === $letter) {
                array_push($result, $word->word);
            }
        }
    }
        return response()->json($result);
    }
}
