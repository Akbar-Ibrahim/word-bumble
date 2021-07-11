<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //

    public function test(Request $request){
        
        // $check = "";

        $letter = $request->letter;

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
        $result = Dictionary::where('word', 'like',  $letter . '%' . $letter)->get();
        return count($result);
    }
}
