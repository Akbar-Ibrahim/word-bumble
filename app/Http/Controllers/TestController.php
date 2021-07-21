<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Services\ConsonantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    
    public function test(Request $request, ConsonantService $consonantService){
        $letter = $request->letter;
        $start = $request->start;
        $end = $request->end;

        // return Dictionary::where('word', 'like', '%' . $letter . '%' . $letter .'%')->where('word', 'not like', $letter . '%')->where('word', 'not like', '%' . $letter . $letter . '%')->where('word', 'not like', '%' . $letter)->inRandomOrder()->take(200)->get();
        // $result = Dictionary::where('word', 'like', $start . '%' . $end)->take(100)->get();
        // $result = DB::table('dictionaries')->where('word', 'like', '%' . $letter)->whereRaw('LENGTH(word) > ' . 4)->get();
        // $result = DB::table('dictionaries')->where('word', 'like', $letter . '%')->whereRaw('LENGTH(word) = ' . 4)->get();
        $result = Dictionary::where('word', 'like', '_j%')->get();
        $four = [];
        $five = [];
        $six = [];
        $seven = [];
        $eight = [];
        $nine = [];
        $ten = [];
        return $result;

        foreach ($result as $r) {
            if (strlen($r->word) == 4) {
                array_push($four, $r);

            } else if (strlen($r->word) == 5) {
                array_push($five, $r);

            } else if (strlen($r->word) == 6) {
                array_push($six, $r);

            } else if (strlen($r->word) == 7) {
                array_push($seven, $r);

            } else if (strlen($r->word) == 8) {
                array_push($eight, $r);

            } else if (strlen($r->word) == 9) {
                array_push($nine, $r);;

            } else if (strlen($r->word) == 10) {
                array_push($ten, $r);;
            }
        }
        return  "<h1> For " .$letter . "</h1>" .
        "four is " . count($four) . "<br>" .
        "five is " . count($five) . "<br>" .
        "six is " . count($six) . "<br>" .
        "seven is " . count($seven) . "<br>" .
        "eight is " . count($eight) . "<br>" .
        "nine is " . count($nine) . "<br>" .
        "ten is " . count($ten) . "<br>";
        
        // $check = "";

        $letter = $request->letter;
        $length = $request->length;

        // switch($letter) {
        //     case "a":
        //         $check = "aa";
        //         break;
        //     case "e":
        //         $check = "ee";
        //         break;
        //     case "i":
        //         $check = "ii";
        //         break;
        //     case "o":
        //         $check = "oo";
        //         break;
        //     case "u":
        //         $check ="uu";
        //         break;
        //         default:
        // }

        // $pattern = '/ba(na){2}/i';
        // // preg_match($pattern, $str); // Outputs 1
        // $str = '/[abc]/i';

        // $result = DB::table('dictionaries')->where('word', 'like', '%' . $check . '%')->whereRaw('LENGTH(word) > ' . 4)->get();
        // $result = DB::table('dictionaries')->whereRaw("word regex '[a-z]'")->get();
        // $result = Dictionary::where('word', 'like',  $letter . '%' . $letter)->take(100)->get();
        // return DB::table('dictionaries')->where('word', 'like', '%' . $letter . '%')->whereRaw('LENGTH(word) > ' . 18)->limit(300)->get();
        return DB::table('dictionaries')->where('word', 'like', $letter . '%')->whereRaw('LENGTH(word) = ' . $length)->limit(300)->get();

        // return $result;
    }
}
