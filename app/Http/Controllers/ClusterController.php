<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClusterController extends Controller
{
    //

    public function vowelUncluster(Request $request){
        

        $playerWord = $request->playerWord;

        $checkPlayerWord = Dictionary::where(['word' => $playerWord])->first();

        if ($checkPlayerWord) {
            return $checkPlayerWord;
    } else {
        return [];
    }
    }

    public function vowelCluster(Request $request){
        
        $check = "";

        $letter = $request->letter;

        switch($letter) {
            case "a":
                $check = "aa";
                break;
            case "e":
                $check = "ee";
                break;
            case "i":
                $check = "ii";
                break;
            case "o":
                $check = "oo";
                break;
            case "u":
                $check ="uu";
                break;
                default:
        }
        
        $result = DB::table('dictionaries')->where('word', 'like', '%' . $check . '%')->whereRaw('LENGTH(word) > ' . 4)->get();
        return count($result);
    }
}
