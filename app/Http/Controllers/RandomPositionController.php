<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class RandomPositionController extends Controller
{
    //

    public function randomPosition(Request $request){

        $word = strtolower($request->word);
        $position = $request->position;
        $letter = $request->letter;

        $checkWord = Dictionary::where('word', $word)->first();

        $check = "";

        for ($i = 1; $i <= $position; $i++) {
            if ($i == $position) {
                $check = $check . $letter;
            } else {
                $check = $check . "_";
            }
        }
// return Dictionary::where('word', 'like', $check . '%')->inRandomOrder()->first();
        if ($checkWord) {
            return Dictionary::where('id', '!=', $checkWord->id)->where('word', 'like', $check . '%')->inRandomOrder()->first();
        } else {
            return [];
        }
    }
}
