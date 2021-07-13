<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
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
}
