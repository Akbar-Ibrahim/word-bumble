<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContainsController extends Controller
{
    //





    public function contains(Request $request)
    {
        
        if ($request->has('contains') && !empty($request->input('contains')) ) {
            $contains = $request->contains;

        if (($request->has('length') && !empty($request->input('length'))) && ($request->has('start') && !empty($request->input('start'))) && ($request->has('end') && !empty($request->input('end'))) ) {
            $length = $request->length;
            $start = $request->start;
            $end = $request->end;
            
            return DB::table('dictionaries')->where('word', 'like', '%' . $contains .'%' )->where('word', 'like', $start . '%')->where('word', 'like', '%' .$end)->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();

        } else if (($request->has('length') && !empty($request->input('length'))) && ($request->has('start') && !empty($request->input('start'))) ) {
            $length = $request->length;
            $start = $request->start;

            return DB::table('dictionaries')->where('word', 'like', '%' . $contains.'%' )->where('word', 'like', $start . '%')->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } else if (($request->has('length') && !empty($request->input('length'))) && ($request->has('end') && !empty($request->input('end'))) ) {
            $length = $request->length;
            $end = $request->end;

            return DB::table('dictionaries')->where('word', 'like', '%' . $contains.'%' )->where('word', 'like', '%' . $end)->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } else if ($request->has('length') && !empty($request->input('length')) ) {
            $length = $request->length;

            return DB::table('dictionaries')->where('word', 'like', '%' . $contains.'%' )->whereRaw('LENGTH(word) = ' . $length)->take(1000)->get();
            
        } else if (($request->has('start') && !empty($request->input('start'))) && ($request->has('start') && !empty($request->input('start'))) ) {
            $start = $request->start;
            $end = $request->end;

            return DB::table('dictionaries')->where('word', 'like', '%' . $contains.'%' )->where('word', 'like', $start . '%')->where('word', 'like', '%' . $end)->take(1000)->get();
            
        } else if ($request->has('start') && !empty($request->input('start')) ) {
            $start = $request->start;

            return DB::table('dictionaries')->where('word', 'like',  '%' . $contains . '%' )->where('word', 'like', $start . '%')->take(1000)->get();
            
        } else if ($request->has('end') && !empty($request->input('end')) ) {
            $end = $request->end;

            return DB::table('dictionaries')->where('word', 'like', '%' . $contains . '%')->where('word', 'like', '%' . $end )->where('word', 'like', '%' . $end)->take(1000)->get();
            
        } 


    } else {
        return "error";
    }

    }
}
