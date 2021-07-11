<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Services\UtilService;
use Faker\Provider\bn_BD\Utils;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlternatingController extends Controller
{
    //

    public function startWithConsonant(Request $request, UtilService $utilService)
    {

        if ($request->has('word') && !empty($request->input('word'))) {
            $word = strtolower($request->word);
            $consonants = $utilService->consonants();
            if (in_array($word[0], $consonants)) {

                if ($request->has('same') && !empty($request->input('same')) ) {

                }
                $r = "";
                for ($i = 0; $i < strlen($word) - 1; $i++) {
                    $r = $r . "_";
                }
                $consonant_val = array_rand($consonants);
                $value = $consonants[$consonant_val] . $r;
                // return $value;
                return DB::table('dictionaries')->where('word', 'like', $value)->inRandomOrder()->limit(1)->get();
                // return Dictionary::where("word", "like", $value )->inRandomOrder()->first();
            } else {
                return "Your word did nnot begin with a consonant ";
            }
        }
    }

    public function consonantAlt(UtilService $utilService){

        return in_array('b', $utilService->consonants());
        return Dictionary::where('word', 'like', in_array('b', $utilService->consonants()) . '%')->get();
    }
}
