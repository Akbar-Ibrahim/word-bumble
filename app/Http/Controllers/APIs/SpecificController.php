<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SpecificLengthController extends Controller
{
    //

    public function specificNumberOfLetters(Request $request){

        if ($request->has('wordLength') && !empty($request->input('wordLength')) ) { 
            $wordLength = $request->wordLength;
            $playerWord = $request->playerWord;
            $check = Dictionary::where(["word" => $playerWord])->first();

            if ($check) {
            $result = DB::table('dictionaries')->whereRaw('LENGTH(word) = ' . $wordLength)->inRandomOrder()->limit(1)->get();
            return $result;
            }else {
                return [];
            }
        } else {
            return [];
        }
    }


    public function specificNumberOfLettersWithOptions(Request $request)
    {

        if ($request->has('length') && !empty($request->input('length')) ) {
            $length = $request->length;

        if (($request->has('contains') && !empty($request->input('contains'))) && ($request->has('start') && !empty($request->input('start'))) && ($request->has('end') && !empty($request->input('end'))) ) {
            $contains = $request->contains;
            $start = $request->start;
            $end = $request->end;
            
            return DB::table('dictionaries')->where('word', 'like', '%' . $contains .'%' )->where('word', 'like', $start . '%')->where('word', 'like', '%' .$end)->whereRaw('LENGTH(word) = ' . $length)->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();

        } else if (($request->has('contains') && !empty($request->input('contains'))) && ($request->has('start') && !empty($request->input('start'))) ) {
            $contains = $request->contains;
            $start = $request->start;

            return DB::table('dictionaries')->where('word', 'like', '%' . $contains.'%' )->where('word', 'like', $start . '%')->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } else if (($request->has('contains') && !empty($request->input('contains'))) && ($request->has('end') && !empty($request->input('end'))) ) {
            $contains = $request->contains;
            $end = $request->end;

            return DB::table('dictionaries')->where('word', 'like', '%' . $contains.'%' )->where('word', 'like', '%' . $end)->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } else if ($request->has('contains') && !empty($request->input('contains')) ) {
            $contains = $request->contains;

            return DB::table('dictionaries')->where('word', 'like', '%' . $contains.'%' )->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } else if (($request->has('start') && !empty($request->input('start'))) && ($request->has('end') && !empty($request->input('end'))) ) {
            $start = $request->start;
            $end = $request->end;

            return DB::table('dictionaries')->where('word', 'like', $start .'%' )->where('word', 'like', '%' . $end)->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } else if ($request->has('start') && !empty($request->input('start')) ) {
            $start = $request->start;

            return DB::table('dictionaries')->where('word', 'like', $start.'%' )->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } else if ($request->has('end') && !empty($request->input('end')) ) {
            $end = $request->end;

            return DB::table('dictionaries')->where('word', 'like', '%' . $end )->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } 
        
        

    } else {
        return "error";
    }
    }
}
