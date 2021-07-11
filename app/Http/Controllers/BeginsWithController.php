<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Services\UtilService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BeginsWithController extends Controller
{
    //


    public function beginsWith($letter, $length, Request $request)
    {
        
        return DB::table('dictionaries')->where('word', 'like', $letter.'%' )->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();


    }

    public function beginsAndEndWithSameLetter(Request $request){

        if ($request->has('letter') && !empty($request->input('letter')) ) { 
            $letter = $request->letter;
            if ($request->has('length') && !empty($request->input('length')) ) { 
                $length = $request->length;
            return DB::table('dictionaries')->where('word', 'like', $letter . '%' .$letter )->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            }
            return DB::table('dictionaries')->where('word', 'like', $letter . '%' .$letter )->take(1000)->get();
        }
    }

    public function startAndEndWithConsonant(Request $request, UtilService $utilService)
    {

        if (($request->has('begin') && !empty($request->input('begin'))) && ($request->has('end') && !empty($request->input('end'))) ) {
            $begin = strtolower($request->begin);
            $end = strtolower($request->end);

            if (!$utilService->is_letter($begin) || !$utilService->is_letter($end)) {
                return "not a letter";
            }

            $consonants = $utilService->consonants();
            if (in_array($begin, $consonants) && in_array($end, $consonants)) {
            
                if ($request->has('length') && !empty($request->input('length')) ) {
                    $length = $request->length;
                if (is_numeric($length)) {

                return DB::table('dictionaries')->where('word', 'like', $begin . '%' . $end)->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(100)->get();
                // return Dictionary::where("word", "like", $begin . '%' . $end)->limit(100)->get();
                } else {
                    return "not numeric";
                }
            } else {
                return DB::table('dictionaries')->where('word', 'like', $begin . '%' . $end)->inRandomOrder()->limit(100)->get();
            }


            } else {
                return "Your word did nnot begin with a consonant ";
            }
        }





        if ($request->has('begin') && !empty($request->input('begin')) ) {
            $begin = strtolower($request->begin);

            if (!$utilService->is_letter($begin)) {
                return "not a letter";
            }

            $consonants = $utilService->consonants();
            $value = array_rand($consonants);
            if (in_array($begin, $consonants)) {
            
                if ($request->has('length') && !empty($request->input('length')) ) {
                    $length = $request->length;
                if (is_numeric($length)) {

                return DB::table('dictionaries')->where('word', 'like', $begin . '%' . $consonants[$value])->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(100)->get();
                // return Dictionary::where("word", "like", $begin . '%')->limit(100)->get();
                } else {
                    return "not numeric";
                }
            } else {
                return DB::table('dictionaries')->where('word', 'like', $begin . '%')->inRandomOrder()->limit(100)->get();
            }


            } else {
                return "Your word did nnot begin with a consonant ";
            }
        }






        if ($request->has('end') && !empty($request->input('end')) ) {
            $end = strtolower($request->end);

            if (!$utilService->is_letter($end)) {
                return "not a letter";
            }

            $consonants = $utilService->consonants();
            $value = array_rand($consonants);
            if (in_array($end, $consonants)) {
            
                if ($request->has('length') && !empty($request->input('length')) ) {
                    $length = $request->length;
                if (is_numeric($length)) {

                return DB::table('dictionaries')->where('word', 'like', $consonants[$value] . '%' . $end)->whereRaw('LENGTH(word) = ' . $length)->limit(100)->get();
                // return Dictionary::where("word", "like", $begin . '%')->limit(100)->get();
                } else {
                    return "not numeric";
                }
            } else {
                return DB::table('dictionaries')->where('word', 'like', $begin . '%')->inRandomOrder()->limit(100)->get();
            }


            } else {
                return "Your word did nnot begin with a consonant ";
            }
        }
    }

    public function startAndEndWithVowel(Request $request, UtilService $utilService)
    {

        if (($request->has('begin') && !empty($request->input('begin'))) && ($request->has('end') && !empty($request->input('end'))) ) {
            $begin = strtolower($request->begin);
            $end = strtolower($request->end);

            if (!$utilService->is_letter($begin) || !$utilService->is_letter($end)) {
                return "not a letter";
            }

            $vowels = $utilService->vowels();
            if (in_array($begin, $vowels) && in_array($end, $vowels)) {
            
                if ($request->has('length') && !empty($request->input('length')) ) {
                    $length = $request->length;
                if (is_numeric($length)) {

                return DB::table('dictionaries')->where('word', 'like', $begin . '%' . $end)->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(100)->get();
                // return Dictionary::where("word", "like", $begin . '%' . $end)->limit(100)->get();
                } else {
                    return "not numeric";
                }
            } else {
                return DB::table('dictionaries')->where('word', 'like', $begin . '%' . $end)->inRandomOrder()->limit(100)->get();
            }


            } else {
                return "Your word did nnot begin with a vowel ";
            }
        }





        if ($request->has('begin') && !empty($request->input('begin')) ) {
            $begin = strtolower($request->begin);

            if (!$utilService->is_letter($begin)) {
                return "not a letter";
            }

            $vowels = $utilService->vowels();
            $value = array_rand($vowels);
            if (in_array($begin, $vowels)) {
            
                if ($request->has('length') && !empty($request->input('length')) ) {
                    $length = $request->length;
                if (is_numeric($length)) {

                return DB::table('dictionaries')->where('word', 'like', $begin . '%' . $vowels[$value])->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(100)->get();
                // return Dictionary::where("word", "like", $begin . '%')->limit(100)->get();
                } else {
                    return "not numeric";
                }
            } else {
                return DB::table('dictionaries')->where('word', 'like', $begin . '%')->inRandomOrder()->limit(100)->get();
            }


            } else {
                return "Your word did nnot begin with a vowel ";
            }
        }






        if ($request->has('end') && !empty($request->input('end')) ) {
            $end = strtolower($request->end);

            if (!$utilService->is_letter($end)) {
                return "not a letter";
            }

            $vowels = $utilService->vowels();
            $value = array_rand($vowels);
            if (in_array($end, $vowels)) {
            
                if ($request->has('length') && !empty($request->input('length')) ) {
                    $length = $request->length;
                if (is_numeric($length)) {

                return DB::table('dictionaries')->where('word', 'like', $vowels[$value] . '%' . $end)->whereRaw('LENGTH(word) = ' . $length)->limit(100)->get();
                // return Dictionary::where("word", "like", $begin . '%')->limit(100)->get();
                } else {
                    return "not numeric";
                }
            } else {
                return DB::table('dictionaries')->where('word', 'like', $begin . '%')->inRandomOrder()->limit(100)->get();
            }


            } else {
                return "Your word did nnot begin with a vowel ";
            }
        }
    }
}
