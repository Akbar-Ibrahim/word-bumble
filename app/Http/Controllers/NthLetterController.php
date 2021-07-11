<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Services\UtilService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NthLetterController extends Controller
{
    //
    public $alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];

    public function specificPosition(Request $request, UtilService $utilService)
    {

        // include starts with, ends with, contains :)

        if (($request->has('letter') && !empty($request->input('letter'))) && ($request->has('position') && !empty($request->input('position'))) && ($request->has('playerWord') && !empty($request->input('playerWord'))) ) {
            $letter = $request->letter;
            $position = $request->position;
            $playerWord = $request->playerWord;

            $checkWord = Dictionary::where(['word' => $playerWord])->first();

            if ($checkWord) {

            if ($utilService->is_letter($letter) && is_numeric($position)) {

                $check = "";
                for ($i = 1; $i <= $position; $i++) {
                    if ($i == $position) {
                        $check = $check . $letter;
                    } else {
                        $check = $check . "_";
                    }
                }

                if ($request->has('length') && !empty($request->input('length'))) {
                    $length = $request->length;
                    if (is_numeric($length)) {
                        return DB::table('dictionaries')->where('word', 'like', $check . '%')->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(1)->get();
                    } else {
                        return "check parameter value";
                    }
                } else {
                    return DB::table('dictionaries')->where('word', '!=', $checkWord->id)->where('word', 'like', $check . '%')->inRandomOrder()->limit(1)->get();
                }
            } else {
                return "Check parameter value";
            }
        } else {
            return [];
        }
        }
    }

    public function specificPositionWithFirstLetter(Request $request, UtilService $utilService)
    {

        if (($request->has('letter') && !empty($request->input('letter'))) && ($request->has('position') && !empty($request->input('position'))) && ($request->has('start') && !empty($request->input('start'))) ) {
            $letter = $request->letter;
            $start = $request->start;
            $position = $request->position;

            if ($utilService->is_letter($letter) && is_numeric($position) && $utilService->is_letter($start) ) {


                $check = "";
                for ($i = 1; $i <= $position; $i++) {
                    if ($i == 1) {
                        $check = $check . $start;
                    } else if ($i == $position) {
                        $check = $check . $letter;
                    } else {
                        $check = $check . "_";
                    }
                }

                if ($request->has('length') && !empty($request->input('length'))) {
                    $length = $request->length;
                    if (is_numeric($length)) {
                        return DB::table('dictionaries')->where('word', 'like', $check . '%')->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(1000)->get();
                    } else {
                        return "check parameter value";
                    }
                } else {
                    return DB::table('dictionaries')->where('word', 'like', $check . '%')->inRandomOrder()->limit(1)->get();
                }
            } else {
                return "Check parameter value";
            }
        }
    }

    public function specificPositionWithLastLetter(Request $request, UtilService $utilService)
    {

        if (($request->has('letter') && !empty($request->input('letter'))) && ($request->has('position') && !empty($request->input('position'))) && ($request->has('end') && !empty($request->input('end'))) ) {
            $letter = $request->letter;
            $end = $request->end;
            $position = $request->position;
            

            if (!$utilService->is_letter($letter) || !is_numeric($position) ) {
                
                return "Check parameter value";
            }

            if (strlen($end) > 1) {
                for($i = 0; $i < strlen($end); $i++ ) {
                    if (!$utilService->is_letter($end[$i]) ) {
                        return "multiple not a letter";
                    }
                }
            } else {
                if (!$utilService->is_letter($end) ) {
                    return "single not a letter";
                }
            }
            




            $letter = strtolower($request->letter);

                $check = "";
                for ($i = 1; $i <= $position; $i++) {
                    if ($i == $position) {
                        $check = $check . $letter;
                    } else {
                        $check = $check . "_";
                    }
                }

                if ($request->has('length') && !empty($request->input('length'))) {
                    $length = $request->length;
                    if (is_numeric($length)) {
                        return DB::table('dictionaries')->where('word', 'like', $check . '%' . $end)->whereRaw('LENGTH(word) = ' . $length)->limit(1000)->get();
                    } else {
                        return "check parameter value";
                    }
                } else {
                    return DB::table('dictionaries')->where('word', 'like', $check . '%' . $end)->limit(100)->get();
                }
            
        }
    }

}
