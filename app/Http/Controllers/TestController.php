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
        return Dictionary::where('word', 'like', '___')->inRandomOrder()->take(200)->get();
        
        
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
