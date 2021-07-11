<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BeginingAndEndController extends Controller
{
    //

    public function beginingAndEnd(Request $request)
    {

        if ($request->has('word') && !empty($request->input('word'))) {
            $word = $request->word;
            $last_letter = $word[-1];

            $check = Dictionary::where(["word" => $word])->first();

            if ($check) {
            return Dictionary::where("id", "!=", $check->id)->where("word", "like", $last_letter . "%")->inRandomOrder()->first();
            } else {
                return [];
            }
        } else {
            return "hello";
        }
    }

    public function beginingAndEndWithSpecificLength(Request $request)
    {

        if ($request->has('word') && !empty($request->input('word')) ) {
            $word = $request->word;
            $length = strlen($word);
            $last_letter = $word[-1];

            $check = Dictionary::where(["word" => $word])->first();

            if ($check) {
            return DB::table('dictionaries')->where('id', '!=', $check->id)->where('word', 'like', $last_letter .'%' )->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(1)->get();
            } else {
                return "not a word";
            }
            
            
        } else {
            return "hello";
        }
    }
}
