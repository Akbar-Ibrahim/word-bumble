<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Services\ConsonantService;
use App\Services\UtilService;
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

    public function endsWith(Request $request)
    {

        if ($request->has('word') && !empty($request->input('word'))) {
            $word = $request->word;
            // $last_letter = $word[-1];
            $letter = $request->letter;

            $check = Dictionary::where(["word" => $word])->first();

            if ($check) {
                if ($request->has('length') && !empty($request->input('length'))) {
                    $length = $request->length;
                return DB::table('dictionaries')->where('id', '!=', $check->id)->where('word', 'like', '%' . $letter)->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(1)->get();
                } else {
                return Dictionary::where("id", "!=", $check->id)->where("word", "like", "%" . $letter)->inRandomOrder()->first();
                }
            } else {
                return [];
            }
        } else {
            return "hello";
        }
    }


    public function beginingAndEndWithSpecificLength(Request $request)
    {

        if ($request->has('word') && !empty($request->input('word'))) {
            $word = $request->word;
            // $length = strlen($word);
            $length = $request->length;
            $last_letter = $word[-1];

            $check = Dictionary::where(["word" => $word])->first();

            if ($check) {
                return DB::table('dictionaries')->where('id', '!=', $check->id)->where('word', 'like', $last_letter . '%')->whereRaw('LENGTH(word) = ' . $length)->inRandomOrder()->limit(1)->get();
            } else {
                return [];
            }
        } else {
            return "hello";
        }
    }

    public function beginsAndEndsWith(Request $request, UtilService $utilService)
    {

        if ($request->has('word') && !empty($request->input('word'))) {
            $word = $request->word;
            $letters = $utilService->lettersForBeginingAndEnd();
            $myLetter = array_rand($letters, 1);

            $letter = $letters[$myLetter];


            $check = Dictionary::where(["word" => $word])->first();

            if ($check) {

                switch ($letter) {
                    case "a":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "b":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "c":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "d":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "e":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "f":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "g":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "h":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "i":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "k":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "l":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "m":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $$letter)->inRandomOrder()->first();
                        break;


                    case "n":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "o":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;


                    case "p":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                        
                    case "r":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $$letter)->inRandomOrder()->first();
                        break;


                    case "s":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "t":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "u":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "v":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "w":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "x":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "y":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;

                    case "z":
                        return Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $letter)->inRandomOrder()->first();
                        break;
                    default:
                }




                // $result = Dictionary::where("id", "!=", $check->id)->where("word", "like", $letter . "%" . $$letter)->inRandomOrder()->get();
                $result = Dictionary::where("word", "like", $letter . "%" . $letter)->inRandomOrder()->get();
                return count($result);
            } else {
                return [];
            }
        } else {
            return "hello";
        }
    }

    public function beginsAndEndsWithVowels(Request $request){

        $word = $request->word;

        $check = Dictionary::where(["word" => $word])->first();
        $vowels = [];
        
        if ($check) {
            $a = Dictionary::where('word', 'like', 'a%a')->orWhere('word', 'like', 'a%e')->orWhere('word', 'like', 'a%i')->orWhere('word', 'like', 'a%o')->orWhere('word', 'like', 'a%u')->inRandomOrder()->first();
            $e = Dictionary::where('word', 'like', 'e%a')->orWhere('word', 'like', 'e%e')->orWhere('word', 'like', 'e%i')->orWhere('word', 'like', 'e%o')->orWhere('word', 'like', 'e%u')->inRandomOrder()->first();
            $i = Dictionary::where('word', 'like', 'i%a')->orWhere('word', 'like', 'i%e')->orWhere('word', 'like', 'i%i')->orWhere('word', 'like', 'i%o')->orWhere('word', 'like', 'i%u')->inRandomOrder()->first();
            $o = Dictionary::where('word', 'like', 'o%a')->orWhere('word', 'like', 'o%e')->orWhere('word', 'like', 'o%i')->orWhere('word', 'like', 'o%o')->orWhere('word', 'like', 'o%u')->inRandomOrder()->first();
            $u = Dictionary::where('word', 'like', 'u%a')->orWhere('word', 'like', 'u%e')->orWhere('word', 'like', 'u%i')->orWhere('word', 'like', 'u%o')->orWhere('word', 'like', 'u%u')->inRandomOrder()->first();

            array_push($vowels, $a);
            array_push($vowels, $e);
            array_push($vowels, $i);
            array_push($vowels, $o);
            array_push($vowels, $u);

            $choice = array_rand($vowels, 1);

            $result = $vowels[$choice];
            return $result;
        } else {
            return [];
        }

    }

    public function beginsAndEndsWithConsonants(Request $request, ConsonantService $consonantService){

        $word = $request->word;
        $letter = $request->letter;

        $check = Dictionary::where(["word" => $word])->first();
        
        
        if ($check) {
                return $consonantService->getLetter($letter);
            
        } else {
            return [];
        }

    }
}
